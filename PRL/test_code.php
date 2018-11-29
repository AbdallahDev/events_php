<?php
//this file gets the event entities related to a specific category, then send the 
//result to the events_insert_page.php file to view them in the event entities 
//dropdown list

include_once 'include/check_session.php';
include_once '../BLL/event_event_entity.php';

$event_entities = new event_event_entity();
$event_entities_rs = $event_entities->entity_id_get(39);
while ($event_entities_row = $event_entities_rs->fetch_assoc()) {
    ?>
    <li><label>لجنة</label>&nbsp;
        <input type="checkbox" id="event_entity_checkbox" 
               name="event_entity_checkbox[]" value="' + entities.committee_id + '" 
               class = "w3-check" > </li>
    <?php
}