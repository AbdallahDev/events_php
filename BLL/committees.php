<?php

include_once '../DAL/my_db.php';

class committees extends my_db {

    public function committee_add($committee_name, $event_entity_category_id) {
        $this->mod_data('INSERT INTO `committees` (`committee_name`, `event_entity_category_id`) VALUES (?,?)', 'si'
                , array(&$committee_name, &$event_entity_category_id));
    }

    public function committee_get($committee_id) {
        return $this->get_data('select * from committees where committee_id = ?'
                        , 'i', array(&$committee_id));
    }

    //this function get all the event entities except the empty one
    public function committees_all_get() {
        return $this->get_all_data('SELECT `committee_id`, `committee_name`, '
                        . 'committees.`event_entity_category_id`, committees.committee_rank, '
                        . 'event_entity_category.event_entity_category_name '
                        . 'FROM `committees`, event_entity_category '
                        //here i set the event_entity_category_id to not equal zero in the where condition 
                        //coz i don't want to select the empty event entities
                        . 'WHERE committees.event_entity_category_id != 0 '
                        . 'AND committees.event_entity_category_id = event_entity_category.event_entity_category_id '
                        . 'ORDER BY committees.event_entity_category_id ASC, `committees`.`committee_rank` ASC');
    }

    //this function get all the event entities related to a specific category
    public function event_entities_category_all_get($event_entity_category_id) {
        return $this->get_data('SELECT `committee_id`, `committee_name`, committees.`event_entity_category_id`, '
                        . 'committees.committee_rank FROM `committees` '
                        . 'WHERE committees.event_entity_category_id != 0 AND committees.event_entity_category_id = ? '
                        . 'ORDER BY `committees`.`committee_rank` ASC'
                        , 'i', array(&$event_entity_category_id));
    }

    public function committee_edit($committee_name, $event_entity_category_id, $committee_id) {
        $this->mod_data('UPDATE `committees` SET `committee_name`= ?,`event_entity_category_id`= ? '
                . 'WHERE committees.committee_id = ?', 'sii'
                , array(&$committee_name, $event_entity_category_id, &$committee_id));
    }

    public function committee_delete($committee_id) {
        $this->mod_data('delete from committees where committee_id = ?'
                , 'i', array(&$committee_id));
    }

    //this function get the event entity name for the event using the provided event id.
    public function event_entity_name_get($event_id) {
        $query = "SELECT committees.committee_name FROM committees INNER JOIN event_event_entity ON event_event_entity.event_entity_id = committees.committee_id INNER JOIN events on events.id = event_event_entity.event_id WHERE events.id = ?";
        return $this->get_data($query, 'i', array(&$event_id));
    }

    function event_entity_category_id_get($event_entity_id) {
        $query = "SELECT event_entity_category_id FROM `committees` WHERE committee_id = ?";
        return $this->get_data($query, 'i', array(&$event_entity_id));
    }

}
