<?php

//This file is for the mobile app usage.

include_once '../DAL/my_db.php';

//this class to make modifications on the user_token table.
class device_token extends my_db {

    public function get_all_device_token() {
        return $this->get_all_data('SELECT device_token FROM `device_token`');
    }

    //this function will delete all the duplicated tokens and that based on the 
    //device identifier.
    //Because if there is duplication in the DB the same message will be 
    //sent multiple times for the same device.
    function delete_duplicated_tokens($device_identifier) {
        $this->mod_data('DELETE FROM `device_token` WHERE device_identifier = ?'
                , 's', array(&$device_identifier));
    }

    //This function will store the mobile device token in the DB to be able to 
    //receive FCM messages.
    function store_device_token($device_token) {
        /* here i'll store the device_token in the table, and i'll get the value 
          from the url */
        $this->mod_data("INSERT INTO `device_token`(`device_token`) VALUES (?)"
                , 's', array(&$device_token));
    }

}
