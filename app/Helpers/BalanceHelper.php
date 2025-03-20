<?php
namespace App\Helpers;

use App\Models\CustomerBalances;

class BalanceHelper
{

    public static function addToBalance($businessId, $amount)
    {
        $balance = CustomerBalances::where("business_id", $businessId)->first();
        if (isset($balance)) {
            $balance->account_balance = (float) ($balance->account_balance + abs($amount));
            $balance->save();
        }
    }

    public static function deductFromBalance($businessId, $amount)
    {
        $balance = CustomerBalances::where("business_id", $businessId)->first();
        if (isset($balance)) {
            $balance->account_balance = (float) ($balance->account_balance - abs($amount));
            $balance->save();
        }

    }

}
