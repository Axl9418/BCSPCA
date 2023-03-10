<?php

$test = array(
    '250 111 1111',
    0000000000,
    1250701820,
    0000000000,
    00000000,
    +778939856,
    '+1 07',
    '236-334-5322',
    '819 287 528',
    7569785,
    '237 416 71',
    0000000000,
    442503089528,
    '102508010505');
    
    $find = array('1','0');

//Check if the phone number in valid to avoid fake numbers
function isValidPhone($phone){
    if(preg_match('/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/', $phone )) {
        echo " Valid Phone Number <BR>";
    } else {
        echo " Invalid Phone Number <BR>";
    }
}


foreach ($test as $key => $value) {
    echo "PHONE: $value <BR>";
    //Removing spaces and special characteres
    $newValue = preg_replace("/[^0-9]/", "", $value);

    foreach($find as $key => $n){
        $pos = strpos($newValue, $n);

        if ($pos !== false && $pos == 0) {
            $newValue = substr($newValue, 1);
           // echo "CURRENT: $newValue<BR>";
        }

    }

    if(preg_match('/^[0-9]{10}+$/', $newValue)) {
        //echo "Valid Phone Number <BR>";
        isValidPhone($newValue);
        } else {
        echo "Invalid Phone Number <BR>";
        }
}

?>

