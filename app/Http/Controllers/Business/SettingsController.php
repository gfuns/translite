<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;

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
}
