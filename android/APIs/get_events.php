<?php

//this file get all the events for all the categories and entities, 
//or for a specific category or for a specific entity, and that depened on the 
//provided category id and entity id. 
//and that for the phone app.

include_once '../BLL/events.php';
include_once '../BLL/event_event_entity.php';
include_once '../BLL/committees.php';

//variable declarations
$category_id_GET = $_GET['categoryId'];
$entity_id_GET = $_GET['entityId'];
$events = new events();
$events_array = array();
$entity_id_obj = new event_event_entity();
$event_id = 0;
$entity_id = 0;
$entity_name_obj = new committees();
$entity_name = "";

//here i get all the events in the db for all the intities
$rs_events_android = $events->get_all_events();

//i'll loop over the events result
while ($row_events_android = $rs_events_android->fetch_assoc()) {
    $event_id = $row_events_android["id"];
    //here i'll check if the event_entity_name column is empty to get the entity name 
    //from the table event_event_entity
    if (empty($row_events_android["event_entity_name"])) {
        //here i get the entities related to the event
        $entity_id_obj_rs = $entity_id_obj->get_entity_id($event_id);
        $entity_id_obj_row = $entity_id_obj_rs->fetch_assoc();
        $entity_id = $entity_id_obj_row['event_entity_id'];

        //here i get the entity name from the committees table base on it's id
        $entity_name_obj_rs = $entity_name_obj->get_entity_name($entity_id);
        $entity_name_obj_row = $entity_name_obj_rs->fetch_assoc();
        $entity_name = $entity_name_obj_row['committee_name'];

        //here i add the entity_name element to the events row, so it can appear 
        //in the json result, coz some events related to entities without having 
        //a specific entity name in the event_entity_name column
        $row_events_android["entity_name"] = $entity_name;
    }
    array_push($events_array, $row_events_android);
}
echo json_encode($events_array);
