<?Php include_once 'include/check_session.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>انشاء جلسة</title>
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
                    <a class="w3-bar-item w3-button" href='sessions_current_future.php'>الحالي/المستقبلي</a>
                    <a class="w3-bar-item w3-button" href='sessions_current_future.php'>الأرشيف</a>
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

        <!--Form-->
        <div class="w3-container w3-padding-64" id="contact">
            <div class="right-align-text">
                <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="sessions_insert_page_ctl.php" method="post">
                    <div class="w3-section">
                        <label>نص الجلسة</label>
                        <textarea rows="5" name="session_text" placeholder="نص الجلسة" class="w3-input w3-border right-dir right-align-text"></textarea>
                    </div>
                    <div class="w3-section">
                        <label>التاريخ</label>
                        <input type="date" name="session_date" value="<?php echo date('Y-m-d'); ?>" class="w3-input w3-border right-dir right-align-text right-float">
                    </div>
                    <br>
                    <div class="w3-section">
                        <label>الوقت</label>
                        <input type="time" id="time" name="session_time" step="1" value="<?php echo date('H:i', mktime(10, 30)); ?>" class="w3-input w3-border right-align-text">
                    </div>
                    <div class="w3-section">
                        <label>نشر على الشاشة</label>
                        <!--this to view the session on the screen-->
                        <input type="checkbox" name="session_status1" value="1" class="w3-check">
                    </div>
                    <button class="w3-button w3-right w3-theme" type="submit" name="submit">انشاء</button>
                </form>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
