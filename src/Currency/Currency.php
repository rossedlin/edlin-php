<?php

namespace Edlin\Currency;

class Currency
{
    const CURRENCY_SYMBOLS = [
        'USD' => '$',    // US Dollar
        'EUR' => '€',    // Euro
        'GBP' => '£',    // British Pound
        'JPY' => '¥',    // Japanese Yen
        'CHF' => 'CHF',  // Swiss Franc
        'CAD' => '$',    // Canadian Dollar
        'AUD' => '$',    // Australian Dollar
        'NZD' => '$',    // New Zealand Dollar
        'ZAR' => 'R',    // South African Rand
        'INR' => '₹',    // Indian Rupee
        'CNY' => '¥',    // Chinese Yuan
        'RUB' => '₽',    // Russian Ruble
        'BRL' => 'R$',   // Brazilian Real
        'SEK' => 'kr',   // Swedish Krona
        'NOK' => 'kr',   // Norwegian Krone
        'DKK' => 'kr',   // Danish Krone
        'PLN' => 'zł',   // Polish Zloty
        'THB' => '฿',    // Thai Baht
        'SGD' => '$',    // Singapore Dollar
        'HKD' => '$',    // Hong Kong Dollar
        'MXN' => '$',    // Mexican Peso
        'TRY' => '₺',    // Turkish Lira
        'KRW' => '₩',    // South Korean Won
        'IDR' => 'Rp',   // Indonesian Rupiah
        'SAR' => 'ر.س', // Saudi Riyal
        'AED' => 'د.إ', // UAE Dirham
        'ILS' => '₪',    // Israeli New Shekel
        'MYR' => 'RM',   // Malaysian Ringgit
        'PHP' => '₱',    // Philippine Peso
        'CZK' => 'Kč',   // Czech Koruna
        'HUF' => 'Ft',   // Hungarian Forint
        'ARS' => '$',    // Argentine Peso
        'CLP' => '$',    // Chilean Peso
        'COP' => '$',    // Colombian Peso
        'EGP' => '£',    // Egyptian Pound
        'PKR' => '₨',    // Pakistani Rupee
    ];

    /**
     * @param string $code
     *
     * @return string|null
     */
    public static function convertCodeToSymbol(string $code): ?string
    {
        if (isset(self::CURRENCY_SYMBOLS[$code])) {
            return self::CURRENCY_SYMBOLS[$code];
        }

        return null;
    }
}
