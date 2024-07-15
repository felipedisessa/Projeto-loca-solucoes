<?php

namespace App\Helpers;

use NumberFormatter;

class FormatCurrencyHelper
{
    public static function formatCurrency($amount)
    {
        $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($amount, 'BRL');
    }
}
