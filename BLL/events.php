<?php

include_once '../DAL/my_db.php';

class events extends my_db {

    function insert_event($event_entity_name, $time, $event_appointment
    , $subject, $event_date, $hall_id, $event_place, $user_id, $event_status) {
        $this->mod_data('insert into events(event_entity_name, time, '
                . 'event_appointment, subject, event_date, hall_id, event_place, user_id_insert, '
                . 'event_status) '
                . 'values(?, ?, ?, ?, ?, ?, ?, ?, ?)', 'sssssisii'
                , array(&$event_entity_name, &$time, &$event_appointment
            , &$subject, &$event_date, &$hall_id, &$event_place, &$user_id, &$event_status));
    }

    //this function get the id of the event after it has been inserted by the user, 
    //to take it and inserted again in the event_event_entity table with the related even entities
    function event_get_id($user_id) {
        $query = "SELECT MAX(events.id) AS 'event_id' FROM `events` WHERE user_id_insert = ?";
        return $this->get_data($query, 'i', array(&$user_id));
    }

    function update_event($event_entity, $event_entity_name, $time, $event_appointment, $hall_id, $event_place, $subject, $event_date, $event_status, $event_edit_date, $directorate_id, $user_id_edit, $id) {
        $this->mod_data('update events set committee_id = ?, event_entity_name = ?, time = ?, event_appointment = ?, hall_id = ?, event_place = ?, subject = ?, event_date = ?, event_status = ?, event_edit_date = ?, directorate_id = ?, user_id_edit = ? where id = ?', 'isssisssisiii', array(&$event_entity, &$event_entity_name, &$time, &$event_appointment, &$hall_id, &$event_place, &$subject, &$event_date, &$event_status, &$event_edit_date, &$directorate_id, &$user_id_edit, &$id));
    }

    function delete_event($id) {
        $this->mod_data('delete from events where id = ?', 'i', array(&$id));
    }

    function get_event($id) {
        return $this->get_data('select * from events where id = ?', 'i', array(&$id));
    }

    function get_subject_characters($event_id) {
        return $this->get_data("SELECT CHAR_LENGTH(`subject`) AS 'character_length' FROM events WHERE `id` = ?", 'i', array(&$event_id));
    }

    function get_subject_characters_all_and_event_rows() {
        return $this->get_all_data("SELECT sum(CHAR_LENGTH(`subject`)) AS 'character_length', COUNT(*) as 'rows_count' FROM events WHERE DATE(event_date) = CURDATE() and event_status = 1");
    }

    function get_events_curdate() {
        return $this->get_all_data('SELECT committees.committee_id, committees.committee_name, events.event_entity_name, events.time, events.event_appointment, halls.hall_name, events.event_place, events.subject, events.id FROM events INNER JOIN committees ON committees.committee_id= events.committee_id INNER JOIN halls on halls.hall_id=events.hall_id WHERE DATE(event_date) = CURDATE() and event_status = 1 ORDER BY time');
    }

    function get_events_curdate_max_time() {
        return $this->get_all_data('SELECT date_add(MAX(time), INTERVAL 1 hour) AS time FROM events WHERE `event_date` = CURRENT_DATE AND `event_status` = 1');
    }

    public function events_get_new() {
        return $this->get_all_data('SELECT * FROM events WHERE DATE(event_date) >= CURDATE() ORDER BY time');
    }

    //this function get the current and future evetns, to view them for the website user.
    function get_events_current_future() {
        $query = 'SELECT events.id, events.event_entity_name, events.time, events.event_appointment, '
                . 'events.subject, events.event_date, users.user_type, halls.hall_name, '
                . 'events.event_place, events.event_status, users.name, events.user_id_insert, '
                . 'events.event_insertion_date, events.user_id_edit, events.event_edit_date '
                . 'FROM events INNER JOIN users ON users.user_id = events.user_id_insert '
                . 'INNER JOIN halls ON halls.hall_id = events.hall_id '
                . 'WHERE events.event_date >= CURDATE() ORDER BY events.event_date desc, events.time ASC';
        return $this->get_all_data($query);
    }

    //this function get old evetns depend on the directorate
    function get_events_old($directorate_id) {
        return $this->get_data('SELECT events.id, events.event_entity_name, committees.committee_id, committees.committee_name, events.time, events.subject,  events.event_date, users.user_type, halls.hall_name, events.event_place, events.event_status, users.name, events.user_id_insert, events.event_insertion_date, events.user_id_edit, events.event_edit_date FROM events INNER JOIN users ON users.user_id = events.user_id_insert INNER JOIN halls ON halls.hall_id = events.hall_id INNER JOIN committees ON committees.committee_id = events.committee_id WHERE events.event_date < CURDATE() and events.directorate_id = ? ORDER BY events.event_date desc, events.time ASC, events.committee_id ASC', 'i', array(&$directorate_id));
    }

    //this function get all the events related to the user, even if he inserted or edited them
    function get_events_user($user_id_insert, $user_id_edit) {
        return $this->get_data('SELECT * FROM `events` WHERE `user_id_insert` = ? OR `user_id_edit` = ?', 'ii', array(&$user_id_insert, &$user_id_edit));
    }

    public function event_update_status($event_id, $event_status) {
        $this->mod_data('update events set event_status = ? '
                . 'where id = ?', 'ii', array(&$event_id, &$event_status));
    }

}
