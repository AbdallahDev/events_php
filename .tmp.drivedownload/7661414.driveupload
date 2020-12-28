<?php
//this file gets all the event entities, then send the result to the events_insert_page.php file 
//to render them as checkboxes

include_once 'include/check_session.php';
include_once '../BLL/committees.php';

$array_event_entities = array();
$event_entities = new committees();
$event_entities_rs = $event_entities->entities_get_all();
while ($event_entities_row = $event_entities_rs->fetch_assoc()) {
    ?>
    <li><label><?php echo $event_entities_row['committee_name'] ?></label>&nbsp;
        <input type="checkbox" id="event_entity_checkbox" 
               name="event_entity_checkbox[]" value="<?php echo $event_entities_row['committee_id'] ?>"
               <?php
               if (isset($event_entity_ids)) {
                   foreach ($event_entity_ids as $value) {
                       if ($value == $event_entities_row['committee_id']) {
                           echo ' checked ';
                       }
                   }
               }
               ?>
               class = "w3-check" > </li>
    <?php
}