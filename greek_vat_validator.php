<?php
/**
 * GreekVATValidator
 *
 * @link https://github.com/kanellov/config-merge
 * @copyright Copyright (c) 2015 Vassilis Kanellopoulos - contact@kanellov.com
 * @license https://raw.githubusercontent.com/kanellov/greek-vat-validator/master/LICENSE
 */
namespace Knlv;

/**
 * Validates Greek VAT number
 * @param  string $value
 * @return bool
 */
function greek_vat_validator($value)
{
    if (!preg_match('/^(EL)?[0-9]{9}$/i', $value)) {
        return false;
    }

    if (strlen($value) > 9) {
        $value = substr($value, 2);
    }

    $remainder = 0;
    $sum       = 0;

    for ($nn = 2, $k = 7, $sum = 0; $k >= 0; $k--, $nn += $nn) {
        $sum += $nn * ($value[$k]);
    }
    $remainder = $sum % 11;

    return ($remainder === 10) ? $value[8] == '0' : $value[8] == $remainder;
}
