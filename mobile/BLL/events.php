<?php

include_once '../DAL/my_db.php';

//this events class for the android events
class events extends my_db {

    //this function get all the events for all the committees
    function get_all_events() {
        $query = "SELECT events.id, events.event_entity_name, events.subject, events.event_date, events.time FROM events ORDER by events.event_date DESC, events.time DESC";
        return $this->get_all_data($query);
    }

    //this function get all the events for a specific entity
    function entity_events_get($entity_id) {
        $query = 'SELECT events.event_entity_name, events.subject, events.event_date, events.time FROM events ORDER by events.event_date DESC, events.time DESC';
        $datatypes = 'i';
        $vars = array(&$entity_id);
        return $this->get_data($query, $datatypes, $vars);
    }

    //this function get the details for the specified event
    function get_event_by_id($event_id) {
        $query = "SELECT events.id, events.event_entity_name, events.subject, events.event_date, events.time FROM events WHERE events.id = ? ORDER by events.event_date DESC, events.time DESC";
        $datatypes = 'i';
        $vars = array(&$event_id);
        return $this->get_data($query, $datatypes, $vars);
    }

}