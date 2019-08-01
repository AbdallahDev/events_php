<?php

//This file is for the mobile app usage.

include_once '../DAL/my_db.php';

//this class to make modifications on the user_token table.
class device_token extends my_db {

    //This function will select all the device token from the device_token table, 
    //and it will order the result by dateTime column to get the latest updated 
    //tokens at first because that will give them the priority to receive the 
    //message early.
    public function get_all_device_token() {
        return $this->get_all_data('SELECT device_token FROM `device_token` ORDER BY dateTime DESC');
    }

    //This function will check for the device identifier existence, if its exist 
    //I'll update the token connected with it, and if its not I'll insert a new 
    //entry for that identifier with a new entry.
    function check_identifier($device_identifier) {
        $query = "SELECT device_token_id FROM `device_token` WHERE device_identifier = ?";
        return $this->get_data($query, "s", array(&$device_identifier));
    }

    //This function will update the current token with a new one for the 
    //specified device identifier.
    function update_token($device_token, $device_identifier) {
        $query = "UPDATE `device_token` SET `device_token`= ?,`dateTime`= CURRENT_TIMESTAMP "
                . "WHERE device_identifier = ?";
        return $this->mod_data($query, "ss", array(&$device_token, &$device_identifier));
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
    //receive FCM messages, and also will save the device identifier to use it 
    //to identify all the duplicated tokens.
    function store_device_token($device_token, $device_identifier) {
        /* here i'll store the device_token and the device_identifier in the DB, 
         * and i'll get the values from the url */
        $this->mod_data("INSERT INTO `device_token`(`device_token`, `device_identifier`) "
                . "VALUES (?,?)", 'ss', array(&$device_token, &$device_identifier));
    }

}
