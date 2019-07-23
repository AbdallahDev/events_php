<?php

//i think this is the main api that gets the events.
//this file get all the events for all the categories and entities, 
//or for a specific category or for a specific entity, and that depened on the 
//provided category id and entity id. 
//and that for the phone app.

include_once '../BLL/events.php';
include_once '../BLL/event_event_entity.php';
include_once '../BLL/committees.php';
include_once '../BLL/event_entity_category.php';

//variable declarations
$events = new events();
$events_array = array();
//This variable will store the category id, I'll initialize it with 0 because 
//it's the default value.
$category_id_GET = 0;
//This variable will store the entity id, I'll initialize it with 0 because 
//it's the default value.
$entity_id_GET = 0;
$entity_id_obj = new event_event_entity();
$event_id = 0;
$entity_id = 0;
$entity_name_obj = new committees();
$entity_name = "";
//I'll check if the value is set in the URL.
if (isset($_GET['categoryId']))
    $category_id_GET = $_GET['categoryId'];
//I'll check if the value is set in the URL.
if (isset($_GET['entityId']))
    $entity_id_GET = $_GET['entityId'];
$categories_obj = new event_entity_category();
$entity_ids = array();

//bellow i'll check for the categoryId and entityId sent by the url to get the
//right events for the right category and entity
//
//here if the categoryId is 0 that means the user want to get all the events
//coz there is no category and entity chosen
if ($category_id_GET == 0) {

    //here i get all the events in the db for all the categories and intities
    $rs_events_android = $events->get_all_events();

    //Here I'll loop over the events to get based on their IDs the entities that 
    //belong to them.
    while ($row_events_android = $rs_events_android->fetch_assoc()) {

        //here i saved the event id to get all the entities related to it
        $event_id = $row_events_android["id"];

        //here i'll check if the event_entity_name column is empty to get the 
        //entity name from the table event_event_entity for the entity related 
        //to the event
        if (empty($row_events_android["event_entity_name"])) {

            //here i get the entity id related to the event from event_event_entity 
            //table to get based on it it's name from the committees table
            $entity_id_obj_rs = $entity_id_obj->get_entity_id($event_id);
            $entity_id_obj_row = $entity_id_obj_rs->fetch_assoc();
            $entity_id = $entity_id_obj_row['event_entity_id'];

            //here i add the entity_name element to the events row, so it can appear 
            //in the json result, coz some events related to the entities without having 
            //a specific entity name in the event_entity_name column
            $row_events_android["entity_name"] = get_entity_name($entity_id);
        }
        array_push($events_array, $row_events_android);
    }
}
//bellow if the categoryId is not 0 and the entityId is 0 that means i should get 
//all the events for all the entities in that specific category
elseif ($category_id_GET != 0 && $entity_id_GET == 0) {
    //Here I'll get all the entity ids that belong to the specified category, 
    //to fetch based on them the details of the events that belong to them.
    $entity_ids_obj = $entity_name_obj->get_entities_specific_category($category_id_GET);

    //Here I'll loop over each entity id to add to the query the condition that 
    //based on it.
    while ($entity_id_obj_row = $entity_ids_obj->fetch_array()) {

        //here i got the entity id so i can based on it get the event ids related to it
        $entity_id = $entity_id_obj_row['committee_id'];
        $entity_events_rs = $entity_id_obj->get_event_id($entity_id);

        while ($entity_events_row = $entity_events_rs->fetch_assoc()) {

            //here i got the event id so i can based on it get the event details
            $event_id = $entity_events_row['event_id'];
            $rs_events_android = $events->get_event_by_id($event_id);
            $row_event_entity = $rs_events_android->fetch_assoc();

            //here i'll check if the event_entity_name column is empty to get the 
            //entity name from the table event_event_entity for the entity related 
            //to the event
            if (empty($row_event_entity["event_entity_name"])) {

                //here i add the entity_name element to the events row, so it can appear 
                //in the json result, coz some events related to entities without having 
                //a specific entity name in the event_entity_name column
                $row_event_entity["entity_name"] = get_entity_name($entity_id);
            }
            array_push($events_array, $row_event_entity);
        }
    }
}
//here in this case i should get all the events for a specified entity
else {

    //here i stored the entity id from the url to get all the event ids related 
    //to that entity
    $entity_id = $entity_id_GET;
    $entity_events_rs = $entity_id_obj->get_event_id($entity_id);

    while ($entity_events_row = $entity_events_rs->fetch_assoc()) {

        //here i got the event id to use it to get the event details
        $event_id = $entity_events_row['event_id'];
        $rs_events_android = $events->get_event_by_id($event_id);
        $row_event_entity = $rs_events_android->fetch_assoc();

        //here i'll check if the event_entity_name column is empty to get the 
        //entity name from the table event_event_entity for the entity related 
        //to the event
        if (empty($row_event_entity["event_entity_name"])) {

            //in the json result, coz some events related to entities without having 
            //a specific entity name in the event_entity_name column
            $row_event_entity["entity_name"] = get_entity_name($entity_id);
        }
        array_push($events_array, $row_event_entity);
    }
}

//this function return the name for the specified entity
function get_entity_name($entity_id) {

    $entity_name_obj = new committees();

    //here i get the entity name from the committees table based on it's id
    $entity_name_obj_rs = $entity_name_obj->get_entity_name($entity_id);
    $entity_name_obj_row = $entity_name_obj_rs->fetch_assoc();
    $entity_name = $entity_name_obj_row['committee_name'];

    return $entity_name;
}

//this print the json result of the event details
echo json_encode($events_array);
