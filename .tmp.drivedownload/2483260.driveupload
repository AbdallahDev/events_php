<?php

include_once '../BLL/sessions.php';
date_default_timezone_set('Asia/Amman');
$session = new sessions();
$rs_session = $session->session_get(date('Y-m-d'));
$row_session = $rs_session->fetch_assoc();
if (($row_session['session_date'] == date('Y-m-d')) and ( $row_session['session_status'] == 1)) {//here i check if the session date is the current date and it's status is 1 (menas enabled)
    $session_time = strtotime($row_session['session_time']);
    if ((time() > strtotime(date("08:00:00")))
            and ( time() < ($session_time - 3600))
            and ( $row_session['session_terminated'] == 0)) {
        echo $row_session['session_text'];
    } elseif (((time() >= ($session_time - 3600))
            and ( time() <= ($session_time + 1800)))
            and ( ( $row_session['session_terminated'] == 0)
            and ( $row_session['session_started'] == 0))) {
        if (date('i') % 2 == 0) {
            echo $row_session['session_text'];
        } else {
            echo '<center><h2>';
            echo 'بإمكانكم متابعة البث المباشر للجلسة ';
            echo ' من خلال موقع مجلس النواب';
            echo '<br>';
            echo '<br>';
            echo ' http://www.representatives.jo';
            echo '</h2></center>';
        }
    } elseif ((time() >= ($session_time + 1800))
            and ( ( $row_session['session_terminated'] == 0)
            and ( $row_session['session_started'] == 0))) {
        if (date('i') % 2 == 0) {
            echo $row_session['session_text'];
        } else {
            echo '<center><h2>';
            echo 'بإمكانكم متابعة البث المباشر للجلسة ';
            echo ' من خلال موقع مجلس النواب';
            echo '<br>';
            echo '<br>';
            echo ' http://www.representatives.jo';
            echo '</h2></center>';
        }
    } elseif (( $row_session['session_terminated'] == 1)
            and ( $row_session['session_started'] == 0)) {
        echo '<center><h2>';
        echo $row_session['session_terminated_text'];
        echo '</h2></center>';
    }
}