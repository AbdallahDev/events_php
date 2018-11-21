<?php
include_once 'include/check_session.php';

include_once '../BLL/committees.php';
$event_entity = new committees();
$rs_event_entity = $event_entity->committees_all_get();
?> 
<!--Responsive table-->
<div class="w3-container w3-padding-64 w3-center">
    <table>
        <thead>
            <tr>
                <th style="font-size: large">فئة جهة النشاط</th>
                <th style="font-size: large">جهة النشاط</th>
                <th style="font-size: large">تعديل</th>
                <th style="font-size: large">حذف</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row_event_entity = $rs_event_entity->fetch_assoc()) {
                ?>
                <tr>
                    <td data-label="فئة جهة النشاط"><?php echo $row_event_entity['event_entity_category_name']; ?></td>
                    <td data-label="جهة النشاط"><?php echo $row_event_entity['committee_name']; ?></td>
                    <td data-label="تعديل"><a href="committee_edit.php?committee_id=<?php echo $row_event_entity['committee_id']; ?>">تعديل</a></td>
                    <td data-label="حذف"><a href="committee_delete.php?committee_id=<?php echo $row_event_entity['committee_id']; ?>" onclick="return confirm('هل انت متأكد من الحذف');">حذف</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
