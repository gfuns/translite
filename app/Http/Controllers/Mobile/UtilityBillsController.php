<?php
namespace App\Http\Controllers\Mobile;

use App\Helpers\BalanceHelper;
use App\Helpers\FeeHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UtilityTransactionResource;
use App\Jobs\BankOneDebitCustomer;
use App\Mail\AirtimeNotification as AirtimeNotification;
use App\Mail\DataNotification as DataNotification;
use App\Mail\PowerNotification as PowerNotification;
use App\Mail\TVNotification as TVNotification;
use App\Models\BillTypes;
use App\Models\ServiceProviders;
use App\Models\UtilityTransaction;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Mail;

class UtilityBillsController extends Controller
{

    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * getBillTypes
     *
     * @return void
     */
    public function getBillTypes()
    {
        $billTypes = BillTypes::all();
        return ResponseHelper::success($billTypes);
    }

    /**
     * getPowerProviders
     *
     * @return void
     */
    public function getPowerProviders()
    {
        try {
            $response = Http::get(env("IRC_BASEURL") . '/get_electric_disco.php?response_format=json');
            if ($response->failed()) {
                return ResponseHelper::error('Failed to retrieve power billers', $response->status());
            }

            if ($response['status'] !== '00') {
                return ResponseHelper::error($response['message']);
            }

            $data = json_decode($response, true);
            return ResponseHelper::success($data);
        } catch (\Exception $e) {
            return ResponseHelper::error('Something Went Wrong, Please Try Again Later');
        }
    }

    /**
     * getMeterInfo
     *
     * @param Request request
     *
     * @return void
     */
    public function getMeterInfo(Request $request)
    {
        $validator = $this->validate($request, [
            'meterNo' => 'required|numeric',
            'disco'   => 'required',
        ]);

        try {
            $referenceId = random_int(100000000000, 999999999999);
            $meterNo     = $request->meterNo;
            $disco       = $request->disco;
            $vendorCode  = env("IRC_VENDOR_CODE");
            $hash        = "{$vendorCode}|{$referenceId}|{$meterNo}|{$disco}|" . env("IRC_PUB_KEY");
            $hash        = hash_hmac("sha1", $hash, env("IRC_PRV_KEY"));
            $url         = env("IRC_BASEURL") . "/get_meter_info.php?vendor_code=$vendorCode&reference_id=$referenceId&meter=$meterNo&disco=$disco&response_format=json&hash=$hash";
            $response    = Http::get($url);
            if ($response->failed()) {
                return ResponseHelper::error('Failed to retrieve meter information', $response->status());
            }

            if ($response['status'] !== '00') {
                return ResponseHelper::error($response['message']);
            }

            $data = json_decode($response, true);
            return ResponseHelper::success($data);
        } catch (\Exception $e) {
            return ResponseHelper::error('Something Went Wrong, Please Try Again Later');
        }
    }

