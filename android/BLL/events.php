<?php

include_once '../DAL/my_db.php';

//this events class for the android events
class events extends my_db {

    //this function get all the events for all the committees
    function get_events() {
        return $this->get_all_data("SELECT committees.committee_name, "
                        . "events.subject, events.event_date, events.time "
                        . "FROM committees, events "
                        . "WHERE committees.committee_id = events.committee_id");
    }

    //this function get all the events for specific committee
    function get_committee_events($committee_id) {
        return $this->get_data('SELECT committees.committee_name, events.subject, '
                        . 'events.event_date, events.time FROM committees, events '
                        . 'WHERE committees.committee_id = events.committee_id '
                        . 'AND events.committee_id = ?', 'i'
                        , array(&$committee_id));
    }

}
