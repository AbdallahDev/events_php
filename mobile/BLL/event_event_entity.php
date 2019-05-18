<?php

//This file is for the mobile app usage.

include_once '../DAL/my_db.php';

//this class to manage the event_event_entity table in the database
//and that for the phone app
class event_event_entity extends my_db {

    //this function get the all the event ids that related to the specified entity
    function get_event_id($entity_id) {
        $query = "SELECT event_id FROM `event_event_entity` WHERE event_entity_id = ?";
        return $this->get_data($query, 'i', array(&$entity_id));
    }

    //this function get the entity id related to a specific event
    function get_entity_id($event_id) {
        $query = "SELECT event_entity_id FROM `event_event_entity` WHERE event_id = ?";
        $datatypes = "i";
        $vars = array(&$event_id);
        return $this->get_data($query, $datatypes, $vars);
    }

}
