<?php

require 'connection.php';

if(isset($_POST["Export"])){
     
     header('Content-Type: text/csv; charset=utf-8');  
     header('Content-Disposition: attachment; filename=data.csv');  
     $output = fopen("php://output", "w");  
     fputcsv($output, array('ID', 'Import ID', 'First Name', 'Last Name', 'Organization Name', 'Phone Import ID','Type','Phone','Primary','Inactive','Comments','Last Update'));  
     $query = "SELECT `ID`,`Import ID`,`First Name`,`Last Name`,`Organization Name`,`Phone Import ID`,`Type`,`Phone`,`Primary`,`Inactive`,`Comments`,`Last Update` FROM `export phone type`
     ORDER BY `ID`";  
     $result = getdb()->query($query);
     if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result))  
        {  
            fputcsv($output, $row);  
        }  
    }
     fclose($output);  
}  

?>