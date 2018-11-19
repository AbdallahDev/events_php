<?php

include_once '../DAL/my_db.php';

class committees extends my_db {

    public function committee_add($committee_name, $directorate_id) {
        $this->mod_data('INSERT INTO `committees` (`committee_name`, `event_entity_category_id`) VALUES (?,?)', 'si'
                , array(&$committee_name, &$directorate_id));
    }

    public function committee_get($committee_id) {
        return $this->get_data('select * from committees where committee_id = ?'
                        , 'i', array(&$committee_id));
    }

    //this function get all the committees for specific directorate
    public function committees_all_get($directorate_id1, $directorate_id2) {//here i get the directorate id twice to get all the committees belong to the same direcotrate, and to exclude the empty committee that belong to the same directoraet so the user can't delete it by mistake, because it's used to view the event entity when it's saved using the event entity textbox
        return $this->get_data('select * from committees where directorate_id = ? AND committee_id != ?', 'ii', array(&$directorate_id1, &$directorate_id2));
    }

    public function committee_edit($committee_name, $committee_id) {
        $this->mod_data('update committees set committee_name = ? '
                . 'where committee_id = ?', 'si'
                , array(&$committee_name, &$committee_id));
    }

    public function committee_delete($committee_id) {
        $this->mod_data('delete from committees where committee_id = ?'
                , 'i', array(&$committee_id));
    }

}