    /**
     * vendPower
     *
     * @param Request request
     *
     * @return void
     */
    public function vendPower(Request $request)
    {
        $validator = $this->validate($request, [
            'meterNo'     => 'required',
            'accessToken' => 'required',
            'disco'       => 'required',
            'phoneNo'     => 'required|numeric',
            'amount'      => 'required|numeric',
        ]);

        try {

            DB::beginTransaction();

            $fee = FeeHelper::getPowerFee(Auth::user()->user_id, $request->amount);

            $total = ($request->amount + $fee);

            if (Auth::user()->balance->account_balance < $total) {
                return ResponseHelper::error('Insufficient Account Balance. Please Fund Your Account.');
            }

            $minAmount = 1000;

            if ($request->amount < $minAmount) {
                return ResponseHelper::error('Mininum Transaction Amount is N1000');
            }

            $vendorCode  = env("IRC_VENDOR_CODE");
            $referenceId = random_int(100000000000, 999999999999);
            $meterNo     = $request->meterNo;
            $accessToken = $request->accessToken;
            $disco       = $request->disco;
            $phoneNo     = $request->phoneNo;
            $email       = Auth::user()->email;
            $amount      = $request->amount;
            $hash        = "{$vendorCode}|{$referenceId}|{$meterNo}|{$disco}|{$amount}|{$accessToken}|" . env("IRC_PUB_KEY");
            $hash        = hash_hmac("sha1", $hash, env("IRC_PRV_KEY"));
            $url         = env("IRC_BASEURL") . "/vend_power.php?vendor_code=$vendorCode&reference_id=$referenceId&meter=$meterNo&access_token=$accessToken&disco=$disco&phone=$phoneNo&email=$email&response_format=json&hash=$hash&amount=$amount";

            $response = Http::get($url);
            if ($response->failed()) {
                return ResponseHelper::error('Failed to Vend Power', $response->status());
            }

            if ($response['status'] !== '00') {
                return ResponseHelper::error($response['message']);
            }

            $data = json_decode($response, true);

            $transaction = UtilityTransaction::create([
                'business_id'       => Auth::user()->id,
                'service'           => 'Power',
                'biller'            => $request->disco,
                'recipient'         => $request->meterNo,
                'amount'            => $request->amount,
                'trx_fee'           => $fee,
                'reference'         => $this->genTrxId(),
                'irc_reference'     => $data['ref'],
                'units'             => $data['units'],
                'recipient_address' => $data['address'],
                'recharge_token'    => $data['meter_token'],
                'status'            => $data['status'] === '00' ? "successful" : "failed",
                'access_token'      => $request->accessToken,
                'generated_hash'    => $hash, //$data["response_hash"],
            ]);

            TransactionHelper::logPowerTransaction($transaction);

            BalanceHelper::deductFromBalance(Auth::user()->id, $total);

            BankOneDebitCustomer::dispatchSync($transaction->id);

            DB::commit();

            try {
                $user = Auth::user();
                Mail::to($user)->send(new PowerNotification($user, $transaction));
            } catch (\Exception $e) {
                report($e);
            } finally {

                return ResponseHelper::success($data);
            }

        } catch (\Exception $e) {
            DB::rollback();

            report($e);

            return ResponseHelper::error('Something Went Wrong, Please Try Again Later');
        }

    }

    /**
     * getAirtimeProviders
     *
     * @return void
     */
    public function getAirtimeProviders()
    {
        $serviceProviders = ServiceProviders::where("category", "airtime/data")->get();
        return ResponseHelper::success($serviceProviders);
    }

    /**
     * vendAirtime
     *
     * @param Request request
     *
     * @return void
     */
    public function vendAirtime(Request $request)
    {
        $validator = $this->validate($request, [
            'provider' => 'required',
            'phoneNo'  => 'required|numeric',
            'amount'   => 'required|numeric',
        ]);

        try {

            DB::beginTransaction();

            $fee = FeeHelper::getAirtimeFee(Auth::user()->user_id, $request->amount);

            $total = ($request->amount + $fee);

            if (Auth::user()->balance->account_balance < $total) {
                return ResponseHelper::error('Insufficient Account Balance. Please Fund Your Account.');
            }

            $vendorCode  = env("IRC_VENDOR_CODE");
            $referenceId = random_int(100000000000, 999999999999);
            $provider    = $request->provider;
            $phone       = $request->phoneNo;
            $email       = Auth::user()->email;
            $amount      = $request->amount;
            $hash        = "{$vendorCode}|{$referenceId}|{$phone}|{$provider}|{$amount}|" . env("IRC_PUB_KEY");
            $hash        = hash_hmac("sha1", $hash, env("IRC_PRV_KEY"));
            $url         = env("IRC_BASEURL") . "/vend_airtime.php?vendor_code=$vendorCode&vtu_network=$provider&vtu_number=$phone&response_format=json&vtu_amount=$amount&reference_id=$referenceId&vtu_email=$email&hash=$hash";
            $response    = Http::get($url);

            if ($response->failed()) {
                return ResponseHelper::error('Failed to Vend Airtime', $response->status());
            }

            if ($response['status'] !== '00') {
                return ResponseHelper::error($response['message']);
            }

            $data = json_decode($response, true);

            $transaction = UtilityTransaction::create([
                'business_id'    => Auth::user()->id,
                'service'        => 'Airtime',
                'biller'         => $request->provider,
                'recipient'      => $request->phoneNo,
                'amount'         => $request->amount,
                'trx_fee'        => $fee,
                'reference'      => $this->genTrxId(),
                'irc_reference'  => $data['ref'],
                'access_token'   => $data['ref'],
                'generated_hash' => $hash, //$data["response_hash"],
                'status'         => $data['status'] === '00' ? "successful" : "failed",
            ]);

            TransactionHelper::logAirtimeTransaction($transaction);

            BalanceHelper::deductFromBalance(Auth::user()->id, $total);

            BankOneDebitCustomer::dispatchSync($transaction->id);

            DB::commit();

            try {
                $user = Auth::user();
                Mail::to($user)->send(new AirtimeNotification($user, $transaction));
            } catch (\Exception $e) {
                report($e);
            } finally {

                return ResponseHelper::success($data);
            }

        } catch (\Exception $e) {
            DB::rollback();

            report($e);

            return ResponseHelper::error('Something Went Wrong, Please Try Again Later');
        }
    }

