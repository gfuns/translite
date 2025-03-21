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

    public function apiKeys()
    {
        $keys      = BusinessKeys::where("business_id", Auth::user()->business->id)->first();
        $publicKey = $keys->public_key;
        $secretKey = Crypt::decrypt($keys->secret_key);
        return view("business.settings.api_keys", compact("publicKey", "secretKey"));
    }
}
