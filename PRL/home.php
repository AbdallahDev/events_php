<?php
include_once 'include/check_session.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>الرئيسية</title>
        <!--header file inclusion-->
        <?php include_once 'include/header.php'; ?>
    </head>
    <body id="myPage">
        <!--top navbar inclusion-->
        <?php include_once 'include/menu.php'; ?>
        
        <div class="w3-container w3-padding-64 w3-center">
            <?php
            //check if the user is superadmin to view the related text in the home page
            if (isset($_SESSION['user_type']) && ( $_SESSION['user_type'] == 0)) {
                ?>
                <h1>شاشة مدير النظام</h1>
                <?php
            }
            //هنا يتم اظهار كلمة (شاشة مشرف النظام ) في حال كان المستخدم مدير
            elseif (isset($_SESSION['user_type']) && ( $_SESSION['user_type'] == 1)) {
                ?>
                <h1 style = "text-align: center">شاشة مشرف النظام</h1>
                <?php
            }
            //هنا يتم اظهار كلمة (نظام النشاطات) في حال كان المستخدم مستخدم عادي
            else {
                ?>
                <h1 style = "text-align: center">نظام نشاطات المجلس</h1>
                <?php
            }
            ?>
        </div>
        
        <!--footer inclusion-->
        <?php include_once 'include/footer.php'; ?>
    </body>
</html>
