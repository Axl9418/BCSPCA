<?php
require 'connection.php';
require 'phoneTypeFunctions.php';

//Change Business type to phone
businessToPhone();

businessComments();

OtherTypeToPhone();

setinactive();

businessToEmail();

emailBusinessComments();

wrongPrimaryPhone();

firstPrimaryPhone();

setPrimaryPhone();

wrongPrimaryEmail();

firstPrimaryEmail();

setPrimaryEmail();

fillPhoneExportTable();

fillEmailExportTable();

fillPhoneFormat();

formatPhone();

invalidPhone();

concatPhone();

deleteType();

//setPrimaryPhone();

//setPrimaryEmail();


?>