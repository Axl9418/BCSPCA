<?php
//Change Business type to phone
function businessToPhone() {

    for($i=0; $i<10; $i++){
        if($i==0){
            $businessToPhone = "UPDATE `phone type`
            SET `Type` = 'Phone #', `Comments` = 'Is a business phone'
            WHERE `Type` = 'Business #' AND `Comments` = ''";

            getdb()->query($businessToPhone);
        }else {
            $type = "Type_$i";
            $comments = "Comments_$i";

            $businessToPhone = "UPDATE `phone type`
            SET `$type` = 'Phone #', `$comments` = 'Is a business phone'
            WHERE `$type` = 'Business #' AND `$comments` = ''";
            
            getdb()->query($businessToPhone);
            
        }
    }
    
}

//Change Business type to phone and refering as a business phone in comments
function businessComments() {
    for($i=0; $i<10; $i++){
        $type = "Type";
            $comments = "Comments";

            if($i<>0){
                $type = "Type_$i";
                $comments = "Comments_$i";
            }

                $businessComments = getdb()->query("SELECT `ID`,`$comments` FROM `phone type` WHERE `$type` = 'Business #' AND `$comments` <> '';");

                if ($businessComments->num_rows > 0) {
                    
                    while($result = mysqli_fetch_assoc($businessComments)){
                        //Updating comments
                        $newComment = $result["$comments"] . "; Is a business phone";
                        
                        //Preparing query to update in BD
                        $fixComments = "UPDATE `phone type`
                        SET `$type` = 'Phone #', `$comments` = '$newComment'
                        WHERE `$type` = 'Business #' AND `ID` =  '$result[ID]' ";

                        getdb()->query($fixComments);
                    }                   
                            
                }

    }
}

//Seting type as Phone for those records where type is 'Direct #', 'Toll Free #','Other'
function OtherTypeToPhone(){

    for($i=0; $i<10; $i++){
        if($i==0){
            $OtherTypeToPhone = "UPDATE `phone type`
            SET `Type` = 'Phone #'
            WHERE `Type` IN ('Direct #', 'Toll Free #','Other')";

            getdb()->query($OtherTypeToPhone);
        }else {
            $type = "Type_$i";
            $comments = "Comments_$i";

            $OtherTypeToPhone = "UPDATE `phone type`
            SET `$type` = 'Phone #'
            WHERE `$type` IN ('Direct #', 'Toll Free #','Other')";
            
            getdb()->query($OtherTypeToPhone);
            
        }
    }
    
}

//Set as Inactive all invalid phone numbers and mark it as no primary as well
function setinactive() {

    for($i=0; $i<10; $i++){
        if($i==0){
            $setinactive = "UPDATE `phone type`
            SET `Inactive` = 'Yes', `Primary` = 'No'
            WHERE `Type` IN ('Number-Incomplete #', 'Number-Invalid', 'Number-Not In Service', 'Number-Wrong Number')";

            getdb()->query($setinactive);
        }else {
            $type = "Type_$i";
            $inactive = "Inactive_$i";
            $primary = "Primary_$i";

            $setinactive = "UPDATE `phone type`
            SET `$inactive` = 'Yes', `$primary` = 'No'
            WHERE `$type` IN ('Number-Incomplete', 'Number-Invalid', 'Number-Not In Service', 'Number-Wrong Number')";

            getdb()->query($setinactive);
            
        }
    }


}

//Change Business type to email
function businessToEmail() {

    for($i=0; $i<10; $i++){
        if($i==0){
            $businessToEmail = "UPDATE `phone type`
            SET `Email Type` = 'Email', `Comments` = 'Is a business email'
            WHERE `Email Type` = 'Email-Business' AND `Comments_10` = ''";

            getdb()->query($businessToEmail);
        }else {
            $emailType = "Email Type_$i";
            $j=$i+10;
            $comments = "Comments_$j";

            $businessToEmail = "UPDATE `phone type`
            SET `$emailType` = 'Email', `$comments` = 'Is a business email'
            WHERE `$emailType` = 'Email-Business' AND `$comments` = ''";
            
            getdb()->query($businessToEmail);
            
        }
    }

}

