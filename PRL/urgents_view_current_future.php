<?Php include_once 'include/check_session.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>العاجل الحالي والمستقبلي</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            function show_urgents() {
                $.get('urgents_get_current_future.php', function (data, status) {
                    $('#urgent').html(data);
                });
            }
            $(document).ready(function () {
                show_urgents();
            });
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
                    <!--here i'll decide the menu links depend on the user type-->
                    <?php
                    //here make the sidemenu for the users from the legislative affairs directorate 
                    if ($_SESSION['user_type'] == 1) {
                        ?>
                        <a class="w3-bar-item w3-button" href='urgents_view_old.php'>الأرشيف</a>
                        <?php
                    } else {
                        ?>
                        <a class="w3-bar-item w3-button" href='urgent_insert_page.php'>انشاء جديد</a>
                        <a class="w3-bar-item w3-button" href='urgents_view_old.php'>الأرشيف</a>
                        <?php
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

        <div id="urgent"></div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
