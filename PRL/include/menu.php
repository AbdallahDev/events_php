<?php
//this default date function to be included with the menu file
//in all the pages
date_default_timezone_set('Asia/Amman');

//create new user to get the user name from the DB and printed on the page
include_once '../BLL/users.php';
$user_user_menu = new users();
$rs_user_menu = $user_user_menu->get_user($_SESSION['user_id']);
$row_user_menu = $rs_user_menu->fetch_assoc();
//check if the user is superadmin to view the related main menu
if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 0)) {
    ?>
    <div>
        <!-- Navbar -->
        <div class="w3-top">
            <div class="w3-bar w3-theme-d2">
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                <a href="home.php" style="float: right" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>الرئيسية</a>
                <a href="events_show.php" target="_blank" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">شاشة النشاطات</a>
                <div class="w3-dropdown-hover w3-hide-small" style="float: right">
                    <button class="w3-button" title="الاعدادات" style="direction: rtl">الاعدادات <i class="fa fa-caret-down"></i></button>     
                    <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                        <a href="users.php" class="w3-bar-item w3-button">المستخدمون</a>
                        <a href="backgrounds.php" class="w3-bar-item w3-button">صور الخلفية</a>
                    </div>
                </div>
                <a href="logout_page.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تسجيل الخروج</a>
            </div>
            <!-- Navbar on small screens -->
            <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
                <a href="events_show.php" target="_blank" style="text-align: right" class="w3-bar-item w3-button">شاشة النشاطات</a>
                <a href="users.php" style="text-align: right" class="w3-bar-item w3-button">المستخدمون</a>
                <a href="backgrounds.php" style="text-align: right" class="w3-bar-item w3-button">صور الخلفية</a>
                <a href="committees.php?directorate=2" style="text-align: right" class="w3-bar-item w3-button">لجان شؤون التشريع</a>
                <a href="logout_page.php" style="text-align: right" class="w3-bar-item w3-button">تسجيل الخروج</a>
            </div>
        </div>
        <br>
        <br>
        <h2 style="text-align: center"><?php echo $row_user_menu['name'] ?></h2>
        <hr>
    </div>
    <?php
}
//here decide the main menu for all the users beside the superadmin
else {
    //check if the directorate is general secretary, directorate id is 1
    if (isset($_SESSION['directorate']) && ( $_SESSION['directorate'] == 1)) {
        //check if the user is admin
        if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 1)) {
            ?>
            <div>
                <!-- Navbar -->
                <div class="w3-top">
                    <div class="w3-bar w3-theme-d2">
                        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                        <a href="home.php" style="float: right" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>الرئيسية</a>
                        <a href="events_show.php" target="_blank" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">شاشة النشاطات</a>
                        <a href="urgents_view_current_future.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">العاجل</a>
                        <a href="users.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">المستخدمون</a>
                        <a href="logout_page.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تسجيل الخروج</a>
                    </div>
                    <!-- Navbar on small screens -->
                    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
                        <a href="events_show.php" target="_blank" style="text-align: right" class="w3-bar-item w3-button">شاشة النشاطات</a>
                        <a href="urgents_view_current_future.php" style="text-align: right" class="w3-bar-item w3-button">العاجل</a>
                        <a href="users.php" style="text-align: right" class="w3-bar-item w3-button">المستخدمون</a>
                        <a href="logout_page.php" style="text-align: right" class="w3-bar-item w3-button">تسجيل الخروج</a>
                    </div>
                </div>
                <br>
                <br>
                <h2 style="text-align: center"><?php echo $row_user_menu['name'] ?></h2>
                <hr>
            </div>
            <?php
        }
        //else for the regular user
        else {
            ?>
            <div>
                <!-- Navbar -->
                <div class="w3-top">
                    <div class="w3-bar w3-theme-d2">
                        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                        <a href="home.php" style="float: right" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>الرئيسية</a>
                        <a href="events_show.php" target="_blank" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">شاشة النشاطات</a>
                        <a href="urgents_view_current_future.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">العاجل</a>
                        <a href="users.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">معلومات المستخدم</a>
                        <a href="logout_page.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تسجيل الخروج</a>
                    </div>
                    <!-- Navbar on small screens -->
                    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
                        <a href="events_show.php" target="_blank" style="text-align: right" class="w3-bar-item w3-button">شاشة النشاطات</a>
                        <a href="urgents_view_current_future.php" style="text-align: right" class="w3-bar-item w3-button">العاجل</a>
                        <a href="users.php" style="text-align: right" class="w3-bar-item w3-button">معلومات المستخدم</a>
                        <a href="logout_page.php" style="text-align: right" class="w3-bar-item w3-button">تسجيل الخروج</a>
                    </div>
                </div>
                <br>
                <br>
                <h2 style="text-align: center"><?php echo $row_user_menu['name'] ?></h2>
                <hr>
            </div>
            <?php
        }
    }
    //check if the directorate is legislative affairs, directorate id is 2
    elseif (isset($_SESSION['directorate']) && ( $_SESSION['directorate'] == 2)) {
        //check if the user is admin
        if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 1)) {
            ?>
            <div>
                <!-- Navbar -->
                <div class="w3-top">
                    <div class="w3-bar w3-theme-d2">
                        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                        <a href="home.php" style="float: right" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>الرئيسية</a>
                        <a href="events_show.php" target="_blank" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">شاشة النشاطات</a>
                        <div class="w3-dropdown-hover w3-hide-small" style="float: right">
                            <button class="w3-button" title="النشاطات" style="direction: rtl">النشاطات <i class="fa fa-caret-down"></i></button>     
                            <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                                <a href="events_preview_current_future.php" class="w3-bar-item w3-button">نشاطات اللجان</a>
                                <a href="sessions_current_future.php" class="w3-bar-item w3-button">الجلسات</a>
                            </div>
                        </div>
                        <a href="committees.php?directorate=2" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">جهات النشاطات</a>
                        <a href="users.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">المستخدمون</a>
                        <a href="logout_page.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تسجيل الخروج</a>
                    </div>
                    <!-- Navbar on small screens -->
                    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
                        <a href="events_show.php" target="_blank" style="text-align: right" class="w3-bar-item w3-button">شاشة النشاطات</a>
                        <a href="events_preview_current_future.php" style="text-align: right" class="w3-bar-item w3-button">نشاطات اللجان</a>
                        <a href="sessions_current_future.php" style="text-align: right" class="w3-bar-item w3-button">الجلسات</a>
                        <a href="committees.php?directorate=2" style="text-align: right" class="w3-bar-item w3-button">جهات النشاطات</a>
                        <a href="users.php" style="text-align: right" class="w3-bar-item w3-button">المستخدمون</a>
                        <a href="logout_page.php" style="text-align: right" class="w3-bar-item w3-button">تسجيل الخروج</a>
                    </div>
                </div>
                <br>
                <br>
                <h2 style="text-align: center"><?php echo $row_user_menu['name'] ?></h2>
                <hr>
            </div>
            <?php
        }
        //else for the regular user of the legislative affairs directorate with id 2
        else {
            //check if the department is committees with id 1 in the legislative affairs directorate with id 2 to decide the amin menu contents
            if (isset($_SESSION['department']) && ( $_SESSION['department'] == 1)) {
                ?>
                <div>
                    <!-- Navbar -->
                    <div class="w3-top">
                        <div class="w3-bar w3-theme-d2">
                            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                            <a href="home.php" style="float: right" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>الرئيسية</a>
                            <a href="events_show.php" target="_blank" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">شاشة النشاطات</a>
                            <a href="events_preview_current_future.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">النشاطات</a>
                            <a href="users.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">معلومات المستخدم</a>
                            <a href="table_live_design_view.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تصميم الجدول</a>
                            <a href="logout_page.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تسجيل الخروج</a>
                        </div>
                        <!-- Navbar on small screens -->
                        <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
                            <a href="events_show.php" target="_blank" style="text-align: right" class="w3-bar-item w3-button">شاشة النشاطات</a>
                            <a href="events_preview_current_future.php" style="text-align: right" class="w3-bar-item w3-button">النشاطات</a>
                            <a href="users.php" style="text-align: right" class="w3-bar-item w3-button">معلومات المستخدم</a>
                            <a href="table_live_design_view.php" style="text-align: right" class="w3-bar-item w3-button">تصميم الجدول</a>
                            <a href="logout_page.php" style="text-align: right" class="w3-bar-item w3-button">تسجيل الخروج</a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <h2 style="text-align: center"><?php echo $row_user_menu['name'] ?></h2>
                    <hr>
                </div>
                <?php
            }
            //check if the department is sessions with id 2 in the legislative affairs directorate with id 2 to decide the main menu contents
            elseif (isset($_SESSION['department']) && ( $_SESSION['department'] == 2)) {
                ?>
                <div>
                    <!-- Navbar -->
                    <div class="w3-top">
                        <div class="w3-bar w3-theme-d2">
                            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                            <a href="home.php" style="float: right" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>الرئيسية</a>
                            <a href="events_show.php" target="_blank" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">شاشة النشاطات</a>
                            <a href="sessions_current_future.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">الجلسات</a>
                            <a href="users.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">معلومات المستخدم</a>
                            <a href="logout_page.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تسجيل الخروج</a>
                        </div>
                        <!-- Navbar on small screens -->
                        <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
                            <a href="events_show.php" target="_blank" style="text-align: right" class="w3-bar-item w3-button">شاشة النشاطات</a>
                            <a href="sessions_current_future.php" style="text-align: right" class="w3-bar-item w3-button">الجلسات</a>
                            <a href="users.php" style="text-align: right" class="w3-bar-item w3-button">معلومات المستخدم</a>
                            <a href="logout_page.php" style="text-align: right" class="w3-bar-item w3-button">تسجيل الخروج</a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <h2 style="text-align: center"><?php echo $row_user_menu['name'] ?></h2>
                    <hr>
                </div>
                <?php
            }
        }
    }
    //here check if the directorate session set and it's for the public relations directorate with the value 3
    elseif (isset($_SESSION['directorate']) && ( $_SESSION['directorate'] == 3)) {
        //check if the user is admin the public relations directorate
        if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 1)) {
            ?>
            <div>
                <!-- Navbar -->
                <div class="w3-top">
                    <div class="w3-bar w3-theme-d2">
                        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                        <a href="home.php" style="float: right" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>الرئيسية</a>
                        <a href="events_show.php" target="_blank" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">شاشة النشاطات</a>
                        <div class="w3-dropdown-hover w3-hide-small" style="float: right">
                            <button class="w3-button" title="النشاطات" style="direction: rtl">النشاطات <i class="fa fa-caret-down"></i></button>     
                            <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                                <a href="events_preview_current_future.php" class="w3-bar-item w3-button">نشاطات اللجان</a>
                                <a href="urgents_view_current_future.php" class="w3-bar-item w3-button">العاجل</a>
                            </div>
                        </div>
                        <a href="users.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">المستخدمون</a>
                        <a href="logout_page.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تسجيل الخروج</a>
                    </div>
                    <!-- Navbar on small screens -->
                    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
                        <a href="events_show.php" target="_blank" style="text-align: right" class="w3-bar-item w3-button">شاشة النشاطات</a>
                        <a href="events_preview_current_future.php" style="text-align: right" class="w3-bar-item w3-button">نشاطات اللجان</a>
                        <a href="urgents_view_current_future.php" style="text-align: right" class="w3-bar-item w3-button">العاجل</a>
                        <a href="users.php" style="text-align: right" class="w3-bar-item w3-button">المستخدمون</a>
                        <a href="logout_page.php" style="text-align: right" class="w3-bar-item w3-button">تسجيل الخروج</a>
                    </div>
                </div>
                <br>
                <br>
                <h2 style="text-align: center"><?php echo $row_user_menu['name'] ?></h2>
                <hr>
            </div>
            <?php
        }
        //else for the regular user
        else {
            ?>
            <div>
                <!-- Navbar -->
                <div class="w3-top">
                    <div class="w3-bar w3-theme-d2">
                        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                        <a href="home.php" style="float: right" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>الرئيسية</a>
                        <a href="events_show.php" target="_blank" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">شاشة النشاطات</a>
                        <div class="w3-dropdown-hover w3-hide-small" style="float: right">
                            <button class="w3-button" title="النشاطات" style="direction: rtl">النشاطات <i class="fa fa-caret-down"></i></button>     
                            <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                                <a href="events_preview_current_future.php" class="w3-bar-item w3-button">نشاطات اللجان</a>
                                <a href="urgents_view_current_future.php" class="w3-bar-item w3-button">العاجل</a>
                            </div>
                        </div>
                        <a href="committees.php?directorate=3" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">اللجان الدبلوماسية</a>
                        <a href="users.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">معلومات المستخدم</a>
                        <a href="logout_page.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تسجيل الخروج</a>
                    </div>
                    <!-- Navbar on small screens -->
                    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
                        <a href="events_show.php" target="_blank" style="text-align: right" class="w3-bar-item w3-button">شاشة النشاطات</a>
                        <a href="events_preview_current_future.php" style="text-align: right" class="w3-bar-item w3-button">نشاطات اللجان</a>
                        <a href="urgents_view_current_future.php" style="text-align: right" class="w3-bar-item w3-button">العاجل</a>
                        <a href="committees.php?directorate=3" style="text-align: right" class="w3-bar-item w3-button">اللجان الدبلوماسية</a>
                        <a href="users.php" style="text-align: right" class="w3-bar-item w3-button">معلومات المستخدم</a>
                        <a href="logout_page.php" style="text-align: right" class="w3-bar-item w3-button">تسجيل الخروج</a>
                    </div>
                </div>
                <br>
                <br>
                <h2 style="text-align: center"><?php echo $row_user_menu['name'] ?></h2>
                <hr>
            </div>
            <?php
        }
    }
    //check if the directorate is blocs with the value 4
    elseif (isset($_SESSION['directorate']) && ( $_SESSION['directorate'] == 4)) {
        //check if the user is admin
        if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 1)) {
            ?>
            <div>
                <!-- Navbar -->
                <div class="w3-top">
                    <div class="w3-bar w3-theme-d2">
                        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                        <a href="home.php" style="float: right" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>الرئيسية</a>
                        <a href="events_show.php" target="_blank" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">شاشة النشاطات</a>
                        <div class="w3-dropdown-hover w3-hide-small" style="float: right">
                            <button class="w3-button" title="النشاطات" style="direction: rtl">النشاطات <i class="fa fa-caret-down"></i></button>     
                            <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                                <a href="events_preview_current_future.php" class="w3-bar-item w3-button">نشاطات الكتل</a>
                                <a href="urgents_view_current_future.php" class="w3-bar-item w3-button">العاجل</a>
                            </div>
                        </div>
                        <a href="users.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">المستخدمون</a>
                        <a href="logout_page.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تسجيل الخروج</a>
                    </div>
                    <!-- Navbar on small screens -->
                    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
                        <a href="events_show.php" target="_blank" style="text-align: right" class="w3-bar-item w3-button">شاشة النشاطات</a>
                        <a href="events_preview_current_future.php" style="text-align: right" class="w3-bar-item w3-button">نشاطات الكتل</a>
                        <a href="urgents_view_current_future.php" style="text-align: right" class="w3-bar-item w3-button">العاجل</a>
                        <a href="users.php" style="text-align: right" class="w3-bar-item w3-button">المستخدمون</a>
                        <a href="logout_page.php" style="text-align: right" class="w3-bar-item w3-button">تسجيل الخروج</a>
                    </div>
                </div>
                <br>
                <br>
                <h2 style="text-align: center"><?php echo $row_user_menu['name'] ?></h2>
                <hr>
            </div>
            <?php
        }
        //else for the regular user
        else {
            ?>
            <div>
                <!-- Navbar -->
                <div class="w3-top">
                    <div class="w3-bar w3-theme-d2">
                        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                        <a href="home.php" style="float: right" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>الرئيسية</a>
                        <a href="events_show.php" target="_blank" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">شاشة النشاطات</a>
                        <div class="w3-dropdown-hover w3-hide-small" style="float: right">
                            <button class="w3-button" title="النشاطات" style="direction: rtl">النشاطات <i class="fa fa-caret-down"></i></button>     
                            <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                                <a href="events_preview_current_future.php" class="w3-bar-item w3-button">نشاطات الكتل</a>
                                <a href="urgents_view_current_future.php" class="w3-bar-item w3-button">العاجل</a>
                            </div>
                        </div>
                        <a href="committees.php?directorate=4" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">الكتل والائتلافات</a>
                        <a href="users.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">معلومات المستخدم</a>
                        <a href="logout_page.php" style="float: right" class="w3-bar-item w3-button w3-hide-small w3-hover-white">تسجيل الخروج</a>
                    </div>
                    <!-- Navbar on small screens -->
                    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
                        <a href="events_show.php" target="_blank" style="text-align: right" class="w3-bar-item w3-button">شاشة النشاطات</a>
                        <a href="events_preview_current_future.php" style="text-align: right" class="w3-bar-item w3-button">نشاطات الكتل</a>
                        <a href="committees.php?directorate=4" style="text-align: right" class="w3-bar-item w3-button">الكتل والائتلافات</a>
                        <a href="urgents_view_current_future.php" style="text-align: right" class="w3-bar-item w3-button">العاجل</a>
                        <a href="users.php" style="text-align: right" class="w3-bar-item w3-button">معلومات المستخدم</a>
                        <a href="logout_page.php" style="text-align: right" class="w3-bar-item w3-button">تسجيل الخروج</a>
                    </div>
                </div>
                <br>
                <br>
                <h2 style="text-align: center"><?php echo $row_user_menu['name'] ?></h2>
                <hr>
            </div>
            <?php
        }
    }
}
?>
        