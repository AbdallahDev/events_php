<?php

//this file gets the event entities related to a specific category, then send the 
//result to the events_insert_page.php file to view them in the event entities 
//dropdown list

include_once 'include/check_session.php';
include_once '../BLL/committees.php';

$array1 = array();
$event_entities = new committees();
$rs = $event_entities->event_entities_category_all_get($_POST['id']);
while ($row = $rs->fetch_assoc()) {
    array_push($array1, $row);
}
echo json_encode($array1);
