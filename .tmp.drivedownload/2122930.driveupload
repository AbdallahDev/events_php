<?php

include_once '../BLL/sessions.php';
date_default_timezone_set('Asia/Amman');
$session = new sessions();
$rs_session = $session->session_get(date('Y-m-d'));
$row_session = $rs_session->fetch_assoc();
if (($row_session['session_date'] == date('Y-m-d'))
        and ( $row_session['session_status'] == 1)) {
    $session_time = strtotime($row_session['session_time']);
    //here return 1 to the event_show.php page to view the live stream video
    //and that if the session_started status = 1
    if (( $row_session['session_started'] == 1)
            and ( $row_session['session_terminated'] == 0)) {
        echo '1';
    }
    //here after the session by 30 minutes, i'll keep checking 
    //if the user started or terminated the session
    elseif (time() >= ($session_time + 1800)) {
        if (( $row_session['session_started'] == 1)
                and ( $row_session['session_terminated'] == 0)) {
            echo 1;
        } elseif (( $row_session['session_started'] == 0)
                or ( $row_session['session_terminated'] == 1)) {
            echo 0;
        }
    } elseif (( $row_session['session_started'] == 1)
            and ( $row_session['session_terminated'] == 0)) {
        echo '1';
    }
}
