<?php

require 'connection.php';
 
if (isset($_POST['submit']))
{
     
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate selected file is a CSV file or not
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
        //Clean TABLE phone type
        $cleanTable = "TRUNCATE TABLE `phone type`";
        getdb()->query($cleanTable);

        //Clean TABLE export phone type
        $clean = "TRUNCATE TABLE `export phone type`";
        getdb()->query($clean);

 
        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

        // Skip the first line
        $headers = fgetcsv($csvFile);

        //Columns
        $header ='';
        foreach($headers as $key=>$value)
        {
            $header .="`".$value."`,";
            //echo "<Br>$header";
        }
        $header = substr($header, 0, -1);

        // Parse data from CSV file line by line        
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
        { 
            
            $num = count($getData);
                //Insert values
                $myVal='';
                foreach($getData as $k=>$v)
                {
                    $myVal .="'".$v."',";
                    //echo "<Br>$myVal";
                }
                

                //$header = substr($header, 0, -1);
                $myVal = substr($myVal, 0, -1); 
                //Inserting data from CSV into database
                $insert="INSERT INTO `phone type` ($header)values($myVal)";
                getdb()->query($insert);
                //echo "<Br>$insert<Br>";
            
        }

        // Close opened CSV file
        fclose($csvFile);

        //header("Location: http://localhost/bcspca/Scripts/index.php");         
    }
    else
    {
        echo "Please select valid file";
    }
}