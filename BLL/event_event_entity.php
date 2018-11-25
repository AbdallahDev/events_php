<?php

include_once '../DAL/my_db.php';

//this class to manage the event_event_entity table in the database, to insert
//the event entity realted to the event
class event_event_entity extends my_db {

    public function event_event_entity_insert($event_id, $event_entity_id) {
        return $this->mod_data("INSERT INTO `event_event_entity` (`event_id`, `event_entity_id`) VALUES (?, ?)", 'ii', array(&$event_id, &$event_entity_id));
    }

}
