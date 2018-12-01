<?php

include_once '../BLL/events.php';

$committee_id = $_GET['committeeId'];
$events = new events();
$events_array = array();

//here i check if the committee_id sent by the url is 0, and that menas the user
//wants to view all the events for all the committees
if ($committee_id == 0) {
    $rs_events_android = $events->get_events();
} else {
    $rs_events_android = $events->entity_events_get($committee_id);
}
while ($row_events_android = $rs_events_android->fetch_assoc()) {
    array_push($events_array, $row_events_android);
}
echo json_encode($events_array);
