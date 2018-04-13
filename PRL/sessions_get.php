<?php
include_once 'include/check_session.php';
include_once '../BLL/sessions.php';
date_default_timezone_set('Asia/Amman');
$session = new sessions();
$rs = $session->sessions_get();
?> <table>
    <tr>
        <th>النص</th>
        <th>التاريخ</th>
        <th>الوقت</th>
        <th>الحالة</th>
        <th>منشور</th>
        <?php
        //check if the user is regular to view the edit and delete tabs
        if ($_SESSION['user_type'] == 2) {
            ?>
            <th>تعديل</th>
            <th>حذف</th>
        <?php }
        ?>
    </tr>
    <?php
    while ($row = $rs->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['session_text']; ?></td>
            <td><?php echo date('Y-m-d', strtotime($row['session_date'])); ?></td>
            <td><?php echo date('h:i:s A', strtotime($row['session_time'])); ?></td>
            <td><?php
                $current_date = date('Y-m-d');
                $session_date = date('Y-m-d', strtotime($row['session_date']));
                if (($row['session_started'] == 1)
                        and ( $row['session_terminated'] == 0)
                        and ( $current_date == $session_date)) {
                    echo '<p style="color:red; background-color: black; '
                    . 'font-weight:bold;">'
                    . 'الجلسة منعقدة' . '</p>';
                } elseif (($row['session_terminated'] == 1)
                        and ( $row['session_started'] == 0)
                        and ( $current_date == $session_date)) {
                    echo '<p style="color:red; font-weight:bold;">'
                    . 'الجلسة لم تعقد' . '</p>';
                }
                ?></td>
            <td><?php
                if (($row['session_status'] == 1)
                        and ( $current_date == $session_date)) {
                    echo '<p style="color:red; background-color:black; '
                    . 'font-weight:bold;">' . 'الجلسة منشورة' . '</p>';
                } elseif (($row['session_status'] == 0)
                        and ( $current_date == $session_date)) {
                    echo '<p>' . 'الجلسة غير منشورة' . '</p>';
                }
                ?>
            </td>
            <?php
            //check if the user is regular with usertype value = 2
            //to view the edit and delete tabs.
            //while for all other user types they will be hidden
            if ($_SESSION['user_type'] == 2) {
                ?>
                <td><a href="sessions_edit_page.php?id=<?php echo $row['id']; ?>">تعديل</a></td>
                <td><a href="sessions_delete.php?id=<?php echo $row['id']; ?>" 
                       onclick="return confirm('هل انت متأكد من حذف الجلسة');">حذف</a></td>
                    <?php
                }
                ?>

        </tr>
        <?php
    }
    ?></table>