//Change Email-Business type to Email and refering as a business email in comments
function emailBusinessComments() {
    for($i=0; $i<10; $i++){
        $emailType = "Email Type";
            $comments = "Comments_10";

            if($i<>0){
                $emailType = "Email Type_$i";
                $j=$i+10;
                $comments = "Comments_$j";
            }

                $emailBusinessComments = getdb()->query("SELECT `ID`,`$comments` FROM `phone type` WHERE `$emailType` = 'Email-Business' AND `$comments` <> '';");

                if ($emailBusinessComments->num_rows > 0) {
                    
                    while($result = mysqli_fetch_assoc($emailBusinessComments)){
                        //Updating comments
                        $newComment = $result["$comments"] . "; Is a business email";
                        
                        //Preparing query to update in BD
                        $fixComments = "UPDATE `phone type`
                        SET `$emailType` = 'Email', `$comments` = '$newComment'
                        WHERE `$emailType` = 'Email-Business' AND `ID` =  '$result[ID]' ";

                        getdb()->query($fixComments);
                    }                   
                            
                }

    }
}

//Fixing wrong primary phone numbers
function wrongPrimaryPhone() {
    for($i=0; $i<10; $i++){
        $primary = "Primary";
            $inactive = "Inactive";

            if($i<>0){
                $primary = "Primary_$i";
                $inactive = "Inactive_$i";
            }

        $wrongPrimaryPhone= "UPDATE `phone type` SET `$primary` = 'No' WHERE `$primary` = 'Yes' AND `$inactive` = 'Yes'";
        getdb()->query($wrongPrimaryPhone);
    }
}

//Mark as a Primary records which only have 1 phone number an is valid
function firstPrimaryPhone() {

        $firstPrimaryPhone= "UPDATE `phone type` SET `Primary` = 'Yes' WHERE `Primary` = 'No' AND `Inactive` = 'No' AND `Primary_1` = '' AND `Type` Not In ('Number-Incomplete', 'Number-Invalid', 'Number-Not In Service', 'Number-Wrong Number')";
        getdb()->query($firstPrimaryPhone);
}

//Setting at least one phone as a primary for ID
function setPrimaryPhone() {
    //Dinamic query 
    $fullQuery = '';
    for($i=1; $i<10; $i++) {

        $long = strlen($fullQuery);
        $cut = $long-21;
        $extra = substr($fullQuery, 0, $cut);

        $query = "SELECT `ID` FROM `phone type` WHERE `Primary` = 'No' AND `Inactive` = 'No' AND `Type` Not In ('Number-Incomplete', 'Number-Invalid', 'Number-Not In Service', 'Number-Wrong Number')";
        $j = $i+1;
            if($i == 1){
                $complement = " AND `Primary_$i` = 'No' AND `Inactive_$i` = 'No' AND `Type_$i` Not In ('Number-Incomplete', 'Number-Invalid', 'Number-Not In Service', 'Number-Wrong Number') AND `Primary_$j` = ''";
                $fullQuery = $query.$complement;
            }else{
                if($i==9){
                    $complement = " AND `Primary_$i` = 'No' AND `Inactive_$i` = 'No' AND `Type_$i` Not In ('Number-Incomplete', 'Number-Invalid', 'Number-Not In Service', 'Number-Wrong Number')";
                }else{
                    $complement = " AND `Primary_$i` = 'No' AND `Inactive_$i` = 'No' AND `Type_$i` Not In ('Number-Incomplete', 'Number-Invalid', 'Number-Not In Service', 'Number-Wrong Number') AND `Primary_$j` = ''";
                }
                
                $fullQuery = $extra.$complement;
            }
        
        //echo "<br> $fullQuery <br><br>";
        $idToUpdate = getdb()->query($fullQuery);

        if ($idToUpdate->num_rows > 0) {
                    
            while($result = mysqli_fetch_assoc($idToUpdate)){
                //Current ID
                $id = $result['ID'];
                //echo "<BR>$id";

                //Most recent date
                $newDate = "SELECT `ID`, @highest_val:= GREATEST(`Last Update`, `Last Update_1`, `Last Update_2`, `Last Update_3`, `Last Update_4`, `Last Update_5`, `Last Update_6`, `Last Update_7`, `Last Update_8`, `Last Update_9`) AS last_update, CASE @highest_val WHEN `Last Update` THEN 'Primary' WHEN `Last Update_1` THEN 'Primary_1' WHEN `Last Update_2` THEN 'Primary_2' WHEN `Last Update_3` THEN 'Primary_3' WHEN `Last Update_4` THEN 'Primary_4' WHEN `Last Update_5` THEN 'Primary_5' WHEN `Last Update_6` THEN 'Primary_6' WHEN `Last Update_7` THEN 'Primary_7' WHEN `Last Update_8` THEN 'Primary_8' WHEN `Last Update_9` THEN 'Primary_9' END AS column_name FROM `phone type` where `ID`= $id";
                $dates = getdb()->query($newDate);
                    if ($dates->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($dates)){
                            $date = $row['last_update'];
                            //echo "<BR>$date";
                            $column = $row['column_name'];
                            //echo "<BR>$column";

                            //set Primary Phone
                            $setPrimaryPhone = "UPDATE `phone type` SET `$column` = 'Yes' WHERE `ID` = '$id'";
                            getdb()->query($setPrimaryPhone);
                        }
                    }
            }
        }
    }
        
}

