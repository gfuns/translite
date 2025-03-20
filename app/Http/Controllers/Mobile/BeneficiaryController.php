<?php
namespace App\Http\Controllers\Mobile;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BeneficiaryResource;
use App\Models\Beneficiaries;
use Auth;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * addBeneficiary
     *
     * @param Request request
     *
     * @return void
     */
    public function addBeneficiary(Request $request)
    {
        $validator = $this->validate($request, [
            'providerName' => 'required',
            'service'      => 'required|in:tv,power,transfer,airtime/data',
            'beneficiary'  => 'required',
            'recipient'    => 'required',
        ]);

        $isExisting = Beneficiaries::where("service", $request->service)->where("provider", $request->providerName)->where("recipient", $request->recipient)->first();

        if (! isset($isExisting)) {

            if ($request->service == "airtime/data" || $request->service == "transfer") {
                $classification = $request->service;
            } else {
                $classification = "bills";
            }

            $beneficiary              = new Beneficiaries;
            $beneficiary->business_id = Auth::user()->id;
            $beneficiary->service     = $request->service;
            $beneficiary->provider    = $request->providerName;
            $beneficiary->beneficiary = $request->beneficiary;
            $beneficiary->recipient   = $request->recipient;
            $beneficiary->category    = $classification;
            if ($beneficiary->save()) {
                $data = BeneficiaryResource::make($beneficiary, false);
                return ResponseHelper::success($data);
            } else {
                return ResponseHelper::error("Something Went Wrong. Please Try Again Later.");
            }
        } else {
            $data = BeneficiaryResource::make($isExisting, false);
            return ResponseHelper::success($data);
        }

    }

    /**
     * viewBeneficiaries
     *
     * @return void
     */
    public function viewBeneficiaries()
    {
        $beneficiaries = Beneficiaries::where("business_id", Auth::user()->id)->get();
        $data          = BeneficiaryResource::collection($beneficiaries);
        return ResponseHelper::success($data);
    }
}
