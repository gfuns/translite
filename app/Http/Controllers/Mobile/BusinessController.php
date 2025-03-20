<?php
namespace App\Http\Controllers\Mobile;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentResource;
use App\Http\Resources\CustomerTransactionResource;
use App\Http\Resources\DashboardResource;
use App\Models\CustomerNotifications;
use App\Models\CustomerTransactions;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class BusinessController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * agentDashboard
     *
     * @return void
     */
    public function agentDashboard()
    {
        $data = DashboardResource::make(Auth::user(), false);
        return ResponseHelper::success($data);
    }

    /**
     * agentProfile
     *
     * @return void
     */
    public function agentProfile()
    {
        $data = AgentResource::make(Auth::user(), false);
        return ResponseHelper::success($data);
    }

    /**
     * validateCurrentPassword
     *
     * @param Request request
     *
     * @return void
     */
    public function validateCurrentPassword(Request $request)
    {
        $validator = $this->validate($request, [
            'current_password' => 'required',
        ]);

        $customer = Auth::user();

        if (! Hash::check($request->current_password, $customer->password)) {

            return ResponseHelper::error("Invalid Password Provided");

        }

        return ResponseHelper::success("Password entered by user is correct");
    }

    /**
     * updatePassword
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePassword(Request $request)
    {
        $validator = $this->validate($request, [
            'new_password' => 'required|confirmed',
        ]);

        $customer = Auth::user();

        $customer->password = Hash::make($request->new_password);
        if (! $customer->save()) {
            return ResponseHelper::error("Something Went Wrong. Password Update Faield");
        }

        return ResponseHelper::success("Password Updated Successfully");

    }

    /**
     * validateCurrentPIN
     *
     * @param Request request
     *
     * @return void
     */
    public function validateCurrentPIN(Request $request)
    {
        $validator = $this->validate($request, [
            'current_pin' => 'required',
        ]);

        $customer = Auth::user();

        if (! Hash::check($request->current_pin, $customer->pin)) {

            return ResponseHelper::error("Invalid Transaction Transfer PIN Provided");

        }

        return ResponseHelper::success("Transaction PIN entered by user is correct");
    }

    /**
     * updatePIN
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePIN(Request $request)
    {
        $validator = $this->validate($request, [
            'new_pin' => 'required|confirmed|digits:4',
        ]);

        $customer = Auth::user();

        $customer->pin = Hash::make($request->new_pin);
        if (! $customer->save()) {
            return ResponseHelper::error("Something Went Wrong. Transaction PIN Update Failed");
        }

        return ResponseHelper::success("Transaction PIN Updated Successfully");

    }

    /**
     * transactionHistory
     *
     * @return void
     */
    public function transactionHistory()
    {
        $transactions = CustomerTransactions::orderBy("id", "desc")->where('business_id', Auth::user()->id)->get();
        $data         = $transactions->flatMap(function ($transaction) {
            return (new CustomerTransactionResource($transaction))->toArray(request());
        });
        return ResponseHelper::success($data);
    }

    /**
     * notifications
     *
     * @return void
     */
    public function notifications()
    {
        $notifactions = CustomerNotifications::orderBy("id", "desc")->where('business_id', Auth::user()->id)->get();
        return ResponseHelper::success($notifactions);
    }

    /**
     * readNotification
     *
     * @param mixed id
     *
     * @return void
     */
    public function readNotification($id)
    {
        $notifaction = CustomerNotifications::find($id);
        if (isset($notifaction)) {
            $notifaction->read = true;
            if ($notifaction->save()) {
                return ResponseHelper::success($notifaction);
            } else {
                return ResponseHelper::error("Something Went Wrong. Please Try Again Late.");
            }
        } else {
            return ResponseHelper::error("Something Went Wrong. We could not find this notification.");
        }
    }

    /**
     * balanceEnquiry
     *
     * @return void
     */
    public function balanceEnquiry()
    {
        $data = [
            "AccountBalance" => Auth::user()->balance->account_balance,
        ];

        return ResponseHelper::success($data);

        $baseURL       = env("BANK_ONE_BASE_URL");
        $authtoken     = env("MY_BANK_ONE_AUTH_TOKEN");
        $accountNumber = Auth::user()->accountNumber;
        $url           = "{$baseURL}/BankOneWebAPI/api/Account/GetAccountByAccountNumber/2?authtoken={$authtoken}&accountNumber={$accountNumber}&computewithdrawableBalance=true";

        $response = Http::get($url);
        if ($response->failed()) {
            return ResponseHelper::error('Failed to retrieve commercial banks');
        }

        $data = json_decode($response, true);
        return ResponseHelper::success($data);
    }

    /**
     * accountDetails
     *
     * @param Request request
     *
     * @return void
     */
    public function accountDetails(Request $request)
    {
        $validator = $this->validate($request, [
            'accountNumber' => 'required',
        ]);

        $baseURL  = env("BANK_ONE_BASE_URL");
        $url      = "{$baseURL}/Thirdpartyapiservice/apiservice/Account/AccountEnquiry";
        $postData = [
            'AccountNo'          => $request->accountNumber,
            'AuthenticationCode' => env("MY_BANK_ONE_AUTH_TOKEN"),
        ];

        $response = Http::post($url, $postData);

        if ($response->failed()) {
            return ResponseHelper::error('Failed to validate bank details');
        }

        $data = json_decode($response, true);
        return ResponseHelper::success($data);
    }
}
