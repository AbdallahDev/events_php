<?php
include_once 'include/check_session.php';
include_once '../BLL/urgents.php';
include_once '../BLL/users.php';
//user object to get the user who last edited the evet
$user = new users();
$urgent = new urgents();
$rs_urgent = $urgent->urgent_get($_SESSION['directorate']); //here i get all the urgents for a specific directorate
if ($rs_urgent->num_rows != 0) {
    ?> 
    <div class="w3-container w3-padding-64 w3-center">
        <table>
            <caption>الأرشيف</caption>
            <thead>
                <tr>
                    <th scope="col">النص</th>
                    <th scope="col">تاريخ الابتداء</th>
                    <th scope="col">تاريخ الانتهاء</th>
                    <th scope="col">وقت الانتهاء</th>
                    <th scope="col">وقت الانشاء</th>
                    <th scope="col">المستخدم</th>
                    <th scope="col">آخر التعديل</th>
                    <th scope="col">المستخدم</th>
                    <?php if ($_SESSION['user_type'] == 2) {
                        ?>
                        <th scope="col">تعديل</th>
                        <th scope="col">حذف</th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <?php
            while ($row_urgent = $rs_urgent->fetch_assoc()) {
                if ($row_urgent['urgent_date_start'] <= date('Y-m-d')) {//here i check if the start date of the urgent is less than the current date, because i can't view in the old urgents page any urgent that has a start date greater than the current date, because that means it hasn't started yet
                    if ($row_urgent['urgent_date_end'] <= date('Y-m-d')) {//here i check if the end date of the urgent is less than or equal to the current date, because i can't view in the old urgents page any urgent that has an end date greater than the current date, because that means it hasn't finished yet
                        if ($row_urgent['urgent_date_end'] < date('Y-m-d')) {//here i check if the end date of the urgent is less than the current date and at the same time it's end time is less than the current time, because when the end date become equal to the current date and at the same time it's end time become also greater than the current time on that date, that means the urgent has finished and i should hide it
                            ?>
                            <tr>
                                <td data-label="النص"><?php echo $row_urgent['urgent_text']; ?></td>
                                <td data-label="تاريخ الابتداء"><?php echo date('Y-m-d', strtotime($row_urgent['urgent_date_start'])); ?></td>
                                <td data-label="تاريخ الانتهاء"><?php echo date('Y-m-d', strtotime($row_urgent['urgent_date_end'])); ?></td>
                                <td data-label="وقت الانتهاء" dir="ltr"><?php echo date('h:i A', strtotime($row_urgent['urgent_time_end'])); ?></td>
                                <!--here i print the date of the urgent insertion-->
                                <td data-label="تاريخ الانشاء">
                                    <?php
                                    echo date('Y-m-d / h:i A', strtotime($row_urgent['urgent_insertion_date']));
                                    ?>
                                </td>
                                <!--here i print the name of the user who inserted the urgent-->
                                <td data-label="المستخدم"><?php echo $row_urgent['name']; ?></td>
                                <!--here i print the editing date of the urgent-->
                                <td data-label="تاريخ التعديل">
                                    <?php
                                    //here check if the urgent date of editing is grater than cuurent date
                                    //to print the editing date
                                    if (date('Y-m-d', strtotime($row_urgent['urgent_edit_date'])) >= date('Y-m-d')) {
                                        echo date('Y-m-d / h:i A', strtotime($row_urgent['urgent_edit_date']));
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
                                    $rs_user = $user->get_user($row_urgent['user_id_edit']);
                                    $row_user = $rs_user->fetch_assoc();
                                    //here print the username if there is one edited the urgent
                                    if ($rs_user->num_rows != 0) {
                                        echo $row_user['name'];
                                    }
                                    //here print the line if there is no one edited the urgent yet
                                    else {
                                        echo 'ـــــــــــــــ';
                                    }
                                    ?>
                                </td>
                                <?php if ($_SESSION['user_type'] == 2) { ?>
                                    <td data-label="تعديل"><a href="urgent_edit_page.php?id=<?php echo $row_urgent['urgent_id']; ?>">تعديل</a></td>
                                    <td data-label="حذف"><a href="urgent_delete.php?id=<?php echo $row_urgent['urgent_id']; ?>" onclick="return confirm('هل انت متأكد من الحذف');">حذف</a></td><?php } ?>
                            </tr>
                            <?php
                        } elseif ($row_urgent['urgent_date_end'] == date('Y-m-d')) {
                            if ($row_urgent['urgent_time_end'] < date('H:i')) {
                                ?>
                                <tr>
                                    <td data-label="النص"><?php echo $row_urgent['urgent_text']; ?></td>
                                    <td data-label="تاريخ الابتداء"><?php echo date('Y-m-d', strtotime($row_urgent['urgent_date_start'])); ?></td>
                                    <td data-label="تاريخ الانتهاء"><?php echo date('Y-m-d', strtotime($row_urgent['urgent_date_end'])); ?></td>
                                    <td data-label="وقت الانتهاء" dir="ltr"><?php echo date('h:i A', strtotime($row_urgent['urgent_time_end'])); ?></td>
                                    <!--here i print the date of the urgent insertion-->
                                    <td data-label="تاريخ الانشاء">
                                        <?php
                                        echo date('Y-m-d / h:i A', strtotime($row_urgent['urgent_insertion_date']));
                                        ?>
                                    </td>
                                    <!--here i print the name of the user who inserted the urgent-->
                                    <td data-label="المستخدم"><?php echo $row_urgent['name']; ?></td>
                                    <!--here i print the editing date of the urgent-->
                                    <td data-label="تاريخ التعديل">
                                        <?php
                                        //here check if the urgent date of editing is grater than cuurent date
                                        //to print the editing date
                                        if (date('Y-m-d', strtotime($row_urgent['urgent_edit_date'])) >= date('Y-m-d')) {
                                            echo date('Y-m-d / h:i A', strtotime($row_urgent['urgent_edit_date']));
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
                                        $rs_user = $user->get_user($row_urgent['user_id_edit']);
                                        $row_user = $rs_user->fetch_assoc();
                                        //here print the username if there is one edited the urgent
                                        if ($rs_user->num_rows != 0) {
                                            echo $row_user['name'];
                                        }
                                        //here print the line if there is no one edited the urgent yet
                                        else {
                                            echo 'ـــــــــــــــ';
                                        }
                                        ?>
                                    </td>
                                    <?php if ($_SESSION['user_type'] == 2) { ?>
                                        <td data-label="تعديل"><a href="urgent_edit_page.php?id=<?php echo $row_urgent['urgent_id']; ?>">تعديل</a></td>
                                        <td data-label="حذف"><a href="urgent_delete.php?id=<?php echo $row_urgent['urgent_id']; ?>" onclick="return confirm('هل انت متأكد من الحذف');">حذف</a></td><?php } ?>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
            }
            ?>
        </table>
    </div>
    <?php
}
//here view a message when there is no urgents currently or in the future
else {
    ?>
    <br>
    <h1 class="w3-center" style="color: blue">لا يوجد ما هو عاجل في تواريخ قديمة</h1>
    <?php
}