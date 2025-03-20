<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentResource;
use App\Models\Business;
use App\Models\UserToken;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * Authenticate an existing Customer
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = $this->validate($request, [
            'agentId' => 'required',
            'password' => 'required',
        ]);

        $userExist = Business::where("agentId", $request->agentId)->first();

        if (!$userExist) {
            return ResponseHelper::error('We could not find a user with the provided credentials');
        }

        if (!$token = auth()->attempt($validator)) {
            return ResponseHelper::error('We could not authenticate the user with the provided credentials');
        }

        $customer = Auth::user();
        $customer->isLoggedInBefore = true;
        $customer->save();

        UserToken::create([
            'business_id' => Auth::user()->id,
            'token' => $token,
        ]);

        $data = AgentResource::make(Auth::user(), false);
        return ResponseHelper::successAuth($token, $data);

    }

    /**
     * updatePassword
     *
     * @param Request request
     *
     * @return void
     */
    public function changeDefaultPassword(Request $request)
    {
        $validator = $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        $customer = Auth::user();
        $customer->password = Hash::make($request->password);
        $customer->isDefaultPasswordChanged = true;
        if (!$customer->save()) {
            return ResponseHelper::error('Unable To Change Default Password');
        }

        return ResponseHelper::success('Default Password Changed Successfully');
    }

    /**
     * createTransactionPIN
     *
     * @param Request request
     *
     * @return void
     */
    public function createTransactionPIN(Request $request)
    {
        $validator = $this->validate($request, [
            'pin' => 'required|confirmed|digits:4',
        ]);

        $customer = Auth::user();
        $customer->pin = Hash::make($request->pin);
        $customer->isPinCreated = true;
        if (!$customer->save()) {
            return ResponseHelper::error('Something Went Wrong. Transaction PIN Creation Failed');
        }

        return ResponseHelper::success('Transaction PIN Created Successfully');
    }

    /**
     * logout
     *
     * @param Request request
     *
     * @return void
     */
    public function logout(Request $request)
    {

        // Fetch all tokens for the user
        $tokens = UserToken::where('business_id', Auth::user()->id)->get();

        // Invalidate and delete each token
        foreach ($tokens as $tk) {
            JWTAuth::setToken($tk->token)->invalidate();
            $tk->delete();
        }

        return ResponseHelper::success('User Successfully Logged Out');
    }
}
