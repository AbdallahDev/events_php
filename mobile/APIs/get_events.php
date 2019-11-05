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

//This variable will store the value that I'll use it to decide if the mobile 
//app wants to view all the events for all the dates. because if it is true I'll 
//show all events for all the dates, and if it's true I'll show the events for 
//the specified date by the GET from the URL. And I've initialized it with false 
//value because I want to show the events of the current date as the default 
//state.
$show_all_events = "false";

//this variable will store the date of the events that the app want to show, and 
//I've made the default value "CURRENT_DATE" because I want to fetch the events 
//for the current date as the default case, but it could store the date of other 
//days if the user choose another date from the date picker in the mobile app.
$events_date = "CURRENT_DATE";

//This variable will store the statement that will be used to decide to fetch 
//the events for all the dates or for a specific date like the current date, 
//and I've initialized it the statement "events.event_date = $events_date" 
//because the default state will be for fetching the events of the current date.
//And I've concatenated the value of the variable $events_date because it will 
//decide the specific date for the events that the app wants to show.
$events_date_statement = "events.event_date = $events_date";

//This object is for dealing with the event_event_entity class that deals with 
//the event_event_entity DB table.
$event_event_entity_obj = new event_event_entity();
$event_id = 0;
$entity_id = 0;
$entity_name_obj = new committees();
$entity_name = "";

//I'll check if the value is set in the URL.
if (isset($_GET['categoryId'])) {
    $category_id_GET = $_GET['categoryId'];
}

//I'll check if the value is set in the URL.
if (isset($_GET['entityId'])) {
    $entity_id_GET = $_GET['entityId'];
}

//Here I'll check if the value of the showAllEvents variable from the GET is set 
//or not.
if (isset($_GET['showAllEvents'])) {
    $show_all_events = $_GET['showAllEvents'];

    //Here I'll check if the value of the variable "$events_date_status_GET" is 
    //"true", that means the function should fetch the events for all the dates, 
    //so I set the statement like "1" because I should add something after 
    //the "WHERE" condition, and 1 will not affect the condition because 1 means 
    //TRUE.
    if ($show_all_events == "true") {
        //Here I'll assign the number one (1) value to the variable 
        //"$events_date_statement" because it will mean in the MySQL query that 
        //I want to fetch all the events for all the dates because 1 after the 
        //where condition means TRUE and that will not affect the condition.
        $events_date_statement = "1";
    } else {
        if (isset($_GET['eventsDate'])) {
            //Here I'll assign the date from the GET that chosen from the date 
            //picker in the mobile app to the variable $events_date because I'll 
            //use it in the MYSQL query to get the events for that date.
            $events_date = $_GET['eventsDate'];
        }
        //Here I'll assign to the variable $events_date_statement the statement 
        //that decides the date for the events that will be fetched from the DB.
        //And I've put the value of the variable $events_date between two single 
        //quotes because the string values in the MYSQL query should be between 
        //quotes to run them correctly.
        $events_date_statement = "events.event_date = '$events_date'";
    }
}

$categories_obj = new event_entity_category();
$entity_ids = array();

