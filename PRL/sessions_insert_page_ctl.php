<?php

if (isset($_POST['submit'])) {
    include_once 'include/check_session.php';
    include_once '../BLL/sessions.php';
    if (isset($_POST['session_status1'])) {//here i check if the status isset or not
        $session_status1 = 1; //if the checkbox checked i'll will set the value 1
    } else {
        $session_status1 = 0; //if the checkbox hasn't checked i'll will set the value 0
    }
    $time = new DateTime($_POST['session_time']);
    $session_time = $time->format('H:i:s A');
    $date = new DateTime($_POST['session_date']);
    $session_date = $date->format('Y-m-d');
    $session_insert = new sessions();
    $session_insert->session_insert($_POST['session_text'], $session_date, $session_time, $_SESSION['user_id'], $session_status1);
    header('location: sessions_current_future.php');
    exit();
}
