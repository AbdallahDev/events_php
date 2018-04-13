<?php
include_once 'include/check_session.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>استعراض النشاطات القديمة</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            //this function get the old events
            function show_events_old() {
                $.get('events_get_preview_old.php', function (data, status) {
                    $('#events').html(data);
                });
            }
            $(document).ready(function () {
                show_events_old();
            });
            setInterval(show_events_old(), 1000);
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
                    <a href="events_insert_page.php" class="w3-bar-item w3-button">انشاء جديد</a>
                    <a href="events_preview_current_future.php" class="w3-bar-item w3-button">النشاطات الحالية/المستقبلية</a>
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

        <!--this div bellow to view the old events table-->
        <div id="events"></div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>    
    </body>
</html>
