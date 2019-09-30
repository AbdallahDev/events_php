<?php

//This file is for the mobile app usage.

include_once '../DAL/my_db.php';

//this events class for the android events
class events extends my_db {

    //this function get all the events for all the committees,
    //This function will receive the "$events_date_statement" parameter to 
    //decide based on it to get the event ids on the current date or the other 
    //dates.
    function get_all_events($events_date_statement) {
        //In the query, I've joined the halls table to get the hall_name to view 
        //it in the mobile app, and I've selected the event place from the 
        //events table in case the hall not chosen.
        $query = "SELECT events.id, events.event_entity_name, events.subject, "
                . "events.event_date, "
                //below I'll format the selected time to make it appears in the 
                //mobile app without seconds.
                . "DATE_FORMAT(events.time, '%H:%i') AS `time`, "
                . "halls.hall_name, event_place "
                . "FROM events "
                . "INNER JOIN halls ON events.hall_id = halls.hall_id "
                //The value of the parameter will be "1" if the wanted events 
                //are for the other dates, and will be 
                //"events.event_date = CURRENT_DATE" for the events on the 
                //current date.
                . "WHERE $events_date_statement "
                . "ORDER by events.event_date DESC, events.time DESC";
        return $this->get_all_data($query);
    }

    //this function get all the events for a specific entity
    function entity_events_get($entity_id) {
        $query = 'SELECT events.event_entity_name, events.subject, '
                . 'events.event_date, events.time '
                . 'FROM events '
                . 'ORDER by events.event_date DESC, events.time DESC';
        $datatypes = 'i';
        $vars = array(&$entity_id);
        return $this->get_data($query, $datatypes, $vars);
    }

    //This function get the details for the specified event.
    function get_event_by_id($event_id) {
        $query = "SELECT events.id, events.event_entity_name, events.subject, "
                . "events.event_date, "
                //below I'll format the selected time to make it appears in the 
                //mobile app without seconds.
                . "DATE_FORMAT(events.time, '%H:%i') AS `time`, "
                //Below, I've fetched the hall name and the event place, 
                //and that to show where the event will behold.
                . "halls.hall_name, events.event_place "
                . "FROM events "
                //Below I've joined the halls table to get the hall name if the 
                //event beholds in one of them.
                . "INNER JOIN halls on halls.hall_id = events.hall_id "
                . "WHERE events.id = ? "
                . "ORDER by events.event_date DESC, events.time DESC";
        $datatypes = 'i';
        $vars = array(&$event_id);
        return $this->get_data($query, $datatypes, $vars);
    }

}
