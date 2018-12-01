<?php

include_once '../DAL/my_db.php';

//this class to manage the event_entity_category table in the database for the 
//phone app
class event_entity_category extends my_db {

    //this function get all the entity categories
    public function get_categories() {
        return $this->get_all_data('SELECT * FROM `event_entity_category`');
    }

}
