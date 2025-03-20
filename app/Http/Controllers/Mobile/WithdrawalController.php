<?php
namespace App\Http\Controllers\Mobile;

use App\Helpers\FeeHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\WithdrawalTransactionResource;
use App\Models\Business;
use App\Models\PosWithdrawals;
use App\Models\Terminals;
use Auth;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * initiateWithdrawal
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateWithdrawal(Request $request)
    {
        $validator = $this->validate($request, [
            'merchantId' => 'required',
            'reference'  => 'required|numeric|digits:12|unique:pos_withdrawals',
            'amount'     => 'required|numeric',
        ]);

        try {
            $business = Business::where("agentId", $request->merchantId)->first();
            if (isset($business)) {
                $terminal = Terminals::find($business->terminal_id);
                $fee      = FeeHelper::getWithdrawalFee($business->user_id, $request->amount);

                $withdrawal                 = new PosWithdrawals;
                $withdrawal->business_id    = $business->id;
                $withdrawal->terminal_id    = $business->terminal_id;
                $withdrawal->reference      = $request->reference;
                $withdrawal->terminal_model = $terminal->model;
                $withdrawal->tid            = $terminal->terminal_id;
                $withdrawal->terminal_sno   = $terminal->serial_number;
                $withdrawal->amount         = $request->amount;
                $withdrawal->fee            = $fee;
                $withdrawal->total          = (double) ($fee + $request->amount);
                if ($withdrawal->save()) {
                    TransactionHelper::logPosWithdrawal($withdrawal);
                    // try {
                    //     $user = Auth::user();
                    //     Mail::to($user)->send(new PosWithdrawalNotification($user, $withdrawal));
                    // } catch (\Exception $e) {
                    //     report($e);
                    // } finally {

                    //     return ResponseHelper::success($withdrawal);
                    // }

                    return ResponseHelper::success($withdrawal);
                } else {
                    return ResponseHelper::error('Something Went Wrong. Please Try Again Later.');
                }
            } else {
                return ResponseHelper::error('We could not find an account with the provided Agent ID');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            return ResponseHelper::error('Something Went Wrong. Please Try Again Later.');
        }
    }

    /**
     * verifyTransaction
     *
     * @param mixed reference
     *
     * @return void
     */
    public function verifyTransaction($reference)
    {

        $trx = PosWithdrawals::where("business_id", Auth::user()->id)->where("reference", $reference)->first();
        if (isset($trx)) {
            return ResponseHelper::success($trx);
        } else {
            return ResponseHelper::error('We could not find a transaction with the provided reference');
        }
    }

    /**
     * withdrawalHistory
     *
     * @param mixed reference
     *
     * @return void
     */
    public function withdrawalHistory()
    {

        $trxs = PosWithdrawals::orderBy("id", "desc")->where("business_id", Auth::user()->id)->get();
        $data = WithdrawalTransactionResource::collection($trxs);
        return ResponseHelper::success($data);

    }

}
