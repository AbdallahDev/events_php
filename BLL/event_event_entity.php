<?php

include_once '../DAL/my_db.php';

//this class to manage the event_event_entity table in the database, to insert
//the event entity realted to the event
class event_event_entity extends my_db {

    function event_event_entity_insert($event_id, $event_entity_id) {
        return $this->mod_data("INSERT INTO `event_event_entity` (`event_id`, `event_entity_id`) VALUES (?, ?)", 'ii', array(&$event_id, &$event_entity_id));
    }

    //this function get the event entity name for the event with the designated event id.
    function event_event_entity_name_get($event_id) {
        $query = "SELECT committees.committee_name FROM committees "
                . "INNER JOIN event_event_entity ON event_event_entity.event_entity_id = committees.committee_id "
                . "INNER JOIN events on events.id = event_event_entity.event_id WHERE events.id = ?";
        return $this->mod_data($query, 'i', array(&$event_id));
    }

}
