<?php

class my_con {

    public function my_con() {
        $con = new mysqli('localhost', 'eventsdev', 'qf8MfbH0OxpxcxBz', 'eventsdevtest');
        mysqli_query($con, "SET NAMES 'utf8'");
        mysqli_query($con, 'SET CHARACTER SET utf8');
        return $con;
    }

}
