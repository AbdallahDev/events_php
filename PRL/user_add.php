<?php
include_once 'include/check_session.php';
include_once '../BLL/committees.php';
include_once '../BLL/users.php';
$committee = new committees();
$rs = $committee->committees_all_get($_SESSION['directorate'], $_SESSION['directorate']);
$user = new users();
$rs_user = $user->get_user($_SESSION['user_id']);
$row_user = $rs_user->fetch_assoc();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>انشاء جديد</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                //hide the committees and the departments dropdown and the committees table
                //unless the selected user type is user
                //the selected directorate is committees to view the departments dropdown
                //and the selected department is committees to view the committees
                var user_type_session = <?php echo $_SESSION['user_type']; ?>;
                var user_directorate_session = <?php echo $_SESSION['directorate']; ?>;
                if ((user_type_session == 0)) {
                    $('#directorate_div').show();
                    if (($('#directorate').val() == 2) && ($('#user_type').val() == 2)) {
                        $('#department_div').show();
                        if (($('#department').val() == 1)) {
                            $('#committees_div').show();
                        } else {
                            $('#committees_div').hide();
                        }
                    } else {
                        $('#department_div').hide();
                        $('#committees_div').hide();
                    }
                } else if ((user_type_session == 1) && (user_directorate_session == 2)) {
                    $('#department_div').show();
                    $('#committees_div').hide();
                } else {
                    $('#directorate_div').hide();
                    $('#department_div').hide();
                    $('#committees_div').hide();
                }
                $("#user_type").on("change", function () {
                    if (this.value > 0) {
                        if (this.value == 2) {
                            $('#directorate_div').show();
                        } else {
                            $('#directorate_div').show();
                            $('#department_div').hide();
                            $('#committees_div').hide();
                        }

                    } else {
                        $('#directorate_div').hide();
                        $('#department_div').hide();
                        $('#committees_div').hide();
                    }
                });
                $("#directorate").on("change", function () {
                    if ((this.value == 2) && ($('#user_type').val() == 2)) {
                        $('#department_div').show();
                    } else {
                        $('#department_div').hide();
                        $('#committees_div').hide();
                    }
                });
                $("#department").on("change", function () {
                    if (this.value == 1) {
                        $('#committees_div').show();
                    } else {
                        $('#committees_div').hide();
                    }
                });
                //hide the committess on page load
                $('#committees').hide();
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
                <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="user_add_ctl.php" method="post">
                    <div class="w3-section">
                        <label>اسم المستخدم</label>
                        <input type="text" name="name" id="name" placeholder="اسم المستخدم" class="w3-input w3-border right-dir">
                    </div>
                    <div class="w3-section">
                        <label>الرقم الوظيفي</label>
                        <input type="number" name="userid" id="userid" placeholder="الرقم الوظيفي" class="w3-input w3-border right-dir">
                    </div>
                    <div class="w3-section">
                        <label>كلمة السر</label>
                        <input type="password" name="password" id="password" placeholder="كلمة السر" class="w3-input w3-border right-dir">
                    </div>
                    <?php
                    //view directorates
                    if ($row_user['user_type'] == 0) {
                        ?>
                        <div id="directorate_div">
                            <div class="w3-section">
                                <label>المديرية</label>
                                <!--this to choose the directorate that the user belongs to-->
                                <select name="directorate" id="directorate" class="w3-input w3-border right-dir">
                                    <option value="">المديرية</option>
                                    <option value="1">مكتب الامين العام</option>
                                    <option value="2">شؤون التشريع</option>
                                    <option value="3">العلاقات</option>
                                    <option value="4">الكتل</option>
                                </select>
                            </div>
                        </div>
                        <?php
                    }
                    //view departments of the committees directorate 
                    //if the user is superadmin
                    //or the user is adimn and belong to the same directorate
                    if (($row_user['user_type'] == 1) && ($row_user['directorate'] == 2)) {
                        ?>
                        <div id="department_div">
                            <div class="w3-section">
                                <label>القسم</label>
                                <!--this to choose the department that the user belongs to-->
                                <select name="department" id="department" class="w3-input w3-border right-dir">
                                    <option value="">الاقسام</option>
                                    <option value="1">اللجان</option>
                                    <option value="2">الجلسات</option>
                                </select>
                            </div>
                        </div>
                        <?php
                        //view committees if the user has no directorate 
                        //or belong to committees directorate
                        if (($row_user['directorate'] == 0) || (($row_user['user_type'] == 1) && ($row_user['directorate'] == 2))) {
                            ?>
                            <div id="committees_div">
                                <table>
                                    <?php
                                    while ($row = $rs->fetch_assoc()) {
                                        ?>
                                        <tr><td>
                                                <div class="w3-section right-align-text">
                                                    <!--those are the committees that the user belongs to-->
                                                    <input type = "checkbox" id="committee[]" name="committee[]" value = "<?php echo $row["committee_id"] ?>" class="w3-check">
                                                    <label><?php echo $row['committee_name'] ?></label>
                                                </div>
                                            </td></tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                                <br>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <button class="w3-button w3-right w3-theme" type="submit" id="add" name="add" value="انشاء">انشاء</button>
                    <div id="error" style="color: red; font-weight: bold"></div>
                </form>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
