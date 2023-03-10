<?php
require 'connection.php';
require 'functions.php';
require 'zipValidation.php';

//Fix Home country and Postal codes
//-------------------------------------------------------------------------------------------------------------
HomeCountry();
closedb();

$result = foreignCountries();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      //echo "CONS ID: " . $row["CONS_ID"]. " - ZIP: " . $row["HOME_ZIP"]. "<br>";
      if($postalCode = postalCode($row["HOME_ZIP"])==true) {
            fixHomeCountry($row["CONS_ID"]);
      } else{
        //echo $row["HOME_ZIP"] . "Is an invalid postal code <br>";
        deleteRecord($row["CONS_ID"]);
      }
    }
  } 

  closedb();
//-------------------------------------------------------------------------------------------------------------

//Home States fixes
//-------------------------------------------------------------------------------------------------------------
homeStates();

$result = provincesCA();

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    //echo "CONS ID: " . $row["CONS_ID"]. " - PROVINCE: " . $row["HOME_STATEPROV"]. " - ZIP: " . $row["HOME_ZIP"]. " - COUNTRY: " . $row["HOME_COUNTRY"]."<br>";
    if($postalCode = postalCode($row["HOME_ZIP"])==true && $row["HOME_COUNTRY"] == "Canada") {
          //Get Province base on postal code
          $province = postal_to_province($row["HOME_ZIP"]);

          if($province != '') {
            updateProvinces($province,$row["CONS_ID"]);
          }
          
    } else{
      //echo $row["HOME_ZIP"] . "Is an invalid postal code <br>";
      deleteRecord($row["CONS_ID"]);
    }
  }
} 

//Delete records that contains Champions
deleteChampions();

//Delete sustaining records
deleteSustaining();

//Delete no first time donors
noNewDonors();

//Format DONATION_DATE date
formatDate();

//Delete blank phone records
noPhone();


?>