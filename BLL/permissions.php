<?php

include_once '../DAL/my_db.php';

class permissions extends my_db {

    public function permission_check($user_id, $page_id) {
        return $this->get_data('select * from permissions where user_id = ? '
                        . 'and page_id = ?'
                        , 'ii', array(&$user_id, &$page_id));
    }

}
