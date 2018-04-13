<?php

include_once '../DAL/my_db.php';

class sessions extends my_db {

    public function session_insert($session_text, $session_date, $session_time, $session_insertion_user_id, $session_status1) {
        $this->mod_data('insert into sessions(session_text, session_date, session_time, session_insertion_user_id, session_status) values(?,?,?,?,?)', 'sssii', array(&$session_text, &$session_date, &$session_time, &$session_insertion_user_id, &$session_status1));
    }

    public function session_get($session_date) {
        return $this->get_data('SELECT * FROM `sessions` WHERE `session_date` = ? and session_status = 1', 's', array(&$session_date));
    }

    public function session_get_id($session_id) {
        return $this->get_data('SELECT * FROM `sessions` WHERE id = ?'
                        , 'i', array(&$session_id));
    }

    public function sessions_get_current_future() {
        return $this->get_all_data('select sessions.id, sessions.session_text, '
                        . 'sessions.session_date, sessions.session_time, sessions.session_started,'
                        . 'sessions.session_terminated, sessions.session_insertion_date, '
                        . 'sessions.session_insertion_user_id, '
                        . 'sessions.session_edit_date, sessions.session_edit_user_id, '
                        . 'sessions.session_status, users.name '
                        . 'from sessions '
                        . 'INNER JOIN users ON sessions.session_insertion_user_id = users.user_id '
                        . 'WHERE `session_date` >= CURRENT_DATE '
                        . 'ORDER BY sessions.session_date ASC, sessions.session_time ASC');
    }

    public function sessions_get_past() {
        return $this->get_all_data('select sessions.id, sessions.session_text, '
                        . 'sessions.session_date, sessions.session_time, sessions.session_started,'
                        . 'sessions.session_terminated, sessions.session_insertion_date, '
                        . 'sessions.session_insertion_user_id, '
                        . 'sessions.session_edit_date, sessions.session_edit_user_id, '
                        . 'sessions.session_status, users.name '
                        . 'from sessions '
                        . 'INNER JOIN users ON sessions.session_insertion_user_id = users.user_id '
                        . 'WHERE `session_date` < CURRENT_DATE '
                        . 'ORDER BY session_date desc, session_time ASC');
    }

    public function session_edit($session_text, $session_date
    , $session_time, $session_started, $session_terminated
    , $session_terminated_text, $session_status, $session_edit_date
    , $session_edit_user_id, $session_id) {
        $this->mod_data('update sessions set session_text = ?, '
                . 'session_date = ?, session_time = ?, session_started = ?, '
                . 'session_terminated = ?, session_terminated_text = ?, '
                . 'session_status = ?,session_edit_date = ?, session_edit_user_id = ? '
                . 'where id = ?'
                , 'sssiisisii', array(&$session_text,
            &$session_date, &$session_time, &$session_started, &$session_terminated
            , &$session_terminated_text, &$session_status, &$session_edit_date
            , &$session_edit_user_id, &$session_id));
    }

    //this function get all the session related to the user, even if he inserted or edited them
    function get_sessions_user($session_insertion_user_id, $session_edit_user_id) {
        return $this->get_data('SELECT * FROM `sessions` WHERE `session_insertion_user_id` = ? OR `session_edit_user_id` = ?', 'ii', array(&$session_insertion_user_id, &$session_edit_user_id));
    }

    public function session_delete($session_id) {
        $this->mod_data('delete from sessions where id = ?', 'i'
                , array(&$session_id));
    }

}
