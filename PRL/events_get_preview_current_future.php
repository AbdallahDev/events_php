<?php
//this page get the current and the future events
include_once 'include/check_session.php';
include_once '../BLL/events.php';
include_once '../BLL/users.php';
//set local server time to jordan time
//and local language to arabic
setlocale(LC_ALL, 'ar_AE.utf8');
date_default_timezone_set('Asia/Amman');
//user object to get the user who last edited the evetn
$user = new users();
//event object to get all the events
$events = new events();
$events_rs = $events->get_events_current_future();
//here i get the max time for the current date events to keep the enabled events 
//viewed on the screen for 2 hours after the last event
$rs_event_max_time = $events->get_events_curdate_max_time();
$row_event_max_time = $rs_event_max_time->fetch_assoc();
//check if there is a result for the events, that means there is events currently or in the future
if ($events_rs->num_rows != 0) {
    ?> 
    <!--Responsive table-->
    <div class="w3-container w3-padding-64 w3-center">
        <table>
            <caption>النشاطات الحالية/المستقبلية</caption>
            <thead>
                <tr>
                    <th scope="col">جهة النشاط</th>
                    <th scope="col">الوقت</th>
                    <th scope="col">المكان</th>
                    <th scope="col">الموضوع</th>
                    <th scope="col">التاريخ</th>
                    <th scope="col">تاريخ الانشاء</th>
                    <th scope="col">المستخدم</th>
                    <th scope="col">تاريخ التعديل</th>
                    <th scope="col">المستخدم</th>
                    <th scope="col">الحالة</th>
                    <?php
                    //check if the user is regular to view the edit and delete tabs
                    if ($_SESSION['user_type'] == 2) {
                        ?>
                        <th scope="col">تعديل</th>
                        <th scope="col">حذف</th>
                    <?php }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($events_row = $events_rs->fetch_assoc()) {
                    ?>
                    <tr>
                        <td data-label="جهة النشاط"><?php
                            //i need to make an object for the committees class 
                            //to get the proper event entity name for the event
                            include_once '../BLL/committees.php';
                            $event_entities = new committees();
                            $event_entities_rs = $event_entities->event_entity_name_get($events_row['id']);
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
                            ?></td>
                        <td data-label="الوقت"><?php echo date('h:i A', strtotime($events_row['time'])); ?></td>
                        <td data-label="المكان" dir="rtl"><?php
                            if ($events_row['hall_name'] != '') {
                                echo $events_row['hall_name'];
                            } elseif ($events_row['event_place'] != '') {
                                echo $events_row['event_place'];
                            } else {
                                echo 'ـــــــــــــــ';
                            }
                            ?>
                        </td>
                        <td data-label="الموضوع"><?php echo $events_row['subject']; ?></td>
                        <td data-label="تاريخ النشاط"><?php echo $events_row['event_date']; ?></td>
                        <!--here i print the date of the event insertion-->
                        <td data-label="تاريخ الانشاء">
                            <?php
                            echo date('Y-m-d / h:i A', strtotime($events_row['event_insertion_date']));
                            ?>
                        </td>
                        <!--here i print the name of the user who inserted the event-->
                        <td data-label="اسم المستخدم"><?php echo $events_row['name']; ?></td>
                        <!--here i print the editing date of the event-->
                        <td data-label="تاريخ التعديل">
                            <?php
                            //here check if the event date of editing is grater than cuurent date
                            //to print the editing date
                            if (date('Y-m-d', strtotime($events_row['event_edit_date'])) >= date('Y-m-d')) {
                                echo date('Y-m-d / h:i A', strtotime($events_row['event_edit_date']));
                            }
                            //here if the editing date is less than the current date
                            //a line will printed
                            else {
                                echo 'ـــــــــــــــ';
                            }
                            ?>
                        </td>
                        <!--here i print the name of the user who last edited the event-->
                        <td data-label="اسم المستخدم">
                            <?php
                            $rs_user = $user->get_user($events_row['user_id_edit']);
                            $row_user = $rs_user->fetch_assoc();
                            //here print the username if there is one edited the event
                            if ($rs_user->num_rows != 0) {
                                echo $row_user['name'];
                            }
                            //here print the line if there is no one edited the event yet
                            else {
                                echo 'ـــــــــــــــ';
                            }
                            ?>
                        </td>
                        <?php
                        if (($events_row['event_status'] == 1) and $events_row['event_date'] == date('Y-m-d') and ( date('H:i') <= $row_event_max_time['time'])) {//here i check if the event status is enabled with value 1 and within the current date and it's time is within the max events time plus one hour
                            ?>
                            <td data-label="الحالة" style="color: white; background-color: red">منشور</td>
                            <?php
                        } else {
                            ?>
                            <td data-label="الحالة">غير منشور</td>
                            <?php
                        }
                        //check if the user is regular with usertype value = 2 to view the edit and delte tabs. while all other user types they will be hidden
                        if ($_SESSION['user_type'] == 2) {
                            ?>
                            <td data-label="تعديل"><a href="events_edit_page.php?id=<?php echo $events_row['id']; ?>">تعديل</a></td>
                            <td data-label="حذف"><a href="events_delete.php?id=<?php echo $events_row['id']; ?>" onclick="return confirm('هل انت متأكد من الحذف');">حذف</a></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}
//here view a message when there is no events currently or in the future
else {
    ?>
    <div class="w3-container w3-padding-64 w3-center">
        <h1>لا يوجد نشاطات في اليوم الحالي او المستقبل</h1>
    </div>
    <?php
}