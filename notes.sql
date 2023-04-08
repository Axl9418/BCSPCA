SELECT DISTINCT `HOME_COUNTRY` FROM `new_donors_original`


UPDATE `new_donors_original`
SET `HOME_COUNTRY` = 'Canada'
WHERE `HOME_COUNTRY` IN ('', 'CA');

------------------------------------------------------------
SELECT `CONS_ID`,`HOME_ZIP`
FROM `new_donors_original`
WHERE `HOME_COUNTRY` NOT IN ('Canada');

foreach (CONS_ID){
    zipValidation(HOME_ZIP)
}

if IS VALID {
    UPDATE `new_donors_original`
    SET `HOME_COUNTRY` = 'Canada'
    WHERE `CONS_ID` = X;
}else {
    DELETE FROM `new_donors_original`
    WHERE `CONS_ID` = X;
}

UPDATE `new_donors_original`
SET `HOME_STATEPROV` = 'BC'
WHERE `HOME_STATEPROV` IN ('', 'British Columbia');

SELECT  `CONS_ID`,`HOME_STATEPROV`,`HOME_COUNTRY`,`HOME_ZIP`
FROM `new_donors_original`
WHERE `HOME_STATEPROV` NOT IN ('AB', 'BC' , 'MB', 'NB', 'NL', 'NT', 'NS', 'NU', 'ON', 'PE', 'QC', 'SK', 'YT');

UPDATE `new_donors_original`
SET `HOME_STATEPROV` = X
WHERE `CONS_ID` = X;

SELECT * FROM `new_donors_original` WHERE `CAMPAIGN_NAME` like '%champions%'

SELECT * FROM `new_donors_original` WHERE `PAYMENT_PLAN` = 'Sustaining'

SELECT * FROM `new_donors_original` WHERE `FIRST_TIME_DONOR` = 'No'

UPDATE `new_donors_original`
SET `DONATION_DATE` = DATE(STR_TO_DATE(`DONATION_DATE`, '%Y/%m/%d'))
WHERE DATE(STR_TO_DATE(date_field, '%Y/%m/%d')) <> '00-00-0000';

SELECT DATE_FORMAT(`DONATION_DATE`, '%m/%d/%Y')  FROM `new_donors_original` WHERE `DONATION_DATE` = '2022/12/16'

UPDATE `new_donors_original` SET `DONATION_DATE` = DATE_FORMAT(`DONATION_DATE`, '%m/%d/%Y')

SELECT `CONS_PHONE` FROM `new_donors_original` WHERE `CONS_PHONE` LIKE '1%' OR `CONS_PHONE` LIKE '0%'

SELECT * FROM `new_donors_original` WHERE `CONS_ID` IN(2760131,
2759919,
1542387,
2615156,
2760097,
2657667,
2461235,
2706706,
1611766,
2577021,
2626712,
2386050,
2426650
)




------------------------------------------------------------------------------------
------------------PHONE PROJECT-----------------------------------------------------


SELECT * FROM `phone type` WHERE Type = "Business #" AND Comments = ""

SELECT Comments_3 FROM `phone type` WHERE Type_3 = "Business #"


UPDATE `phone type` 
SET `Comments` = (SELECT CONCAT((SELECT `Comments` FROM `phone type` 									WHERE `Type` = 'Direct #'),'AXL'))
WHERE `Type` = 'Direct #'



SELECT `ID`, `PRIMARY`, `Last Update`, `PRIMARY_1`, `Last Update_1` , `PRIMARY_2`, `Last Update_2`, `PRIMARY_3`, `Last Update_3`, `PRIMARY_4`, `Last Update_4`, `PRIMARY_5`, `Last Update_5`, `PRIMARY_6`, `Last Update_6`, `PRIMARY_7`, `Last Update_7`, `PRIMARY_8`, `Last Update_8`, `PRIMARY_9`, `Last Update_9` FROM `phone type` WHERE `Primary` = 'No' AND `Inactive` = 'No' AND `ID` NOT IN (Select `ID` FROM `phone type` WHERE `Primary_1` = 'No' AND `Inactive_1` = 'No') AND  `ID` NOT IN (Select `ID` FROM `phone type` WHERE `Primary_2` = 'No' AND `Inactive_2` = 'No') AND  `ID` NOT IN (Select `ID` FROM `phone type` WHERE `Primary_3` = 'No' AND `Inactive_3` = 'No') AND  `ID` NOT IN (Select `ID` FROM `phone type` WHERE `Primary_4` = 'No' AND `Inactive_4` = 'No') AND  `ID` NOT IN (Select `ID` FROM `phone type` WHERE `Primary_5` = 'No' AND `Inactive_5` = 'No') AND  `ID` NOT IN (Select `ID` FROM `phone type` WHERE `Primary_6` = 'No' AND `Inactive_6` = 'No')AND  `ID` NOT IN (Select `ID` FROM `phone type` WHERE `Primary_7` = 'No' AND `Inactive_7` = 'No')AND  `ID` NOT IN (Select `ID` FROM `phone type` WHERE `Primary_8` = 'No' AND `Inactive_8` = 'No') AND  `ID` NOT IN (Select `ID` FROM `phone type` WHERE `Primary_9` = 'No' AND `Inactive_9` = 'No')

