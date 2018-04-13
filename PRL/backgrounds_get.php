<?php
include_once 'include/check_session.php';
include_once '../BLL/backgrounds.php';
$background = new backgrounds();
$rs_background = $background->background_get_all();
?> 

<!--Responsive table-->
<div class="w3-container w3-padding-64 w3-center">
    <table>
        <caption>صور الخلفية</caption>
        <thead>
            <tr>
                <th>الصورة</th>
                <th>تعديل</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row_background = $rs_background->fetch_assoc()) {
                ?>
                <tr>
                    <td data-label = "الصورة"><img src="<?php echo $row_background['background_path'] ?>" alt="Mountain View" style="width:100%;height:20%;"></td>
                        <?php if ($row_background['background_path'] != '../imgs/backgrounds/background_black.png') {//here i check if the image is not the black one, because the black image can't be allowed to be deleted, or set as background
                            ?>
                        <td data-label = "تعديل"><a href="background_edit.php?id=<?php echo $row_background['background_id']; ?>">تعيين كخلفية</a></td>
                        <td data-label = "حذف"><a href="background_delete.php?id=<?php echo $row_background['background_id']; ?>" onclick="return confirm('هل انت متأكد من الحذف');">حذف</a></td>
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