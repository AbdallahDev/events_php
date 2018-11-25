<?php

include_once 'include/check_session.php';
include_once '../BLL/events.php';

//bellow i'll check if the user chose the event entity name (like committee) 
//from the dropdown menu or typed it's name in the textbox
if (isset($_POST['committee'])) {
    //here i choose the event entity id that chosen from the event entity dropdown
    $event_entity_id = $_POST['committee'];

    //here i make the event entity name empty, because the name chosen from the 
    //event entity dropdown menu
    $event_entity_name = '';
} else {
    //here i chose the event entity name that typed in the event entity textbox
    $event_entity_name = $_POST['event_entity_name'];
}

//bellow i'll check if the event appointment is set in the event appointemnt 
//textbox, to view it in the live screen instead of the event time.
if (isset($_POST['event_appointment']) &&
        !empty(trim($_POST['event_appointment']))) {
    $event_appointment = $_POST['event_appointment'];
    //here i set the value of the time from the form to the event_time variable 
    //and increase it with one second so it can come on the live screen after 
    //the event that it should come after it
    $event_time = date("H:i:s", strtotime($_POST['time']) + 1);
}
//here when the event appointment is empty
else {
    //here the event appointment will be empty
    $event_appointment = $_POST['event_appointment'];
    //here i set the value of the time from the form to the event_time variable 
    //as it's, because the events appointment has not set, so i won't need the 
    //increase the event time by one second
    $event_time = $_POST['time'];
}

//here i check if the hall has been choosed
if ((isset($_POST['hall'])) && !empty(trim($_POST['hall']))) {
    $hall_id = $_POST['hall'];
    $event_place = '';
} elseif (isset($_POST['event_place_textbox'])) {
    //here i check if the hall hasn't been choosen, instead the text box filled 
    //with the place of the event
    if (!empty(trim($_POST['event_place_textbox']))) {
        $event_place = $_POST['event_place_textbox'];
        $hall_id = 0;
    } else {
        $event_place = '';
        $hall_id = 0;
    }
}

//here i check the status of the event, coz the status decide if the event will be shown on the screen or not
if (isset($_POST['event_status'])) {
    $event_status = $_POST['event_status'];
} else {
    $event_status = 0;
}

//this code insert 

$event1 = new events();
$event1->insert_event($event_entity_id, $event_entity_name, $event_time
        , $event_appointment, $hall_id, $event_place, nl2br($_POST['subject'])
        , $_POST['event_date'], $event_status, $_SESSION['directorate']
        , $_SESSION['user_id']);

/* this inclusion for the eventNotificatoin file to send notifications when the 
  event inserted in the db */
//and i've made the inclusion directory like this because this file will be
//included in the event_insert.php file
include_once '../android/BLL/device_token.php';
include_once '../android/apis/event_notification.php';

header('location: events_preview_current_future.php');

