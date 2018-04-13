<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>تسجيل الدخول</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                var error = <?php echo $_GET['error']; ?>;
                if (error == 1) {
                    $('#error').html('اما رقم المستخدم او كلمة المرور خطأ');
                }
            });
        </script>
    </head>
    <body id="myPage">
        <div class="w3-container w3-padding-64 w3-center">
            <h1>تسجيل الدخول</h1>
        </div>
        <h4 id="error" style="color: red; text-align: center" dir="rtl"></h4>
        
        <!-- Form Container -->
        <div class="w3-container w3-padding-64" id="contact">
            <div class="right-align-text">
                <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="login_page_ctl.php" method="post">
                    <input type="hidden" id="user_type" 
                           value="<?php echo $_SESSION['type'] ?>">
                    <div class="w3-section">
                        <label>رقم المستخدم</label>
                        <input class="w3-input right-align-text right-dir" type="number" name="user_id" required>
                    </div>
                    <div class="w3-section">      
                        <label>كلمة المرور</label>
                        <input class="w3-input right-align-text right-dir" type="password" name="password" required>
                    </div>
                    <button type="submit" name="submit" class="w3-button w3-right w3-theme">دخول</button>
                </form>
            </div>
        </div>

        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
