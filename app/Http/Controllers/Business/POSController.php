<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;

class POSController extends Controller
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
     * xtrapayPos
     *
     * @return void
     */
    public function xtrapayPos()
    {
        return view("business.pos.terminals");
    }

    /**
     * branches
     *
     * @return void
     */
    public function branches()
    {
        return view("business.pos.branches");
    }

    /**
     * requests
     *
     * @return void
     */
    public function requests()
    {
        return view("business.pos.terminal_requests");
    }
}
