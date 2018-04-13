<?php

include_once '../DAL/my_db.php';

class users extends my_db {

    function check_user_login($user_id, $password) {
        $rs = $this->get_data('select * from users where user_id = ? and password = ?'
                , 'is', array(&$user_id, &$password));
        if ($rs->num_rows != 0) {
            return 1;
        }
    }

    public function get_user($user_id) {
        return $this->get_data('select * from users where user_id = ?', 'i', array(&$user_id));
    }

    public function get_all_users() {
        return $this->get_all_data('select * from users ORDER BY users.name ASC');
    }

    public function get_all_users_except_regular_ones() {
        return $this->get_all_data('SELECT * FROM `users` WHERE `user_type` != 2 ORDER BY users.user_type ASC, users.user_id ASC');
    }

    public function get_all_users_in_directorate($directorate) {
        return $this->get_data('select * from users WHERE directorate = ? ORDER BY users.user_type ASC, users.user_id ASC', 'i', array(&$directorate));
    }

    public function get_all_users_regular_in_directorate($user_type, $directorate) {//this function get all the regular users in the same directorate
        return $this->get_data('SELECT * FROM `users` WHERE `user_type` = ? AND `directorate` = ?', 'ii', array(&$user_type, &$directorate));
    }

    public function add_user($name, $user_id, $password, $user_type
    , $directorate, $department) {
        $this->mod_data('insert into users(name, user_id, password, user_type, directorate, department) values(?, ?, ?, ?, ?, ?)', 'sisiii', array(&$name, &$user_id, &$password, &$user_type, &$directorate, &$department));
    }

    public function update_user($name, $user_id, $user_type, $userid_old, $directorate, $department) {//here when other user like the superadmin and the admins tries to edit other user, i send all the data except the password because its encrypted and not always edited
        $this->mod_data('update users set name = ?, user_id = ?, user_type = ?, directorate = ?, department = ? where user_id = ?', 'siiiii', array(&$name, &$user_id, &$user_type, &$directorate, &$department, &$userid_old));
    }

    public function update_user_edit_himself($name, $user_id) {//here i update the user naem just, because the user left the password empty, that mean he didn't try to edit it, and that because the user here tries to edit himself, so he can't edit anything else
        $this->mod_data('update users set name = ? where user_id = ?', 'si', array(&$name, &$user_id));
    }

    public function update_user_password($password, $user_id) {//here i update the user password just, because the password is not always edited by the users
        $this->mod_data('update users set password = ? where user_id = ?', 'si', array(&$password, &$user_id));
    }

    public function delete_user($user_id) {
        $this->mod_data('delete from users where user_id = ?', 'i', array(&$user_id));
    }

}
