<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;

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
}
