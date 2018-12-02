<?php

//this file get all the events for all the entities or for a specific one.
//and that for the phone app.

include_once '../BLL/events.php';

$events = new events();
$events_array = array();

$rs_events_android = $events->get_all_events();

while ($row_events_android = $rs_events_android->fetch_assoc()) {
    array_push($events_array, $row_events_android);
}
echo json_encode($events_array);
