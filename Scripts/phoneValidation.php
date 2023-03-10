<?php
/**
     * Validates a Canadian phone number.
     *
     * Can allow only seven digit numbers.
     * Also allows the formats, (xxx) xxx-xxxx, xxx xxx-xxxx,
     * And now x (xxx) xxx-xxxx
     * or various combination without spaces, dashes.
     * THIS SHOULD EVENTUALLY take a FORMAT in the options, instead
     *
     * @param string $number       phone to validate
     * @param bool   $withAreaCode require the area code?
     *
     * @return bool Whether the phone number is valid.
     * @access public
     * @static
     */
    function phoneNumber($number, $withAreaCode = true)
    {
        if ($number == '') {
            return true;
        }

        if (!$withAreaCode) {
            // just seven digits, maybe a space or dash
            return (boolean)preg_match('/^[2-9](0[0-9]|10|1[2-9]|[2-9]\d)[- ]?\d{4}$/', $number);
        }

        // ten digits, maybe  spaces and/or dashes and/or parentheses
        // maybe a 1 or a 0..
        $reg = '/^[0-1]?[- ]?(\()?[2-9](0[0-9]|10|1[2-9]|[2-8]\d)(?(1)\))[- ]?[2-9](0[0-9]|10|1[2-9]|[2-9]\d)[- ]?\d{4}$/';

        // These special area codes allow "exchange" codes to end in 11
        $special = array(
            800,
            822,
            833,
            844,
            855,
            866,
            877,
            880,
            881,
            882,
            883,
            884,
            885,
            886,
            887,
            888,
            889,
            900,
        );
        $reg2 = '/^[0-1]?[- ]?(\()?('.implode('|', $special)
                                   .')(?(1)\))[- ]?[2-9]\d{2}[- ]?\d{4}$/';

        return ((boolean)preg_match($reg, $number)
                || (boolean)preg_match($reg2, $number));
    }

$badPHone = '3345322';
$result = phoneNumber($badPHone);
echo 'Test ' . $badPHone .' : <br />';
var_export($result);
?>