<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;

class CommerceController extends Controller
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

    public function customers()
    {
        alert()->info('Coming Soon.');
        return redirect()->route("business.dashboard");
    }

    public function paymentLinks()
    {
        alert()->info('Coming Soon.');
        return redirect()->route("business.dashboard");
    }

    public function invoices()
    {
        alert()->info('Coming Soon.');
        return redirect()->route("business.dashboard");
    }
}
