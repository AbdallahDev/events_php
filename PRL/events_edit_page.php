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
//this array to store all the event entity ids related to the event
$event_entity_ids = array();

//the code bellow is to get the event entity category for the event entity that 
//belong to the event if it has been selected from the event entity drop down menu
//coz this value is needed to decide mutliple things
//
//bellow i'll select all the event entity ids that 
//belong to this event
include_once '../BLL/event_event_entity.php';
$event_event_entity = new event_event_entity();
$event_event_entity_rs = $event_event_entity->entity_id_get($event_id);
//here i'll check if the result has just single row,
//coz that means that the event belong to an
//event entity selected form the event entity dropdown menu, 
//coz of that i should select for the
//user the event entity category that belong to that event entity
if ($event_event_entity_rs->num_rows == 1 && $events_row['event_entity_name'] == "") {
    $event_event_entity_row = $event_event_entity_rs->fetch_assoc();
    $event_entity_id = $event_event_entity_row['event_entity_id'];
    //so here bellow depend on the event entity id
    //i'll get the event entity category id from the committees
    //table to make it selected it in the dropdown menu
    include_once '../BLL/committees.php';
    $committees = new committees();
    $committees_rs = $committees->event_entity_category_id_get($event_entity_id);
    $committees_row = $committees_rs->fetch_assoc();
    $event_entity_catgory_id = $committees_row['event_entity_category_id'];
}
//but here if the returned result has one row or more and the event entity name 
//text box filled with text i'll get all the event entities related to that event 
//if they exist to make them checked in the check boxes
elseif ($event_event_entity_rs->num_rows >= 1 && $events_row['event_entity_name'] != "") {
    while ($event_event_entity_row = $event_event_entity_rs->fetch_assoc()) {
        //here i'll add the event entity ids in the event_entity_ids array so i 
        //can use it later to decide which check box should be checked
        $event_entity_ids[] = $event_event_entity_row['event_entity_id'];
    }
}
?>
<html>
    <head>
        <title>تعديل النشاط</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>

            //this function get the event entities from the db depend on the event entity category
            function event_entities(event_entity_category_id) {
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
                    //here i'll check the result array length to see
                    //if there is result or no
                    if (entities.length !== 0) {
                        $("#committee").show()
                        //here i'll hide the event_entity_name textbox, 
                        //coz the event entity name is exist in the dropdown menu, 
                        //so the user dosen't need to write it here
                        $("#event_entity_name").hide()
                        entities.forEach(function (entities) {
                            $("#committee").append('<option value="' + entities.committee_id + '">' + entities.committee_name + '</option>')
                        })
                    } else {
                        $("#committee").hide();
                        //here i'll show the event_entity_name textbox, 
                        //coz the event entity name dosen't exist in the dropdown menu, 
                        //so he need to write it here
                        $("#event_entity_name").show()
                    }
                });
            }

            //this function render all the event entity check boxes
            function event_entity_checkboxes() {
                //bellow i'll get all the event entites to render them as 
                //check boxes so the user can chose the right one for the event,
                //coz it dosen't belong to a specific one from the event entites dropdown menu
                $.ajax({
                    url: 'event_entities_get_checkbox.php',
                    method: 'post'
                }).done(function (entities) {
                    console.log(entities);
                    entities = JSON.parse(entities);
                    //here i emptying the element of it's content so it dosen't 
                    //stack the new content on the old one every time they appended
                    $("#event_entity_checkboxes_ul").empty();
                    entities.forEach(function (entities) {
                        $("#event_entity_checkboxes_ul").append('<li><label>' + entities.committee_name + '</label>&nbsp;<input type="checkbox" id="" name="event_entity_checkbox[]" value="' + entities.committee_id + '" class = "w3-check" > </li>');
                    })
                });
            }

            $(document).ready(function () {
                //this var to save the event entity catgeroy id
                var event_entity_category_id = <?Php echo $event_entity_catgory_id; ?>;

                //bellow i'll check the event_entity_category_id value
                //coz depend on it i'll decide to view the event entities dropdown menu
                //or the event entity name text box
                if (event_entity_category_id !== 0) {
                    $("#committee").show();
                    //here i called the function to fill the event entities select 
                    //element coz the event entity category already chosen
                    event_entities(event_entity_category_id);
                    $("#event_entity_name").hide();
                } else {
                    $("#committee").hide();
                    $("#event_entity_name").show();
                    $("#event_entity_name").prop("disabled", false);
                    $("#event_entity_category_id").prop("disabled", true);
                }

                //here i'll render all the event entity check boxes if 
                //the event entity name text box filled with text
                if ($("#event_entity_name").val() !== "") {
                    event_entity_checkboxes();
                }

                //this event runs when the event entity categories dropdown value changes
                $("#event_entity_category_id").change(function () {
                    event_entity_category_id = $("#event_entity_category_id").val();
                    //here i'll check for the event_entity_category_id value
                    //coze if it's 0 i don't need to get the commitees from the db
                    if (event_entity_category_id !== 0) {
                        event_entities(event_entity_category_id);
                    }
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
                //here when the user focusout the event entity textbox, if it has a 
                //value the event_entity_checkboxes will be enabled so the user
                //can chose the event entity that the event belong to.
                $("#event_entity_name").focusout(function () {
                    if ($("#event_entity_name").val() !== '') {
                        //here i'll hide the event entity category id dropdown menu
                        //coz the user can't chose from it if he decided to write 
                        //the event entity name in the textbox
                        $("#event_entity_category_id").prop("disabled", true);
                        $("#event_entity_checkboxes").show();
                        event_entity_checkboxes();
                    } else {
                        //here i'll show the event entity category id dropdown menu
                        //coz the user didn't write the event entity name in the textbox
                        //so he will chose it from the dropdown menu
                        $("#event_entity_category_id").prop("disabled", false);
                        $("#event_entity_checkboxes").hide();
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
            <div class="right-align-text">
                <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="events_edit_ctl.php" method="post">
                    <!--this hidden input to send the event id on the form post-->
                    <input type="hidden" id="id" name="id" value="<?php echo $events_row['id'] ?>" class="w3-input w3-border">

                    <!--this div for the event entity categories drop down list -->
                    <div class="w3-section">
                        <select class="w3-input w3-border right-dir" id="event_entity_category_id" 
                                name="event_entity_category_id">
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
                                        <?php echo $row_event_entity_category['event_entity_category_id']; ?>"
                                        <?php
                                        //here i'll select the event entity category 
                                        //that match the one related to the event entity that belong to this event
                                        if ($row_event_entity_category['event_entity_category_id'] == $event_entity_catgory_id) {
                                            echo ' selected';
                                        }
                                        ?>>
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
                            <option value="0">اختر جهة النشاط</option>
                        </select>
                    </div>

                    <div class="w3-section">
                        <!--this is the name of the event entity-->
                        <input type="text" id="event_entity_name" name="event_entity_name" 
                               value="<?php echo $events_row['event_entity_name'] ?>" 
                               placeholder="جهة النشاط" class="w3-input w3-border right-dir">
                    </div>

                    <!--here i'll view all the event entities and render them 
                    as check boxes, coz some events don't belong to a specific
                    event entity, so he can chose to whom the event belong from here-->
                    <div class="w3-section" id="event_entity_checkboxes">
                        <ul class="chk" id="event_entity_checkboxes_ul"></ul>
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

                </form>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
