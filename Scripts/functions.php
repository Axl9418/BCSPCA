<?php

//HOME COUNTRY to Canada
function HomeCountry() {
  $HomeCountry = "UPDATE `new_donors_original`
  SET `HOME_COUNTRY` = 'Canada'
  WHERE `HOME_COUNTRY` IN ('', 'CA')";
  
  return getdb()->query($HomeCountry);
}

//Review and fix Postal Codes
function foreignCountries() {
  $foreignCountries = "SELECT `CONS_ID`,`HOME_ZIP`
  FROM `new_donors_original`
  WHERE `HOME_COUNTRY` NOT IN ('Canada')";

  return getdb()->query($foreignCountries);
}

//Fix the country to Canada if necessary
function fixHomeCountry($id) {
  $fixHomeCountry = "UPDATE `new_donors_original`
  SET `HOME_COUNTRY` = 'Canada'
  WHERE `CONS_ID` = ". $id;

  return getdb()->query($fixHomeCountry);
}

function deleteRecord($id) {
  $deleteRecord = "DELETE FROM `new_donors_original` WHERE `CONS_ID` = " . $id;
  
  return getdb()->query($deleteRecord);
}

//Fill Home States blanks
function homeStates() {
  $homeStates = "UPDATE `new_donors_original`
  SET `HOME_STATEPROV` = 'BC'
  WHERE `HOME_STATEPROV` IN ('', 'British Columbia')";

  return getdb()->query($homeStates);
} 

//Check for Canada provinces
function provincesCA() {
  $provincesCA = "SELECT `CONS_ID`,`HOME_STATEPROV`,`HOME_COUNTRY`,`HOME_ZIP`
  FROM `new_donors_original`
  WHERE `HOME_STATEPROV` NOT IN ('AB', 'BC' , 'MB', 'NB', 'NL', 'NT', 'NS', 'NU', 'ON', 'PE', 'QC', 'SK', 'YT')";

  return getdb()->query($provincesCA);
}

//Map a Canadian Postal Code to the matching Province
function postal_to_province($postal_code = '') {
  static $provinces = array(
      'A' => 'NL',
      'a' => 'NL',
      'B' => 'NS',
      'b' => 'NS',
      'C' => 'PE',
      'c' => 'PE',
      'E' => 'NB',
      'e' => 'NB',
      'G' => 'QC',
      'g' => 'QC',
      'H' => 'QC',
      'h' => 'QC',
      'J' => 'QC',
      'j' => 'QC',
      'K' => 'ON',
      'k' => 'ON',
      'L' => 'ON',
      'l' => 'ON',
      'M' => 'ON',
      'm' => 'ON',
      'N' => 'ON',
      'n' => 'ON',
      'P' => 'ON',
      'p' => 'ON',
      'R' => 'MB',
      'r' => 'MB',
      'S' => 'SK',
      's' => 'SK',
      'T' => 'AB',
      't' => 'AB',
      'V' => 'BC',
      'v' => 'BC',
      'X' => 'NT',
      'x' => 'NT',
      'Y' => 'YT',
      'y' => 'YT',
  );

  $city = '';

      $postal_letter = substr( $postal_code, 0, 1 );
      if ( $postal_letter && ! is_numeric( $postal_letter ) && array_key_exists( $postal_letter, $provinces ) ) {
          $city = $provinces[ $postal_letter ];
      }

  return $city;
}


//Update province if needed
function updateProvinces($province, $id) {
  $updateProvinces = "UPDATE `new_donors_original`
  SET `HOME_STATEPROV` = '$province' 
  WHERE `CONS_ID` = '$id' ";

  return getdb()->query($updateProvinces);
}

//------------------------------------------------------------------------------------------------------------------
//Delete Champions

function deleteChampions() {
  $deleteChampions = "DELETE FROM `new_donors_original` WHERE `CAMPAIGN_NAME` like '%champions%'";

  return getdb()->query($deleteChampions);
}

 ?>