//Fixing wrong primary email addresses
function wrongPrimaryEmail() {
    for($i=0; $i<10; $i++){
        $primary = "Is Primary?";
            $inactive = "Is Inactive?";

            if($i<>0){
                $primary = "Is Primary_$i?";
                $inactive = "Is Inactive_$i?";
            }

        $wrongPrimaryEmail= "UPDATE `phone type` SET `$primary` = 'No' WHERE `$primary` = 'Yes' AND `$inactive` = 'Yes'";
        getdb()->query($wrongPrimaryEmail);
    }
}

//Mark as a Primary records which only have 1 email address an is valid
function firstPrimaryEmail() {

    $firstPrimaryEmail= "UPDATE `phone type` SET `Is Primary?` = 'Yes' WHERE `Is Primary?` = 'No' AND `Is Inactive?` = 'No' AND `Email Type` = 'Email' AND `Is Primary?_1` = ''";
    getdb()->query($firstPrimaryEmail);
}

function setPrimaryEmail() {
    //Dinamic query 
    $fullQuery = '';
    for($i=1; $i<10; $i++) {

        $long = strlen($fullQuery);
        $cut = $long-24;
        $extra = substr($fullQuery, 0, $cut);

        $query = "SELECT `ID` FROM `phone type` WHERE `Is Primary?` = 'No' AND `Is Inactive?` = 'No' AND `Email Type` = 'Email'";
        $j = $i+1;
            if($i == 1){
                $complement = " AND `Is Primary?_$i` = 'No' AND `Is Inactive?_$i` = 'No' AND `Email Type_$i` = 'Email' AND `Is Primary?_$j` = ''";
                $fullQuery = $query.$complement;
            }else{
                if($i==9){
                    $complement = " AND `Is Primary?_$i` = 'No' AND `Is Inactive?_$i` = 'No' AND `Email Type_$i` = 'Email'";
                }else{
                    $complement = " AND `Is Primary?_$i` = 'No' AND `Is Inactive?_$i` = 'No' AND `Email Type_$i` = 'Email' AND `Is Primary?_$j` = ''";
                }
                
                $fullQuery = $extra.$complement;
            }
        
        //echo "<br> $fullQuery <br><br>";
        $idToUpdate = getdb()->query($fullQuery);

        if ($idToUpdate->num_rows > 0) {
                    
            while($result = mysqli_fetch_assoc($idToUpdate)){
                //Current ID
                $id = $result['ID'];
                //echo "<BR>$id";

                //Most recent date
                $newDate = "SELECT `ID`, @highest_val:= GREATEST(`Date Last Changed`, `Date Last Changed_1`, `Date Last Changed_2`, `Date Last Changed_3`, `Date Last Changed_4`, `Date Last Changed_5`, `Date Last Changed_6`, `Date Last Changed_7`, `Date Last Changed_8`, `Date Last Changed_9`) AS last_update, CASE @highest_val WHEN `Date Last Changed` THEN 'Is Primary?' WHEN `Date Last Changed_1` THEN 'Is Primary?_1' WHEN `Date Last Changed_2` THEN 'Is Primary?_2' WHEN `Date Last Changed_3` THEN 'Is Primary?_3' WHEN `Date Last Changed_4` THEN 'Is Primary?_4' WHEN `Date Last Changed_5` THEN 'Is Primary?_5' WHEN `Date Last Changed_6` THEN 'Is Primary?_6' WHEN `Date Last Changed_7` THEN 'Is Primary?_7' WHEN `Date Last Changed_8` THEN 'Is Primary?_8' WHEN `Date Last Changed_9` THEN 'Is Primary?_9' END AS column_name FROM `phone type` where `ID`= $id";
                $dates = getdb()->query($newDate);
                    if ($dates->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($dates)){
                            $date = $row['last_update'];
                            //echo "<BR>$date";
                            $column = $row['column_name'];
                            //echo "<BR>$column";

                            //set Primary Email
                            $setPrimaryEmail = "UPDATE `phone type` SET `$column` = 'Yes' WHERE `ID` = '$id'";
                            getdb()->query($setPrimaryEmail);
                        }
                    }
            }
        }
    }
        
}

