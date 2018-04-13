<?php

include_once '../DAL/my_db.php';

class halls extends my_db {

    public function halls_get_all() {
        return $this->get_all_data('select * from halls');
    }

}
