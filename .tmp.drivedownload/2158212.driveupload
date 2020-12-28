<?Php
include_once 'include/check_session.php';
include_once '../BLL/sessions.php';
$session = new sessions();
$rs_session = $session->session_get_id($_GET['id']);
$row_session = $rs_session->fetch_assoc();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>تعديل الجلسة</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                var current_time = <?php echo time(); ?>;
                var session_time = <?Php echo strtotime($row_session['session_time']) ?>;
                //this function bellow check if the current time is less than the session time, to ban the user from cheking the session started checkbox if that ture
                $('#session_started').on('change', function () {
                    if (current_time < session_time) {
                        alert('لم يحن موعد الجلسة بعد');
                        $('#session_started').prop('checked', false);
                    } else {
                        $('#session_terminated').prop('checked', false);//here i discheck the session termination checkbox because the session started checkbox is checked
                        $('#session_terminated_text').prop('disabled', true);//here i disable the session termination textbox because the session started checkbox is checked
                    }
                });
                if ($('#session_terminated').is(':checked')) {//here i check if the session terminated checkbox is checked to enable to session termination textbox, or keep it disabled
                    $('#session_terminated_text').prop('disabled', false);//here i disable the session termination textbox, because it's not used if the session termination checkbox not checked
                } else {
                    $('#session_terminated_text').prop('disabled', true);//here i disable the session termination textbox, because it's not used if the session termination checkbox not checked
                }

                //bellow i check if the session terminated check box has been checked to enable the textbox for session termination textbox, or i'll keep it disabled
                $('#session_terminated').on('change', function () {
                    if ($('#session_terminated').is(':checked')) {
                        $('#session_terminated_text').prop('disabled', false);
                    } else {
                        $('#session_terminated_text').prop('disabled', true);
                    }
                });
                $('#session_terminated').on('change', function () {
                    $('#session_started').prop('checked', false);
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
                    <a class="w3-bar-item w3-button" href='sessions_insert_page.php'>انشاء جديد</a>
                    <a class="w3-bar-item w3-button" href='sessions_current_future.php'>الحالي/المستقبلي</a>
                    <a class="w3-bar-item w3-button" href='sessions_current_future.php'>الأرشيف</a>
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

        <!--Form-->
        <div class="w3-container w3-padding-64" id="contact">
            <div class="right-align-text">
                <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="sessions_edit_page_ctl.php" method="post">
                    <div class="w3-section">
                        <label>نص الجلسة</label>
                        <textarea rows="5" name="session_text" placeholder="نص الجلسة" class="w3-input w3-border right-dir right-align-text"><?php echo $row_session['session_text']; ?></textarea>
                    </div>
                    <div class="w3-section">
                        <label>التاريخ</label>
                        <input type="date" name="session_date" value="<?php echo $row_session['session_date']; ?>" class="w3-input w3-border right-dir right-align-text right-float">
                    </div>
                    <br>
                    <div class="w3-section">
                        <label>الوقت</label>
                        <input type="time" id="time" id="session_time" name="session_time" step="1" value="<?php echo $row_session['session_time']; ?>" class="w3-input w3-border right-dir right-align-text right-float">
                    </div>
                    <br>
                    <br>
                    <p style="font-weight: bold; text-decoration: underline">انعقاد الجلسة</p>
                    <div class="w3-section">
                        <label>عقدت</label>
                        <input type="checkbox" name="session_started" id="session_started" value="1" class="w3-check" <?php
                        if ($row_session['session_started'] == 1) {
                            echo 'checked';
                        }
                        ?>>
                    </div>
                    <div class="w3-section">
                        <label>فضت</label>
                        <input type="checkbox" name="session_terminated" id="session_terminated" value="1" class="w3-check" <?php
                        if ($row_session['session_terminated'] == 1) {
                            echo 'checked';
                        }
                        ?>>
                    </div>
                    <div class="w3-section">
                        <label>سبب فض الجلسة</label>
                        <textarea name="session_terminated_text" id="session_terminated_text" placeholder="سبب فض الجلسة" class="w3-input w3-border right-dir right-align-text"><?php echo $row_session['session_terminated_text']; ?></textarea>
                    </div>
                    <div class="w3-section">
                        <label>نشر على الشاشة</label>
                        <!--this to view the session on the screen-->
                        <input type="checkbox" name="session_status1" value="1" class="w3-check" <?php
                        if ($row_session['session_status'] == 1) {
                            echo 'checked';
                        }
                        ?>>
                    </div>
                    <input type="hidden" name="session_id" value="<?php echo $row_session['id']; ?>">
                    <button class="w3-button w3-right w3-theme" type="submit" name="submit">تعديل</button>
                </form>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
