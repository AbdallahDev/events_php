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
        return $this->get_all_data('SELECT device_token FROM `device_token` '
                        . 'ORDER BY dateTime DESC');
    }

    //This function will check for the device identifier existence, if its exist 
    //I'll update the token connected with it, and if its not I'll insert a new 
    //entry for that identifier with a new entry.
    function check_identifier($device_identifier) {
        $query = "SELECT device_token_id FROM `device_token` "
                . "WHERE device_identifier = ?";
        return $this->get_data($query, "s", array(&$device_identifier));
    }

    //This function will update the current token with a new one for the 
    //specified device identifier.
    function update_token($device_token, $device_identifier) {
        $query = "UPDATE `device_token` SET `device_token`= ?, "
                . "`dateTime`= CURRENT_TIMESTAMP "
                . "WHERE device_identifier = ?";
        return $this->mod_data($query, "ss", array(&$device_token
                    , &$device_identifier));
    }

    //This function will delete the outdated tokens from the DB, all the tokens 
    //that have not been updated for a long time will be deleted because that 
    //means the app has not been used by the user for a long time or the app has 
    //been deleted or the same device that the app installed in is has 
    //a duplicated entry in the DB.
    function delete_outdated_tokens() {
        //This variable is used as an argument to be sent to the mod_data 
        //function because the function requires arguments to be sent to it, 
        //so I've created this dummy argument, and I made its value as 1 because 
        //I don't want to affect the condition.
        $argument = 1;
        $query = "DELETE FROM `device_token` "
                . "WHERE "
                . "device_token.dateTime < CURRENT_DATE - INTERVAL 1 MONTH "
                //I've added this condition because it's required to send an 
                //argument to the mod_data function.
                . "AND ?";
        $this->mod_data($query, "i", array(&$argument));
    }

    //this function will delete all the duplicated tokens and that based on the 
    //device identifier.
    //Because if there is duplication in the DB the same message will be 
    //sent multiple times for the same device.
    function delete_duplicated_tokens($device_name, $device_model) {
        $this->mod_data('DELETE FROM `device_token` WHERE device_identifier = ?'
                , 's', array(&$device_identifier));
    }

    //This function will store the mobile device token in the DB to be able to 
    //receive FCM messages, and also will save the device identifier to use it 
    //to identify all the duplicate tokens, and will save 
    //the device (name, model, is physical) to be able to recognize the device 
    //in the database.
    //And will save the device_is_IOS parameter value to recognize the devices 
    //that have IOS to deal with their app badge when they receive a new 
    //notification.
    function store_device_token($device_token, $device_identifier, $device_name
    , $device_model, $device_isPhysical, $device_is_IOS) {
        /* here i'll store the device_token, device_identifier, device_name, 
         * device_model, device_isPhysical and device_is_IOS in the DB, and 
         * i'll get the values from the url in the file save_device_token.php */
        $query = "INSERT INTO `device_token`(`device_token`, "
                . "`device_identifier`, `device_name`, `device_model`, "
                . "`device_isPhysical`, `device_is_IOS`) VALUES (?,?,?,?,?,?)";
        $this->mod_data($query, 'sssssi', array(&$device_token,
            &$device_identifier, &$device_name, &$device_model,
            &$device_isPhysical, &$device_is_IOS));
    }

    //This function will increase the current badge counter for the specified 
    //device identifier.
    function increase_badge_counter($device_identifier) {
        $query = "UPDATE `device_token` SET `badge_count`=`badge_count`+1 "
                . "WHERE `device_identifier` = ?";
        return $this->mod_data($query, "s", array(&$device_identifier));
    }

}
