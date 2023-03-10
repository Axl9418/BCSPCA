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
            WHERE `$type` IN ('Number-Incomplete #', 'Number-Invalid', 'Number-Not In Service', 'Number-Wrong Number')";

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

//Setting at least one phone as a primary for ID

function setPrimaryPhone() {

    $noPrimary = "SELECT `ID` FROM `phone type` WHERE `PRIMARY` = 'No' AND `Inactive` = 'No'
    AND `PRIMARY_1` = 'No' AND `Inactive_1` = 'No'
    AND `PRIMARY_2` = 'No' AND `Inactive_2` = 'No'
    AND `PRIMARY_3` = 'No' AND `Inactive_3` = 'No'
    AND `PRIMARY_4` = 'No' AND `Inactive_4` = 'No'
    AND `PRIMARY_5` = 'No' AND `Inactive_5` = 'No'
    AND `PRIMARY_6` = 'No' AND `Inactive_6` = 'No'
    AND `PRIMARY_7` = 'No' AND `Inactive_7` = 'No'
    AND `PRIMARY_8` = 'No' AND `Inactive_8` = 'No'
    AND `PRIMARY_9` = 'No' AND `Inactive_9` = 'No'";

    
    
    /*
    $x = 0;

    do {
        $primary = 'Primary';
        if($x<>0){
            
            $primary = "Primary_$x";
        }

        echo "The number is: $primary <br>";

        $x++;
      } while ($x <=9);
      */

    //Cuales no
    //comparar fechas
    //obtengo posicion
    //updATE


}

?>