<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessKeys;
use Auth;
use Illuminate\Http\Request;
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

    /**
     * notificationSettings
     *
     * @return void
     */
    public function notificationSettings()
    {
        return view("business.settings.notifications");
    }

    /**
     * businessRepresentatives
     *
     * @return void
     */
    public function businessRepresentatives()
    {
        return view("business.settings.representatives");
    }

    /**
     * paymentSettings
     *
     * @return void
     */
    public function paymentSettings()
    {
        return view("business.settings.payment");
    }

    /**
     * businessType
     *
     * @return void
     */
    public function businessType()
    {
        return view("business.settings.business_type");
    }

    /**
     * businessDocuments
     *
     * @return void
     */
    public function businessDocuments()
    {
        return view("business.settings.business_documents");
    }

    /**
     * updateLogo
     *
     * @param Request request
     *
     * @return void
     */
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // $logoName = time() . '.' . $request->logo->extension();
            // $request->logo->move(public_path('logos'), $logoName);

            return response()->json([
                'success' => true,
                'message' => 'Logo updated successfully!',
                // 'logo'    => asset('logos/' . $logoName), // Return new logo URL
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Failed to upload logo'], 400);
    }
}
