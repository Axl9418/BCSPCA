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
