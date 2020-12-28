<?php

session_start();
include '../BLL/users.php';
$user = new users();
$result = $user->check_user_login($_POST['user_id'], sha1($_POST['password']));
if ($result == 1) {
    $result = $user->get_user($_POST['user_id']);
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['user_type'] = $row['user_type'];
    $_SESSION['directorate'] = $row['directorate'];
    $_SESSION['department'] = $row['department'];
    header('location: events_preview_current_future.php');
    exit();
} else {
    header('location: login_page.php?error=1');
    exit();
}
