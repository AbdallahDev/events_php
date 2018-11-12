<?php

include_once '../DAL/my_db.php';

class committees extends my_db {

    //here i get data for specific committee
    function committee_get($committee_id) {
        return $this->get_data('select * from committees where committee_id = ?'
                        , 'i', array(&$committee_id));
    }

    //here i'll get the committee_id and the committee_name for all the 
    //committees in the database
    function committees_get() {
        return $this->get_all_data("SELECT committee_id, committee_name FROM "
                        . "`committees` WHERE `committee_name` != '' "
                        . "ORDER BY `committees`.`committee_rank`  ASC");
    }

}
