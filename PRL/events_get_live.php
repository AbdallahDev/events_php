<?php
//include events class
include_once '../BLL/events.php';
//set time zone to amman
date_default_timezone_set('Asia/Amman');

include_once 'include/arabicdate.php'; //this file to print the date as arabic date
//get events
$event = new events();
$rs = $event->get_events_curdate();

//here i get the max time for the current date events to keep the events table viewed 2 hours after the last event
$rs_event_max_time = $event->get_events_curdate_max_time();
$row_event_max_time = $rs_event_max_time->fetch_assoc();

//bellow i'll get the data regared the table live design
include_once '../BLL/table_live_design.php';
$table_live_design = new table_live_design();
$rs_table_live_design = $table_live_design->table_live_design_get_live();
$row_table_live_design = $rs_table_live_design->fetch_assoc();
?>


<?php
if ($rs->num_rows > 0) {
    if ((date('H:i') >= date('08:00')) && (date('H:i') <= $row_event_max_time['time'])) {
        ?> 
        <div style="position: relative; top: 265px; font-size: 32px; font-weight: 900; color: balck"><?php echo ArabicDate(); ?></div>
        <table style="position: relative; top: 280px; font-size: <?php echo $row_table_live_design['table_live_design_font_size']; ?>px;">
            <tr>
                <th>النشاط</th>
                <th>الوقت</th>
                <th>المكان</th>
                <th>الموضوع</th>
            </tr>
            <?php
            while ($row = $rs->fetch_assoc()) {
                ?>
                <tbody style="vertical-align: text-top; text-align: center; font-weight: bold;">
                    <tr>
                        <td style="width: <?php echo $row_table_live_design['table_live_design_event_entity_column_width'] ?>%"><?php
                            if ($row['committee_id'] > 4) {//here i check if the committee id is greater that 4, because 4 is the last id for the empty committees, and because that means that the event entity name is not choossed using the event entity dropdown menu saved using the event entity textbox
                                echo $row['committee_name'];
                            } else {
                                echo $row['event_entity_name'];
                            }
                            ?></td>
                        <td style="width: <?php echo $row_table_live_design['table_live_design_event_time_column_width']; ?>%; direction: ltr"><?php
                            if ($row['event_appointment'] != "") {
                                echo $row['event_appointment'];
                            } else {
                                echo date('h:i A', strtotime($row['time']));
                            }
                            ?></td>
                        <td style="width: <?php echo $row_table_live_design['table_live_design_event_place_column_width']; ?>%">
                            <?php
                            if ($row['hall_name'] != "")
                                echo $row['hall_name'];
                            else
                                echo $row['event_place'];
                            ?>
                        </td>
                        <td style="text-align: right;
                            width: <?php echo $row_table_live_design['table_live_design_event_subject_column_width']; ?>%"><?php echo $row['subject'] ?></td>
                    </tr>
                </tbody>
                <?php
            }
        }
    }
    ?>
</table>