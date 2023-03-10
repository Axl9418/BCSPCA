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

setPrimaryPhone();


?>