<?php

include 'my_con.php';

class my_db extends my_con {

    function mod_data($query, $datatypes, $vars) {
        $con = $this->my_con();
        $st = $con->prepare($query);
        call_user_func_array(array($st, 'bind_param'), array_merge(array($datatypes), $vars));
        $st->execute();
    }

    function get_data($query, $datatypes, $vars) {
        $con = $this->my_con();
        $st = $con->prepare($query);
        call_user_func_array(array($st, 'bind_param'), array_merge(array($datatypes), $vars));
        $st->execute();
        return $st->get_result();
    }

    function get_all_data($query) {
        $con = $this->my_con();
        $st = $con->prepare($query);
        $st->execute();
        return $st->get_result();
    }

}
