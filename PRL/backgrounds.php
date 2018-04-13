<?php
include 'include/check_session.php';
include_once '../BLL/permissions.php';

$page_id = 3;
$permission = new permissions();
$rs_permission = $permission->permission_check($_SESSION['user_id'], $page_id);
if ($rs_permission->num_rows != 0) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>صور الخلفية</title>
            <!--header file inclusion-->
            <?php include_once 'include/header.php'; ?>
            <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
            <script>
                function show_backgrounds() {
                    $.get('backgrounds_get.php', function (data, status) {
                        $('#backgrounds').html(data);
                    });
                }
                $(document).ready(function () {
                    show_backgrounds();
                });
                setInterval(show_backgrounds, 1000);
            </script>
        </head>
        <body>
            <!---top menu inclusion file->
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
                        <a href="background_add.php" class="w3-bar-item w3-button">انشاء جديد</a>
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

            <div id="backgrounds"></div>

            <!--footer inclusion-->
            <?php include_once 'include/footer.php'; ?>
        </body>
    </html><?php
} else {
    header('location: login_page.php'); //this will redirect the user to the login page if he dosen't have permission to access this page
    exit();
}