    /**
     * getDataProviders
     *
     * @return void
     */
    public function getDataProviders()
    {
        $serviceProviders = ServiceProviders::where("category", "airtime/data")->get();
        return ResponseHelper::success($serviceProviders);
    }

    /**
     * getDataBundles
     *
     * @param Request request
     *
     * @return void
     */
    public function getDataBundles(Request $request)
    {
        $validator = $this->validate($request, [
            'provider' => 'required',
        ]);

        try {
            $network  = $request->provider;
            $url      = env("IRC_BASEURL") . "/get_data_bundles.php?response_format=json&data_network=$network";
            $response = Http::get($url);

            if ($response->failed()) {
                return ResponseHelper::error('Failed to retrieve data bundles', $response->status());
            }

            if ($response['status'] !== '00') {
                return ResponseHelper::error($response['message']);
            }

            $data = json_decode($response, true);
            return ResponseHelper::success($data);
        } catch (\Exceprion $e) {
            return ResponseHelper::error('Something Went Wrong, Please Try Again Later');
        }
    }

    /**
     * vendData
     *
     * @param Request request
     *
     * @return void
     */
    public function vendData(Request $request)
    {
        $validator = $this->validate($request, [
            'provider' => 'required',
            'phoneNo'  => 'required|numeric',
            'dataCode' => 'required',
            'amount'   => 'required',
        ]);

        try {
            DB::beginTransaction();

            $fee = FeeHelper::getDataFee(Auth::user()->user_id, $request->amount);

            $total = ($request->amount + $fee);

            if (Auth::user()->balance->account_balance < $total) {
                return ResponseHelper::error('Insufficient Account Balance. Please Fund Your Account.');
            }

            $vendorCode  = env("IRC_VENDOR_CODE");
            $network     = $request->provider;
            $referenceId = random_int(100000000000, 999999999999);
            $phone       = $request->phoneNo;
            $dataCode    = $request->dataCode;
            $email       = Auth::user()->email;
            $hash        = "{$vendorCode}|{$referenceId}|{$phone}|{$network}|{$dataCode}|" . env("IRC_PUB_KEY");
            $hash        = hash_hmac("sha1", $hash, env("IRC_PRV_KEY"));
            $url         = env("IRC_BASEURL") . "/vend_data.php?vendor_code=$vendorCode&vtu_network=$network&reference_id=$referenceId&vtu_number=$phone&vtu_data=$dataCode&response_format=json&hash=$hash&email=$email";
            $response    = Http::get($url);

            if ($response->failed()) {
                return ResponseHelper::error('Failed to vend data', $response->status());
            }

            if ($response['status'] !== '00') {
                return ResponseHelper::error($response['message']);
            }

            $data = json_decode($response, true);

            $transaction = UtilityTransaction::create([
                'business_id'       => Auth::user()->id,
                'service'           => 'Data',
                'biller'            => $request->provider,
                'recipient'         => $request->phoneNo,
                'amount'            => $data['amount'],
                'trx_fee'           => $fee,
                'reference'         => $this->genTrxId(),
                'irc_reference'     => $data['ref'],
                'subscription_plan' => $data['order'],
                'access_token'      => $data['ref'],
                'generated_hash'    => $hash, //$data["response_hash"],
                'status'            => $data['status'] === '00' ? "successful" : "failed",
            ]);

            TransactionHelper::logDataTransaction($transaction);

            BalanceHelper::deductFromBalance(Auth::user()->id, $total);

            BankOneDebitCustomer::dispatchSync($transaction->id);

            DB::commit();

            try {
                $user = Auth::user();
                Mail::to($user)->send(new DataNotification($user, $transaction));
            } catch (\Exception $e) {
                report($e);
            } finally {

                return ResponseHelper::success($data);
            }

        } catch (\Exception $e) {
            DB::rollback();

            report($e);

            return ResponseHelper::error('Something Went Wrong, Please Try Again Later ' . $e->getMessage());
        }
    }

