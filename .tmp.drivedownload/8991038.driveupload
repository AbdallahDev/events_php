<?php

include_once '../DAL/my_db.php';

class blocs extends my_db {

    //this function get all the blocs
    public function blocs_all_get() {
        return $this->get_all_data('select * from blocs');
    }

    public function bloc_get($bloc_id) {
        return $this->get_data('select * from blocs where bloc_id = ?'
                        , 'i', array(&$bloc_id));
    }

    public function bloc_add($bloc_name) {
        $this->mod_data('insert into blocs(bloc_name) values(?)', 's'
                , array(&$bloc_name));
    }

    public function bloc_edit($bloc_name, $bloc_id) {
        $this->mod_data('update blocs set bloc_name = ? '
                . 'where bloc_id = ?', 'si'
                , array(&$bloc_name, &$bloc_id));
    }

    public function bloc_delete($bloc_id) {
        $this->mod_data('delete from blocs where bloc_id = ?'
                , 'i', array(&$bloc_id));
    }

}
