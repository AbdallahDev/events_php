<?php

session_start();
date_default_timezone_set('Asia/Amman');
setlocale(LC_ALL, 'ar_AE.utf8');

if (!isset($_SESSION['user_id'])) {
    header('location: login_page.php');
    exit();
}