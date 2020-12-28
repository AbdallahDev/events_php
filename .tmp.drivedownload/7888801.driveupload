<?php
include_once 'include/check_session.php';
include_once '../BLL/table_live_design.php';

$table_live_design = new table_live_design();
$rs_table_live_design = $table_live_design->table_live_design_get_all();

if ($rs_table_live_design->num_rows != 0) {//check if there is returned urgents
    ?> 
    <div class="w3-container w3-padding-64 w3-center">
        <table>
            <caption>تنسيق الجدول</caption>
            <thead>
                <tr>
                    <th scope="col">حجم الخط</th>
                    <th scope="col">عرض عامود النشاط</th>
                    <th scope="col">عرض عامود الوقت</th>
                    <th scope="col">عرض عامود المكان</th>
                    <th scope="col">عرض عامود الموضوع</th>
                    <th scope="col">الحالة</th>
                    <th scope="col">تعديل</th>
                    <th scope="col">حذف</th>
                </tr>
            </thead>
            <?php
            while ($row_table_live_design = $rs_table_live_design->fetch_assoc()) {
                ?>
                <tbody>
                    <tr>
                        <td data-label="حجم الخط"><?php echo $row_table_live_design['table_live_design_font_size']; ?></td>
                        <td data-label="عرض عامود النشاط"><?php echo $row_table_live_design['table_live_design_event_entity_column_width']; ?></td>
                        <td data-label="عرض عامود الوقت"><?php echo $row_table_live_design['table_live_design_event_time_column_width']; ?></td>
                        <td data-label="عرض عامود المكان"><?php echo $row_table_live_design['table_live_design_event_place_column_width']; ?></td>
                        <td data-label="عرض عامود الموضوع"><?php echo $row_table_live_design['table_live_design_event_subject_column_width']; ?></td>
                        <?php
                        if ($row_table_live_design['table_live_design_status'] == 1) {
                            ?>
                            <td data-label="الحالة" style="background-color: red; font-weight: bold">مفعل</td>    
                        <?php } else {
                            ?>
                            <td data-label = "الحالة">غير مفعل</td>
                        <?php }
                        ?>
                        <td data-label="تعديل"><a href="table_live_design_edit.php?id=<?php echo $row_table_live_design['table_live_design_id']; ?>">تعديل</a></td>
                        <td data-label="حذف"><a href="table_live_design_delete.php?id=<?php echo $row_table_live_design['table_live_design_id']; ?>" onclick="return confirm('هل انت متأكد من الحذف');">حذف</a></td>
                    </tr>
                </tbody>
                <?php
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
    <h1 class="w3-center" style="color: blue">لا يوجد تنسيقات للجدول</h1>
    <?php
}        