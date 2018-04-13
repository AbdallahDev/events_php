<?php
include 'include/check_session.php';
include_once '../BLL/permissions.php';
$page_id = 1;
$permission = new permissions();
$rs_permission = $permission->permission_check($_SESSION['user_id'], $page_id);
if ($rs_permission->num_rows != 0) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>تغيير الخلفية</title>
            <!--header file inclusion-->
            <?php include_once 'include/header.php'; ?>
            <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        </head>
        <body>
            <!---top menu file inclusion-->
            <?php include_once 'include/menu.php'; ?>

            <!-- Sidebar menu and button -->
            <div>
                <!-- Sidebar menu -->
                <div>
                    <nav class="w3-sidebar w3-bar-block w3-white w3-card-2 w3-animate-left w3-xxlarge" style="display:none;z-index:2" id="mySidebar">
                        <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-display-topright w3-text-teal">Close
                            <i class="fa fa-remove"></i>
                        </a>
                        <hr>
                        <a href="backgrounds.php" class="w3-bar-item w3-button">رجوع</a>
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

            <!--this form to choose and upload an image-->
            <div class="w3-container w3-padding-64" id="contact">
                <div class="right-align-text">
                    <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="background_add_ctl.php" method="post" enctype="multipart/form-data">
                        <div class="w3-section">
                            <img id="img1" src="../imgs/placeholder.png" height="400px" width="400px" class="w3-input w3-border"/>
                        </div>
                        <div class="w3-section">
                            <input type="file" id="photo_path" name="background_path" class="w3-input w3-border right-dir"/>
                        </div>
                        <input class="w3-check right-align-input" type="checkbox" name="background_status1" value="1">
                        <label>تعيين كخلفية</label>
                        <br>
                        <br>
                        <button class="w3-button w3-right w3-theme" type="submit" name="submit">تحميل الصورة</button>
                    </form>
                </div>
            </div>

            <!--this code bellow to view the choosed image in the browser-->
            <script>
                function prev_image(path)
                {
                    var f = new FileReader();
                    f.onload = function (e) {
                        var image = new Image();
                        image.src = f.result;
                        image.onload = function () {
                            if ((image.width === 1366) && (image.height === 768)) {
                                $("#img1").attr("src", e.target.result);
                            } else {
                                alert('ابعاد الصورة غير مناسبة: \nالطول المناسب: 768px ، العرض المناسب: 1366px');
                                window.location = 'background_add.php';
                            }
                        };
                    };
                    f.readAsDataURL(path.files[0]);
                }
                $("#photo_path").change(function () {
                    prev_image(this);
                });
            </script>

            <!--footer inclusion-->
            <?php include_once 'include/footer.php'; ?>
        </body>
    </html><?php
} else {
    header('location: login_page.php'); //this will redirect the user to the login page if he dosen't have permission to access this page
    exit();
}
