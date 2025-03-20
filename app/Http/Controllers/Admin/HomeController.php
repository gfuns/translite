<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountType;
use App\Models\Business;
use App\Models\CustomerBalances;
use App\Models\CustomFeeConfig;
use App\Models\Disputes;
use App\Models\EndOfMonth;
use App\Models\FeeConfig;
use App\Models\PlatformFeatures;
use App\Models\PosWithdrawals;
use App\Models\SupportTickets;
use App\Models\Terminals;
use App\Models\TransferTrxs;
use App\Models\User;
use App\Models\UserPermissions;
use App\Models\UserRole;
use App\Models\UtilityTransaction;
use Auth;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use \Carbon\Carbon;

class HomeController extends Controller
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
        $params = [
            "customers"       => User::where("role", "customer")->count(),
            "businesses"      => Business::count(),
            "terminals"       => Terminals::count(),
            "activeTerminals" => Terminals::where("status", "active")->count(),
            "airtimeSold"     => EndOfMonth::where("month", date("F"))->where("year", date("Y"))->sum("airtime"),
            "dataSold"        => EndOfMonth::where("month", date("F"))->where("year", date("Y"))->sum("data"),
            "tvSubSold"       => EndOfMonth::where("month", date("F"))->where("year", date("Y"))->sum("electricity"),
            "powerSold"       => EndOfMonth::where("month", date("F"))->where("year", date("Y"))->sum("tv"),
            "inwardTrf"       => EndOfMonth::where("month", date("F"))->where("year", date("Y"))->sum("inward_transfer"),
            "outwardTrf"      => EndOfMonth::where("month", date("F"))->where("year", date("Y"))->sum("outward_transfer"),
            "posDrw"          => EndOfMonth::where("month", date("F"))->where("year", date("Y"))->sum("pos_withdrawals"),
            "revenue"         => EndOfMonth::where("month", date("F"))->where("year", date("Y"))->sum("total_fees"),

        ];
        return view("admin.dashboard", compact("params"));
    }

    /**
     * changePassword
     *
     * @return void
     */
    public function changePassword()
    {
        return view("admin.change_password");
    }

    /**
     * updatePassword
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password'      => 'required',
            'new_password'          => 'required',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            toast('Invalid Current Password Provided.', 'error');
            return back();
        } else {
            if ($request->new_password != $request->password_confirmation) {
                toast('Your Newly Seleted Passwords Do Not Match.', 'error');
                return back();
            } else {
                $user->password = Hash::make($request->new_password);
                $user->save();
            }
        }

        if ($user->save()) {
            toast('Password Successfully Updated.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }

    }

    /**
     * customers
     *
     * @return void
     */
    public function customers()
    {
        $customers    = User::where("role", "customer")->get();
        $accountTypes = AccountType::all();
        return view("admin.customers", compact("customers", "accountTypes"));
    }

    /**
     * storeCustomer
     *
     * @param Request request
     *
     * @return void
     */
    public function storeCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lastName'    => 'required',
            'firstName'   => 'required',
            'email'       => 'required|unique:users',
            'phoneNumber' => 'required|unique:users',
            'accountType' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $customer                  = new User;
        $customer->lastName        = $request->lastName;
        $customer->firstName       = $request->firstName;
        $customer->otherNames      = $request->otherNames;
        $customer->email           = $request->email;
        $customer->phoneNumber     = $request->phoneNumber;
        $customer->account_type_id = $request->account_type;
        $customer->password        = Hash::make($request->phoneNumber);
        $customer->token           = Str::random(16);
        if ($customer->save()) {
            toast('Customer Account Created Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * updateCustomer
     *
     * @param Request request
     *
     * @return void
     */
    public function updateCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'lastName'    => 'required',
            'firstName'   => 'required',
            'email'       => 'required',
            'phoneNumber' => 'required',
            'accountType' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $customer                  = User::find($request->customer_id);
        $customer->lastName        = $request->lastName;
        $customer->firstName       = $request->firstName;
        $customer->otherNames      = $request->otherNames;
        $customer->email           = $request->email;
        $customer->phoneNumber     = $request->phoneNumber;
        $customer->account_type_id = $request->account_type;
        if ($customer->save()) {
            toast('Customer Account Updated Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * suspendCustomer
     *
     * @param mixed id
     *
     * @return void
     */
    public function suspendCustomer($id)
    {
        $admin         = User::find($id);
        $admin->status = "suspended";
        if ($admin->save()) {
            toast('Customer Account Suspended', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * activateCustomer
     *
     * @param mixed id
     *
     * @return void
     */
    public function activateCustomer($id)
    {
        $admin         = User::find($id);
        $admin->status = "active";
        if ($admin->save()) {
            toast('Customer Account Activated', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * customerBusinesses
     *
     * @param mixed id
     *
     * @return void
     */
    public function customerBusinesses($id)
    {
        $businesses = Business::where("user_id", $id)->get();
        $terminals  = Terminals::where("assigned", 0)->get();
        return view("admin.customer_businesses", compact("businesses", "terminals", 'id'));
    }

    /**
     * storeBusiness
     *
     * @param Request request
     *
     * @return void
     */
    public function storeBusiness(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'          => 'required',
            'business_name'    => 'required',
            'business_address' => 'required',
            'email'            => 'required|unique:businesses',
            'last_name'        => 'required',
            'first_name'       => 'required',
            'agentPhoneNumber' => 'required|unique:businesses',
            'bvn'              => 'required|unique:businesses',
            'dob'              => 'required',
            'gender'           => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {

            $customer = User::find($request->user_id);

            $baseURL   = env("BANK_ONE_BASE_URL");
            $authToken = env("MY_BANK_ONE_AUTH_TOKEN");
            $url       = $baseURL . '/BankOneWebAPI/api/Account/CreateAccountQuick/2?authToken=' . $authToken;

            $postData = [
                'TransactionTrackingRef'    => Str::uuid(),
                'AccountOpeningTrackingRef' => Str::uuid(),
                'ProductCode'               => env("BANK_ONE_PRODUCT_CODE"),
                'LastName'                  => $request->last_name,
                'OtherNames'                => $request->first_name . " " . $request->other_names,
                'BVN'                       => $request->bvn,
                'PhoneNo'                   => $request->agentPhoneNumber,
                'Gender'                    => $request->gender === 'male' ? 0 : 1,
                'DateOfBirth'               => $this->bankOneDate($request->dob),
                'Address'                   => $request->business_address,
                'AccountOfficerCode'        => env("BANK_ONE_ACCOUNT_OFFICER"),
                'Email'                     => $request->email,
                'AccountTier'               => 2,
            ];

            $response = Http::post($url, $postData);

            if ($response->failed()) {

                toast('An Error Occured While Creating Account For Customer On Bank One Infrastructure', 'error');
                return back();

            } else {

                $data = json_decode($response, true);
                if ($data["IsSuccessful"] === false) {
                    toast($data["Message"], 'error');
                    return back();
                }

                DB::beginTransaction();

                $business                       = new Business;
                $business->user_id              = $request->user_id;
                $business->businessName         = $request->business_name;
                $business->businessAddress      = $request->business_address;
                $business->email                = $request->email;
                $business->password             = Hash::make($request->agentPhoneNumber);
                $business->agentLastName        = $request->last_name;
                $business->agentFirstName       = $request->first_name;
                $business->agentPhoneNumber     = $request->agentPhoneNumber;
                $business->agentOtherNames      = $request->other_names;
                $business->bvn                  = $request->bvn;
                $business->gender               = $request->gender;
                $business->dob                  = $this->formatDate($request->dob);
                $business->customerId           = $data["Message"]["CustomerID"];
                $business->bankId               = $data["Message"]["Id"];
                $business->accountNumber        = $data["Message"]["AccountNumber"];
                $business->bankOneAccountNumber = $data["Message"]["BankoneAccountNumber"];
                $business->productCode          = env("BANK_ONE_PRODUCT_CODE");
                $business->accountOfficerCode   = env("BANK_ONE_ACCOUNT_OFFICER");
                $business->save();

                $account              = new CustomerBalances;
                $account->user_id     = $business->user_id;
                $account->business_id = $business->id;
                $account->save();

                DB::commit();

                toast('Business Information Created Successfully', 'success');
                return back();

            }

        } catch (\Exception $e) {
            DB::rollback();

            report($e);

            toast('Something went wrong. Please try again ' . $e->getMessage(), 'error');
            return back();
        }
    }

    /**
     * updateBusiness
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusiness(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_id'      => 'required',
            'business_name'    => 'required',
            'business_address' => 'required',
            'email'            => 'required',
            'last_name'        => 'required',
            'first_name'       => 'required',
            'phone_number'     => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $business                   = Business::find($request->business_id);
        $business->businessName     = $request->business_name;
        $business->businessAddress  = $request->business_address;
        $business->email            = $request->email;
        $business->agentLastName    = $request->last_name;
        $business->agentFirstName   = $request->first_name;
        $business->agentPhoneNumber = $request->phone_number;
        $business->agentOtherNames  = $request->other_names;
        if ($business->save()) {
            toast('Business Information Updated Activated', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    public function businesses()
    {
        $businesses = Business::all();
        $terminals  = Terminals::where("assigned", 0)->get();
        $customers  = User::where("role", "customer")->get();
        return view("admin.businesses", compact("businesses", "terminals", "customers"));
    }

    /**
     * releaseTerminal
     *
     * @param mixed id
     *
     * @return void
     */
    public function releaseTerminal($id)
    {
        try {
            DB::beginTransaction();

            $business           = Business::find($id);
            $terminal           = Terminals::find($business->terminal_id);
            $terminal->assigned = 0;
            $terminal->save();

            $business->terminal_id = null;
            $business->save();

            DB::commit();

            toast('Terminal For This Business Released Successfully', 'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            report($e);

            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * assignTerminal
     *
     * @param Request request
     *
     * @return void
     */
    public function assignTerminal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_id'  => 'required',
            'pos_terminal' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {

            $terminal = Terminals::find($request->pos_terminal);

            if (isset($terminal)) {

                DB::beginTransaction();
                $terminal->assigned = 1;
                $terminal->status   = "active";
                $terminal->save();

                $business              = Business::find($request->business_id);
                $business->terminal_id = $terminal->id;
                $business->save();
                DB::commit();

                toast('Terminal For This Business Released Successfully', 'success');
                return back();

            } else {
                toast('We Could Not Locate The Configuration For The Selected POS Terminal', 'success');
                return back();
            }

        } catch (\Exception $e) {
            DB::rollback();
            report($e);

            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * accountTypes
     *
     * @return void
     */
    public function accountTypes()
    {
        $accountTypes = AccountType::all();
        return view("admin.account_types", compact("accountTypes"));
    }

    /**
     * storeAccountType
     *
     * @param Request request
     *
     * @return void
     */
    public function storeAccountType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_type'     => 'required',
            'transfer_limit'   => 'required|numeric',
            'utility_limit'    => 'required|numeric',
            'withdrawal_limit' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $accountType                   = new AccountType;
        $accountType->level            = $request->account_type;
        $accountType->utility_limit    = $request->utility_limit;
        $accountType->transfer_limit   = $request->transfer_limit;
        $accountType->withdrawal_limit = $request->withdrawal_limit;
        if ($accountType->save()) {
            toast('Account Type Created Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * updateAccountType
     *
     * @param Request request
     *
     * @return void
     */
    public function updateAccountType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_type_id'  => 'required',
            'account_type'     => 'required',
            'transfer_limit'   => 'required|numeric',
            'utility_limit'    => 'required|numeric',
            'withdrawal_limit' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $accountType                   = AccountType::find($request->account_type_id);
        $accountType->level            = $request->account_type;
        $accountType->utility_limit    = $request->utility_limit;
        $accountType->transfer_limit   = $request->transfer_limit;
        $accountType->withdrawal_limit = $request->withdrawal_limit;
        if ($accountType->save()) {
            toast('Account Type Updated Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * transferFees
     *
     * @return void
     */
    public function transferFees()
    {
        $transferSettings = FeeConfig::where("trans_type", "transfer")->get();
        return view("admin.transfer_settings", compact("transferSettings"));
    }

    /**
     * withdrawalFees
     *
     * @return void
     */
    public function withdrawalFees()
    {
        $withdrawalSettings = FeeConfig::where("trans_type", "withdrawal")->get();
        return view("admin.withdrawal_settings", compact("withdrawalSettings"));
    }

    /**
     * utilityFees
     *
     * @return void
     */
    public function utilityFees()
    {
        $utilitySettings = FeeConfig::where("trans_type", "utilities")->get();
        return view("admin.utility_settings", compact("utilitySettings"));
    }

    /**
     * updateFeeAmount
     *
     * @param Request request
     *
     * @return void
     */
    public function updateFeeAmount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fee_id'     => 'required',
            'fee_amount' => 'required|numeric',
            'configType' => 'required',
            'narration'  => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $fee             = FeeConfig::find($request->fee_id);
        $fee->config     = $request->configType;
        $fee->fee_amount = $request->fee_amount;
        $fee->narration  = $request->narration;
        if ($fee->save()) {
            toast('Fee Amount Updated Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * utilityTransactions
     *
     * @param mixed type
     *
     * @return void
     */
    public function utilityTransactions($service)
    {
        $transactions = UtilityTransaction::orderBy("id", "desc")->where("service", $service)->where('created_at', '>=', Carbon::now()->subDays(30))->get();
        return view("admin.utilities", compact("transactions", "service"));
    }

    /**
     * filterUtilityTrxs
     *
     * @param Request request
     *
     * @return void
     */
    public function filterUtilityTrxs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service'    => 'required',
            'start_date' => 'required',
            'end_date'   => 'required',
        ]);

        $startDate = $this->cleanDate($request->start_date);
        $endDate   = $this->cleanDate($request->end_date);

        if ($startDate > $endDate) {
            toast('End Date must be a date after Start Date.', 'error');
            return back();
        }

        return redirect()->route("admin.fetchUtilityTrxs", [$request->service, $startDate, $endDate]);
    }

    /**
     * fetchUtilityTrxs
     *
     * @param mixed service
     * @param mixed startDate
     * @param mixed endDate
     *
     * @return void
     */
    public function fetchUtilityTrxs($service, $startDate = null, $endDate = null)
    {

        $startDate = $this->purifyDate($startDate);
        $endDate   = $this->purifyDate($endDate);

        $transactions = UtilityTransaction::orderBy("id", "desc")->where("service", $service)->whereBetween('created_at', [$startDate, $endDate])->get();

        return view("admin.utilities", compact("transactions", "service", "startDate", "endDate"));
    }

    /**
     * customerDisputes
     *
     * @return void
     */
    public function customerDisputes()
    {
        $disputes = Disputes::orderBy("status", "asc")->get();

        return view("admin.disputes", compact("disputes"));
    }

    /**
     * closeDispute
     *
     * @param Request request
     *
     * @return void
     */
    public function closeDispute(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dispute_id' => 'required',
            'feedback'   => 'required',
        ]);

        $dispute                   = Disputes::find($request->dispute_id);
        $dispute->support_feedback = $request->feedback;
        $dispute->status           = "closed";
        if ($dispute->save()) {
            toast('Feedback Logged Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * customerTickets
     *
     * @return void
     */
    public function customerTickets()
    {
        $tickets = SupportTickets::orderBy("status", "asc")->get();

        return view("admin.tickets", compact("tickets"));
    }

    /**
     * closeTicket
     *
     * @param Request request
     *
     * @return void
     */
    public function closeTicket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_id' => 'required',
            'feedback'  => 'required',
        ]);

        $ticket                   = SupportTickets::find($request->ticket_id);
        $ticket->support_feedback = $request->feedback;
        $ticket->status           = "closed";
        if ($ticket->save()) {
            toast('Feedback Logged Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * terminals
     *
     * @return void
     */
    public function terminals()
    {
        $terminals = Terminals::all();
        return view("admin.terminals", compact("terminals"));
    }

    /**
     * storeTerminal
     *
     * @param Request request
     *
     * @return void
     */
    public function storeTerminal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pos_model'     => 'required',
            'terminal_id'   => 'required|unique:terminals',
            'serial_number' => 'required|unique:terminals',
            'sim_number'    => 'required|unique:terminals',
            'ip'            => 'required|unique:terminals',
            'port'          => 'required',
        ]);

        $terminal                = new Terminals;
        $terminal->model         = $request->pos_model;
        $terminal->terminal_id   = $request->terminal_id;
        $terminal->serial_number = $request->serial_number;
        $terminal->sim           = $request->sim_number;
        $terminal->ip            = $request->ip;
        $terminal->port          = $request->port;
        if ($terminal->save()) {
            toast('Terminal Added Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }

    }

    /**
     * updateTerminal
     *
     * @param Request request
     *
     * @return void
     */
    public function updateTerminal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'term_id'       => 'required',
            'pos_model'     => 'required',
            'terminal_id'   => 'required',
            'serial_number' => 'required',
            'sim_number'    => 'required',
            'ip'            => 'required',
            'port'          => 'required',
        ]);

        $terminal                = Terminals::find($request->term_id);
        $terminal->model         = $request->pos_model;
        $terminal->terminal_id   = $request->terminal_id;
        $terminal->serial_number = $request->serial_number;
        $terminal->sim           = $request->sim_number;
        $terminal->ip            = $request->ip;
        $terminal->port          = $request->port;
        if ($terminal->save()) {
            toast('Terminal Details Updated Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }

    }

    /**
     * filterTerminals
     *
     * @param Request request
     *
     * @return void
     */
    public function filterTerminals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        return redirect()->route("admin.fetchTerminals", [$request->status]);
    }

    /**
     * fetchTerminals
     *
     * @param mixed status
     *
     * @return void
     */
    public function fetchTerminals($status)
    {
        $terminals = Terminals::where("assigned", $status)->get();
        return view("admin.terminals", compact("terminals", "status"));
    }

    /**
     * posWithdrawals
     *
     * @return void
     */
    public function posWithdrawals()
    {
        $transactions = PosWithdrawals::orderBy("id", "desc")->where('created_at', '>=', Carbon::now()->subDays(30))->get();
        return view("admin.pos_withdrawals", compact("transactions"));
    }

    /**
     * filterTransaction
     *
     * @param Request request
     *
     * @return void
     */
    public function filterWithdrawals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date'   => 'required',
        ]);

        $startDate = $this->cleanDate($request->start_date);
        $endDate   = $this->cleanDate($request->end_date);

        if ($startDate > $endDate) {
            toast('End Date must be a date after Start Date.', 'error');
            return back();
        }

        return redirect()->route("admin.fetchWithdrawals", [$startDate, $endDate]);
    }

    /**
     * fetchWithdrawals
     *
     * @param mixed startDate
     * @param mixed endDate
     *
     * @return void
     */
    public function fetchWithdrawals($startDate, $endDate)
    {
        $startDate = $this->purifyDate($startDate);
        $endDate   = $this->purifyDate($endDate);

        $transactions = PosWithdrawals::orderBy("id", "desc")->whereBetween('created_at', [$startDate, $endDate])->get();

        return view("admin.pos_withdrawals", compact("transactions", "startDate", "endDate"));
    }

    /**
     * platformFeatures
     *
     * @return void
     */
    public function platformFeatures()
    {
        $features = PlatformFeatures::all();
        return view("admin.platform_features", compact("features"));
    }

    /**
     * manageRoles
     *
     * @return void
     */
    public function manageRoles()
    {
        $userRoles = UserRole::all();
        return view("admin.manage_roles", compact("userRoles"));
    }

    /**
     * storeRole
     *
     * @param Request request
     *
     * @return void
     */
    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|unique:user_roles',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $role       = new UserRole;
        $role->role = $request->role;
        if ($role->save()) {
            toast('User Role Created Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * updateRole
     *
     * @param Request request
     *
     * @return void
     */
    public function updateRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|numeric',
            'role'    => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $parseRole = UserRole::where("role", $request->role)->where("id", "!=", $request->role_id)->count();
        if ($parseRole > 0) {
            toast('The provided user role is already allocated.', 'error');
            return back();
        }

        $role       = UserRole::find($request->role_id);
        $role->role = $request->role;
        if ($role->save()) {
            toast('User Role Updated Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * managePermissions
     *
     * @param mixed id
     *
     * @return void
     */
    public function managePermissions($id)
    {
        $role             = UserRole::find($id);
        $platformFeatures = PlatformFeatures::all();
        return view('admin.manage_permissions', compact('role', 'platformFeatures'));
    }

    /**
     * grantFeaturePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function grantFeaturePermission($role, $feature)
    {
        $permission             = new UserPermissions;
        $permission->role_id    = $role;
        $permission->feature_id = $feature;
        if ($permission->save()) {
            toast('Feature Permission Granted', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * revokeFeaturePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function revokeFeaturePermission($role, $feature)
    {
        $permission = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        if ($permission->delete()) {
            toast('Feature Permission Revoked', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * grantCreatePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function grantCreatePermission($role, $feature)
    {
        $permission             = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_create = 1;
        if ($permission->save()) {
            toast('Can Create Permission Granted', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * revokeCreatePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function revokeCreatePermission($role, $feature)
    {
        $permission             = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_create = 0;
        if ($permission->save()) {
            toast('Can Create Permission Revoked', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * grantEditPermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function grantEditPermission($role, $feature)
    {
        $permission           = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_edit = 1;
        if ($permission->save()) {
            toast('Can Edit Permission Granted', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * revokeEditPermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function revokeEditPermission($role, $feature)
    {
        $permission           = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_edit = 0;
        if ($permission->save()) {
            toast('Can Edit Permission Revoked', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * grantDeletePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function grantDeletePermission($role, $feature)
    {
        $permission             = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_delete = 1;
        if ($permission->save()) {
            toast('Can Delete Permission Granted', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * revokeDeletePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function revokeDeletePermission($role, $feature)
    {
        $permission             = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_delete = 0;
        if ($permission->save()) {
            toast('Can Delete Permission Revoked', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * administrators
     *
     * @return void
     */
    public function administrators()
    {
        $administrators = User::where("role", "admin")->get();
        $userRoles      = UserRole::all();
        return view("admin.administrators", compact("administrators", "userRoles"));
    }

    public function storeAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'surname'       => 'required',
            'first_name'    => 'required',
            'email'         => 'required|unique:users',
            'assigned_role' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $password = $request->first_name . "1#";

        $admin              = new User;
        $admin->lastName    = $request->surname;
        $admin->firstName   = $request->first_name;
        $admin->otherNames  = $request->other_names;
        $admin->email       = $request->email;
        $admin->phoneNumber = $request->phone_number;
        $admin->role        = "admin";
        $admin->role_id     = $request->assigned_role;
        $admin->password    = Hash::make($password);
        $admin->token       = Str::random(16);
        if ($admin->save()) {
            toast('Administrator Added Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * updateAdmin
     *
     * @return void
     */
    public function updateAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_id'      => 'required|numeric',
            'surname'       => 'required',
            'first_name'    => 'required',
            'email'         => 'required',
            'assigned_role' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $admin              = User::find($request->admin_id);
        $admin->lastName    = $request->surname;
        $admin->firstName   = $request->first_name;
        $admin->otherNames  = $request->other_names;
        $admin->email       = $request->email;
        $admin->phoneNumber = $request->phone_number;
        $admin->role_id     = $request->assigned_role;
        if ($admin->save()) {
            toast('Administrator Updated Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * suspendAdmin
     *
     * @param mixed id
     *
     * @return void
     */
    public function suspendAdmin($id)
    {
        $admin         = User::find($id);
        $admin->status = "suspended";
        if ($admin->save()) {
            toast('Administrator Account Suspended', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * activateAdmin
     *
     * @param mixed id
     *
     * @return void
     */
    public function activateAdmin($id)
    {
        $admin         = User::find($id);
        $admin->status = "active";
        if ($admin->save()) {
            toast('Administrator Account Activated', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * storeCustomFee
     *
     * @param Request request
     *
     * @return void
     */
    public function storeCustomFee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id'          => 'required|numeric',
            'config_type'          => 'required',
            'airtime_fee'          => 'required|numeric',
            'data_fee'             => 'required|numeric',
            'electricity_fee'      => 'required|numeric',
            'tv_fee'               => 'required|numeric',
            'inward_transfer_fee'  => 'required|numeric',
            'outward_transfer_fee' => 'required|numeric',
            'withdrawal_fee'       => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }
        try {

            $customer = User::find($request->customer_id);
            if (isset($customer)) {

                DB::beginTransaction();

                $fee                  = new CustomFeeConfig;
                $fee->user_id         = $request->customer_id;
                $fee->config_type     = $request->config_type;
                $fee->airtime_fee     = $request->airtime_fee;
                $fee->data_fee        = $request->data_fee;
                $fee->electricity_fee = $request->electricity_fee;
                $fee->tv_fee          = $request->tv_fee;
                $fee->inward_trf_fee  = $request->inward_transfer_fee;
                $fee->outward_trf_fee = $request->outward_transfer_fee;
                $fee->withdrawal_fee  = $request->withdrawal_fee;
                $fee->save();

                $customer->fee_type = "custom";
                $customer->save();

                DB::commit();
                toast('Custom Customer Fee Configuration Successful.', 'success');
                return back();

            } else {
                toast('Something went wrong. Please try again', 'error');
                return back();
            }
        } catch (\Exception $e) {
            report($e);
            DB::rollback();

            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * updateCustomFee
     *
     * @param Request request
     *
     * @return void
     */
    public function updateCustomFee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'config_id'            => 'required|numeric',
            'config_type'          => 'required',
            'airtime_fee'          => 'required|numeric',
            'data_fee'             => 'required|numeric',
            'electricity_fee'      => 'required|numeric',
            'tv_fee'               => 'required|numeric',
            'inward_transfer_fee'  => 'required|numeric',
            'outward_transfer_fee' => 'required|numeric',
            'withdrawal_fee'       => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $fee                  = CustomFeeConfig::find($request->config_id);
        $fee->config_type     = $request->config_type;
        $fee->airtime_fee     = $request->airtime_fee;
        $fee->data_fee        = $request->data_fee;
        $fee->electricity_fee = $request->electricity_fee;
        $fee->tv_fee          = $request->tv_fee;
        $fee->inward_trf_fee  = $request->inward_transfer_fee;
        $fee->outward_trf_fee = $request->outward_transfer_fee;
        $fee->withdrawal_fee  = $request->withdrawal_fee;
        if ($fee->save()) {
            toast('Custom Customer Fee Configuration Updated Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }

    }

    /**
     * transfers
     *
     * @return void
     */
    public function transfers($category)
    {
        $transactions = TransferTrxs::orderBy("id", "desc")->where("category", $category)->where('created_at', '>=', Carbon::now()->subDays(30))->get();

        $label = $category == "inward" ? "Sender" : "Recipient";
        return view("admin.transfers", compact("category", "transactions", "label"));
    }

    /**
     * filterTransferTrxs
     *
     * @param Request request
     *
     * @return void
     */
    public function filterTransferTrxs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'   => 'required',
            'start_date' => 'required',
            'end_date'   => 'required',
        ]);

        $startDate = $this->cleanDate($request->start_date);
        $endDate   = $this->cleanDate($request->end_date);

        if ($startDate > $endDate) {
            toast('End Date must be a date after Start Date.', 'error');
            return back();
        }

        return redirect()->route("admin.fetchTransferTrxs", [$request->category, $startDate, $endDate]);
    }

    /**
     * fetchTransferTrxs
     *
     * @param mixed category
     * @param mixed startDate
     * @param mixed endDate
     *
     * @return void
     */
    public function fetchTransferTrxs($category, $startDate = null, $endDate = null)
    {

        $startDate = $this->purifyDate($startDate);
        $endDate   = $this->purifyDate($endDate);

        $transactions = TransferTrxs::orderBy("id", "desc")->where("category", $category)->whereBetween('created_at', [$startDate, $endDate])->get();

        $label = $category == "inward" ? "Sender" : "Recipient";
        return view("admin.transfers", compact("transactions", "category", "startDate", "endDate", "label"));
    }

    /**
     * requeryUtilityTransaction
     *
     * @param mixed id
     *
     * @return void
     */
    public function requeryUtilityTransaction($id)
    {
        $transaction = UtilityTransaction::find($id);
        if (isset($transaction)) {
            $vendorCode    = env("IRC_VENDOR_CODE");
            $trxType       = strtolower($transaction->service);
            $accessToken   = $transaction->access_token;
            $generatedHash = $transaction->generated_hash;
            $response      = Http::get(env("IRC_TEST_BASEURL") . "/vend_status.php?vendor_code=$vendorCode&type=$trxType&access_token=$accessToken&hash=$generatedHash&response_format=json");

            $data = json_decode($response, true);

            if ($data["status"] == "00") {
                toast('Transaction Status Requeried and Updated Successfully.', 'success');
                return back();

            } else {
                toast("Something Went Wrong. " . $data["message"], 'error');
                return back();
            }

        } else {
            toast('Something Went Wrong. Could Not Find This Transaction', 'error');
            return back();
        }
    }

    /**
     * requeryTransferTransaction
     *
     * @param mixed id
     *
     * @return void
     */
    public function requeryTransferTransaction($id)
    {
        $transaction = TransferTrxs::find($id);
        if (isset($transaction)) {

            $url = "http://52.168.85.231/thirdpartyapiservice/apiservice/Transactions/TransactionStatusQuery";

            $postData = [
                'RetrievalReference' => Str::uuid(),
                'TransactionDate'    => Str::uuid(),
                'Token'              => env("MY_BANK_ONE_AUTH_TOKEN"),
            ];

            $response = Http::post($url, $postData);
            $data     = json_decode($response, true);

            if ($response->failed()) {
                dd($data);
                toast('Something Went Wrong. ', 'error');
                return back();

            }

            toast('Transaction Status Requeried and Updated Successfully.', 'success');
            return back();

        } else {
            toast('Something Went Wrong. Could Not Find This Transaction', 'error');
            return back();
        }
    }

    /**
     * requeryPOSTransaction
     *
     * @param mixed id
     *
     * @return void
     */
    public function requeryPOSTransaction($id)
    {
        $admin = Admin::findOrFail(auth()->guard('admin')->user()->id);
        if ($admin->transfer != 1 || $admin->withdraw != 1) {
            return back()->with(["error" => "You do not have permission to take this action"]);
        }
        $data = PosTrans::where(['id' => $id, 'status' => 'Pending'])->first();
        if (! $data) {
            return back()->with('error', "Not a Pending transaction");
        }

        if ($data->gateway == "PROVIDUS") {
            //
            $acc      = explode("|", $data->to);
            $bankCode = $acc[1];
            $call     = new ProvidusBucket();
            $new      = new Request([
                'reference' => $data->ref,
            ]);
            $res = $call->requery($new);

            if (isset($res['responseCode'])) {
                $status     = $res['responseCode'];
                $rep        = explode("|", $res);
                $session_id = $rep[2] ?? '';
            } else {
                $rep        = explode("|", $res);
                $status     = $rep[0];
                $session_id = $rep[2] ?? '';
            }

            // check for outright fail response code
            if ($bankCode == "000023") {
                $fail = ["32", "7701", "7702", "7703", "7704", "7709", "8005", "8888"];
            } else {
                $fail = ["03", "05", "06", "07", "11", "12", "13", "14", "15", "16", "17", "18", "21", "25", "26", "30", "31", "32", "505", "51", "57", "58", "61", "63", "65", "7701", "7709", "8005", "8888", "91", "92", "94", "96"];
            }

            if (in_array($status, $fail)) {
                // update log gateway
                $data->status = "Failed";
                $data->save();
                // auto refund | initiate refund transaction
                Log::info("(XtraPay) POS Withdrawal Failed: Auto refund attempt. Transaction Ref: " . $data->ref);
                // find terminal to refund
                $gnl      = GeneralSettings::first();
                $trx      = Carbon::now()->format('YmdHi') . rand();
                $ref      = "POS|XTRA_" . $trx;
                $terminal = Terminal::where(['pos_id' => $data->pos_id])->first();

                $total = $data->amount + $data->fee;
                if ($data->profit != 0) {
                    if ($data->profit < 0) {
                        // add up back to profit balance
                        $profit = "10";
                    } else {
                        // remove the profit
                        $profit = "-10";
                    }
                } else {
                    $profit = 0;
                }
                // log reversal transaction
                $tr = PosTrans::create([
                    'user_id'        => $terminal->user_id,
                    'pos_id'         => $terminal->id,
                    'title'          => 'Fund Reversed',
                    'service'        => 'reversal',
                    'icon'           => 'wallet_purple',
                    'description'    => $gnl->currency_sym . number_format(floatval($data->amount), $gnl->decimal) . ' reversed to ' . $terminal->name,
                    'narration'      => 'Reversal of transaction ' . $data->ref,
                    'amount'         => $data->amount,
                    'discount'       => 0,
                    'fee'            => 0,
                    'total'          => 0,
                    'init_bal'       => $terminal->balance,
                    'new_bal'        => $terminal->balance + $total,
                    'from'           => $data->ref,
                    'to'             => $terminal->terminal_id . " | " . $terminal->name,
                    'profit'         => $profit,
                    'point'          => 0,
                    'trx'            => $trx,
                    'ref'            => $ref,
                    'transactionRef' => null,
                    'sessionId'      => null,
                    'purchase_code'  => null,
                    'type'           => 0,
                    'status'         => "Successful",
                ]);
                // credit terminal wallet for the reversal value
                $terminal->balance += $total;
                $terminal->save();
                // remove referral earning on transaction
                if ($data->point > 0) {
                    // remove the profit
                }
                $data->status = "Reversed";
                $data->save();

                return back()->with('success', "POS Requery processed");
            }

            if ($status == "00") {
                $data->status    = "Successful";
                $data->sessionId = $session_id;
                $data->save();

                Log::info("(XtraPay) POS Withdrawal Successful. Ref: " . $data->ref);

                return back()->with('success', "POS Withdrawal Successful");
            } else {
                return back()->with('success', "POS Withdrawal Status not determined yet, contact service provider");
            }

        } elseif ($data->gateway == "VFD") {
            //
        } else {
            return back()->with('error', "Gateway Not determined");
        }
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

    public function bankOneDate($date)
    {
        $date    = str_replace('/', '-', $date);
        $newDate = date('Y-m-d', strtotime($date));
        return $newDate;
    }
}
