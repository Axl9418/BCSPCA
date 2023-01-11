<?php
/**
     * Validates a Canadian Postal Code
     *
     * @param string $postalCode the postal code to validate
     * @param string $province   the province code
     *
     * @return boolean TRUE if code is valid, FALSE otherwise
     * @access public
     * @static
     * @link www.canadapost.ca/business/tools/pg/preparation/mpp2-04-e.asp#c154
     */
    function postalCode($postalCode, $province = '')
    {
        $letters = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        if (!$province) {
            $sRegExp = "[ABCEGHJKLMNPRSTVXY][0-9][$letters]"
                     . "[ \t-]*[0-9][$letters][0-9]";

        } else {
            switch (strtoupper($province)) {
            case 'NL':          // Newfoundland and Labrador
            case 'NF':          // Newfoundland (kept for BC)
                $sRegExp = 'A';
                break;
            case 'NS':          // Nova Scotia
                $sRegExp = 'B';
                break;
            case 'PE':          // Prince Edward Island
                $sRegExp = 'C';
                break;
            case 'NB':          // New Brunswick
                $sRegExp = 'E';
                break;
            case 'QC':          // Quebec
                $sRegExp = '[GHJ]';
                break;
            case 'ON':          // Ontario
                $sRegExp = '[KLMNP]';
                break;
            case 'MB':          // Manitoba
                $sRegExp = 'R';
                break;
            case 'SK':          // Saskatchewan
                $sRegExp = 'S';
                break;
            case 'AB':          // Alberta
                $sRegExp = 'T';
                break;
            case 'BC':          // British Columbia
                $sRegExp = 'V';
                break;
            case 'NT':          // Northwest Territories
            case 'NU':          // Nunavut
                $sRegExp = 'X';
                break;
            case 'YK':          // Yukon Territory
            case 'YT':          // Yukon Territory (Canada Post)
                $sRegExp = 'Y';
                break;
            default:
                return false;
            }

            $sRegExp .= "[0-9][$letters][ \t-]*[0-9][ $letters][0-9]";
        }

        $sRegExp = '/^' . $sRegExp . '$/';

        return (bool) preg_match($sRegExp, strtoupper($postalCode));
    }
/*
$badPostCode = '48103';
$result = postalCode($badPostCode);
echo 'Test ' . $badPostCode .' : <br />';
var_export($result);
*/

?>