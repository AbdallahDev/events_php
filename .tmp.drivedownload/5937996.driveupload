<?Php
include_once 'include/check_session.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ارشيف الجلسات</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            function show_sessions() {
                $.get('sessions_get_past.php', function (data, status) {
                    $('#sessions').html(data);
                });
            }
            $(document).ready(function () {
                show_sessions();
            });
            setInterval(show_sessions, 1000);
        </script>
    </head>
    <body>

        <!---top menu inclusion file-->
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
                    <!--here i'll decide the menu links depend on the user type-->
                    <?php
                    //here make the sidemenu for the users from the legislative affairs directorate 
                    if ($_SESSION['directorate'] == 2) {
                        if ($_SESSION['user_type'] == 1) {
                            //here make the menu for the admin
                            ?>
                    <a class="w3-bar-item w3-button" href='sessions_current_future.php'>الحالي/المستقبلي</a>
                            <?php
                        } else {
                            //here make the menu for the regular user
                            ?>
                            <a class="w3-bar-item w3-button" href='sessions_insert_page.php'>انشاء جديد</a>
                            <a class="w3-bar-item w3-button" href='sessions_current_future.php'>الحالي/المستقبلي</a>
                            <?php
                        }
                    }
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

        <div id="sessions"></div>
        
        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
