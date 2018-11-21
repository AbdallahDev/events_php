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
                //this event runs when the event entity categories dropdown value changes
                //bellow i'll hide the committees dropdownlist, coz the user 
                //has not yet chosen any category
                $("#committee").hide();
                $("#event_entity_category_id").change(function () {
                    var event_entity_category_id = $("#event_entity_category_id").val();
                    $.ajax({
                        url: 'event_entities_get_category.php',
                        method: 'post',
                        data: "id=" + event_entity_category_id
                    }).done(function (entities) {
                        console.log(entities);
                        entities = JSON.parse(entities);
                        $("#committee").empty();
                        if (entities.length != 0) {
                            $("#committee").show()
                            entities.forEach(function (entities) {
                                $("#committee").append('<option>' + entities.committee_name + '</option>')
                            })
                        } else if (entities.length == 0) {
                            $("#committee").hide();
                        }
                    })
                });

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
            }
            );
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
                <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="events_insert.php" method="post">
                    <!--this div for the event entity categories drop down list -->
                    <div class="w3-section">
                        <select class="w3-input w3-border right-dir" id="event_entity_category_id" 
                                name="event_entity_category_id">
                            <option value="">فئة جهة النشاط</option>
                            <?PHP
                            //bellow i'll view all the event entity catigories
                            //
                            //here is the php code to view the event entity 
                            //categories in the drop down list
                            include_once '../BLL/event_entity_category.php';
                            $event_entity_category = new event_entity_category();
                            $rs_event_entity_category = $event_entity_category->event_entity_category_get_all();
                            while ($row_event_entity_category = $rs_event_entity_category->fetch_assoc()) {
                                ?>
                                <option value="
                                        <?php echo $row_event_entity_category['event_entity_category_id']; ?>">
                                            <?php echo $row_event_entity_category['event_entity_category_name']; ?>
                                </option>
                            <?php }
                            ?>
                        </select>
                    </div>

                    <!--this div for the event entities drop down list -->
                    <div class="w3-section">
                        <!--this select for the committees that the user can choose from-->
                        <select class="w3-input w3-border right-dir" id="committee" name="committee">
                            <option value="">اختر جهة النشاط</option>

                        </select>
                    </div>
                    <div class="w3-section">
                        <!--this is the name of the event entity-->
                        <input type="text" id="event_entity_name" name="event_entity_name" placeholder="جهة النشاط" class="w3-input w3-border right-dir">
                    </div>
                    <div class="w3-section">
                        <label>وقت النشاط</label>
                        <!--this is the time of the event-->
                        <input type="time" id="time" name="time" value="<?php echo date('H:i') ?>" class="w3-input w3-border right-align-text">
                    </div>
                    <div class="w3-section">
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
