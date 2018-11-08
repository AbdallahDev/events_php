<?php

include_once '../DAL/my_db.php';

class committees extends my_db {

    function committee_get($committee_id) {
        return $this->get_data('select * from committees where committee_id = ?'
                        , 'i', array(&$committee_id));
    }

}
