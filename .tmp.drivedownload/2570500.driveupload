<?Php include_once 'include/check_session.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>انشاء جديد</title>
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
                    <a class="w3-bar-item w3-button" href='table_live_design_view.php'>التنسيقات</a>
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

        <!--form-->
        <div class="w3-container w3-padding-64" id="contact">
            <div class="right-align-text">
                <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="table_live_design_insert_ctl.php" method="post">
                    <div class="w3-section">
                        <label>حجم الخط</label>
                        <input class="w3-input w3-border right-align-text" type="number" name="table_live_design_font_size" value="17">
                    </div>
                    <div class="w3-section">
                        <label>عرض عامود النشاط</label>
                        <input class="w3-input w3-border right-align-text" type="number" name="table_live_design_event_entity_column_width" value="3">
                    </div>
                    <div class="w3-section">
                        <label>عرض عامود الوقت</label>
                        <input class="w3-input w3-border right-align-text" type="number" name="table_live_design_event_time_column_width" value="1">
                    </div><div class="w3-section">
                        <label>عرض عامود المكان</label>
                        <input class="w3-input w3-border right-align-text" type="number" name="table_live_design_event_place_column_width" value="1">
                    </div><div class="w3-section">
                        <label>عرض عامود الموضوع</label>
                        <input class="w3-input w3-border right-align-text" type="number" name="table_live_design_event_subject_column_width" value="11">
                    </div>
                    <div class="w3-section">
                        <label>تفعيل</label>
                        <input class="w3-check" type="checkbox" name="table_live_design_status1" value="1" checked="">
                    </div>
                    <button class="w3-button w3-right w3-theme" type="submit" name="submit">انشاء</button>
                </form>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
