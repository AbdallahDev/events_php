<?php
include_once 'include/check_session.php';
include_once '../BLL/users.php';
include_once '../BLL/committees.php';
include_once '../BLL/user_committee.php';
//create new user object
$user = new users();
//get user detail regard the id sent with link
$rs = $user->get_user($_GET['userId']);
$row = $rs->fetch_assoc();
//get user detail regard the id in session
$rs_user = $user->get_user($_SESSION['user_id']);
$row_user = $rs_user->fetch_assoc();
//create new committee object
$committee = new committees();
$rs1 = $committee->entities_get_all($_SESSION['directorate'], $_SESSION['directorate']);//here i send the directorate id twice to get all the committees belong to the same direcotrate, and to exclude the empty committee that belong to the same directoraet so the user can't delete it by mistake, because it's used to view the event entity when it's saved using the event entity textbox
//create new user committee object
$user_committee = new user_committee();
$rs2 = $user_committee->user_committees_get($_GET['userId']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>تعديل المستخدم</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#directorate_div').show();
                //get the usertype value from the session
                var user_type = <?php echo $_SESSION['user_type'] ?>;
                //check if the usertype value is 0 for the superadmin
                //to hide all the dropdown menus
                //because he dosen't need them when editing
                if (user_type == 0) {
                    $('#department_div').hide();
                    $('#committees_div').hide();
                } else {
                }
                if ($('#department').val() == 1) {
                    $('#committees_div').show();
                } else {
                    $('#committees_div').hide();
                }
                $('#department').change(function () {
                    if ($('#department').val() == 1) {
                        $('#committees_div').show();
                    } else {
                        $('#committees_div').hide();
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
                    <a class="w3-bar-item w3-button" href='users.php'>رجوع</a>
                    <a class="w3-bar-item w3-button" href='user_add.php'>انشاء جديد</a>
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

        <div class="w3-container w3-padding-64" id="contact">
            <div class="right-align-text">
                <!--user editing form-
                some of the form fields will be hidden if the same user session
                will try to edit himself, what will be shown just 
                the username and the password
                and that will happen by checking if the user session id 
                is similar to the edited userid-->
                <form class="w3-container w3-card-4 w3-padding-16 w3-white" id="edit_user" action="user_edit_ctl.php" method="post">
                    <div class="w3-section">
                        <label>الاسم</label>
                        <input class="w3-input w3-border right-dir" type="text" id="name" name="name" value="<?php echo $row['name'] ?>" placeholder="الاسم">
                    </div>
                    <div class="w3-section">
                        <label>كلمة السر</label>
                        <input class="w3-input w3-border right-dir" type="password" id="password" name="password" value="" placeholder="كلمة السر">
                    </div>
                    <?php
                    if ($_SESSION['user_id'] != $row['user_id']) {
                        //view directorates if the user is superadmin
                        if ($row_user['user_type'] == 0) {
                            ?>
                            <div id="directorate_div">
                                <div class="w3-section">
                                    <label>المديرية</label>
                                    <select class="w3-input w3-border right-dir" name="directorate" id="directorate">
                                        <option value="">المديرية</option>
                                        <option value="1" 
                                        <?php echo (($row['directorate'] == 1) ? 'selected' : ''); ?>
                                                >مكتب الامين العام</option>
                                        <option value="2" 
                                        <?php echo (($row['directorate'] == 2) ? 'selected' : ''); ?>
                                                >شؤون التشريع</option>
                                        <option value="3" 
                                        <?php echo (($row['directorate'] == 3) ? 'selected' : ''); ?>
                                                >العلاقات العامة</option>
                                        <option value="4" 
                                        <?php echo (($row['directorate'] == 4) ? 'selected' : ''); ?>
                                                >الكتل والائتلافات النيابية</option>
                                    </select>
                                </div>
                            </div>
                            <?php
                        }
                        //view departments for the committees directorate and that
                        //if the user is superadmin
                        //or the user is adimn and belong to the same directorate
                        if (($row_user['user_type'] == 1) && ($row_user['directorate'] == 2)) {
                            ?>
                            <div id = "department_div">
                                <label>القسم</label>
                                <select class="w3-input w3-border right-dir" name = "department" id = "department">
                                    <option value = "">القسم</option>
                                    <option value = "1"
                                    <?php echo (($row['department'] == 1) ? 'selected' : '');
                                    ?>
                                            >اللجان</option>
                                    <option value="2" 
                                    <?php echo (($row['department'] == 2) ? 'selected' : ''); ?>
                                            >الجلسات</option>
                                </select><br>
                            </div>
                            <?php
                            //عرض اللجان
                            //this array to store all the committees in the db
                            //for the legislatives affairs directorate
                            $row1_ar = array();
                            //this array to store all the committees in the db
                            //for the legislatives affairs directorate
                            //specific user
                            $row2_ar = array();
                            //this array to store all the committees committee_id 
                            //in the db for the legislatives affairs directorate
                            //and that for specific user
                            $row3_ar_committee_id = array();

                            while ($row1 = $rs1->fetch_assoc()) {
                                $row1_ar[] = $row1;
                            }
                            while ($row2 = $rs2->fetch_assoc()) {
                                //here i bring all the specific user committees
                                //and store them in the $row2_ar[] array
                                $row2_ar[] = $row2;
                                //here i bring all the specific user committees committee_id
                                //and store them in the $row3_ar_committee_id[] array
                                $row3_ar_committee_id[] = $row2['committee_id'];
                            }
                            ?>
                            <div id = "committees_div" dir = "rtl" style="text-align: right">
                                <table>
                                    <?php
                                    foreach ($row1_ar as $value1) {
                                        if (in_array($value1['committee_id'], $row3_ar_committee_id)) {
                                            ?>
                                            <tr><td style="text-align: right">
                                                    <input class="w3-check" type="checkbox" name="committee[]" value="<?php echo $value1['committee_id'] ?>" checked>
                                                    <label> <?php echo $value1['committee_name'] ?></label>
                                                </td></tr>
                                            <?php
                                        } else {
                                            ?>
                                            <tr><td style="text-align: right">
                                                    <input class="w3-check" type="checkbox" name="committee[]" value="<?php echo $value1['committee_id'] ?>">
                                                    <label> <?php echo $value1['committee_name'] ?></label>
                                                </td></tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                                <br>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <!--add hidden input type for usertype-->
                    <input type="hidden" name="user_type" value="<?php echo $row['user_type'] ?>">
                    <!--add hidden input type for user id-->
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
                    <button class="w3-button w3-right w3-theme" type="submit" name="edit" id="edit">تعديل</button>
                </form>
                <div id="error" style="color: red; font-weight: bold"></div>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
