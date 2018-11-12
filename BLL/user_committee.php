<?php

include_once '../DAL/my_db.php';

class user_committee extends my_db {

    //this function bring the committees that belong to specific user
    public function user_committees_get($user_id) {
        return $this->get_data('SELECT committees.committee_name, '
                        . 'committees.committee_id, committees.committee_rank '
                        . 'FROM committees INNER JOIN user_committee ON '
                        . 'committees.committee_id = user_committee.committee_id '
                        . 'WHERE user_committee.user_id = 30566 '
                        . 'ORDER by committees.committee_rank ASC'
                        , 'i', array(&$user_id));
    }

    //this function insert committees for a specific user
    public function user_committee_insert($user_id, $committee_id) {
        $this->mod_data('insert into user_committee(user_id, committee_id) values(?,?)', 'ii', array(&$user_id, &$committee_id));
    }

    public function user_committee_delete($user_id) {
        $this->mod_data('delete from user_committee where user_id = ?', 'i', array(&$user_id));
    }

}
