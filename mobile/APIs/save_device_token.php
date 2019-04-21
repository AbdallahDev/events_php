<?php

/* this file will be called from the android app to store the device token 
  in the db */

include_once '../BLL/device_token.php';

$device_token = new device_token();
$device_token->store_device_token($_GET['deviceToken']);
