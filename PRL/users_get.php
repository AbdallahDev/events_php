<?php
include_once 'include/check_session.php';
include_once '../BLL/users.php';
include_once '../BLL/user_committee.php';

$user = new users();
//cehck if the user type superadmin with value 0
if ($_SESSION['user_type'] == 0) {
    //get all the users(superadmin, admins) except the regular users
//because superadmin can't see them
    $rs = $user->get_all_users_except_regular_ones();
}
//cehck if the user type admin with value 1
else if ($_SESSION['user_type'] == 1) {
//get all the users on the same direcotrates, and that for the admins
//so they can see their employees
    $rs = $user->get_all_users_in_directorate($_SESSION['directorate']);
}
//cehck if the user type is regular one with value 2
else {
    //get specific user to be able to see his information.
    $rs = $user->get_user($_SESSION['user_id']);
    $row_user_type = $rs->fetch_assoc();
}

//create user to get committees
$user_committee = new user_committee();
?> 
<!--Responsive table-->
<div class="w3-container w3-padding-64 w3-center">
    <table>
        <?php if ($_SESSION['user_type'] != 2) { ?>
            <caption>المستخدمون</caption>
        <?php } else {
            ?>   
            <caption>معلومات المستخدم</caption>
        <?Php }
        ?>
        <thead>
            <tr>
                <th scope="col">الاسم</th>
                <th scope="col">الرقم الوظيفي</th>
                <th scope="col">نوع الموظف</th>
                <th scope="col">المديرية</th>
                <!--view the table header of the departments and committees -->
                <!--just if the user belong to legislative affairs-->
                <?php if ($_SESSION['directorate'] == 2) { ?>
                    <th scope="col">القسم</th>
                    <?php
                    if (($_SESSION['user_type'] == 1) || ($_SESSION['department'] == 1)) {
                        ?>
                        <th scope="col">اللجان</th>
                        <?php
                    }
                }
                ?>
                <th scope="col">تعديل</th>
                <?php if ($_SESSION['user_type'] != 2) {//here i'll show the delete coloumn just for the superadmin and the admins, so the regular user won't be able to delete himself ?>
                    <th scope="col">حذف</th>
                <?php } ?>
            </tr>
        </thead>
        <?php
        //this view will be for the superadmin and the admins to view the users that belong to them
        if ($_SESSION['user_type'] != 2) {//here check if the user is not regual user
            while ($row = $rs->fetch_assoc()) {
                ?>
                <tr>
                    <td data-label="الاسم"><?php echo $row['name']; ?></td>
                    <td data-label="الرقم الوظيفي"><?php echo $row['user_id']; ?></td>
                    <!--view user type-->
                    <?php if ($row['user_type'] == 0) {
                        ?>
                        <td data-label="نوع المستخدم">مسؤول نظام</td>
                        <?php
                    } elseif ($row['user_type'] == 1) {
                        ?>
                        <td data-label="نوع المستخدم">مشرف</td>
                        <?php
                    } else {
                        ?><td data-label="نوع المستخدم">مستخدم</td><?php } ?>
                    <!--view the directorates that each user belong to-->
                    <td data-label="المديرية">
                        <?php
                        if ($row['directorate'] == 0) {
                            echo 'ـــــــــ';
                        } elseif ($row['directorate'] == 1) {
                            echo 'مكتب الامين العام';
                        } elseif ($row['directorate'] == 2) {
                            echo 'شؤون التشريع';
                        } elseif ($row['directorate'] == 3) {
                            echo 'العلاقات العامة';
                        } elseif ($row['directorate'] == 4) {
                            echo 'الكتل والائتلافات النيابية';
                        }
                        ?>
                    </td>
                    <!--view the departments in the table-->
                    <!--just if the user belong to legislative affairs-->
                    <?php if ($_SESSION['directorate'] == 2) { ?>
                        <td data-label="القسم">
                            <?php
                            if ($row['department'] == 1) {
                                echo 'اللجان';
                            } elseif ($row['department'] == 2) {
                                echo 'الجلسات';
                            }
                            ?>
                        </td>
                    <?php } ?>
                    <!--view the committees in the table -->
                    <!--just if the user belong to legislative affairs-->
                    <?php if ($_SESSION['directorate'] == 2) { ?>
                        <td data-label="اللجان">
                            <?php if ($row['department'] == 1) { ?>
                                <select>
                                    <?php
                                    $user_committee = new user_committee();
                                    $rs1 = $user_committee->user_committees_get($row['user_id']);
                                    while ($row1 = $rs1->fetch_assoc()) {
                                        echo '<option name="check_list[]" '
                                        . 'value="' . $row1['committee_id'] . '">'
                                        . $row1['committee_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <?php
                            } else {
                                echo 'ـــــــــ';
                            }
                        }
                        ?>
                    </td>
                    <td data-label="تعديل"><a href="user_edit.php?userId=<?php echo $row['user_id']; ?>">تعديل</a></td>
                    <td data-label="حذف"><a href = "user_delete.php?userId=<?php echo $row['user_id']; ?>" onclick="return confirm('هل انت متأكد من الحذف');">حذف</a></td>
                </tr>
                <?php
            }
        }
        //here view the table with information for specific user, 
        //because the regular user can't see any information for any other users
        else {
            ?>
            <tr>
                <td data-label="الاسم"><?php echo $row_user_type['name']; ?></td>
                <td data-label="الرقم الوظيفي"><?php echo $row_user_type['user_id']; ?></td>
                <!--view user type-->
                <td data-label="نوع المستخدم">مستخدم عادي</td>
                <!--view the directorate in the table-->
                <td data-label="المديرية">
                    <?php
                    if ($row_user_type['directorate'] == 0) {
                        echo 'ـــــــــ';
                    } elseif ($row_user_type['directorate'] == 1) {
                        echo 'مكتب الامين العام';
                    } elseif ($row_user_type['directorate'] == 2) {
                        echo 'شؤون التشريع';
                    } elseif ($row_user_type['directorate'] == 3) {
                        echo 'العلاقات العامة';
                    } elseif ($row_user_type['directorate'] == 4) {
                        echo 'الكتل والائتلافات النيابية';
                    }
                    ?>
                </td>
                <!--view the department in the table-->
                <?php if ($_SESSION['directorate'] == 2) { ?>
                    <td data-label="القسم">
                        <?php
                        if ($row_user_type['department'] == 0) {
                            echo 'ـــــــــ';
                        } elseif ($row_user_type['department'] == 1) {
                            echo 'اللجان';
                        } elseif (($row_user_type['department'] == 2)) {
                            echo 'الجلسات';
                        }
                        ?>
                    </td>
                <?php } ?>
                <!--view the committees in the table just-->
                <!--for the user for the legislative affairs directorate-->
                <!--and in the committees department-->
                <?php if ($_SESSION['department'] == 1) {
                    ?>
                    <td data-label="اللجان">
                        <?php if ($row_user_type['department'] == 1) { ?>
                            <select>
                                <?php
                                $user_committee = new user_committee();
                                $rs1 = $user_committee->user_committees_get($row_user_type['user_id']);
                                while ($row1 = $rs1->fetch_assoc()) {
                                    echo '<option name="check_list[]" '
                                    . 'value="' . $row1['committee_id'] . '">'
                                    . $row1['committee_name'] . '</option>';
                                }
                                ?>
                            </select>
                            <?php
                        } else {
                            echo 'ـــــــــ';
                        }
                        ?>
                    </td>
                <?php } ?>
                <td data-label="تعديل"><a href="user_edit.php?userId=<?php echo $_SESSION['user_id']; ?>">تعديل</a></td>
            </tr>
        <?php }
        ?> 
    </table>
</div>