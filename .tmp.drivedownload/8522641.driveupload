<?php

//This file is for the mobile app usage.

include_once '../DAL/my_db.php';

//this class to manage the event_entity_category table in the database for the 
//phone app
class event_entity_category extends my_db {

    //this function get all the entity categories
    public function get_categories() {
        return $this->get_all_data('SELECT * FROM `event_entity_category`');
    }
    
    //this function get all the ids for all the categories
    function get_category_ids() {
        $query = "SELECT event_entity_category.event_entity_category_id FROM `event_entity_category`";
        return $this->get_all_data($query);
    }

}
