<?php
namespace App\Helpers;

class MaskAccount
{

    function maskString($string)
    {
        $length = strlen($string);

        if ($length <= 6) {
            return $string; // Handle short strings
        }

        $firstThree   = substr($string, 0, 3); // First 3 characters
        $lastThree    = substr($string, -3);   // Last 3 characters
        $middleLength = $length - 6;           // Number of middle characters

        return $firstThree . str_repeat('*', $middleLength) . $lastThree;
    }

}
