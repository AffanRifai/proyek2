<?php

namespace App\Helpers;

use Midtrans\Config;

class MidtransHelper
{
    public static function initialize()
    {
        // Cek apakah class Config ada
        if (!class_exists('Midtrans\Config')) {
            throw new \Exception('Midtrans package tidak terinstall');
        }

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = config('midtrans.is_sanitized', true);
        Config::$is3ds = config('midtrans.is_3ds', true);
    }
}
