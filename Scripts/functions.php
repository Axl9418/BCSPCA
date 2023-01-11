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

function deleteCountry($id) {
  $deleteCountry = "DELETE FROM `new_donors_original` WHERE `CONS_ID` = " . $id;
  
  return getdb()->query($deleteCountry);
}


 ?>