//FIRST UPDATE
SELECT `ID`,`Primary`,`Inactive`,`Primary_1`,`Inactive_1`,`Primary_2`,`Inactive_2`,`Primary_3`,`Inactive_3`,`Primary_4`,`Inactive_4`,`Primary_5`,`Inactive_5`,`Primary_6`,`Inactive_6`,`Primary_7`,`Inactive_7`,`Primary_8`,`Inactive_8`,`Primary_9`,`Inactive_9` FROM `phone type` WHERE `Primary` = 'No' AND `Inactive` = 'No' AND `Primary_1` = ''

SELECT `ID`,`Primary`,`Inactive`,`Last update`,`Primary_1`,`Inactive_1`,`Last update_1`,`Primary_2`,`Inactive_2`,`Primary_3`,`Inactive_3`,`Primary_4`,`Inactive_4`,`Primary_5`,`Inactive_5`,`Primary_6`,`Inactive_6`,`Primary_7`,`Inactive_7`,`Primary_8`,`Inactive_8`,`Primary_9`,`Inactive_9` FROM `phone type` WHERE `Primary` = 'No' AND `Inactive` = 'No' AND `Primary_1` = 'No' AND `Inactive_1` = 'No' AND `Primary_2` = '' AND `Type` Not In ('Number-Incomplete', 'Number-Invalid', 'Number-Not In Service', 'Number-Wrong Number') AND `Type_1` Not In ('Number-Incomplete', 'Number-Invalid', 'Number-Not In Service', 'Number-Wrong Number')


SELECT * FROM `phone type` where DATE_FORMAT(`Last Update`,'%d/%m/%Y') AND `ID`= 100023

//BUENO
SELECT GREATEST(`Last Update`, `Last Update_1`, `Last Update_2`) FROM `phone type` where `ID`= 1014029

SELECT `ID`, @highest_val:= GREATEST(`Last Update`, `Last Update_1`, `Last Update_2`, `Last Update_3`, `Last Update_4`, `Last Update_5`, `Last Update_6`, `Last Update_7`, `Last Update_8`, `Last Update_9`) AS last_update, CASE @highest_val WHEN `Last Update` THEN 'Primary' WHEN `Last Update_1` THEN 'Primary_1' WHEN `Last Update_2` THEN 'Primary_2' WHEN `Last Update_3` THEN 'Primary_3' WHEN `Last Update_4` THEN 'Primary_4' WHEN `Last Update_5` THEN 'Primary_5' WHEN `Last Update_6` THEN 'Primary_6' WHEN `Last Update_7` THEN 'Primary_7' WHEN `Last Update_8` THEN 'Primary_8' WHEN `Last Update_9` THEN 'Primary_9' END AS column_name FROM `phone type` where `ID`= 1135573

INSERT INTO `export phone type` ( 
`ID`,`Import ID`,`First Name`,`Last Name`,`Organization Name`,`Phone Import ID`,`Type`,`Phone`,`Primary`,`Inactive`,`Comments`,`Last Update` ) 
SELECT `ID`,`Import ID`,`First Name`,`Last Name`,`Organization Name`,`Phone Import ID`,`Type`,`Phone`,`Primary`,`Inactive`,`Comments`,`Last Update` FROM `phone type` WHERE `Phone` <> ''


//UPDATE `export phone type` SET `PhoneFormat` = `Phone`

-- Step 1 - This query will remove all non-digits (0-9) from the phone number
UPDATE `export phone type` SET `PhoneFormat` = REGEXP_REPLACE(`PhoneFormat`,'[^0-9]', '') WHERE `Type` NOT IN ('Email','Email-Invalid')

-- Step 2 - Now we remove the first digit, if it's 1 (for the country code for USA/Canada)
UPDATE `export phone type`   
SET `PhoneFormat`   =  CASE 
                        WHEN SUBSTR(`PhoneFormat`, 1,1) = '1' THEN SUBSTR(`PhoneFormat`, 2,LENGTH(`PhoneFormat`) -1) 
                        ELSE `PhoneFormat` 
                    END
WHERE `Type` NOT IN ('Email','Email-Invalid')



SELECT * FROM `export phone type` WHERE `ID` = 1000021 AND `PhoneFormat` = 6045496911

SELECT CONCAT(`ID`,`Type`,`PhoneFormat`) FROM `export phone type`
UPDATE `export phone type` SET `Concatenated` = CONCAT(`ID`,`Type`,`PhoneFormat`)