    /**
     * getTvProviders
     *
     * @return void
     */
    public function getTvProviders()
    {
        $serviceProviders = ServiceProviders::where("category", "tv")->get();
        return ResponseHelper::success($serviceProviders);
    }

    /**
     * getTvBouquets
     *
     * @param Request request
     *
     * @return void
     */
    public function getTvBouquets(Request $request)
    {
        $validator = $this->validate($request, [
            'provider' => 'required',
        ]);

        try {
            $tvNetwork = $request->provider;
            $url       = env("IRC_BASEURL") . "/get_tv_bouquet.php?tv_network=$tvNetwork&response_format=json";
            $response  = Http::get($url);
            if ($response->failed()) {
                return ResponseHelper::error('Failed to retrieve TV Bouquets', $response->status());
            }

            if ($response['status'] !== '00') {
                return ResponseHelper::error($response['message']);
            }

            if ($tvNetwork == "StarTimes") {
                $responseData    = json_decode($response, true);
                $cleanedResponse = collect($responseData["bundles"])
                    ->filter(fn($value, $key) => is_array($value) && is_numeric($key))
                    ->values(); // Reset the keys for the cleaned data
                $data = [
                    "status"  => "00",
                    "message" => "Successful",
                    "bundles" => $cleanedResponse,
                ];
                return ResponseHelper::success($data);
            } else {
                $data = json_decode($response, true);
                return ResponseHelper::success($data);
            }

        } catch (\Exception $e) {
            return ResponseHelper::error('Something Went Wrong, Please Try Again Later' . $e->getMessage());
        }
    }

    /**
     * getSmartCardInfo
     *
     * @param Request request
     *
     * @return void
     */
    public function getSmartCardInfo(Request $request)
    {
        $validator = $this->validate($request, [
            'provider'    => 'required',
            'serviceCode' => 'required',
            'smartcardNo' => 'required',
            'amount'      => 'required_if:provider,StarTimes',
        ]);

        try {
            $vendorCode      = env("IRC_VENDOR_CODE");
            $referenceId     = random_int(100000000000, 999999999999);
            $serviceCode     = $request->serviceCode;
            $tvNetwork       = $request->provider;
            $smartcardNumber = $request->smartcardNo;
            $hash            = "{$vendorCode}|{$referenceId}|{$tvNetwork}|{$smartcardNumber}|{$serviceCode}|" . env("IRC_PUB_KEY");
            $hash            = hash_hmac("sha1", $hash, env("IRC_PRV_KEY"));
            $url             = env("IRC_BASEURL") . "/get_smartcard_info.php?vendor_code=$vendorCode&response_format=json&hash=$hash&reference_id=$referenceId&service_code=$serviceCode&tv_network=$tvNetwork&smartcard_number=$smartcardNumber";
            $response        = Http::get($url);
            if ($response->failed()) {
                return ResponseHelper::error('Failed to retrieve smartcard information', $response->status());
            }

            if ($response['status'] !== '00') {
                return ResponseHelper::error($response['message']);
            }

            $data = json_decode($response, true);
            return ResponseHelper::success($data);
        } catch (\Exception $e) {
            return ResponseHelper::error('Something Went Wrong, Please Try Again Later');
        }
    }

