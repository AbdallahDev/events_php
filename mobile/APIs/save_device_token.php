<?php

/* this file will be called from the mobile app to store the device token 
  in the db */

include_once '../BLL/device_token.php';

//This variable stores the device token that got from the URL.
$device_token_get = $_GET['deviceToken'];
//This variable will store the device identifier that sent with the URL from the 
//mobile app.
$device_identifier_get = $_GET['deviceIdentifier'];

//This object used to access the functions in the device_token class.
$device_token_obj = new device_token();
//Here I'll delete all the duplicate device tokens from the DB, and that based 
//on the device identifier.
$device_token_obj->delete_duplicated_tokens($device_identifier_get);
//Here I'll store the device token in the DB with the device identifier.
$device_token_obj->store_device_token($device_token_get, $device_identifier_get);
