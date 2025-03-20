<?php

namespace App\Http\Controllers\Workers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\CustomerTransactions;
use App\Models\EndOfDay;
use App\Models\EndOfMonth;
use App\Models\EndOfYear;
use Carbon\Carbon;

class ServiceWorkers extends Controller
{
    /**
     * endOfDay
     *
     * @return void
     */
    public function endOfDay($date = null)
    {
        // Use the current date if no date is provided
        $date = $date ?? Carbon::yesterday();

        $dateExist = EndOfDay::whereDate("trnx_date", $date)->first();

        if (!isset($dateExist)) {

            //Utilities

            //Airtime
            $airtimeAmount = CustomerTransactions::whereDate('created_at', $date)->where("service", "airtime")->sum("amount");
            $airtimeFees = CustomerTransactions::whereDate('created_at', $date)->where("service", "airtime")->sum("trx_fee");

            //Data
            $dataAmount = CustomerTransactions::whereDate('created_at', $date)->where("service", "data")->sum("amount");
            $dataFees = CustomerTransactions::whereDate('created_at', $date)->where("service", "data")->sum("trx_fee");

            //Electricity
            $powerAmount = CustomerTransactions::whereDate('created_at', $date)->where("service", "power")->sum("amount");
            $powerFees = CustomerTransactions::whereDate('created_at', $date)->where("service", "power")->sum("trx_fee");

            //TV
            $tvAmount = CustomerTransactions::whereDate('created_at', $date)->where("service", "tv")->sum("amount");
            $tvFees = CustomerTransactions::whereDate('created_at', $date)->where("service", "tv")->sum("trx_fee");

            //Total Utilities
            $utilities = CustomerTransactions::whereDate('created_at', $date)->whereIn("service", ["airtime", "data", "tv", "power"])->sum("amount");
            $utilityFees = CustomerTransactions::whereDate('created_at', $date)->whereIn("service", ["airtime", "data", "tv", "power"])->sum("trx_fee");

            //POS Withdrawals
            $drwAmount = CustomerTransactions::whereDate('created_at', $date)->where("service", "withdrawal")->where("category", "pos")->sum("amount");
            $drwFees = CustomerTransactions::whereDate('created_at', $date)->where("service", "withdrawal")->where("category", "pos")->sum("trx_fee");

            //Transfers

            //Inward Transfer
            $inTrfAmount = CustomerTransactions::whereDate('created_at', $date)->where("service", "transfer")->where("category", "inward")->sum("amount");
            $inTrfFees = CustomerTransactions::whereDate('created_at', $date)->where("service", "transfer")->where("category", "inward")->sum("trx_fee");

            //Outward Transfers
            $outTrfAmount = CustomerTransactions::whereDate('created_at', $date)->where("service", "transfer")->where("category", "outward")->sum("amount");
            $outTrfFees = CustomerTransactions::whereDate('created_at', $date)->where("service", "transfer")->where("category", "outward")->sum("trx_fee");

            //Total Transfers
            $totalTrf = CustomerTransactions::whereDate('created_at', $date)->where("service", "transfer")->whereIn("category", ["inward", "outward"])->sum("amount");
            $trfFees = CustomerTransactions::whereDate('created_at', $date)->where("service", "transfer")->whereIn("category", ["inward", "outward"])->sum("trx_fee");

            //Total Transactions
            $totalAmount = CustomerTransactions::whereDate('created_at', $date)->sum("amount");
            $totalFees = CustomerTransactions::whereDate('created_at', $date)->sum("trx_fee");

            $eod = new EndOfDay;
            $eod->airtime = $airtimeAmount;
            $eod->airtime_fees = $airtimeFees;
            $eod->data = $dataAmount;
            $eod->data_fees = $dataFees;
            $eod->electricity = $powerAmount;
            $eod->electricity_fees = $powerFees;
            $eod->tv = $tvAmount;
            $eod->tv_fees = $tvFees;
            $eod->total_utilities = $utilities;
            $eod->utility_fees = $utilityFees;
            $eod->inward_transfer = $inTrfAmount;
            $eod->inward_fees = $inTrfFees;
            $eod->outward_transfer = $outTrfAmount;
            $eod->outward_fees = $outTrfFees;
            $eod->total_transfers = $outTrfFees;
            $eod->transfer_fees = $trfFees;
            $eod->pos_withdrawals = $drwAmount;
            $eod->withdrawal_fees = $drwFees;
            $eod->total_transfers = $drwAmount;
            $eod->transfer_fees = $drwFees;
            $eod->total_transactions = $totalAmount;
            $eod->total_fees = $totalFees;
            $eod->trnx_date = $date;
            $eod->save();
        } else {
            return ResponseHelper::error('End of Day Already Catpured For The Provided Date');
        }
    }

