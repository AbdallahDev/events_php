<?php

//This file is for the mobile app usage.

include_once '../DAL/my_db.php';

//this class to make modifications on the user_token table.
class device_token extends my_db {
    
     public function get_all_device_token() {
        return $this->get_all_data('SELECT device_token FROM `device_token`');
    }

    function store_device_token($device_token) {
        /* here i'll store the device_token in the table, and i'll get the value 
          from the url */
        $this->mod_data("INSERT INTO `device_token`(`device_token`) VALUES (?)"
                , 's', array(&$device_token));
    }

}
