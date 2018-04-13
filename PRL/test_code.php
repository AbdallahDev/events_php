<?php include_once 'include/check_session.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>انشاء نشاط جديد</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                //this event run when the event entity name dropdown value changes
                $("#committee").change(function () {
                    //if the user choosed nothing from the dropdown the event entity name textbox will be enabled
                    if ($("#committee").val() == '') {//here i check if user hasn't choose anything from the entity event dropdonw
                        $("#event_entity_name").prop("disabled", false);//here i keep the event entity textbox enabled
                    } else {//this code run when the user chooses event entity from the dropdown
                        $("#event_entity_name").prop("disabled", true);//i make the event entity textbox disabled
                    }
                });
                //bellow when the user focusin the event entity textbox the committe dropdown will be disabled, and that to prevent the user from choosing duplicated values
                $("#event_entity_name").focusin(function () {
                    $("#committee").prop("disabled", true);
                });
                //here when the user focusout the event entity textbox, if it's has a value the dropdown will kept disabled but if it's empty the dropdown will be enabled
                $("#event_entity_name").focusout(function () {
                    if ($("#event_entity_name").val() == '') {
                        $("#committee").prop("disabled", false);
                    } else {
                        $("#committee").prop("disabled", true);
                    }
                });
                //this event run when the dropdown value changes
                $("#hall").change(function () {
                    //if the user choosed nothing from the dropdown
                    //the event place textbox will be enabled
                    if ($("#hall").val() == '') {
                        $("#event_place_textbox").prop("disabled", false);
                    }
                    //if the user choosed a hall from the dropdown
                    //the event place textbox will be diabled if it's empty
                    else {
                        $("#event_place_textbox").prop("disabled", true);
                    }
                });
                //here when the user focusin the event place textbox
                //the hall dropdown will be disabled
                $("#event_place_textbox").focusin(function () {
                    $("#hall").prop("disabled", true);
                });
                //here when the user focusout the event place textbox
                //if it's has a value the dropdown will kept disabled
                //but if it's empty the dropdown will be enabled
                $("#event_place_textbox").focusout(function () {
                    if ($("#event_place_textbox").val() == '') {
                        $("#hall").prop("disabled", false);
                    } else {
                        $("#hall").prop("disabled", true);
                    }
                });
                $("#new_event").click(function () {
                    if (($("#form_div").is(":visible")) === true) {
                        $("#form_div").hide();
                    } else {
                        $("#form_div").show();
                    }
                });
            });
        </script>
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
                    <a class="w3-bar-item w3-button" href='events_preview_current_future.php'>النشاطات الحالية/المستقبلية</a>
                    <a class="w3-bar-item w3-button" href='events_preview_old.php'>ارشيف النشاطات</a>
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

        <!--this form to choose and upload an image-->
        <div class="w3-container w3-padding-64" id="contact">
            <div class="right-align-text">
                <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="test_code_ctl.php" method="post">
                    <div class="w3-section">
                        <label>جهة النشاط</label>
                        <!--this select for the committees that the user can choose from-->
                        <select class="w3-input w3-border right-dir" id="committee" name="committee">
                            <option value="">اختر جهة النشاط</option>
                            <?PHP
                            //here view the committees that belong to
                            //the legislative affairs directorate
                            if ($_SESSION['directorate'] == 2) {
                                include_once '../BLL/user_committee.php';
                                $user_committee = new user_committee();
                                $rs_user_committee = $user_committee->user_committees_get($_SESSION['user_id']);
                                while ($row_user_committee = $rs_user_committee->fetch_assoc()) {
                                    echo '<option value="' . $row_user_committee['committee_id'] . '">'
                                    . $row_user_committee['committee_name']
                                    . '</option><br>';
                                }
                            }
                            //here view the committees that belong to
                            //the public relations directorate
                            //or for the blocs depend on the directorate
                            else {
                                include_once '../BLL/committees.php';
                                $committees = new committees();
                                $rs_committees = $committees->committees_all_get($_SESSION['directorate'], $_SESSION['directorate']);
                                while ($row_committees = $rs_committees->fetch_assoc()) {
                                    echo '<option value="' . $row_committees['committee_id'] . '">'
                                    . $row_committees['committee_name']
                                    . '</option><br>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="w3-section">
                        <label>جهة النشاط</label>
                        <!--this is the name of the event entity-->
                        <input type="text" id="event_entity_name" name="event_entity_name" placeholder="جهة النشاط" class="w3-input w3-border right-dir">
                    </div>
                    <div class="w3-section">
                        <label>وقت النشاط</label>
                        <!--this is the time of the event-->
                        <input type="time" id="time" name="time" value="<?php echo date('H:i') ?>" class="w3-input w3-border right-align-text">
                    </div>
                    <div class="w3-section">
                        <label>موعد النشاط</label>
                        <!--this is the name of the event entity-->
                        <input type="text" id="event_appointment" name="event_appointment" placeholder="موعد النشاط" class="w3-input w3-border right-dir">
                    </div>
                    <div class="w3-section">
                        <label>تاريخ النشاط</label>
                        <!--this is event date, when the event will be hold in-->
                        <input type="date" id="event_date" name="event_date" value="<?php echo date('Y-m-d'); ?>" class="w3-input w3-border right-dir right-align-text right-float">
                    </div>
                    <br>
                    <div class="w3-section">
                        <label>الموضوع</label>
                        <!--this is event subject, it means what the event hold for-->
                        <textarea rows="5" cols="48" id="subject" name="subject" placeholder="الموضوع" class="w3-input w3-border right-dir right-align-text"></textarea>
                    </div>
                    <div class="w3-section">
                        <label>القاعة</label>
                        <!--this select for the hall that the event will be in-->
                        <select id="hall" name="hall" class="w3-input w3-border right-dir">
                            <option value="">اختر القاعة</option>
                            <?PHP
                            include_once '../BLL/halls.php';
                            $hall = new halls();
                            $rs_hall = $hall->halls_get_all();
                            while ($row_hall = $rs_hall->fetch_assoc()) {
                                if ($row_hall['hall_id'] != 0) {
                                    echo '<option value="' . $row_hall['hall_id']
                                    . '">' . $row_hall['hall_name']
                                    . '</option><br>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="w3-section">
                        <label>مكان الاجتماع</label>
                        <!--this is event place, and that when the event dosen't hold in a hall-->
                        <input id="event_place_textbox" name="event_place_textbox" class="w3-input w3-border right-dir" type="text" placeholder="مكان الاجتماع">
                    </div>


                    <div class="w3-section">
                        <label>نشر على الشاشة</label>
                        <!--this is if the event will be shown on the screen-->
                        <input type="checkbox" id="event_status" name="event_status" value="1" class="w3-check">
                    </div>
                    <button class="w3-button w3-right w3-theme" type="submit" id="add" name="add" value="انشاء">انشاء</button>
                </form>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
