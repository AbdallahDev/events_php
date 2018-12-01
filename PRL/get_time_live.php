<?php

//set time zone to amman
date_default_timezone_set('Asia/Amman');
//include events class
include_once '../BLL/events.php';
//get events
$event = new events();

//here i get the current date events
$rs_current_events = $event->get_events_curdate();

//here i get the max for the current date events to keep the screen enabled 2 hours after the last event
$rs_event_max_time = $event->get_events_curdate_max_time();
$row_event_max_time = $rs_event_max_time->fetch_assoc();

switch (date('w')) {//here i check for the current day of the week to decide to make the screen on/off
    //bellow for the days friday and saturday to make the screen off (black)
    case 5://here if the day is firday
    case 6://here if the day is saturday 
        echo 0;
        break;
    default ://here for all the days except friday and saturday to make the screen on/off based on the time
        if ((date('H:i') >= date('08:00')) && (date('H:i') <= date('24:00'))) {//here i check if the current time is between 8 am and 12 am
            if ($rs_current_events->num_rows > 0) {
                if ((date('H:i') <= date('18:00')) || ((date('H:i') > date('18:00')) && (date('H:i') <= $row_event_max_time['time']))) {
                    echo 1;
                } else {
                    echo 0;
                }
            } elseif (date('H:i') <= date('18:00')) {
                echo 1;
            } else {
                echo 0;
            }
        } else {//here for all the times between 12 am and 8 am
            echo 0;
        }
        break;
}