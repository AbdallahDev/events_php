<?php

include_once '../DAL/my_db.php';

class halls extends my_db {

    public function halls_get_all() {
        return $this->get_all_data('select * from halls');
    }

    //This function will get the hall name when it's chosen from the dropdown 
    //menu for the event, and it will be sent with the app notification.
    public function hall_name_get($hall_id) {
        return $this->get_data('SELECT `hall_name` FROM `halls` WHERE `hall_id` = ?'
                        , 'i', array(&$hall_id));
    }

}
