<?php

//This file is for the mobile app usage.

include_once '../DAL/my_db.php';

class committees extends my_db {

    //here i get data for specific committee
    function committee_get($committee_id) {
        return $this->get_data('select * from committees where committee_id = ?'
                        , 'i', array(&$committee_id));
    }

    //here i'll get the committee_id and the committee_name for all the 
    //committees in the database
    function committees_get() {
        return $this->get_all_data("SELECT committee_id, committee_name, event_entity_category_id, committee_rank FROM `committees` WHERE `committee_name` != '' ORDER BY `committees`.`committee_rank` ASC");
    }

    //get the entity name depened on the entity id
    function get_entity_name($entity_id) {
        $query = "SELECT committee_name FROM `committees` WHERE committee_id = ?";
        $datatypes = "i";
        $vars = array(&$entity_id);
        return $this->get_data($query, $datatypes, $vars);
    }

    //this function get the entities for a specific category
    function get_entities_specific_category($category) {
        $query = "SELECT committee_id, committee_name FROM `committees` WHERE committees.event_entity_category_id = ? ORDER BY `committees`.`committee_rank` ASC";
        $datatypes = "i";
        $vars = array(&$category);
        return $this->get_data($query, $datatypes, $vars);
    }

}
