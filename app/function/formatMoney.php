<?php

if (!function_exists('formatMoney')) {
    function FormatMoney($amount, $currency = 'VND')
    {
        return number_format($amount, 0, ',', '.') . ' ' . $currency;
    }
}
