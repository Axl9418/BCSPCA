<?php
function getdb(){
$servername = "localhost";
$username = "root";
$password = "";
$db = "bcspca";
try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
     //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

function closedb(){
    getdb()->close();
}
?>