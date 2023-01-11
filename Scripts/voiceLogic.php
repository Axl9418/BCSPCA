<?php
require 'connection.php';
require 'functions.php';
require 'zipValidation.php';

//HOME COUNTRY FIXES
/*$fixHomeCountry = "UPDATE `new_donors_original`
SET `HOME_COUNTRY` = 'Canada'
WHERE `HOME_COUNTRY` IN ('', 'CA')";
$result = getdb()->query($fixHomeCountry);*/

//Populate with Canada blanks and CA records
HomeCountry();
closedb();



//Review and fix Postal Codes
/*$foreignCountries = "SELECT `CONS_ID`,`HOME_ZIP`
FROM `new_donors_original`
WHERE `HOME_COUNTRY` NOT IN ('Canada')";*/

$result = foreignCountries();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      //echo "CONS ID: " . $row["CONS_ID"]. " - ZIP: " . $row["HOME_ZIP"]. "<br>";
      if($postalCode = postalCode($row["HOME_ZIP"])==true) {

            /*$fixHomeCountry = "UPDATE `new_donors_original`
            SET `HOME_COUNTRY` = 'Canada'
            WHERE `CONS_ID` = ". $row["CONS_ID"];
            //Fix the country to Canada if necessary
            $query = getdb()->query($fixHomeCountry); */

            fixHomeCountry($row["CONS_ID"]);

      } else{
        //echo $row["HOME_ZIP"] . "Is an invalid postal code <br>";
        //Delete rows that are not Canadian postal codes
        //$deleteCountry = "DELETE FROM `new_donors_original` WHERE `CONS_ID` = " . $row["CONS_ID"];
        deleteCountry($row["CONS_ID"]);
      }
    }
  } 

  closedb();


?>