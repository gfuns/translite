<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;

class LogsController extends Controller
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
    public function webhookLogs()
    {
        return view("business.logs.webhook_logs");
    }
}
