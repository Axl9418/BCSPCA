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