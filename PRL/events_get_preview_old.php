<?php
//this page get the current and the future events
include_once 'include/check_session.php';
include_once '../BLL/events.php';
include_once '../BLL/users.php';
//user object to get the user who last edited the evet
$user = new users();
//event object to get all the events
$event1 = new events();
$rs = $event1->get_events_old($_SESSION['directorate']);
//check if there is result for events,
//that mean if there is events in the past
if ($rs->num_rows != 0) {
    ?> 

    <!--Responsive table-->
    <div class="w3-container w3-padding-64 w3-center">
        <table>
            <caption>ارشيف النشاطات</caption>
            <thead>
                <tr>
                    <th scope="col">النشاط</th>
                    <th scope="col">الوقت</th>
                    <th scope="col">المكان</th>
                    <th scope="col">الموضوع</th>
                    <th scope="col">التاريخ</th>
                    <th scope="col">تاريخ الانشاء</th>
                    <th scope="col">المستخدم</th>
                    <th scope="col">تاريخ التعديل</th>
                    <th scope="col">المستخدم</th>
                    <?php
                    //check if the user is regular to view the edit and delete tabs
                    if ($_SESSION['user_type'] == 2) {
                        ?>
                        <th>تعديل</th>
                        <th>حذف</th>
                    <?php }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($events_row = $rs->fetch_assoc()) {
                    ?>
                    <tr>
                        <td data-label="جهة النشاط"><?php
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
                        <td data-label="الوقت"><?php echo date('h:i A', strtotime($events_row['time'])); ?></td>
                        <td data-label="المكان"><?php
                            if ($events_row['hall_name'] != '') {
                                echo $events_row['hall_name'];
                            } else {
                                echo $events_row['event_place'];
                            }
                            ?>
                        </td>
                        <td data-label="الموضوع"><?php
                            echo nl2br($events_row['subject']);
                            ?></td>
                        <td data-label="تاريخ النشاط"><?php echo $events_row['event_date']; ?></td>
                        <!--here i print the date of the event insertion-->
                        <td data-label="تاريخ الانشاء">
                            <?php echo date('d-m-Y / h:i A', strtotime($events_row['event_insertion_date'])); ?>
                        </td>
                        <!--here i print the name of the user who inserted the event-->
                        <td data-label="اسم المستخدم"><?php echo $events_row['name']; ?></td>
                        <!--here i print the editing date of the event-->
                        <td data-label="تاريخ التعديل">
                            <?php
                            if ($events_row['event_edit_date'] > 0) {
                                echo date('d-m-Y / h:i A', strtotime($events_row['event_edit_date']));
                            } else {//here i check if the event date is not set i'll print empty line
                                echo 'ـــــــــــــــ';
                            }
                            ?>
                        </td>
                        <!--here i print the name of the user who last edited the event-->
                        <td data-label="اسم المستخدم">
                            <?php
                            if ($events_row['user_id_edit'] >= 0) {
                                $rs_user = $user->get_user($events_row['user_id_edit']);
                                $row_user = $rs_user->fetch_assoc();
                                echo $row_user['name'];
                            }
                            //here print the line if there is no one edited the event yet
                            else {
                                echo 'ـــــــــــــــ';
                            }
                            ?>
                        </td>
                        <?php
                        //check if the user is regular with usertype value = 2 to view the edit and delete tabs, while all other user types they will be hidden
                        if ($_SESSION['user_type'] == 2) {
                            ?>
                            <td><a href="events_edit_page.php?id=<?php echo $events_row['id']; ?>">تعديل</a></td>
                            <td><a href="events_delete.php?id=<?php echo $events_row['id']; ?>" 
                                   onclick="return confirm('هل انت متأكد من الحذف');">حذف</a></td>
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
//here view a message when there is no events in the past
else {
    ?>
    <div class="w3-container w3-padding-64 w3-center">
        <h1>لا يوجد نشاطات قديمة</h1>
    </div>
    <?php
}
