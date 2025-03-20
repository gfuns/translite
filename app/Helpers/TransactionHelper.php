<?php
namespace App\Helpers;

use App\Models\CustomerNotifications;
use App\Models\CustomerTransactions;

class TransactionHelper
{

    public static function logPowerTransaction($transaction)
    {
        CustomerTransactions::create([
            'business_id'    => $transaction->business_id,
            'service'        => "power",
            'category'       => "power",
            'transaction'    => "Power Purchase ({$transaction->biller})",
            'amount'         => $transaction->amount,
            'trx_fee'        => $transaction->trx_fee,
            'status'         => $transaction->status,
            'classification' => "bills",
            'reference'      => $transaction->reference,
        ]);

        CustomerNotifications::create([
            'business_id'  => $transaction->business_id,
            'title'        => "Power Purchase ({$transaction->biller})",
            'notification' => "Your Power Purchase of N{$transaction->amount} was successful",
            'category'     => "power",
        ]);

    }

    public static function logAirtimeTransaction($transaction)
    {
        CustomerTransactions::create([
            'business_id'    => $transaction->business_id,
            'service'        => "airtime",
            'category'       => "airtime",
            'transaction'    => "{$transaction->biller} Airtime Purchase",
            'amount'         => $transaction->amount,
            'trx_fee'        => $transaction->trx_fee,
            'status'         => $transaction->status,
            'classification' => "bills",
            'reference'      => $transaction->reference,
        ]);

        CustomerNotifications::create([
            'business_id'  => $transaction->business_id,
            'title'        => "{$transaction->biller} Airtime Purchase",
            'notification' => "Your Airtime Purchase of N{$transaction->amount} was successful",
            'category'     => "airtime",
        ]);

    }

    public static function logDataTransaction($transaction)
    {
        CustomerTransactions::create([
            'business_id'    => $transaction->business_id,
            'service'        => "data",
            'category'       => "data",
            'transaction'    => "{$transaction->biller} Data Subscription",
            'amount'         => $transaction->amount,
            'trx_fee'        => $transaction->trx_fee,
            'status'         => $transaction->status,
            'classification' => "bills",
            'reference'      => $transaction->reference,
        ]);

        CustomerNotifications::create([
            'business_id'  => $transaction->business_id,
            'title'        => "{$transaction->biller} Data Subscription",
            'notification' => "Your Data Subscription of N{$transaction->amount} was successful",
            'category'     => "data",
        ]);

    }

    public static function logTvTransaction($transaction)
    {
        CustomerTransactions::create([
            'business_id'    => $transaction->business_id,
            'service'        => "tv",
            'category'       => "tv",
            'transaction'    => "{$transaction->biller} TV Subscription",
            'amount'         => $transaction->amount,
            'trx_fee'        => $transaction->trx_fee,
            'status'         => $transaction->status,
            'classification' => "bills",
            'reference'      => $transaction->reference,
        ]);

        CustomerNotifications::create([
            'business_id'  => $transaction->business_id,
            'title'        => "{$transaction->biller} TV Subscription",
            'notification' => "Your TV Subscription of N{$transaction->amount} was successful",
            'category'     => "tv",
        ]);

    }

    public static function logInwardTransfer($transaction)
    {
        CustomerTransactions::create([
            'business_id'    => $transaction->business_id,
            'service'        => "transfer",
            'category'       => "inward",
            'transaction'    => "Transfer From {$transaction->sender_name} - {$transaction->sender_bank}",
            'amount'         => $transaction->amount,
            'trx_fee'        => $transaction->fee,
            'status'         => $transaction->status,
            'classification' => "inward",
            'reference'      => $transaction->reference,
        ]);

        CustomerNotifications::create([
            'business_id'  => $transaction->business_id,
            'title'        => "Incoming Transfer",
            'notification' => "You have received N{$transaction->amount} from  {$transaction->sender_name}",
            'category'     => "inward transfer",
        ]);

    }

    public static function logOutwardTransfer($transaction)
    {
        CustomerTransactions::create([
            'business_id'    => $transaction->business_id,
            'service'        => "transfer",
            'category'       => "outward",
            'transaction'    => "Transfer To {$transaction->receiver_name} - {$transaction->receiver_bank}",
            'amount'         => $transaction->amount,
            'trx_fee'        => $transaction->trx_fee,
            'status'         => $transaction->status,
            'classification' => "outward",
            'reference'      => $transaction->reference,
        ]);

        CustomerNotifications::create([
            'business_id'  => $transaction->business_id,
            'title'        => "Outward Transfer",
            'notification' => "Your Transfer of N{$transaction->amount} To {$transaction->receiver_name} was successful",
            'category'     => "outward transfer",
        ]);

    }

    public static function logPosWithdrawal($transaction)
    {
        CustomerTransactions::create([
            'business_id'    => $transaction->business_id,
            'service'        => "withdrawal",
            'category'       => "pos",
            'transaction'    => "Cash Withdrawal of N{$transaction->amount}",
            'amount'         => $transaction->amount,
            'trx_fee'        => $transaction->fee,
            'status'         => "successful",
            'classification' => "outward",
            'reference'      => $transaction->reference,
        ]);

        CustomerNotifications::create([
            'business_id'  => $transaction->business_id,
            'title'        => "Cash Withdrawal",
            'notification' => "Your cash withdrawal of N{$transaction->amount} was successful",
            'category'     => "withdrawal",
        ]);

    }

}
