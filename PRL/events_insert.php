<?php

include_once 'include/check_session.php';
include_once '../BLL/events.php';

//bellow i'll list the needed variables in the page.
//
//this array to store the id/ids of the event entity/event entities
$event_entities_id = array();
//this variable to be used for the event_entity_name that typed in the event entity text box
$event_entity_name = '';
//this var to store the event time
$event_time = "";
//this var to store the event appointment and that when the user dosen't want 
//the real time to appear on the screen
$event_appointment = "";
//this var to store the event subject
$subject = nl2br($_POST['subject']);
//this variable to store the event date
$event_date = "";
//hall id variable, and i sat the default value to 0 so the name of the hall appear as empty string ""
$hall_id = 0;
//event place variable, this variable used when the user dosen't select a hall for the event
$event_place = "";
//this variable for the user id and i'll get it from the session after the user login.
$user_id = $_SESSION['user_id'];

//bellow i'll check if the user choose the event entity from the event entities drop down menu or not
//and that by checking the value from the event_entity_categroy_id drop down menu, coz if it's 0 
//that menas the user didn't choose anything from the dropdown menu, and typed the event
//entity name in the textbox.
if (isset($_POST['event_entity_category_id']) && $_POST['event_entity_category_id'] != 0) {
    //here i'll save the event entity id that chosen from the event entities drop down menu
    $event_entities_id = $_POST['committee'];
}
//here i'll check if the event entity name typed in the event entity name text box and it's not empty
//to use it as the event entity name, and to get all the event entities related to it from
//the check boxes.
elseif (isset($_POST['event_entity_name']) && trim($_POST['event_entity_name']) != "") {
    //here i chose the event entity name that typed in the event entity textbox
    $event_entity_name = $_POST['event_entity_name'];

    //bellow i'll check if the user choose any event entity from the event entity check boxes
    if (isset($_POST['event_entity_checkbox'])) {
        foreach ($_POST['event_entity_checkbox'] as $value) {
            $event_entities_id[] = $value;
        }
    }
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
    //here i set the value of the time from the form to the event_time variable 
    //as it's, because the events appointment has not set, so i won't need the 
    //increase the event time by one second
    $event_time = $_POST['time'];
}

//here i check if the hall has been chosen
//
//if the chosen hall id is not zero, that means the user chose the hall from the 
//halls drop down menu
if ((isset($_POST['hall'])) && $_POST['hall'] != 0) {
    $hall_id = $_POST['hall'];
}
//here if the value of the event place text box sat, that means the user typed 
//the event place in the text box
elseif (isset($_POST['event_place_textbox'])) {
    $event_place = $_POST['event_place_textbox'];
}

//here i check the status of the event, coz the status decide if the event will be shown on the screen or not
if (isset($_POST['event_status'])) {
    $event_status = $_POST['event_status'];
} else {
    $event_status = 0;
}

//this code insert a new event
$event1 = new events();
$event1->insert_event($event_entity_name, $event_time, $event_appointment, $subject
        , $event_date, $hall_id, $event_place, $user_id, $event_status);

/* this inclusion for the eventNotificatoin file to send notifications when the 
  event inserted in the db */
//and i've made the inclusion directory like this because this file will be
//included in the event_insert.php file
include_once '../android/BLL/device_token.php';
include_once '../android/apis/event_notification.php';

header('location: events_preview_current_future.php');

