<?php

//this file to get all the events for a specific entity for the app.

include_once '../BLL/events.php';

//variable declarations
$entity_id = $_GET['entityId'];
$events = new events();
$events_array = array();

$rs_events_android = $events->entity_events_get($entity_id);
while ($row_events_android = $rs_events_android->fetch_assoc()) {
    array_push($events_array, $row_events_android);
}
echo json_encode($events_array);
