<?php
include_once 'include/check_session.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ادارة المستخدمون</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            //this function to view confirm message before delete
            function message_confirm() {
                var result = confirm("Want to delete?");
                if (result) {
                    window.location = ''
                }
            }

            $(document).ready(function () {
                $.get('users_get.php', function (data, status) {
                    $('#users').html(data);
                });
            }
            );
        </script>
    </head>
    <body>

        <!---top menu inclusion file-->
        <?php include 'include/menu.php' ?>

        <!--this sidemenu will appear just for the superadmin and the admins-->
        <?php
        if ($_SESSION['user_type'] != 2) {
            ?>
            <!-- Sidebar menu and button -->
            <div>
                <!-- Sidebar menu -->
                <div>
                    <nav class="w3-sidebar w3-bar-block w3-white w3-card-2 w3-animate-left w3-xxlarge" style="display:none;z-index:2" id="mySidebar">
                        <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-display-topright w3-text-teal">Close
                            <i class="fa fa-remove"></i>
                        </a>
                        <hr>
                        <a href="user_add.php" class="w3-bar-item w3-button">انشاء جديد</a>

                    </nav>
                </div>
                <!-- Sidebar menu button -->
                <div>
                    <br>
                    <div class="w3-container" style="position:relative">
                        <a onclick="w3_open()" class="w3-button w3-xlarge w3-circle w3-teal"
                           style="position:absolute;top:-28px;right:24px">+</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <!--this div to view the error related to the user deletion or editing-->
        <div id="error" class="w3-center" style="color: red;"><h3><?php
                if (isset($_GET['error'])) {
                    switch ($_GET['error']) {
                        case 1://this error relate to the user deletion
                            echo 'لا يمكن حذف المستخدم لارتباطه بمستخدون او نشاطات';
                            break;

                        case 2://this error relate to the user editing
                            echo 'لا يمكن تعديل المستخدم لارتباطه بمستخدون او نشاطات';
                            break;
                    }
                }
                ?></h3></div>

        <div id="users" class="w3-center"></div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
