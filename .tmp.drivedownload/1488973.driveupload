<?php

include_once '../DAL/my_db.php';

class backgrounds extends my_db {

    public function background_insert($background_path
    , $background_status) {
        $this->mod_data('insert into backgrounds(background_path, background_status) values(?,?)', 'si', array(&$background_path, &$background_status));
    }

    public function background_get($background_id) {
        return $this->get_data('select * from backgrounds where background_id = ?'
                        , 'i', array(&$background_id));
    }

    public function background_get_live() {
        return $this->get_all_data('select * from backgrounds where background_status = 1');
    }

    public function background_get_all() {
        return $this->get_all_data('select * from backgrounds');
    }

    public function background_delete($background_id) {
        $this->mod_data('delete from backgrounds where background_id = ?'
                , 'i', array(&$background_id));
    }

    public function background_edit($background_status, $background_id) {
        $this->mod_data('update backgrounds set background_status = ? '
                . 'where background_id = ?'
                , 'ii', array(&$background_status, &$background_id));
    }

    public function background_all_status($background_status) {
        $this->mod_data('update backgrounds set background_status = 0', 'i', array(&$background_status));
    }

}
