<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
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
     * dashboard
     *
     * @return void
     */
    public function dashboard()
    {
        return view("business.dashboard");
    }

    /**
     * transactions
     *
     * @return void
     */
    public function transactions(Request $request)
    {
        if (isset($request->filter) && $request->filter == "list") {
            return view("business.payment.transactions_list");

        } else {
            return view("business.payment.transactions_summary");

        }
    }

    /**
     * settlements
     *
     * @param Request request
     *
     * @return void
     */
    public function settlements(Request $request)
    {
        if (isset($request->filter) && $request->filter == "list") {
            return view("business.payment.settlements_list");

        } else {
            return view("business.payment.settlements_summary");

        }
    }

    /**
     * refunds
     *
     * @param Request request
     *
     * @return void
     */
    public function refunds(Request $request)
    {
        if (isset($request->filter) && $request->filter == "list") {
            return view("business.payment.refunds_list");

        } else {
            return view("business.payment.refunds_summary");

        }
    }

    /**
     * disputes
     *
     * @param Request request
     *
     * @return void
     */
    public function disputes(Request $request)
    {
        return view("business.payment.disputes");

    }

}