//bellow i'll check for the categoryId and entityId sent by the url to get the
//right events for the right category and entity
//
//here if the categoryId is 0 that means the user want to get all the events
//coz there is no category and entity chosen
if ($category_id_GET == 0) {

    //Here I'll get all the events in the DB for all the categories and entities. 
    //And I've sent the current date events status to the function, based on 
    //that value the function will get the events of the current date or for all 
    //the days.
    $rs_events_android = $events->get_all_events($events_date_statement);

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
            $entity_id_obj_rs = $event_event_entity_obj->get_entity_id($event_id);
            $entity_id_obj_row = $entity_id_obj_rs->fetch_assoc();
            $entity_id = $entity_id_obj_row['event_entity_id'];

            //here i add the entity_name element to the events row, so it can 
            //appear in the json result, coz some events related to the entities 
            //without having a specific entity name in the event_entity_name 
            //column
            $row_events_android["entity_name"] = get_entity_name($entity_id);
        }

        //Here I'll check for the value of the event appointment that selected 
        //from the DB if it's not empty I'll assign it to the JSON field 
        //'eventtime', else I'll assign the value of the time.
        if (!empty($row_events_android['event_appointment'])) {
            $row_events_android['event_time'] = $row_events_android['event_appointment'];
        } else {
            $row_events_android['event_time'] = $row_events_android['time'];
        }

        array_push($events_array, $row_events_android);
    }
}
//bellow if the categoryId is not 0 and the entityId is 0 that means i should 
//get all the events for all the entities in that specific category
elseif ($category_id_GET != 0 && $entity_id_GET == 0) {
    //Here I'll get all the entity ids that belong to the specified category, 
    //to fetch based on them the details of the events that belong to them.
    $entity_ids_obj = $entity_name_obj->get_entities_specific_category($category_id_GET);

    //I've created this variable to store the query that will be sent to the 
    //function that will fetch the event details for all the entities for the 
    //specified category.
    //And I've joined the committee's table to get the entity name that related 
    //to the event.
    //And I've made the last where condition as 0 because later I'll add more 
    //conditions for each entity id.
    $query = "SELECT event_id, events.event_entity_name, events.subject, "
            . "events.event_date, "
            //below I'll format the selected time to make it appears in the 
            //mobile app without seconds.
            . "DATE_FORMAT(events.time, '%H:%i') AS `time`, "
            //I've selected the event appointment because the event 
            //sometimes has a time filled in the appointment text box in the 
            //events web system, so I need to show it in the mobile app.
            . "events.event_appointment, "
            //Below, I've fetched the hall name and the event place, and that to 
            //show where the event will behold.
            . "halls.hall_name, events.event_place, "
            //below, I'll select the committee name as 'entity_name' because I 
            //want the column to be recognized like that in the final JSON 
            //result because in the Android model it's recognized like that.
            . "committees.committee_name AS entity_name "
            . "FROM `event_event_entity` "
            . "INNER JOIN events ON events.id = event_event_entity.event_id "
            //Below I've joined the halls table to get the hall name if the 
            //event beholds in one of them.
            . "INNER JOIN halls on halls.hall_id = events.hall_id "
            . "INNER JOIN committees ON committees.committee_id = event_event_entity.event_entity_id "
            //Here I've concatenated the variable "$events_date_statement", 
            //to decide based on its value to get the events of the current 
            //date or all the dates for all the entities that belong to 
            //a specific category.
            . "WHERE $events_date_statement "
            //I've added the start bracket after the AND operator and I'll add 
            //the end one later because I want to group all the conditions that 
            //come after the AND operator, and that because I want them to be 
            //treated as a single unity, because if I don't do that the query 
            //will not operate successfully.
            . "AND (event_entity_id = 0";

    //Here I'll loop over each entity id to add to the query the condition that 
    //related to it.
    while ($entity_ids_obj_row = $entity_ids_obj->fetch_array()) {

        //Here I get the entity id to add it with a condition to the query.
        $entity_id = $entity_ids_obj_row['committee_id'];

        //Here for every entity id, I'll add a condition to the query.
        $query .= " OR event_entity_id = $entity_id";
    }

    //This is the last concatenation for the query, to get all the events for 
    //all the entities in the specified
    //
    //Here I've added the end bracket to close the group of the conditions that 
    //come after the AND operator. And I've done it like that because I want the 
    //conditions that related to each entity from the above while to be added to 
    //that group.
    $query .= ") ORDER BY events.event_date DESC, events.time DESC";

    //Here I'll fetch all the event details for all the entity ids that 
    //concatenated with the query, then I'll store the result in the 
    //$event_details variable.
    $event_details = $event_event_entity_obj->get_event_details_based_on_entity_ids($query);

    //Here I'll loop over the result fetched regard the event details to store 
    //each row of it in the $events_array array.
    while ($event_details_row = $event_details->fetch_assoc()) {
        //Here I'll check for the value of the event appointment that selected 
        //from the DB if it's not empty I'll assign it to the JSON field 
        //'event_time', else I'll assign the value of the time that selected 
        //from the DB.
        if (!empty($event_details_row['event_appointment'])) {
            $event_details_row['event_time'] = $event_details_row['event_appointment'];
        } else {
            $event_details_row['event_time'] = $event_details_row['time'];
        }

        //Here I'll push each row that contains one event details to the events 
        //array.
        array_push($events_array, $event_details_row);
    }
}
//here in this case i should get all the events for a specified entity
else {

    //Here i stored the entity id from the url to get all the event ids related 
    //to that entity
    $entity_id = $entity_id_GET;
    $entity_events_rs = $event_event_entity_obj->get_event_id($entity_id
            , $events_date_statement);

    //Here I'll loop over the event ids that related to the specified entity, 
    //and that to get the event details
    while ($entity_events_row = $entity_events_rs->fetch_assoc()) {

        //here i got the event id to use it to get the event details
        $event_id = $entity_events_row['event_id'];
        $rs_events_android = $events->get_event_by_id($event_id);
        $row_event_entity = $rs_events_android->fetch_assoc();

        //here i'll check if the event_entity_name column is empty to get the 
        //entity name from the table event_event_entity for the entity related 
        //to the event
        if (empty($row_event_entity["event_entity_name"])) {

            //Here I'll add an entry to the JSON result contains the entity name, 
            //and that when the event doesn't have an entity name typed in the 
            //entity name text box in the web system. That name will be fetched 
            //from the event_event_entity table.
            $row_event_entity["entity_name"] = get_entity_name($entity_id);
        }

        //Here I'll check for the value of the event appointment that selected 
        //from the DB if it's not empty I'll assign it to the JSON field 
        //'event_time', else I'll assign the value of the time that selected 
        //from the DB.
        if (!empty($row_event_entity['event_appointment'])) {
            $row_event_entity['event_time'] = $row_event_entity['event_appointment'];
        } else {
            $row_event_entity['event_time'] = $row_event_entity['time'];
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