//Fill export phone type table with all phones numbers
function fillPhoneExportTable() {
    
    for($i=0; $i<10; $i++) {
        $phone = 'Phone';
        $primary = 'Primary';
        $inactive = 'Inactive';
        $comments = 'Comments';
        $date = 'Last Update';
        
        if($i > 0){
            $phone = "Phone_$i";
            $primary = "Primary_$i";
            $inactive = "Inactive_$i";
            $comments = "Comments_$i";
            $date = "Last Update_$i";
        }

        $data = "INSERT INTO `export phone type` ( 
            `ID`,`Import ID`,`First Name`,`Last Name`,`Organization Name`,`Phone Import ID`,`Type`,`Phone`,`Primary`,`Inactive`,`Comments`,`Last Update` ) SELECT `ID`,`Import ID`,`First Name`,`Last Name`,`Organization Name`,`Phone Import ID`,`Type`,`$phone`,`$primary`,`$inactive`,`$comments`,`$date` FROM `phone type` WHERE `$phone` <> ''";
        getdb()->query($data);
    }
}

//Fill export phone type table with all email addresses
function fillEmailExportTable() {
    $j = 10;
    for($i=0; $i<10; $i++) {
        $email = 'Email';
        $primary = 'Is Primary?';
        $inactive = 'Is Inactive?';
        $comments = "Comments_$j";
        $date = 'Date Last Changed';
        
        if($i > 0){
            $j++;
            $email = "Email_$i";
            $primary = "Is Primary?_$i";
            $inactive = "Is Inactive?_$i";
            $comments = "Comments_$j";
            $date = "Date Last Changed_$i";
        }

        $data = "INSERT INTO `export phone type` ( 
            `ID`,`Import ID`,`First Name`,`Last Name`,`Organization Name`,`Phone Import ID`,`Type`,`Phone`,`Primary`,`Inactive`,`Comments`,`Last Update` ) SELECT `ID`,`Import ID`,`First Name`,`Last Name`,`Organization Name`,`Email Import ID`,`Email Type`,`$email`,`$primary`,`$inactive`,`$comments`,`$date` FROM `phone type` WHERE `$email` <> ''";
        getdb()->query($data);
    }
}

?>