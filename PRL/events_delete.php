<?php

include_once 'include/check_session.php';
include '../BLL/events.php';
//variable declaratoins
$event_id = $_GET['id'];
$event = new events();
$event->delete_event($event_id);
//here i'll delete all the event entities related to the event
include_once '../BLL/event_event_entity.php';
$event_event_entity = new event_event_entity();
$event_event_entity_rs = $event_event_entity->event_event_entity_deletion($event_id);
header('location: events_preview_current_future.php');
exit();
