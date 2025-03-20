<?php
namespace App\Http\Controllers;

use App\Helpers\BalanceHelper;
use App\Helpers\FeeHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Mail\InwardTransferNotification as InwardTransferNotification;
use App\Mail\PosWithdrawalNotification as PosWithdrawalNotification;
use App\Models\Business;
use App\Models\PosWithdrawals;
use App\Models\Terminals;
use App\Models\TransferTrxs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class WebhookController extends Controller
{
    /**
     * bankOneNotification
     *
     * @param Request request
     *
     * @return void
     */
    public function bankOneNotification(Request $request)
    {
        \Log::info("Logging Incoming Transfer Notification");
        \Log::info($request->all());

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
                    Mail::to($business)->send(new InwardTransferNotification($business, $transfer));
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
     * transliteNotification
     *
     * @param Request request
     *
     * @return void
     */
    public function transliteNotification(Request $request)
    {
        \Log::info("Logging Incoming POS Withdrawal Notification");
        \Log::info($request->all());

        $transaction = PosWithdrawals::where("reference", $request->reference)->first();
        if (isset($transaction)) {
            if ($transaction->treated == 0) {

                if ($request->status == "successful" || $request->status == "failed" || $request->status == "reversed") {
                    try {
                        DB::beginTransaction();

                        $transaction->bank             = $request->bank;
                        $transaction->masked_pan       = $request->maskedPan;
                        $transaction->stan             = $request->stan;
                        $transaction->description      = $request->narration;
                        $transaction->gateway          = $request->gateway;
                        $transaction->charge           = $request->charge;
                        $transaction->gateway_response = $request->gatewayResponse;
                        $transaction->status           = $request->status;
                        $transaction->treated          = 1;
                        $transaction->save();

                        //Deduct From Balance Only if Transaction is Successful
                        if ($request->status == "successful") {
                            $totalDeduction = ($transaction->amount + $transaction->fee);
                            BalanceHelper::deductFromBalance($transaction->business_id, $totalDeduction);
                        }

                        DB::commit();

                        try {
                            $user = Business::find($transaction->business_id);
                            Mail::to($user)->send(new PosWithdrawalNotification($user, $transaction));
                        } catch (\Exception $e) {
                            report($e);
                        } finally {
                            \Log::info("Transaction with the provided Reference: {$request->reference} processed successfully.");
                            return ResponseHelper::successOk("Transaction with the provided Reference: {$request->reference} Successfully Processed.");
                        }
                    } catch (\Exception $e) {
                        DB::rollback();

                        report($e);

                        return ResponseHelper::error($e->getMessage());
                    }

                } else {
                    $transaction->status = "pending";
                    $transaction->save();
                    return ResponseHelper::error("Transaction with the provided Reference: {$request->reference} is still pending.");
                }
            } else {
                \Log::info("Transaction with the provided Reference: {$request->reference} has been previously processed successfully.");
                return ResponseHelper::successOk("Transaction with the provided Reference: {$request->reference} has been previously processed successfully.");
            }
        } else {
            \Log::info("Transaction with the provided Reference: {$request->reference} does not exist on our records");
            return ResponseHelper::error("Transaction with the provided Reference: {$request->reference} does not exist on our records.");
        }
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
