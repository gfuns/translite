<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;

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

}
