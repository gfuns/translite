<?php

namespace App\Helpers;

use App\Models\CustomFeeConfig;
use App\Models\FeeConfig;
use App\Models\User;

class FeeHelper
{

    /**
     * Get the fee assigned to a customer.
     *
     * @param int $customerId
     * @return float|null
     */
    public static function getInwardTransferFee(int $customerId, float $amount)
    {
        $customer = User::find($customerId);
        if ($customer->fee_type == "generic") {
            $fee = FeeConfig::where("trans_type", "transfer")->where("category", "inward")->first();
            if ($fee->config == "fixed") {
                return $fee->fee_amount;
            } else {
                return (($fee->fee_amount / 100) * $amount);
            }
        } else {
            $fee = CustomFeeConfig::where("user_id", $customer->id)->first();
            if ($fee->config_type == "fixed") {
                return $fee->inward_trf_fee;
            } else {
                return (($fee->inward_trf_fee / 100) * $amount);
            }
        }

    }

    /**
     * getOutwardTransferFee
     *
     * @param int customerId
     * @param float amount
     *
     * @return void
     */
    public static function getOutwardTransferFee(int $customerId, float $amount)
    {
        $customer = User::find($customerId);
        if ($customer->fee_type == "generic") {
            $fee = FeeConfig::where("trans_type", "transfer")->where("category", "outward")->first();
            if ($fee->config == "fixed") {
                return $fee->fee_amount;
            } else {
                return (($fee->fee_amount / 100) * $amount);
            }
        } else {
            $fee = CustomFeeConfig::where("user_id", $customer->id)->first();
            if ($fee->config_type == "fixed") {
                return $fee->outward_trf_fee;
            } else {
                return (($fee->outward_trf_fee / 100) * $amount);
            }
        }

    }

    /**
     * getWithdrawalFee
     *
     * @param int customerId
     * @param float amount
     *
     * @return void
     */
    public static function getWithdrawalFee(int $customerId, float $amount)
    {
        $customer = User::find($customerId);
        if ($customer->fee_type == "generic") {
            $fee = FeeConfig::where("trans_type", "withdrawal")->where("category", "pos")->first();
            if ($fee->config == "fixed") {
                return $fee->fee_amount;
            } else {
                return (($fee->fee_amount / 100) * $amount);
            }
        } else {
            $fee = CustomFeeConfig::where("user_id", $customer->id)->first();
            if ($fee->config_type == "fixed") {
                return $fee->withdrawal_fee;
            } else {
                return (($fee->withdrawal_fee / 100) * $amount);
            }
        }

    }

    /**
     * getAirtimeFee
     *
     * @param int customerId
     * @param float amount
     *
     * @return void
     */
    public static function getAirtimeFee(int $customerId, float $amount)
    {
        $customer = User::find($customerId);
        if ($customer->fee_type == "generic") {
            $fee = FeeConfig::where("trans_type", "utilities")->where("category", "airtime")->first();
            if ($fee->config == "fixed") {
                return $fee->fee_amount;
            } else {
                return (($fee->fee_amount / 100) * $amount);
            }
        } else {
            $fee = CustomFeeConfig::where("user_id", $customer->id)->first();
            if ($fee->config_type == "fixed") {
                return $fee->airtime_fee;
            } else {
                return (($fee->airtime_fee / 100) * $amount);
            }
        }

    }

    /**
     * getDataFee
     *
     * @param int customerId
     * @param float amount
     *
     * @return void
     */
    public static function getDataFee(int $customerId, float $amount)
    {
        $customer = User::find($customerId);
        if ($customer->fee_type == "generic") {
            $fee = FeeConfig::where("trans_type", "utilities")->where("category", "data")->first();
            if ($fee->config == "fixed") {
                return $fee->fee_amount;
            } else {
                return (($fee->fee_amount / 100) * $amount);
            }
        } else {
            $fee = CustomFeeConfig::where("user_id", $customer->id)->first();
            if ($fee->config_type == "fixed") {
                return $fee->data_fee;
            } else {
                return (($fee->data_fee / 100) * $amount);
            }
        }

    }

    /**
     * getPowerFee
     *
     * @param int customerId
     * @param float amount
     *
     * @return void
     */
    public static function getPowerFee(int $customerId, float $amount)
    {
        $customer = User::find($customerId);
        if ($customer->fee_type == "generic") {
            $fee = FeeConfig::where("trans_type", "utilities")->where("category", "power")->first();
            if ($fee->config == "fixed") {
                return $fee->fee_amount;
            } else {
                return (($fee->fee_amount / 100) * $amount);
            }
        } else {
            $fee = CustomFeeConfig::where("user_id", $customer->id)->first();

            if ($fee->config_type == "fixed") {
                return $fee->electricity_fee;
            } else {
                return (($fee->electricity_fee / 100) * $amount);
            }
        }

    }

    /**
     * getTvFee
     *
     * @param int customerId
     * @param float amount
     *
     * @return void
     */
    public static function getTvFee(int $customerId, float $amount)
    {
        $customer = User::find($customerId);
        if ($customer->fee_type == "generic") {
            $fee = FeeConfig::where("trans_type", "utilities")->where("category", "tv")->first();
            if ($fee->config == "fixed") {
                return $fee->fee_amount;
            } else {
                return (($fee->fee_amount / 100) * $amount);
            }
        } else {
            $fee = CustomFeeConfig::where("user_id", $customer->id)->first();
            if ($fee->config_type == "fixed") {
                return $fee->tv_fee;
            } else {
                return (($fee->tv_fee / 100) * $amount);
            }
        }

    }

}
