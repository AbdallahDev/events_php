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
                while ($row = $rs->fetch_assoc()) {
                    ?>
                    <tr>
                        <td data-label="النشاط"><?php
                            if ($row['committee_id'] > 4) {//here i check if the committee id is greater that 4, because 4 is the last id for the empty committees, and because that means that the event entity name is not choossed using the event entity dropdown menu saved using the event entity textbox
                                echo $row['committee_name'];
                            } else {
                                echo $row['event_entity_name'];
                            }
                            ?></td>
                        <td data-label="الوقت"><?php echo date('h:i A', strtotime($row['time'])); ?></td>
                        <td data-label="المكان"><?php
                            if ($row['hall_name'] != '') {
                                echo $row['hall_name'];
                            } else {
                                echo $row['event_place'];
                            }
                            ?>
                        </td>
                        <td data-label="الموضوع"><?php echo $row['subject']; ?></td>
                        <td data-label="تاريخ النشاط"><?php echo $row['event_date']; ?></td>
                        <!--here i print the date of the event insertion-->
                        <td data-label="تاريخ الانشاء">
        <?php echo date('d-m-Y / h:i A', strtotime($row['event_insertion_date'])); ?>
                        </td>
                        <!--here i print the name of the user who inserted the event-->
                        <td data-label="اسم المستخدم"><?php echo $row['name']; ?></td>
                        <!--here i print the editing date of the event-->
                        <td data-label="تاريخ التعديل">
                            <?php
                            if ($row['event_edit_date'] > 0) {
                                echo date('d-m-Y / h:i A', strtotime($row['event_edit_date']));
                            } else {//here i check if the event date is not set i'll print empty line
                                echo 'ـــــــــــــــ';
                            }
                            ?>
                        </td>
                        <!--here i print the name of the user who last edited the event-->
                        <td data-label="اسم المستخدم">
                            <?php
                            if ($row['user_id_edit'] >= 0) {
                                $rs_user = $user->get_user($row['user_id_edit']);
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
                            <td><a href="events_edit_page.php?id=<?php echo $row['id']; ?>">تعديل</a></td>
                            <td><a href="events_delete.php?id=<?php echo $row['id']; ?>" 
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
