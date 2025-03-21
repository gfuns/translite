<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessKeys;
use Auth;
use Illuminate\Support\Facades\Crypt;

class SettingsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * webhookLogs
     *
     * @return void
     */
    public function settings()
    {
        return view("business.settings.home");
    }

    /**
     * userProfile
     *
     * @return void
     */
    public function userProfile()
    {
        $google2fa       = app('pragmarx.google2fa');
        $google2faSecret = $google2fa->generateSecretKey();
        $QRImage         = $google2fa->getQRCodeInline(
            env('APP_NAME'),
            Auth::user()->email,
            $google2faSecret,
            140
        );
        return view("business.settings.profile", compact("google2faSecret", "QRImage"));
    }

    /**
     * apiKeys
     *
     * @return void
     */
    public function apiKeys()
    {
        $keys      = BusinessKeys::where("business_id", Auth::user()->business->id)->first();
        $publicKey = $keys->public_key;
        $secretKey = Crypt::decrypt($keys->secret_key);
        return view("business.settings.api_keys", compact("publicKey", "secretKey"));
    }

    /**
     * webhooks
     *
     * @return void
     */
    public function webhooks()
    {
        return view("business.settings.webhook");
    }

    /**
     * settlements
     *
     * @return void
     */
    public function settlements()
    {
        return view("business.settings.settlement");
    }

    /**
     * dynamicSettlement
     *
     * @return void
     */
    public function dynamicSettlement()
    {
        return view("business.settings.services");
    }

    /**
     * settlementAccounts
     *
     * @return void
     */
    public function settlementAccounts()
    {
        return view("business.settings.accounts");
    }

    /**
     * businessDetails
     *
     * @return void
     */
    public function businessDetails()
    {
        return view("business.settings.business_details");
    }
}
