<?php
include_once 'include/check_session.php';
include_once '../BLL/committees.php';
$committee = new committees();
$rs_committee = $committee->committee_get($_GET['committee_id']);
$row_committee = $rs_committee->fetch_assoc();
?>
<!DOCTYPE html>
<html>
    <head>
        <!--here decide the title depend on the directorate-->
        <?php
        if (($_SESSION['directorate'] == 2) || ($_SESSION['user_type'] == 0)) {
            ?>
            <title>تعديل اللجنة</title>
        <?php } elseif ($_SESSION['directorate'] == 3) {
            ?>
            <title>تعديل اللجنة الدبلوماسية</title>
            <?php
        } elseif ($_SESSION['directorate'] == 4) {
            ?>
            <title>اسم الكتلة / الائتلاف</title>
            <?php
        }
        ?>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
    </head>
    <body>
        <!---top menu file inclusion-->
        <?php include 'include/menu.php'; ?>

        <!-- Sidebar menu and button -->
        <div>
            <!-- Sidebar menu -->
            <div>
                <nav class="w3-sidebar w3-bar-block w3-white w3-card-2 w3-animate-left w3-xxlarge" style="display:none;z-index:2" id="mySidebar">
                    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-display-topright w3-text-teal">Close
                        <i class="fa fa-remove"></i>
                    </a>
                    <hr>
                    <!--bellow i send with the url the id of the directorate-->
                    <?php
                    if ($_SESSION['user_type'] == 2) {//here if the user type is regular user
                        ?>
                        <a class="w3-bar-item w3-button" href='committees.php?directorate=<?php echo $_SESSION['directorate']; ?>'>رجوع</a><!--here i'll send with the url the directorate id for that user-->
                    <?php } elseif ($_SESSION['user_type'] == 0) { ?>
                        <a class="w3-bar-item w3-button" href='committees.php?directorate=2'>رجوع</a><!--here because the user is superadmin and he can just add the legislative affairs committees, i'll send always with the url the directorate id as 2-->
                    <?php }
                    ?>
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
                <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="committee_edit_ctl.php" method="post">
                    <input type = "hidden" name = "committee_id" value = "<?php echo $row_committee['committee_id'] ?>" class="w3-input w3-border">

                    <!--this div for the event entity categories drop down list -->
                    <div class="w3-section">
                        <select class="w3-input w3-border right-dir" name="event_entity_category_id">
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

                    <!--this is the event entity name text box-->
                    <div class="w3-section">
                        <input type="text" name="committee_name" 
                               placeholder = "جهة النشاط" 
                               class="w3-input w3-border right-dir" 
                               value = "<?php echo $row_committee['committee_name'] ?>">
                    </div>
                    
                    <button class="w3-button w3-right w3-theme" type="submit" name="edit">تعديل</button>
                </form>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>    
    </body>
</html>
