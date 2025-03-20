<?php
namespace App\Http\Controllers\Mobile;

use App\Helpers\BalanceHelper;
use App\Helpers\FeeHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransferTransactionResource;
use App\Mail\InwardTransferNotification as InwardTransferNotification;
use App\Mail\OutwardTransferNotification as OutwardTransferNotification;
use App\Models\Banks;
use App\Models\Business;
use App\Models\Terminals;
use App\Models\TransferTrxs;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Mail;

class TransferController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * simulateInwardTransfer
     *
     * @param Request request
     *
     * @return void
     */
    public function simulateInwardTransfer(Request $request)
    {
        $validator = $this->validate($request, [
            'senderName'        => 'required',
            'senderBank'        => 'required',
            'senderAccount'     => 'required',
            'receiverAccount'   => 'required',
            'amountTransferred' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $business = Business::where("accountNumber", $request->receiverAccount)->first();
            if (isset($business)) {
                $terminal = Terminals::find($business->terminal_id);
                $fee      = FeeHelper::getInwardTransferFee($business->user_id, $request->amountTransferred);

                $transfer                   = new TransferTrxs;
                $transfer->business_id      = $business->id;
                $transfer->terminal_id      = $business->terminal_id;
                $transfer->category         = "inward";
                $transfer->reference        = $this->genTrxId();
                $transfer->terminal_model   = $terminal->model;
                $transfer->tid              = $terminal->terminal_id;
                $transfer->terminal_sno     = $terminal->serial_number;
                $transfer->sender_name      = $request->senderName;
                $transfer->sender_bank      = $request->senderBank;
                $transfer->sender_account   = $request->senderAccount;
                $transfer->receiver_name    = $request->receiverName;
                $transfer->receiver_bank    = $request->receiverBank;
                $transfer->receiver_account = $request->receiverAccount;
                $transfer->description      = $request->description;
                $transfer->amount           = $request->amountTransferred;
                $transfer->amount_kobo      = ($request->amountTransferred * 100);
                $transfer->fee              = $fee;
                $transfer->total            = (double) ($fee + $request->amountTransferred);
                $transfer->status           = "successful";
                $transfer->save();

                TransactionHelper::logInwardTransfer($transfer);
                BalanceHelper::addToBalance($transfer->business_id, $transfer->total);

                DB::commit();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new InwardTransferNotification($user, $transfer));
                } catch (\Exception $e) {
                    report($e);
                } finally {

                    return ResponseHelper::success($transfer);
                }

            } else {
                return ResponseHelper::error('We could not find an account with the provided Receiver Account');
            }
        } catch (\Exception $e) {
            DB::rollback();

            report($e);

            return ResponseHelper::error('Something Went Wrong. Please Try Again Later.');
        }
    }

    /**
     * transferDetails
     *
     * @param mixed reference
     *
     * @return void
     */
    public function transferDetails($reference)
    {
        $trx = TransferTrxs::where("business_id", Auth::user()->id)->where("reference", $reference)->first();
        if (isset($trx)) {
            return ResponseHelper::success($trx);
        } else {
            return ResponseHelper::error('We could not find a transaction with the provided reference');
        }
    }

    /**
     * transferHistory
     *
     * @return void
     */
    public function transferHistory()
    {
        $trxs = TransferTrxs::orderBy("id", "desc")->where("business_id", Auth::user()->id)->get();
        $data = TransferTransactionResource::collection($trxs);
        return ResponseHelper::success($data);
    }

    /**
     * getBanks
     *
     * @return void
     */
    public function getBanks()
    {
        $baseURL   = env("BANK_ONE_BASE_URL");
        $authToken = env("MY_BANK_ONE_AUTH_TOKEN");
        $url       = "{$baseURL}/ThirdPartyAPIService/APIService/BillsPayment/GetCommercialBanks/{$authToken}";
        $response  = Http::get($url);
        if ($response->failed()) {
            return ResponseHelper::error('Failed to retrieve commercial banks');
        }

        $data = json_decode($response, true);
        return ResponseHelper::success($data);

        // foreach ($data as $dd) {
        //     $bank            = new Banks;
        //     $bank->bank_code = $dd["Code"];
        //     $bank->bank_name = $dd["Name"];
        //     $bank->save();
        // }
    }

    /**
     * nameEnquiry
     *
     * @param Request request
     *
     * @return void
     */
    public function nameEnquiry(Request $request)
    {
        $validator = $this->validate($request, [
            'bankCode'      => 'required',
            'accountNumber' => 'required',
        ]);

        $baseURL = env("BANK_ONE_BASE_URL");
        $url     = "{$baseURL}/thirdpartyapiservice/apiservice/Transfer/NameEnquiry";

        $postData = [
            'AccountNumber' => $request->accountNumber,
            'bankCode'      => $request->bankCode,
            'Token'         => env("MY_BANK_ONE_AUTH_TOKEN"),
        ];

        $response = Http::post($url, $postData);

        if ($response->failed()) {
            return ResponseHelper::error('Failed to validate bank details');
        }

        $data = json_decode($response, true);
        return ResponseHelper::success($data);
    }

    /**
     * initiateOutwardTransfer
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateOutwardTransfer(Request $request)
    {
        $validator = $this->validate($request, [
            'receiverName'      => 'required',
            'bankCode'          => 'required',
            'accountNumber'     => 'required',
            'amountTransferred' => 'required|numeric',
        ]);

        $senderName    = Auth::user()->agentFirstName . " " . Auth::user()->agentLastName . " " . Auth::user()->agentOtherNames;
        $senderBank    = Auth::user()->bankName;
        $senderAccount = Auth::user()->accountNumber;
        $terminal      = Terminals::find(Auth::user()->terminal_id);
        $fee           = FeeHelper::getOutwardTransferFee(Auth::user()->user_id, $request->amountTransferred);
        $bank          = Banks::where("bank_code", $request->bankCode)->first();

        $transfer                   = new TransferTrxs;
        $transfer->business_id      = Auth::user()->id;
        $transfer->terminal_id      = Auth::user()->terminal_id;
        $transfer->category         = "outward";
        $transfer->reference        = $this->genTrxId();
        $transfer->terminal_model   = $terminal->model;
        $transfer->tid              = $terminal->terminal_id;
        $transfer->terminal_sno     = $terminal->serial_number;
        $transfer->sender_name      = $senderName;
        $transfer->sender_bank      = $senderBank;
        $transfer->sender_account   = $senderAccount;
        $transfer->receiver_name    = $request->receiverName;
        $transfer->receiver_bank    = $bank->bank_name;
        $transfer->receiver_account = $request->accountNumber;
        $transfer->description      = $request->description;
        $transfer->amount           = $request->amountTransferred;
        $transfer->amount_kobo      = ($request->amountTransferred * 100);
        $transfer->fee              = $fee;
        $transfer->total            = (double) ($fee + $request->amountTransferred);
        $transfer->status           = "pending";
        if ($transfer->save()) {

            try {

                ini_set('max_execution_time', 600); // 10 minutes

                ini_set('memory_limit', '1G'); // 1 GB of memory

                $baseURL = env("BANK_ONE_BASE_URL");
                $url     = "{$baseURL}/thirdpartyapiservice/apiservice/Transfer/InterBankTransfer";

                $postData = [
                    'Amount'                => ($request->amountTransferred * 100),
                    'Payer'                 => $senderName,
                    'PayerAccountNumber'    => $senderAccount,
                    'ReceiverAccountNumber' => $request->accountNumber,
                    'ReceiverAccountType'   => "00",
                    'ReceiverBankCode'      => $request->bankCode,
                    'ReceiverName'          => $request->receiverName,
                    'Narration'             => $transfer->description,
                    'TransactionReference'  => $transfer->reference,
                    'NIPSessionID'          => $request->sessionID,
                    'Token'                 => env("MY_BANK_ONE_AUTH_TOKEN"),
                ];

                $response = Http::timeout(600)->post($url, $postData);

                $data = json_decode($response, true);

                if ($response->failed() || $data["Status"] == "Failed") {
                    return ResponseHelper::error($data["StatusDescription"]);
                }

                if ($data["Status"] == "Pending") {
                    $transfer->status = "pending";
                    $transfer->save();

                    return ResponseHelper::pending($data);
                }

                $transfer->status = "successful";
                $transfer->save();
                BalanceHelper::deductFromBalance(Auth::user()->id, $request->amount);
                TransactionHelper::logOutwardTransfer($transfer);

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new OutwardTransferNotification($user, $transfer));
                } catch (\Exception $e) {
                    report($e);
                } finally {

                    return ResponseHelper::success($data);
                }
            } catch (\Exception $e) {
                $transfer->status = "failed";
                $transfer->save();

                return ResponseHelper::timeout("Service took too long too respond. Connection closed.");
            }

        } else {
            return ResponseHelper::error("Something went wrong.");
        }
    }

    /**
     * generateUniqueReferences
     *
     * @param mixed length
     * @param mixed quantity
     *
     * @return void
     */
    public function generateUniqueReferences($length = 8, $quantity = 12)
    {
        // Ensure the length does not exceed 12 characters
        $length = min($length, 12);

        // Generate a unique reference using hash and substr
        return strtoupper(substr(bin2hex(random_bytes(6)), 0, $length));
    }

    /**
     * genTrxId
     *
     * @return void
     */
    public function genTrxId()
    {
        // Get the current timestamp
        $timestamp = (string) (strtotime('now') . microtime(true));

        // Remove any non-numeric characters (like dots)
        $cleanedTimestamp = preg_replace('/[^0-9]/', '', $timestamp);

        // Shuffle the digits
        $shuffled = str_shuffle($cleanedTimestamp);

        // Extract the first 12 characters
        $code = substr($shuffled, 0, 12);

        return $code;
    }

}
