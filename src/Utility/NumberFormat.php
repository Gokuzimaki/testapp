<?php

namespace App\Utility;

class NumberFormat
{
    public static function formatFineNumber($number): string
    {
        if ($number >= 1000) {
            $divider = 1000;
            $suffix = 'k';
            if ($number >= 1000000000) {
                $divider = 1000000000;
                $suffix = 'b';
            } elseif ($number >= 1000000) {
                $divider = 1000000;
                $suffix = 'm';
            }
            $result = ($number / $divider);
            $number = \round($result, 2) . $suffix;
        }

        return (string) ($number ?? '0');
    }
}
