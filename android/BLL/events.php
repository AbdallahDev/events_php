<?php

include_once '../DAL/my_db.php';

class events extends my_db {

    function get_events() {
        return $this->get_all_data("SELECT committees.committee_name, "
                        . "events.subject, events.event_date, events.time "
                        . "FROM committees, events "
                        . "WHERE committees.committee_id = events.committee_id");
    }

}
