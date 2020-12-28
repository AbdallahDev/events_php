<?php include_once 'include/check_session.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>جهات النشاطات</title>

        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            function committees_show() {
                var directorate = <?php echo $_GET['directorate']; ?>;
                $.get('committees_get.php?directorate=' + directorate
                        , function (data, status) {
                            $('#committees').html(data);
                        });
            }
            $(document).ready(function () {
                committees_show();
            });
            setInterval(committees_show, 1000);
        </script>
    </head>
    <body>
        <!---top menu inclusion file-->
        <?php include 'include/menu.php' ?>

        <?php
        if (($_SESSION['user_type'] == 2) || ( $_SESSION['user_type'] == 1)) {// here i check if the user type is regular user with value 2 or admin with value 1, to enable him adding a new committe
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
                        <a href="committee_add.php" class="w3-bar-item w3-button">انشاء جديد</a>
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
        <?php }
        ?>

        <!--this div bellow to view the committees table-->
        <div id="committees"></div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
