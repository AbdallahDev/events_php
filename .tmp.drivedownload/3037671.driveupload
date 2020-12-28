<?Php include_once 'include/check_session.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>تعديل العاجل</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
    </head>
    <body>

        <!---top menu file inclusion-->
        <?php include 'include/menu.php' ?>

        <!-- Sidebar menu and button -->
        <div>
            <!-- Sidebar menu -->
            <div>
                <nav class="w3-sidebar w3-bar-block w3-white w3-card-2 w3-animate-left w3-xxlarge" style="display:none;z-index:2" id="mySidebar">
                    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-display-topright w3-text-teal">Close
                        <i class="fa fa-remove"></i>
                    </a>
                    <hr>
                    <?php if ($_SESSION['user_type'] == 2) {//here i check for the regular user, because i want to view the urgent insert page link just for him, because the admin can't insert urgents, he allowed just to view them
                        ?>
                        <a class="w3-bar-item w3-button" href='urgent_insert_page.php'>انشاء جديد</a>
                    <?php } ?>
                    <a class="w3-bar-item w3-button" href='urgents_view_current_future.php'>الحالي / القادم</a>
                    <a class="w3-bar-item w3-button" href='urgents_view_old.php'>الأرشيف</a>
                </nav>
            </div>
            <!-- Sidebar button -->
            <div>
                <br>
                <div class="w3-container" style="position:relative">
                    <a onclick="w3_open()" class="w3-button w3-xlarge w3-circle w3-teal"
                       style="position:absolute;top:-28px;right:24px">+</a>
                </div>
            </div>
        </div>

        <?php
        include_once '../BLL/urgents.php';
        $urgent = new urgents();
        $rs_urgent = $urgent->urgent_get_id($_GET['id']);
        $row_urgent = $rs_urgent->fetch_assoc();
        ?>

        <!--form-->
        <div class="w3-container w3-padding-64" id="contact">
            <div class="right-align-text">
                <form action="urgent_edit_page_ctl.php" method="post" class="w3-container w3-card-4 w3-padding-16 w3-white">
                    <div class="w3-section">
                        <label>النص</label>
                        <textarea class="w3-input w3-border right-dir" placeholder="نص العاجل" name="urgent_text"><?php echo $row_urgent['urgent_text']; ?></textarea>
                    </div>
                    <div class="w3-section">
                        <label>تاريخ الابتداء</label>
                        <input class="w3-input w3-border right-align-text" type="date" name="urgent_date_start" value="<?php echo $row_urgent['urgent_date_start']; ?>">
                    </div>
                    <div class="w3-section">
                        <label>تاريخ الانتهاء</label>
                        <input class="w3-input w3-border right-align-text" type="date" name="urgent_date_end" value="<?php echo $row_urgent['urgent_date_end']; ?>">
                    </div>
                    <div class="w3-section">
                        <label>وقت الانتهاء</label>
                        <input class="w3-input w3-border right-align-text" type="time" name="urgent_time_end" value="<?php echo $row_urgent['urgent_time_end']; ?>">
                    </div>
                    <div class="w3-section">
                        <label>تفعيل</label>
                        <input type="checkbox" name="urgent_status1" value="1" class="w3-check" 
                        <?php
                        if ($row_urgent['urgent_status'] == 1) {
                            echo 'checked';
                        }
                        ?>>
                    </div>
                    <input type="hidden" name="urgent_id" value="<?php echo $row_urgent['urgent_id']; ?>"><!--here i send the urgent id as hidden value to know which urgent i want to edit in the database-->
                    <button class="w3-button w3-black" type="submit" name="submit">تعديل</button>
                </form>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
