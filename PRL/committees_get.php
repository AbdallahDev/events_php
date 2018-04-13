<?php
include_once 'include/check_session.php';

include '../BLL/committees.php';
$committee = new committees();
if ($_SESSION['user_type'] != 0) {
    $rs = $committee->committees_all_get($_SESSION['directorate'], $_SESSION['directorate']);//here i send the directorate id twice to get all the committees belong to the same direcotrate, and to exclude the empty committee that belong to the same directoraet so the user can't delete it by mistake, because it's used to view the event entity when it's saved using the event entity textbox
} elseif (($_SESSION['user_type'] == 0) && isset($_GET['directorate'])) {
    $rs = $committee->committees_all_get($_GET['directorate'], $_SESSION['directorate']);//here i send the directorate id twice to get all the committees belong to the same direcotrate, and to exclude the empty committee that belong to the same directoraet so the user can't delete it by mistake, because it's used to view the event entity when it's saved using the event entity textbox
}
?> 
<!--Responsive table-->
<div class="w3-container w3-padding-64 w3-center">
    <table>
        <caption>اللجان</caption>
        <thead>
            <tr>
                <th>اللجنة</th>
                <th>تعديل</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $rs->fetch_assoc()) {
                ?>
                <tr>
                    <td data-label="اللجنة"><?php echo $row['committee_name']; ?></td>
                    <td data-label="تعديل"><a href="committee_edit.php?committee_id=<?php echo $row['committee_id']; ?>">تعديل</a></td>
                    <td data-label="حذف"><a href="committee_delete.php?committee_id=<?php echo $row['committee_id']; ?>" onclick="return confirm('هل انت متأكد من الحذف');">حذف</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
