<?php

if (isset($_POST['submit'])) {
    include_once 'include/check_session.php';
    include_once '../BLL/sessions.php';
    $time = new DateTime($_POST['session_time']);
    $session_time = $time->format('H:i:s A');
    $date = new DateTime($_POST['session_date']);
    $session_date = $date->format('Y-m-d');
    $session_insert = new sessions();
    if (isset($_POST['session_started'])) {
        $session_started = 1;
    } else {
        $session_started = 0;
    }
    if (isset($_POST['session_terminated'])) {
        $session_terminated = 1;
    } else {
        $session_terminated = 0;
    }
    if (isset($_POST['session_status1'])) {
        $session_status1 = 1;
    } else {
        $session_status1 = 0;
    }
    $session_insert->session_edit($_POST['session_text'], $session_date, $session_time, $session_started, $session_terminated, $_POST['session_terminated_text'], $session_status1, date("Y-m-d h:i:s A"), $_SESSION['user_id'], $_POST['session_id']);
    header('location: sessions_current_future.php');
    exit();
}