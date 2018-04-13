<?php

include_once '../DAL/my_db.php';

class urgents extends my_db {

    public function urgent_insert($urgent_text, $urgent_date_start, $urgent_date_end, $urgent_time_end, $urgent_status, $user_id_insert, $directorate_id) {
        $this->mod_data('insert into urgents(urgent_text, urgent_date_start, urgent_date_end, urgent_time_end, urgent_status, user_id_insert, directorate_id) values(?,?,?,?,?,?,?)', 'ssssiii', array(&$urgent_text, &$urgent_date_start, &$urgent_date_end, &$urgent_time_end, &$urgent_status, &$user_id_insert, &$directorate_id));
    }

    public function urgent_get($directorate_id) {
        return $this->get_data('select urgents.urgent_id, urgents.urgent_date_start, urgents.urgent_date_end, urgents.urgent_time_end, urgents.urgent_text, urgents.urgent_status, urgents.urgent_insertion_date, users.name, urgents.urgent_edit_date, urgents.user_id_edit FROM urgents INNER JOIN users ON users.user_id = urgents.user_id_insert WHERE directorate_id = ? ORDER BY urgents.urgent_status DESC, urgents.urgent_date_start ASC, urgents.urgent_date_end ASC', 'i', array(&$directorate_id));
    }

    public function urgent_get_live() {
        return $this->get_all_data("SELECT * FROM `urgents` WHERE `urgent_status` = 1");
    }

    public function urgent_get_id($urgent_id) {
        return $this->get_data("SELECT * FROM `urgents` WHERE urgent_id = ?", 'i', array(&$urgent_id));
    }

    public function urgent_edit($urgent_text, $urgent_date_start, $urgent_date_end, $urgent_time_end, $urgent_status, $urgent_edit_date, $user_id_edit, $urgent_id) {
        $this->mod_data('update urgents set urgent_text = ?, urgent_date_start = ?, urgent_date_end = ?, urgent_time_end = ?, urgent_status = ?, urgent_edit_date = ?, user_id_edit = ? where urgent_id = ?', 'ssssisii', array(&$urgent_text, &$urgent_date_start, &$urgent_date_end, &$urgent_time_end, &$urgent_status, &$urgent_edit_date, &$user_id_edit, &$urgent_id));
    }

    public function urgent_delete($urgent_id) {
        $this->mod_data('delete from urgents where urgent_id = ?', 'i'
                , array(&$urgent_id));
    }

}