    /**
     * endOfMonth
     *
     * @return void
     */
    public function endOfMonth($month = null, $year = null)
    {
        // Use the current month and year if no month and year is provided
        $month = $month ?? Carbon::now()->subMonth()->format('F');
        $numMonth = Carbon::createFromFormat('F', 'December')->month;
        $lastYear = Carbon::now()->subYear()->year;
        $year = $year ?? ($month == "December" ? $lastYear : date("Y"));

        $eomExist = EndOfMonth::where('month', $month)->where('year', $year)->first();

        if (!isset($eomExist)) {

            //Utilities

            //Airtime
            $airtimeAmount = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("airtime");
            $airtimeFees = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("airtime_fees");

            //Data
            $dataAmount = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("data");
            $dataFees = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("data_fees");

            //Electricity
            $powerAmount = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("electricity");
            $powerFees = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("electricity_fees");

            //TV
            $tvAmount = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("tv");
            $tvFees = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("tv_fees");

            //Total Utilities
            $utilities = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("total_utilities");
            $utilityFees = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("utility_fees");

            //POS Withdrawals
            $drwAmount = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("pos_withdrawals");
            $drwFees = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("withdrawal_fees");

            //Transfers

            //Inward Transfer
            $inTrfAmount = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("inward_transfer");
            $inTrfFees = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("inward_fees");

            //Outward Transfers
            $outTrfAmount = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("outward_transfer");
            $outTrfFees = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("outward_fees");

            //Total Transfers
            $totalTrf = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("total_transfers");
            $trfFees = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("transfer_fees");

            //Total Transactions
            $totalAmount = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("total_transactions");
            $totalFees = EndOfDay::whereMonth('trnx_date', $numMonth)->whereYear('trnx_date', $year)->sum("total_fees");

            $eom = new EndOfMonth;
            $eom->month = $month;
            $eom->year = $year;
            $eom->airtime = $airtimeAmount;
            $eom->airtime_fees = $airtimeFees;
            $eom->data = $dataAmount;
            $eom->data_fees = $dataFees;
            $eom->electricity = $powerAmount;
            $eom->electricity_fees = $powerFees;
            $eom->tv = $tvAmount;
            $eom->tv_fees = $tvFees;
            $eom->total_utilities = $utilities;
            $eom->utility_fees = $utilityFees;
            $eom->inward_transfer = $inTrfAmount;
            $eom->inward_fees = $inTrfFees;
            $eom->outward_transfer = $outTrfAmount;
            $eom->outward_fees = $outTrfFees;
            $eom->total_transfers = $outTrfFees;
            $eom->transfer_fees = $trfFees;
            $eom->pos_withdrawals = $drwAmount;
            $eom->withdrawal_fees = $drwFees;
            $eom->total_transfers = $drwAmount;
            $eom->transfer_fees = $drwFees;
            $eom->total_transactions = $totalAmount;
            $eom->total_fees = $totalFees;
            $eom->save();
        } else {
            return ResponseHelper::error('End of Month Already Catpured For The Provided Month and Year');
        }
    }

    /**
     * endOfYear
     *
     * @return void
     */
    public function endOfYear($year = null)
    {
        // Use the current year if no year is provided
        $year = Carbon::now()->subYear()->year;

        $eoyExist = EndOfYear::where('year', $year)->first();

        if (!isset($eoyExist)) {
            //Utilities

            //Airtime
            $airtimeAmount = EndOfMonth::where('year', $year)->sum("airtime");
            $airtimeFees = EndOfMonth::where('year', $year)->sum("airtime_fees");

            //Data
            $dataAmount = EndOfMonth::where('year', $year)->sum("data");
            $dataFees = EndOfMonth::where('year', $year)->sum("data_fees");

            //Electricity
            $powerAmount = EndOfMonth::where('year', $year)->sum("electricity");
            $powerFees = EndOfMonth::where('year', $year)->sum("electricity_fees");

            //TV
            $tvAmount = EndOfMonth::where('year', $year)->sum("tv");
            $tvFees = EndOfMonth::where('year', $year)->sum("tv_fees");

            //Total Utilities
            $utilities = EndOfMonth::where('year', $year)->sum("total_utilities");
            $utilityFees = EndOfMonth::where('year', $year)->sum("utility_fees");

            //POS Withdrawals
            $drwAmount = EndOfMonth::where('year', $year)->sum("pos_withdrawals");
            $drwFees = EndOfMonth::where('year', $year)->sum("withdrawal_fees");

            //Transfers

            //Inward Transfer
            $inTrfAmount = EndOfMonth::where('year', $year)->sum("inward_transfer");
            $inTrfFees = EndOfMonth::where('year', $year)->sum("inward_fees");

            //Outward Transfers
            $outTrfAmount = EndOfMonth::where('year', $year)->sum("outward_transfer");
            $outTrfFees = EndOfMonth::where('year', $year)->sum("outward_fees");

            //Total Transfers
            $totalTrf = EndOfMonth::where('year', $year)->sum("total_transfers");
            $trfFees = EndOfMonth::where('year', $year)->sum("transfer_fees");

            //Total Transactions
            $totalAmount = EndOfMonth::where('year', $year)->sum("total_transactions");
            $totalFees = EndOfMonth::where('year', $year)->sum("total_fees");

            $eoy = new EndOfYear;
            $eoy->year = $year;
            $eoy->airtime = $airtimeAmount;
            $eoy->airtime_fees = $airtimeFees;
            $eoy->data = $dataAmount;
            $eoy->data_fees = $dataFees;
            $eoy->electricity = $powerAmount;
            $eoy->electricity_fees = $powerFees;
            $eoy->tv = $tvAmount;
            $eoy->tv_fees = $tvFees;
            $eoy->total_utilities = $utilities;
            $eoy->utility_fees = $utilityFees;
            $eoy->inward_transfer = $inTrfAmount;
            $eoy->inward_fees = $inTrfFees;
            $eoy->outward_transfer = $outTrfAmount;
            $eoy->outward_fees = $outTrfFees;
            $eoy->total_transfers = $outTrfFees;
            $eoy->transfer_fees = $trfFees;
            $eoy->pos_withdrawals = $drwAmount;
            $eoy->withdrawal_fees = $drwFees;
            $eoy->total_transfers = $drwAmount;
            $eoy->transfer_fees = $drwFees;
            $eoy->total_transactions = $totalAmount;
            $eoy->total_fees = $totalFees;
            $eoy->save();
        } else {
            return ResponseHelper::error('End of Year Already Catpured For The Provided Year');
        }
    }
}
