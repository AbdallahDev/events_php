<?php
include_once 'include/check_session.php';
include_once '../BLL/sessions.php';
include_once '../BLL/users.php';
date_default_timezone_set('Asia/Amman');
//user object to get the user who last edited the evet
$user = new users();
$session = new sessions();
$rs = $session->sessions_get_current_future();
//here check if there is session to view them
if ($rs->num_rows != 0) {
    ?> <!--Responsive table-->
    <!--Responsive table-->
    <div class="w3-container w3-padding-64 w3-center">
        <table>
            <caption>الجلسات الحالية / المستقبلية</caption>
            <thead>
                <tr>
                    <th scope="col">النص</th>
                    <th scope="col">التاريخ</th>
                    <th scope="col">الوقت</th>
                    <th scope="col">الحالة</th>
                    <th scope="col">منشور</th>
                    <th scope="col">وقت الانشاء</th>
                    <th scope="col">المستخدم</th>
                    <th scope="col">آخر التعديل</th>
                    <th scope="col">المستخدم</th>
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
            <?php
            while ($row = $rs->fetch_assoc()) {
                ?>
                <tbody>
                    <tr>
                        <td data-label="النص"><?php echo $row['session_text']; ?></td>
                        <td data-label="التاريخ"><?php echo date('Y-m-d', strtotime($row['session_date'])); ?></td>
                        <td data-label="الوقت"><?php echo date('h:i A', strtotime($row['session_time'])); ?></td>
                        <!--this row for the session status-->
                        <!--if it's broadcasted or not-->
                        <td data-label="الانعقاد"><?php
                            $session_date = date('Y-m-d', strtotime($row['session_date']));
                            if (($row['session_started'] == 1) and ( $row['session_terminated'] == 0) and ( date('Y-m-d') == $session_date)) {
                                echo '<p style="color:red; background-color: black; '
                                . 'font-weight:bold;">'
                                . 'الجلسة منعقدة' . '</p>';
                            } elseif (($row['session_terminated'] == 1) and ( $row['session_started'] == 0) and ( date('Y-m-d') == $session_date)) {
                                echo '<p style="color:red; font-weight:bold;">'
                                . 'الجلسة لم تعقد' . '</p>';
                            } else {
                                echo 'ـــــــــــــــ';
                            }
                            ?></td>
                        <td data-label="على الشاشة"><?php
                            if (($row['session_status'] == 1) and ( date('Y-m-d') == $session_date)) {
                                echo '<p style="color:red; background-color:black; '
                                . 'font-weight:bold;">' . 'الجلسة منشورة' . '</p>';
                            } elseif (($row['session_status'] == 0) and ( $current_date == $session_date)) {
                                echo 'الجلسة غير منشورة';
                            }
                            ?>
                        </td>
                        <!--here i print the date of the event insertion-->
                        <td data-label="تاريخ الانشاء">
                            <?php
                            echo date('Y-m-d / h:i A', strtotime($row['session_insertion_date']));
                            ?>
                        </td>
                        <!--here i print the name of the user who inserted the session-->
                        <td data-label="المستخدم"><?php
                            echo $row['name'];
                            ?>
                        </td>
                        <!--here i print the editing date of the event-->
                        <td data-label="تاريخ التعديل">
                            <?php
                            //here check if the event date of editing is grater than cuurent date
                            //to print the editing date
                            if (date('Y-m-d', strtotime($row['session_edit_date'])) >= date('Y-m-d')) {
                                echo date('Y-m-d / h:i A', strtotime($row['session_edit_date']));
                            }
                            //here if the editing date is less than the current date
                            //a line will printed
                            else {
                                echo 'ـــــــــــــــ';
                            }
                            ?>
                        </td>
                        <!--here i print the name of the user who last edited the event-->
                        <td data-label="المستخدم">
                            <?php
                            $rs_user = $user->get_user($row['session_edit_user_id']);
                            if ($rs_user->num_rows != 0) {
                                $row_user = $rs_user->fetch_assoc();
                                echo $row_user['name'];
                            } else {
                                echo 'ـــــــــــــــ';
                            }
                            ?>
                        </td>
                        <?php
                        //check if the user is regular with usertype value = 2
                        //to view the edit and delete tabs.
                        //while for all other user types they will be hidden
                        if ($_SESSION['user_type'] == 2) {
                            ?>
                            <td data-label="تعديل"><a href="sessions_edit_page.php?id=<?php echo $row['id']; ?>">تعديل</a></td>
                            <td data-label="حذف"><a href="sessions_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('هل انت متأكد من حذف الجلسة');">حذف</a></td>
                            <?php
                        }
                        ?>
                    </tr>
                </tbody>
            <?php } ?>    
        </table>
    </div>
    <?php
}
//if there is no current and future session a messeage will be printed
else {
    ?>
    <br>
    <h1 style="color: blue" class="w3-center">لا يوجد جلسات في اليوم الحالي او المستقبل</h1>
    <?php
}
    