<?php

//this file gets the event entities related to a specific category, then send the 
//result to the events_insert_page.php file to view them in the event entities 
//dropdown list

include_once 'include/check_session.php';
include_once '../BLL/committees.php';

$array_event_entities = array();
$event_entities = new committees();
$rs_array_event_entities = $event_entities->committees_all_get();
while ($row_array_event_entities = $rs_array_event_entities->fetch_assoc()) {
    array_push($array_event_entities, $row_array_event_entities);
}
echo json_encode($array_event_entities);
