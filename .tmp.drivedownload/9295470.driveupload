<?php

include_once '../DAL/my_db.php';

class table_live_design extends my_db {

    public function table_live_design_get_live() {
        return $this->get_all_data('select * from table_live_design where table_live_design_status = 1'); //here i get all the data regarded the table live design, like the font size, and that for the event_show.php that view the live table
    }

    public function table_live_design_get_all() {
        return $this->get_all_data('SELECT * FROM `table_live_design` WHERE 1 ORDER BY `table_live_design_status` DESC'); //here i get all the data regarded the table live design, like the font size, and that to show them for the user
    }

    public function table_live_design_get_specific($table_live_design_id) {
        return $this->get_data('SELECT * FROM `table_live_design` WHERE `table_live_design_id` = ?', 'i', array(&$table_live_design_id));
    }

    public function table_live_design_enabled_status_zero($table_live_design_status) {
        $this->mod_data('UPDATE `table_live_design` SET `table_live_design_status`= 0 WHERE `table_live_design_status` = ?', 'i', array(&$table_live_design_status)); //here i make the enabled table live design status to zero, to let the user by able to enable a new design, that means a new design can make affect if the other enabled design status is zero
    }

    public function table_live_design_insert($table_live_design_font_size, $table_live_design_event_entity_column_width, $table_live_design_event_time_column_width, $table_live_design_event_place_column_width, $table_live_design_event_subject_column_width, $table_live_design_status) {
        $this->mod_data('INSERT INTO `table_live_design` (`table_live_design_font_size`, `table_live_design_event_entity_column_width`, `table_live_design_event_time_column_width`, `table_live_design_event_place_column_width`, `table_live_design_event_subject_column_width`, `table_live_design_status`) values(?, ?, ?, ?, ?, ?)', 'iiiiii', array(&$table_live_design_font_size, &$table_live_design_event_entity_column_width, &$table_live_design_event_time_column_width, &$table_live_design_event_place_column_width, &$table_live_design_event_subject_column_width, &$table_live_design_status));
    }

    public function table_live_design_edit($table_live_design_font_size, $table_live_design_event_entity_column_width, $table_live_design_event_time_column_width, $table_live_design_event_place_column_width, $table_live_design_event_subject_column_width, $table_live_design_status, $table_live_design_id) {
        $this->mod_data('UPDATE `table_live_design` SET `table_live_design_font_size` = ?,`table_live_design_event_entity_column_width` = ?, table_live_design_event_time_column_width = ?, table_live_design_event_place_column_width = ?, table_live_design_event_subject_column_width = ?, table_live_design_status = ? WHERE `table_live_design_id` = ?', 'iiiiiii', array(&$table_live_design_font_size, &$table_live_design_event_entity_column_width, &$table_live_design_event_time_column_width, &$table_live_design_event_place_column_width, &$table_live_design_event_subject_column_width, &$table_live_design_status, &$table_live_design_id));
    }

    public function table_live_design_delete($table_live_design_id) {
        $this->mod_data('DELETE FROM `table_live_design` WHERE `table_live_design_id` = ?', 'i', array(&$table_live_design_id));
    }

}
