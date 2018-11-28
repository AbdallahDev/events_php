<?php
//this file to edit the event

include_once 'include/check_session.php';
include '../BLL/events.php';

//needed variable declarations
//
//this is the object of the event
$event = new events();
//this array to store the id/ids of the event entity/event entities
$event_entity_ids = array();
//this variable to be used for the event_entity_name that typed in the event entity text box
$event_entity_name = '';
//this var to store the event time
$event_time = "";
//this var to store the event appointment, and that when the user dosen't want 
//the real time to appear on the screen
$event_appointment = "";
//this var to store the event subject
$subject = nl2br($_POST['subject']);
//this variable to store the event date
$event_date = $_POST['event_date'];
//hall id variable, and i sat the default value to 0 so the name of the hall appear as an empty string ""
$hall_id = 0;
//event place variable, this variable used when the user dosen't select a hall for the event
$event_place = "";
//this variable for the user id and i'll get it from the session after the user login.
$user_id = $_SESSION['user_id'];
//this var for the status of the event and i'll make it with 0 default value for the casses it's not checked
$event_status = 0;

echo $_POST['committee_id'];

//bellow i'll check if the user choosed the event entity name (like committee) from the dropdown menu or typed it's name in the textbox
if (isset($_POST['committee_id']) && !empty(trim($_POST['committee_id']))) {//here i check the event entity has been choosed form the dropdown menu
    $event_entity = $_POST['committee_id']; //here i choose the event entity name that choosen from the dropdown to be inserted
    $event_entity_name = ''; //here i make the event entity name empty, because the name choosed from the dropdown
} else {
    $event_entity_name = $_POST['event_entity_name']; //here i choose the event entity name that typed in the event entity textbox to be inserted
    if ($_SESSION['directorate'] == 2) {//here i check if the directorate of the user is legislate affiars with value 2, to store 2 in the committee id
        $event_entity = 2; //here i make the event entity to 2, because the name typed in the textbox
    } elseif ($_SESSION['directorate'] == 3) {//here i check if the directorate of the user is general affairs with value 3, to store 3 in the committee id
        $event_entity = 3; //here i make the event entity to 3, because the name typed in the textbox
    } elseif ($_SESSION['directorate'] == 4) {//here i check if the directorate of the user is blocs with value 4, to store 4 in the entity event id
        $event_entity = 4; //here i make the event entity to 4, because the name typed in the textbox
    }
}

//bellow i'll check if the event appointment is set in the event appointemnt textbox, to view it in the live screen instead of the event time.
if (isset($_POST['event_appointment']) && !empty(trim($_POST['event_appointment']))) {
    $event_appointment = $_POST['event_appointment'];
    $event_time = date("H:i:s", strtotime($_POST['time']) + 1); //here i set the value of the time from the form to the event_time variable and increase it with one second so it can come on the live screen after the event that it should come after it
} else {//here when the event appointment is empty
    $event_appointment = $_POST['event_appointment']; //here the event appointment will be empty
    $event_time = $_POST['time']; //here i set the value of the time from the form to the event_time variable as it's, because the events appointment has not set, so i won't need the increase the event time by one second
}

//bellow i'll check if the event hall is set or the event place is typed in the event place text box
if ((isset($_POST['hall_id'])) && !empty(trim($_POST['hall_id']))) {//here i check if the hall has been choosed
    $hall_id = $_POST['hall_id'];
    $event_place = '';
} elseif (isset($_POST['event_place_textbox'])) {
    if (!empty(trim($_POST['event_place_textbox']))) {//here i check if the hall hasn't been choosen, instead the text box filled with the place of the event
        $event_place = $_POST['event_place_textbox'];
        $hall_id = 0;
    } else {
        $event_place = '';
        $hall_id = 0;
    }
}

//bellow i'll check for the event status
if (isset($_POST['event_status'])) {
    $event_status = $_POST['event_status'];
} else {
    $event_status = 0;
}

$event->update_event($event_entity, $event_entity_name, $event_time, $event_appointment, $hall_id, $event_place, nl2br($_POST['subject']), $_POST['event_date'], $event_status, date("Y-m-d H:i:s"), $_SESSION['directorate'], $_SESSION['user_id'], $_POST['id']);
