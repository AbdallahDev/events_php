<?php include_once 'include/check_session.php'; ?>
<!DOCTYPE html>
<?php
include_once '../BLL/events.php';
$event = new events();
$rs = $event->get_event($_GET['id']);
$events_row = $rs->fetch_assoc();

//needed variables declaration
$event_id = $_GET['id'];
$event_entity_id = 0;
$event_entity_catgory_id = 0;
?>
<html>
    <head>
        <title>تعديل النشاط</title>
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
                        //here i emptying the element of it's content so it dosen't 
                        //stack the new content on the old one every time they appended
                        $("#committee").empty();
                        if (entities.length !== 0) {
                            $("#committee").show()
                            //here i'll hide the event_entity_name textbox, 
                            //coz the event entity name is exist in the dropdown menu, 
                            //so he dosen't need to write it here
                            $("#event_entity_name").hide()
                            entities.forEach(function (entities) {
                                $("#committee").append('<option value="' + entities.committee_id + '">' + entities.committee_name + '</option>')
                            })
                        } else if (entities.length === 0) {
                            $("#committee").hide();
                            //here i'll show the event_entity_name textbox, 
                            //coz the event entity name dosen't exist in the dropdown menu, 
                            //so he need to write it here
                            $("#event_entity_name").show()
                        }
                    })
                });

                //here check if the event entity dropdown has value
                if ($("#committee").val() != '') {//here i check if the event entity has been choosed from the dropdown menu
                    $("#event_entity_name").prop("disabled", true);//here i disable the event entity textbox
                } else if ($("#event_entity_name").val() != '') {//here i check if the event entity written in the textbox
                    $("#committee").prop("disabled", true);//here i disable the event entity dropdwon menu, because the event entity already has been choosen from the dropdown menu
                }
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
                //--------------------------------------------
                //here check if the hall dropdown has value
                if ($("#hall").val() != '') {//here i check if there is hall choosed from the dropdown menu
                    $("#event_place_textbox").prop("disabled", true);//here i disable the hall textbox
                } else if ($("#event_place_textbox").val() != '') {//here i check if the hall written in the textbox
                    $("#hall").prop("disabled", true);//here i disable the hall dropdwon menu
                }
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
                $('#edit').click(function () {
                    $.post('events_edit_ctl.php', {
                        id: $('#id').val(),
                        committee_id: $("#committee option:selected").val(),
                        event_entity_name: $("#event_entity_name").val(),
                        time: $('#time').val(),
                        event_appointment: $('#event_appointment').val(),
                        hall_id: $("#hall option:selected").val(),
                        event_place_textbox: $("#event_place_textbox").val(),
                        subject: $('#subject').val(),
                        event_date: $('#event_date').val(),
                        event_status: $('#event_status:checkbox:checked').val()
                    }, function (data, status) {
                        window.location = 'events_preview_current_future.php';
//                        alert(data);
                    });
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
                    <a class="w3-bar-item w3-button" href='events_insert_page.php'>انشاء جديد</a>
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

        <!--this form to edit the event-->
        <div class="w3-container w3-padding-64" id="contact">
            <div class="right-align-text w3-container w3-card-4 w3-padding-16 w3-white">
                <input type="hidden" id="id" name="id" value="<?php echo $events_row['id'] ?>" class="w3-input w3-border">

                <!--this div for the event entity categories drop down list -->
                <div class="w3-section">
                    <select class="w3-input w3-border right-dir" id="event_entity_category_id" 
                            name="event_entity_category_id">
                                <?php
                                //bellow i'll select all the event entity ids that 
                                //belong to this event
                                include_once '../BLL/event_event_entity.php';
                                $event_event_entity = new event_event_entity();
                                $event_event_entity_rs = $event_event_entity->entity_id_get($event_id);
                                //here i'll check if the result has just single row,
                                //coz that means that the event belong to a single
                                //event entity, so that means i should select for the 
                                //user the event entity category that belong to that event entity
                                if ($event_event_entity_rs->num_rows == 1) {
                                    $event_event_entity_row = $event_event_entity_rs->fetch_assoc();
                                    $event_entity_id = $event_event_entity_row['event_entity_id'];
                                    //so here bellow depend on the event entity id
                                    //i'll get the event entity category id to select it
                                    //in the dropdown menu
                                    
                                }
                                ?>
                        <!--bellow i've added this option with value 0 so i can 
                        in the logic page the events_insert_page.php decide 
                        if the user did not chose anything-->
                        <option value="0">فئة جهة النشاط</option>
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
                    <input type="text" id="event_entity_name" name="event_entity_name" value="<?php echo $events_row['event_entity_name'] ?>" placeholder="جهة النشاط" class="w3-input w3-border right-dir">
                </div>
                <div class="w3-section">
                    <label>وقت النشاط</label>
                    <!--this is the time of the event-->
                    <input type="time" id="time" name="time" placeholder="time" value="<?php echo $events_row['time'] ?>" class="w3-input w3-border right-align-text">
                </div>
                <div class="w3-section">
                    <label>موعد النشاط</label>
                    <!--this is the name of the event entity-->
                    <input type="text" id="event_appointment" name="event_appointment" placeholder="موعد النشاط" value="<?php echo $events_row['event_appointment'] ?>" class="w3-input w3-border right-dir">
                </div>
                <div class="w3-section">
                    <label>تاريخ النشاط</label>
                    <!--this is event date, when the event will be hold in-->
                    <input type="date" id="event_date" name="event_date" placeholder="التاريخ" value="<?php echo $events_row['event_date'] ?>" class="w3-input w3-border right-dir right-align-text right-float"><br>
                </div>
                <br>
                <div class="w3-section">
                    <label>الموضوع</label>
                    <!--this is event subject, it means what the event hold for-->
                    <textarea style="text-align: right" rows="5" cols="48" id="subject" name="subject" placeholder="الموضوع" class="w3-input w3-border right-dir"><?php echo $events_row['subject'] ?></textarea>
                </div>
                <div class="w3-section">
                    <label>القاعة</label>
                    <!--this select for the hall that the event will be hold in-->
                    <select id="hall" name="hall" class="w3-input w3-border right-dir">
                        <option value="">اختر القاعة</option>
                        <?PHP
                        include_once '../BLL/halls.php';
                        $hall = new halls();
                        $rs_hall = $hall->halls_get_all();
                        //fill the dropdown with halls 
                        //and if the hall id mathces the event hall id
                        //it will be selected
                        while ($row_hall = $rs_hall->fetch_assoc()) {
                            if ($row_hall['hall_id'] != 0) {
                                echo '<option value="' . $row_hall['hall_id'] . '"';
                                if ($row_hall['hall_id'] == $events_row['hall_id']) {
                                    echo ' selected';
                                }
                                echo '>';
                                echo $row_hall['hall_name']
                                . '</option><br>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="w3-section">
                    <label>مكان الاجتماع</label>
                    <!--this is event place, and that when the event dosen't hold in a hall-->
                    <input id="event_place_textbox" name="event_place_textbox" class="w3-input w3-border right-dir"  type="text" placeholder="مكان الاجتماع" value="<?php echo $events_row['event_place'] ?>">
                </div>
                <div class="w3-section">
                    <label>نشر على الشاشة</label>
                    <!--this is if the event will be shown on the screen-->
                    <input type="checkbox" id="event_status" value="1" <?php
                    if ($events_row['event_status'] == 1) {
                        echo ' checked';
                    }
                    ?> class="w3-check">
                </div>
                <button class="w3-button w3-right w3-theme" type="submit" id="edit" name="edit" value="تعديل">تعديل</button>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
