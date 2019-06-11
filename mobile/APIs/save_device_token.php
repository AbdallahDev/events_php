<?php

/* this file will be called from the mobile app to store the device token 
  in the db */

include_once '../BLL/device_token.php';

//This variable stores the device token that got from the URL.
$device_token_get = $_GET['deviceToken'];
$device_token = new device_token();
//Here I'll delete all the duplicate device tokens from the DB.
$device_token->delete_duplicated_tokens($device_token_get);
//Here I'll store the device token in the DB.
$device_token->store_device_token($device_token_get);
