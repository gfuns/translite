<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrails;
use App\Models\AuthenticationLogs;
use App\Models\Business;
use App\Models\EndOfDay;
use App\Models\EndOfMonth;
use App\Models\PosWithdrawals;
use App\Models\Terminals;
use App\Models\TransferTrxs;
use App\Models\User;
use App\Models\UtilityTransaction;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Carbon\Carbon;

class ReportsController extends Controller
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
     * index
     *
     * @return void
     */
    public function index()
    {
        return view("admin.reports.index");
    }

    /**
     * authenticationReport
     *
     *
     * @return void
     */
    public function authenticationReport()
    {
        return view("admin.reports.authentication_report");
    }

    /**
     * searchUserAuths
     *
     * @param Request request
     *
     * @return void
     */
    public function searchUserAuths(Request $request)
    {

        if (isset($request->start_date) || isset($request->end_date)) {
            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'end_date'   => 'required',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $errors = implode("<br>", $errors);
                toast($errors, 'error');
                return back();
            }
        }

        $eventType = $request->event_type;
        $startDate = isset($request->start_date) ? $this->cleanDate($request->start_date) : $request->start_date;
        $endDate   = isset($request->end_date) ? $this->cleanDate($request->end_date) : $request->end_date;

        if ($startDate > $endDate) {
            toast('End Date must be a date after Start Date.', 'error');
            return back();
        }

        return redirect()->route("report.fetchUserAuths", [$eventType, $startDate, $endDate]);
    }

    /**
     * fetchUserAuths
     *
     * @param mixed workgroup
     * @param mixed eventType
     * @param mixed startDate
     * @param mixed endDate
     *
     * @return void
     */
    public function fetchUserAuths($eventType = null, $startDate = null, $endDate = null)
    {

        $eventType = $eventType == "null" ? null : $eventType;
        $startDate = isset($startDate) ? $this->purifyDate($startDate) : $startDate;
        $endDate   = isset($endDate) ? $this->purifyDate($endDate) : $endDate;

        if (isset($eventType) && isset($startDate) && isset($endDate)) {
            $activities = AuthenticationLogs::orderBy("id", "desc")->where("event", $eventType)->whereBetween('created_at', [$startDate, $endDate])->get();

        } else if (isset($eventType) && ! isset($startDate) && ! isset($endDate)) {
            $startDate  = Carbon::today()->startOfMonth();
            $endDate    = Carbon::today()->endOfMonth();
            $activities = AuthenticationLogs::orderBy("id", "desc")->where("event", $eventType)->whereBetween('created_at', [$startDate, $endDate])->get();

        } elseif (! isset($eventType) && isset($startDate) && isset($endDate)) {
            $activities = AuthenticationLogs::orderBy("id", "desc")->whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            $startDate  = Carbon::today()->startOfMonth();
            $endDate    = Carbon::today()->endOfMonth();
            $activities = AuthenticationLogs::orderBy("id", "desc")->whereBetween('created_at', [$startDate, $endDate])->get();

        }

        return view("admin.reports.authentication_report", compact("activities", "eventType", "startDate", "endDate"));
    }

    /**
     * auditTrailReport
     *
     *
     * @return void
     */
    public function auditTrailReport()
    {
        return view("admin.reports.audit_trails");
    }

    /**
     * searchAuditTrails
     *
     * @param Request request
     *
     * @return void
     */
    public function searchAuditTrails(Request $request)
    {

        if (isset($request->start_date) || isset($request->end_date)) {
            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'end_date'   => 'required',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $errors = implode("<br>", $errors);
                toast($errors, 'error');
                return back();
            }
        }

        $eventType = $request->event_type;
        $startDate = isset($request->start_date) ? $this->cleanDate($request->start_date) : $request->start_date;
        $endDate   = isset($request->end_date) ? $this->cleanDate($request->end_date) : $request->end_date;

        if ($startDate > $endDate) {
            toast('End Date must be a date after Start Date.', 'error');
            return back();
        }

        return redirect()->route("report.fetchAuditTrails", [$eventType, $startDate, $endDate]);
    }

    /**
     * fetchAuditTrails
     *
     * @param mixed eventType
     * @param mixed startDate
     * @param mixed endDate
     *
     * @return void
     */
    public function fetchAuditTrails($eventType = null, $startDate = null, $endDate = null)
    {

        $eventType = $eventType == "null" ? null : $eventType;
        $startDate = isset($startDate) ? $this->purifyDate($startDate) : $startDate;
        $endDate   = isset($endDate) ? $this->purifyDate($endDate) : $endDate;

        if (isset($eventType) && isset($startDate) && isset($endDate)) {
            $activities = AuditTrails::orderBy("id", "desc")->where("event", $eventType)->whereBetween('created_at', [$startDate, $endDate])->get();

        } else if (isset($eventType) && ! isset($startDate) && ! isset($endDate)) {
            $startDate  = Carbon::today()->startOfMonth();
            $endDate    = Carbon::today()->endOfMonth();
            $activities = AuditTrails::orderBy("id", "desc")->where("event", $eventType)->whereBetween('created_at', [$startDate, $endDate])->get();

        } elseif (! isset($eventType) && isset($startDate) && isset($endDate)) {
            $activities = AuditTrails::orderBy("id", "desc")->whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            $startDate  = Carbon::today()->startOfMonth();
            $endDate    = Carbon::today()->endOfMonth();
            $activities = AuditTrails::orderBy("id", "desc")->whereBetween('created_at', [$startDate, $endDate])->get();

        }

        if ($eventType == "created") {
            $eventType = "New Record Creation";
        } else if ($eventType == "updated") {
            $eventType = "Record Update";
        } else if ($eventType == "deleted") {
            $eventType = "Record Deletion";
        } else if ($eventType == "restored") {
            $eventType = "Record Restoration";
        } else {
            $eventType = "Record Retrieval";
        }

        return view("admin.reports.audit_trails", compact("activities", "eventType", "startDate", "endDate"));
    }

    /**
     * terminals
     *
     * @return void
     */
    public function terminals($assigned = null)
    {
        $isAssigned = $assigned;

        if (isset($assigned)) {
            $terminals = Terminals::where("assigned", $assigned)->get();
        } else {
            $terminals = Terminals::all();
        }

        if ($assigned == 1) {
            $assigned = "Assigned";
        } else if ($assigned == 0) {
            $assigned = "Unassigned";
        } else {
            $assigned = null;
        }
        return view("admin.reports.terminals", compact("terminals", "assigned", "isAssigned"));
    }

    /**
     * searchTerminals
     *
     * @param Request request
     *
     * @return void
     */
    public function searchTerminals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date'   => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $assigned  = $request->assigned ?? "null";
        $startDate = isset($request->start_date) ? $this->cleanDate($request->start_date) : $request->start_date;
        $endDate   = isset($request->end_date) ? $this->cleanDate($request->end_date) : $request->end_date;

        if ($startDate > $endDate) {
            toast('End Date must be a date after Start Date.', 'error');
            return back();
        }

        return redirect()->route("report.fetchTerminals", [$assigned, $startDate, $endDate]);

    }

    /**
     * fetchTerminals
     *
     * @param mixed assigned
     * @param mixed startDate
     * @param mixed endDate
     *
     * @return void
     */
    public function fetchTerminals($assigned = null, $startDate = null, $endDate = null)
    {
        $isAssigned = $assigned;
        $assigned   = $assigned == "null" ? null : $assigned;
        $startDate  = isset($startDate) ? $this->purifyDate($startDate) : $startDate;
        $endDate    = isset($endDate) ? $this->purifyDate($endDate) : $endDate;

        if (isset($assigned) && isset($startDate) && isset($endDate)) {
            $terminals = Terminals::where("assigned", $assigned)->whereBetween('created_at', [$startDate, $endDate])->get();

        } else if (isset($assigned) && ! isset($startDate) && ! isset($endDate)) {
            $startDate = Carbon::today()->startOfMonth();
            $endDate   = Carbon::today()->endOfMonth();
            $terminals = Terminals::where("assigned", $assigned)->whereBetween('created_at', [$startDate, $endDate])->get();

        } elseif (! isset($assigned) && isset($startDate) && isset($endDate)) {
            $terminals = Terminals::whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            $terminals = Terminals::all();
        }

        if ($assigned == 1) {
            $assigned = "Assigned";
        } else if ($assigned == 0) {
            $assigned = "Unassigned";
        } else {
            $assigned = null;
        }

        return view("admin.reports.terminals", compact("terminals", "assigned", "startDate", "endDate", "isAssigned"));
    }

    /**
     * posWithdrawals
     *
     * @param mixed status
     *
     * @return void
     */
    public function posWithdrawals($status = null)
    {
        $defStatus = $status;
        if (isset($status)) {
            $status = $status == 1 ? "successful" : ($status == 0 ? "failed" : "reversed");
        }

        if (isset($status)) {
            $withdrawals = PosWithdrawals::where("status", $status)->get();
        } else {
            $withdrawals = PosWithdrawals::whereIn("status", ["successful", "failed", "reversed"])->get();
        }

        return view("admin.reports.pos_withdrawals", compact("withdrawals", "status", "defStatus"));
    }

    /**
     * searchPosWithdrawals
     *
     * @param Request request
     *
     * @return void
     */
    public function searchPosWithdrawals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date'   => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $status    = $request->status ?? "null";
        $startDate = isset($request->start_date) ? $this->cleanDate($request->start_date) : $request->start_date;
        $endDate   = isset($request->end_date) ? $this->cleanDate($request->end_date) : $request->end_date;

        if ($startDate > $endDate) {
            toast('End Date must be a date after Start Date.', 'error');
            return back();
        }

        return redirect()->route("report.fetchPosWithdrawals", [$status, $startDate, $endDate]);

    }

    /**
     * fetchPosWithdrawals
     *
     * @param mixed status
     * @param mixed startDate
     * @param mixed endDate
     *
     * @return void
     */
    public function fetchPosWithdrawals($status = null, $startDate = null, $endDate = null)
    {
        $status    = $status == "null" ? null : $status;
        $defStatus = $status;
        if (isset($status)) {
            $status = $status == 1 ? "successful" : ($status == 0 ? "failed" : "reversed");
        }
        $startDate = isset($startDate) ? $this->purifyDate($startDate) : $startDate;
        $endDate   = isset($endDate) ? $this->purifyDate($endDate) : $endDate;

        if (isset($status) && isset($startDate) && isset($endDate)) {
            $withdrawals = PosWithdrawals::where("status", $status)->whereBetween('created_at', [$startDate, $endDate])->get();

        } else if (isset($status) && ! isset($startDate) && ! isset($endDate)) {
            $startDate   = Carbon::today()->startOfMonth();
            $endDate     = Carbon::today()->endOfMonth();
            $withdrawals = PosWithdrawals::where("status", $status)->whereBetween('created_at', [$startDate, $endDate])->get();

        } elseif (! isset($status) && isset($startDate) && isset($endDate)) {
            $withdrawals = PosWithdrawals::whereIn("status", ["successful", "failed", "reversed"])->whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            $withdrawals = PosWithdrawals::whereIn("status", ["successful", "failed", "reversed"])->get();
        }

        return view("admin.reports.pos_withdrawals", compact("withdrawals", "status", "startDate", "endDate", "defStatus"));
    }

    /**
     * utilityTrxs
     *
     * @param mixed service
     *
     * @return void
     */
    public function utilityTrxs($service = null)
    {

        if (isset($service)) {
            $transactions = UtilityTransaction::where("service", $service)->get();
        } else {
            $transactions = UtilityTransaction::all();
        }

        return view("admin.reports.utility_trxs", compact("transactions", "service"));
    }

    /**
     * searchUtilitiesTrx
     *
     * @param Request request
     *
     * @return void
     */
    public function searchUtilitiesTrx(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date'   => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $service   = $request->service ?? "null";
        $startDate = isset($request->start_date) ? $this->cleanDate($request->start_date) : $request->start_date;
        $endDate   = isset($request->end_date) ? $this->cleanDate($request->end_date) : $request->end_date;

        if ($startDate > $endDate) {
            toast('End Date must be a date after Start Date.', 'error');
            return back();
        }

        return redirect()->route("report.fetchUtilitiesTrx", [$service, $startDate, $endDate]);

    }

    /**
     * fetchUtilitiesTrx
     *
     * @param mixed service
     * @param mixed startDate
     * @param mixed endDate
     *
     * @return void
     */
    public function fetchUtilitiesTrx($service = null, $startDate = null, $endDate = null)
    {
        $service   = $service == "null" ? null : $service;
        $startDate = isset($startDate) ? $this->purifyDate($startDate) : $startDate;
        $endDate   = isset($endDate) ? $this->purifyDate($endDate) : $endDate;

        if (isset($service) && isset($startDate) && isset($endDate)) {
            $transactions = UtilityTransaction::where("service", $service)->whereBetween('created_at', [$startDate, $endDate])->get();

        } else if (isset($service) && ! isset($startDate) && ! isset($endDate)) {
            $startDate    = Carbon::today()->startOfMonth();
            $endDate      = Carbon::today()->endOfMonth();
            $transactions = UtilityTransaction::where("service", $service)->whereBetween('created_at', [$startDate, $endDate])->get();

        } elseif (! isset($service) && isset($startDate) && isset($endDate)) {
            $transactions = UtilityTransaction::whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            $transactions = UtilityTransaction::all();
        }

        return view("admin.reports.utility_trxs", compact("transactions", "service", "startDate", "endDate"));
    }

    /**
     * customerAccounts
     *
     * @return void
     */
    public function customerAccounts()
    {
        $customers = User::where("role", "customer")->get();
        return view("admin.reports.customer_accounts", compact("customers"));
    }

    /**
     * searchCustomers
     *
     * @param Request request
     *
     * @return void
     */
    public function searchCustomers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date'   => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $startDate = isset($request->start_date) ? $this->cleanDate($request->start_date) : $request->start_date;
        $endDate   = isset($request->end_date) ? $this->cleanDate($request->end_date) : $request->end_date;

        if ($startDate > $endDate) {
            toast('End Date must be a date after Start Date.', 'error');
            return back();
        }

        return redirect()->route("report.fetchCustAccounts", [$startDate, $endDate]);

    }

    /**
     * fetchCustAccounts
     *
     * @param mixed startDate
     * @param mixed endDate
     *
     * @return void
     */
    public function fetchCustAccounts($startDate = null, $endDate = null)
    {
        $startDate = isset($startDate) ? $this->purifyDate($startDate) : $startDate;
        $endDate   = isset($endDate) ? $this->purifyDate($endDate) : $endDate;

        $customers = User::where("role", "customer")->whereBetween('created_at', [$startDate, $endDate])->get();

        return view("admin.reports.customer_accounts", compact("customers", "startDate", "endDate"));
    }

    /**
     * customerBusinesses
     *
     * @return void
     */
    public function customerBusinesses()
    {
        $businesses = Business::all();
        $customers  = User::where("role", "customer")->get();
        return view("admin.reports.customer_businesses", compact("businesses", "customers"));
    }

    /**
     * searchBusiness
     *
     * @param Request request
     *
     * @return void
     */
    public function searchBusiness(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $customer = User::find($request->customer);
        if (isset($customer)) {
            return redirect()->route("report.fetchCustBusiness", [$customer->id]);
        } else {
            toast("Something Went Wrong. Please Try Again Later.", 'error');
            return back();
        }
    }

    /**
     * fetchCustBusiness
     *
     * @param mixed customer
     *
     * @return void
     */
    public function fetchCustBusiness($id)
    {
        $customer = User::find($id);

        $businesses = Business::where("user_id", $id)->get();
        $customers  = User::where("role", "customer")->get();
        return view("admin.reports.customer_businesses", compact("businesses", "customers", "customer"));
    }

    /**
     * customerTermimals
     *
     * @return void
     */
    public function customerTermimals()
    {
        $terminals = Business::whereNotNull("terminal_id")->get();
        $customers = User::where("role", "customer")->get();
        return view("admin.reports.customer_terminals", compact("terminals", "customers"));
    }

    /**
     * searchCustTerminals
     *
     * @param Request request
     *
     * @return void
     */
    public function searchCustTerminals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $customer = User::find($request->customer);
        if (isset($customer)) {
            return redirect()->route("report.fetchCustTerminals", [$customer->id]);
        } else {
            toast("Something Went Wrong. Please Try Again Later.", 'error');
            return back();
        }
    }

    /**
     * fetchCustTerminals
     *
     * @param mixed id
     *
     * @return void
     */
    public function fetchCustTerminals($id)
    {
        $customer  = User::find($id);
        $terminals = Business::where("user_id", $id)->whereNotNull("terminal_id")->get();
        $customers = User::where("role", "customer")->get();
        return view("admin.reports.customer_terminals", compact("terminals", "customers", "customer"));
    }

    /**
     * customerTransfers
     *
     * @param mixed type
     *
     * @return void
     */
    public function customerTransfers($type = null)
    {
        $defType = $type;
        if (isset($type)) {
            $type      = $type == 1 ? "inward" : "outward";
            $transfers = TransferTrxs::where("category", $type)->get();
        } else {
            $transfers = TransferTrxs::all();
        }

        return view("admin.reports.customer_transfers", compact("transfers", "type", "defType"));
    }

    /**
     * searchTransfers
     *
     * @param Request request
     *
     * @return void
     */
    public function searchTransfers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date'   => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $type      = $request->type ?? "null";
        $startDate = isset($request->start_date) ? $this->cleanDate($request->start_date) : $request->start_date;
        $endDate   = isset($request->end_date) ? $this->cleanDate($request->end_date) : $request->end_date;

        if ($startDate > $endDate) {
            toast('End Date must be a date after Start Date.', 'error');
            return back();
        }

        return redirect()->route("report.fetchTransfers", [$type, $startDate, $endDate]);
    }

    /**
     * fetchTransfers
     *
     * @param mixed type
     * @param mixed startDate
     * @param mixed endDate
     *
     * @return void
     */
    public function fetchTransfers($type = null, $startDate = null, $endDate = null)
    {
        $type    = $type == "null" ? null : $type;
        $defType = $type;
        if (isset($type)) {
            $type = $type == 1 ? "inward" : "outward";
        }
        $startDate = isset($startDate) ? $this->purifyDate($startDate) : $startDate;
        $endDate   = isset($endDate) ? $this->purifyDate($endDate) : $endDate;

        if (isset($type) && isset($startDate) && isset($endDate)) {
            $transfers = TransferTrxs::where("type", $type)->whereBetween('created_at', [$startDate, $endDate])->get();

        } else if (isset($type) && ! isset($startDate) && ! isset($endDate)) {
            $startDate = Carbon::today()->startOfMonth();
            $endDate   = Carbon::today()->endOfMonth();
            $transfers = TransferTrxs::where("type", $type)->whereBetween('created_at', [$startDate, $endDate])->get();

        } elseif (! isset($type) && isset($startDate) && isset($endDate)) {
            $transfers = TransferTrxs::whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            $transfers = TransferTrxs::all();
        }

        return view("admin.reports.customer_transfers", compact("transfers", "type", "startDate", "endDate", "defType"));
    }

    /**
     * endOfDay
     *
     * @return void
     */
    public function endOfDay()
    {
        $date     = Carbon::yesterday();
        $endOfDay = EndOfDay::whereDate("trnx_date", $date)->first();
        return view("admin.reports.endofday", compact("endOfDay", "date"));
    }

    /**
     * searchEndOfDay
     *
     * @param Request request
     *
     * @return void
     */
    public function searchEndOfDay(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $date = isset($request->date) ? $this->cleanDate($request->date) : $request->date;

        return redirect()->route("report.fetchEndOfDay", [$date]);
    }

    /**
     * fetchEndOfDay
     *
     * @param mixed date
     *
     * @return void
     */
    public function fetchEndOfDay($date = null)
    {
        $date = isset($date) ? $this->purifyDate($date) : Carbon::yesterday();

        $endOfDay = EndOfDay::whereDate("trnx_date", $date)->first();
        return view("admin.reports.endofday", compact("endOfDay", "date"));
    }

    /**
     * endOfMonth
     *
     * @return void
     */
    public function endOfMonth()
    {
        $month      = Carbon::now()->subMonth()->format('F');
        $year       = date("Y");
        $endOfMonth = EndOfMonth::where("month", $month)->where("year", $year)->first();
        return view("admin.reports.endofmonth", compact("endOfMonth", "year", "month"));
    }

    /**
     * searchEndOfMonth
     *
     * @param Request request
     *
     * @return void
     */
    public function searchEndOfMonth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'month' => 'required',
            'year'  => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        return redirect()->route("report.fetchEndOfMonth", [$request->month, $request->year]);
    }

    /**
     * fetchEndOfMonth
     *
     * @param mixed month
     * @param mixed year
     *
     * @return void
     */
    public function fetchEndOfMonth($month = null, $year = null)
    {
        $month = $month ?? Carbon::now()->subMonth()->format('F');
        $year  = $year ?? date("Y");

        $endOfMonth = EndOfMonth::where("month", $month)->where("year", $year)->first();
        return view("admin.reports.endofmonth", compact("endOfMonth", "year", "month"));
    }

    /**
     * endOfYear
     *
     * @return void
     */
    public function endOfYear()
    {
        $year      = Carbon::now()->subYear()->year;
        $endOfYear = EndOfMonth::where("year", $year)->first();
        return view("admin.reports.endofyear", compact("endOfYear", "year"));
    }

    /**
     * searchEndOfYear
     *
     * @param Request request
     *
     * @return void
     */
    public function searchEndOfYear(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        return redirect()->route("report.fetchEndOfYear", [$request->year]);
    }

    /**
     * fetchEndOfYear
     *
     * @param mixed year
     *
     * @return void
     */
    public function fetchEndOfYear($year = null)
    {
        $year      = $year ?? Carbon::now()->subYear()->year;
        $endOfYear = EndOfMonth::where("year", $year)->first();
        return view("admin.reports.endofyear", compact("endOfYear", "year"));
    }

    /**
     * cleanDate
     *
     * @param mixed date
     *
     * @return void
     */
    public function cleanDate($date)
    {
        $newDate = preg_replace("|/|", "-", $date);
        return $newDate;
    }

    /**
     * purifyDate
     *
     * @param mixed date
     *
     * @return void
     */
    public function purifyDate($date)
    {
        $date    = preg_replace("|-|", "/", $date);
        $newDate = $this->formatDate($date);
        return $newDate;
    }

    /**
     * formatDate
     *
     * @param mixed date
     *
     * @return void
     */
    public function formatDate($date)
    {
        $date          = str_replace('/', '-', $date);
        $newDate       = date('Y-m-d', strtotime($date));
        $formattedDate = new DateTime($newDate);
        return $formattedDate;
    }
}
