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

    public function committee_edit($committee_name, $event_entity_category_id, $committee_id) {
        $this->mod_data('UPDATE `committees` SET `committee_name`= ?,`event_entity_category_id`= ? '
                . 'WHERE committees.committee_id = ?', 'sii'
                , array(&$committee_name, $event_entity_category_id, &$committee_id));
    }

    public function committee_delete($committee_id) {
        $this->mod_data('delete from committees where committee_id = ?'
                , 'i', array(&$committee_id));
    }

}
