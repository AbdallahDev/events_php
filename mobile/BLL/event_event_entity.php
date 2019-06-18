<?php

//This file is for the mobile app usage.

include_once '../DAL/my_db.php';

//this class to manage the event_event_entity table in the database
//and that for the phone app
class event_event_entity extends my_db {

    //This function gets the all the event IDs that related to the specified entity, 
    //and also I've selected the event date and time, because If I don't do that 
    //the selected events will be shown in the app as the latest event shown in 
    //the last and the old one in the first.
    function get_event_id($entity_id) {
        $query = "SELECT event_id, events.event_date, events.time "
                . "FROM `event_event_entity` INNER JOIN events ON event_event_entity.event_id = events.id "
                . "WHERE event_entity_id = ? ORDER BY events.event_date DESC, events.time DESC";
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
