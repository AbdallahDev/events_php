<?php

include_once '../DAL/my_db.php';

//this class to manage the event_event_entity table in the database
//this for the web app
class event_event_entity extends my_db {

    function event_event_entity_insert($event_id, $event_entity_id) {
        return $this->mod_data("INSERT INTO `event_event_entity` (`event_id`, `event_entity_id`) VALUES (?, ?)", 'ii', array(&$event_id, &$event_entity_id));
    }

    function entity_id_get($event_id) {
        $query = "SELECT event_entity_id FROM `event_event_entity` WHERE event_id = ?";
        return $this->get_data($query, 'i', array(&$event_id));
    }

    function event_event_entity_deletion($event_id) {
        $query = 'DELETE FROM event_event_entity WHERE event_id = ?';
        $datatypes = 'i';
        $vars = array(&$event_id);
        return $this->mod_data($query, $datatypes, $vars);
    }

}