    /**
     * vendTvSubscription
     *
     * @param Request request
     *
     * @return void
     */
    public function vendTvSubscription(Request $request)
    {
        $validator = $this->validate($request, [
            'provider'        => 'required',
            'serviceCode'     => 'required',
            'smartcardNumber' => 'required',
            'accessToken'     => 'required',
            'phoneNo'         => 'required|numeric',
            'amount'          => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $fee = FeeHelper::getTvFee(Auth::user()->user_id, $request->amount);

            $total = ($request->amount + $fee);

            if (Auth::user()->balance->account_balance < $total) {
                return ResponseHelper::error('Insufficient Account Balance. Please Fund Your Account.');
            }

            $vendorCode      = env("IRC_VENDOR_CODE");
            $referenceId     = random_int(100000000000, 999999999999);
            $smartcardNumber = $request->smartcardNumber;
            $accessToken     = $request->accessToken;
            $tvNetwork       = $request->provider;
            $serviceCode     = $request->serviceCode;
            $email           = Auth::user()->email;
            $phoneNumber     = $request->phoneNo;
            $hash            = "{$vendorCode}|{$referenceId}|{$smartcardNumber}|{$tvNetwork}|{$serviceCode}|{$accessToken}|" . env("IRC_PUB_KEY");
            $hash            = hash_hmac("sha1", $hash, env("IRC_PRV_KEY"));
            $url             = env("IRC_BASEURL") . "/vend_tv.php?vendor_code=$vendorCode&response_format=json&hash=$hash&reference_id=$referenceId&service_code=$serviceCode&tv_network=$tvNetwork&smartcard_number=$smartcardNumber&access_token=$accessToken&email=$email&phone=$phoneNumber";
            $response        = Http::get($url);

            if ($response->failed()) {
                return ResponseHelper::error('Failed to Vend TV', $response->status());
            }

            if ($response['status'] !== '00') {
                return ResponseHelper::error($response['message']);
            }

            $data = json_decode($response, true);

            $transaction = UtilityTransaction::create([
                'business_id'       => Auth::user()->id,
                'service'           => 'TV',
                'biller'            => $request->provider,
                'recipient'         => $request->smartcardNumber,
                'amount'            => $request->amount,
                'trx_fee'           => $fee,
                'reference'         => $this->genTrxId(),
                'irc_reference'     => $data['ref'] === null ? $data['response_hash'] : $data['ref'],
                'status'            => $data['status'] === '00' ? "successful" : "failed",
                'access_token'      => $request->accessToken,
                'generated_hash'    => $hash, //$data["response_hash"],
                'subscription_plan' => $data['order'],
            ]);

            TransactionHelper::logTvTransaction($transaction);

            BalanceHelper::deductFromBalance(Auth::user()->id, $total);

            BankOneDebitCustomer::dispatchSync($transaction->id);

            DB::commit();

            try {
                $user = Auth::user();
                Mail::to($user)->send(new TVNotification($user, $transaction));
            } catch (\Exception $e) {
                report($e);
            } finally {

                return ResponseHelper::success($data);
            }
        } catch (\Exception $e) {
            DB::rollback();

            report($e);
            return ResponseHelper::error('Something Went Wrong, Please Try Again Later');
        }
    }

    /**
     * utilityTransactions
     *
     * @return void
     */
    public function transactionHistory(Request $request)
    {
        if (isset($request->filterParam)) {
            $transactions = UtilityTransaction::orderBy("id", "desc")->where('business_id', Auth::user()->id)->where("service", ucwords($request->filterParam))->get();
        } else {
            $transactions = UtilityTransaction::orderBy("id", "desc")->where('business_id', Auth::user()->id)->get();
        }
        $data = UtilityTransactionResource::collection($transactions);
        return ResponseHelper::success($data);
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
