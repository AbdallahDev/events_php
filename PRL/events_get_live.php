<?php
//include events class
include_once '../BLL/events.php';
//set time zone to amman
date_default_timezone_set('Asia/Amman');

include_once 'include/arabicdate.php'; //this file to print the date as arabic date
//get events
$events = new events();
$events_rs = $events->get_events_curdate();

//here i get the max time for the current date events to keep the events table viewed 2 hours after the last event
$rs_event_max_time = $events->get_events_curdate_max_time();
$row_event_max_time = $rs_event_max_time->fetch_assoc();

//bellow i'll get the data regared the table live design
include_once '../BLL/table_live_design.php';
$table_live_design = new table_live_design();
$rs_table_live_design = $table_live_design->table_live_design_get_live();
$row_table_live_design = $rs_table_live_design->fetch_assoc();
?>


<?php
if ($events_rs->num_rows > 0) {
    if ((date('H:i') >= date('08:00')) && (date('H:i') <= $row_event_max_time['time'])) {
        ?> 
        <div style="position: relative; top: 265px; font-size: 32px; font-weight: 900; color: balck"><?php echo ArabicDate(); ?></div>
        <table style="position: relative; top: 280px; font-size: <?php echo $row_table_live_design['table_live_design_font_size']; ?>px;">
            <tr>
                <th>جهة النشاط</th>
                <th>الوقت</th>
                <th>المكان</th>
                <th>الموضوع</th>
            </tr>
            <?php
            while ($events_row = $events_rs->fetch_assoc()) {
                ?>
                <tbody style="vertical-align: text-top; text-align: center; font-weight: bold;">
                    <tr>
                        <!--this column to view the event entity name-->
                        <td style="width: <?php echo $row_table_live_design['table_live_design_event_entity_column_width'] ?>%"><?php
                            //i need to make an object for the committees class 
                            //to get the proper event entity name for the event
                            include_once '../BLL/committees.php';
                            $event_entities = new committees();
                            $event_entities_rs = $event_entities->event_entity_name_get($events_row['id']);
                            //i'll check if the result has rows less than 2, 
                            //coz that means the event related to one event entity,
                            //coz if it's related to more than that i should view
                            //the event entity name that typed in the text box
                            //even if it's empty.
                            if ($event_entities_rs->num_rows < 2) {
                                $event_entities_row = $event_entities_rs->fetch_assoc();
                                //bellow i'll check if the name of the event entity exist
                                //coz if it's not i'll check if it has instead of that 
                                //a fixed entity name inserted in the event entity text box, 
                                //but if it dosen't have anything one of those, that means 
                                //the user chose to put it with no name
                                if ($event_entities_row['committee_name'] != "") {
                                    echo $event_entities_row['committee_name'];
                                } elseif ($events_row['event_entity_name'] != '') {
                                    echo $events_row['event_entity_name'];
                                } else {
                                    echo 'ـــــــــــــــ';
                                }
                            } else {
                                if ($events_row['event_entity_name'] != '') {
                                    echo $events_row['event_entity_name'];
                                } else {
                                    echo 'ـــــــــــــــ';
                                }
                            }
                            ?>
                        </td>
                        <!--this column to view the event time or appointment-->
                        <td style="width: <?php echo $row_table_live_design['table_live_design_event_time_column_width']; ?>%; direction: ltr"><?php
                            //here i'll check if the event appointment column is empty
                            //coz that means the user choose to view the real time instead of it
                            if ($events_row['event_appointment'] == "") {
                                echo date('h:i A', strtotime($events_row['time']));
                            } else {
                                echo $events_row['event_appointment'];
                            }
                            ?></td>
                        <!--this column to view the event hall or place-->
                        <td style="width: <?php echo $row_table_live_design['table_live_design_event_place_column_width']; ?>%">
                            <?php
                            if ($events_row['hall_name'] != '') {
                                echo $events_row['hall_name'];
                            } elseif ($events_row['event_place'] != '') {
                                echo $events_row['event_place'];
                            } else {
                                echo 'ـــــــــــــــ';
                            }
                            ?>
                        </td>
                        <td style="text-align: right;
                            width: <?php echo $row_table_live_design['table_live_design_event_subject_column_width']; ?>%"><?php echo nl2br($events_row['subject']) ?></td>
                    </tr>
                </tbody>
                <?php
            }
        }
    }
    ?>
</table>