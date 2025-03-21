<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UtilityController extends Controller
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

    public function utilities(Request $request)
    {
        if (isset($request->filter) && $request->filter == "list") {
            return view("business.utilities.utilities_list");
        } else {
            return view("business.utilities.utilities_summary");
        }

    }
}
