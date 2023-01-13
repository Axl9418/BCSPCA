<?php
/**
 * Map a Canadian Postal Code to the matching Province
 * Province Data Retrieved From:
 * https://www.statcan.gc.ca/pub/92-195-x/2011001/other-autre/pc-cp/tbl/tbl9-eng.htm
 */
function postal_to_province( $postal_codes = array() ) {
    static $provinces = array(
        'A' => 'Newfoundland and Labrador',
        'a' => 'Newfoundland and Labrador',
        'B' => 'Nova Scotia',
        'b' => 'Nova Scotia',
        'C' => 'Prince Edward Island',
        'c' => 'Prince Edward Island',
        'E' => 'New Brunswick',
        'e' => 'New Brunswick',
        'G' => 'Quebec',
        'g' => 'Quebec',
        'H' => 'Quebec',
        'h' => 'Quebec',
        'J' => 'Quebec',
        'j' => 'Quebec',
        'K' => 'Ontario',
        'k' => 'Ontario',
        'L' => 'Ontario',
        'l' => 'Ontario',
        'M' => 'Ontario',
        'm' => 'Ontario',
        'N' => 'Ontario',
        'n' => 'Ontario',
        'P' => 'Ontario',
        'p' => 'Ontario',
        'R' => 'Manitoba',
        'r' => 'Manitoba',
        'S' => 'Saskatchewan',
        's' => 'Saskatchewan',
        'T' => 'Alberta',
        't' => 'Alberta',
        'V' => 'British Columbia',
        'v' => 'British Columbia',
        'X' => 'Northwest Territories and Nunavut',
        'x' => 'Northwest Territories and Nunavut',
        'Y' => 'Yukon',
        'y' => 'Yukon',
    );

    $cities = array();

    foreach( $postal_codes as $key => $postal_code ) {
        $postal_letter = substr( $postal_code, 0, 1 );
        if ( $postal_letter && ! is_numeric( $postal_letter ) && array_key_exists( $postal_letter, $provinces ) ) {
            $cities[ $postal_code ] = $provinces[ $postal_letter ];
        }
    }

    return $cities;
}

// Example Usage
/*$postal_codes = array(
    'V3R 0A2',
    'J7E 5M7',
    'V5Z 2C3',
    'V7L 1C3',
    'V0G 1L0',
    'V8T 4G3',
    'V5R 4Z5',
    'V9A 5H6',
    'V7V 4H7',
    'T4N 3M5'

);
$cities = postal_to_province( $postal_codes );

foreach( $cities as $key => $city ) {
    echo $key . ' - ' . $city . '<br/>';
}*/

?>

