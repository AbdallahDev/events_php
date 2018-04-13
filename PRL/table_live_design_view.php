<?Php include_once 'include/check_session.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>تنسيق الجدول</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            function show_table_live_design() {
                $.get('table_live_design_view_get.php', function (data, status) {
                    $('#table_live_design').html(data);
                });
            }
            $(document).ready(function () {
                show_table_live_design();
            });
            setInterval(show_table_live_design, 1000);
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
                    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-display-topright w3-text-teal">Close<i class="fa fa-remove"></i></a>
                    <hr>
                    <a class="w3-bar-item w3-button" href='table_live_design_insert.php'>انشاء جديد</a>
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

        <div id="table_live_design"></div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
