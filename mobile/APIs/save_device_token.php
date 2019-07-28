<?php

/* this file will be called from the mobile app to store the device token 
  in the db */

include_once '../BLL/device_token.php';

//This variable stores the device token that got from the URL.
$device_token = $_GET['deviceToken'];
//This variable will store the device identifier that sent with the URL from the 
//mobile app.
$device_identifier = $_GET['deviceIdentifier'];

//This object used to access the functions in the device_token class.
$device_token_obj = new device_token();

//Here I'll call the function that checks if the identifier exists.
$identifier_check_rs = $device_token_obj->check_identifier($device_identifier);

//Here I'll check if the result after calling the function that checks for the 
//device identifier has data by checking for the row numbers.
if ($device_identifier_check_rs->num_rows > 0) {
    //Here I'll call the function that updates the token for the specified 
    //identifier because the number of rows is more than zero and that means the 
    //identifier already exists.
    $device_token_obj->update_token($device_token, $device_identifier);
} else {
    //Here I'll call the function that inserts a new entry for the specified 
    //identifier with a new token, and that because the number of rows is less 
    //than zero and that means the specified identifier does not exist in the DB.
    $device_token_obj->store_device_token($device_token, $device_identifier);
}