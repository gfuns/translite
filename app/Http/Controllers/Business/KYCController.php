<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KYCController extends Controller
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
     * kycApplication
     *
     * @return void
     */
    public function kycApplication(Request $request)
    {
        if (isset($request->current) && $request->current == 2) {
            return view("business.kyc.personal_information");
        } else if (isset($request->current) && $request->current == 3) {
            return view("business.kyc.business_information");
        } else if (isset($request->current) && $request->current == 4) {
            return view("business.kyc.business_representatives");
        } else if (isset($request->current) && $request->current == 5) {
            return view("business.kyc.business_documents");
        } else if (isset($request->current) && $request->current == 6) {
            return view("business.kyc.support_information");
        } else if (isset($request->current) && $request->current == 7) {
            return view("business.kyc.bank_details");
        } else if (isset($request->current) && $request->current == 8) {
            return view("business.kyc.charges");
        } else {
            return view("business.kyc.apply");
        }
    }
}
