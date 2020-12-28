<?php

if (isset($_POST['submit'])) {
    include_once 'include/check_session.php';
    include_once '../BLL/urgents.php';
    if (isset($_POST['urgent_status1'])) {
        $urgent_status1 = 1;
    } else {
        $urgent_status1 = 0;
    }
    $urgent = new urgents();
    $urgent->urgent_insert($_POST['urgent_text'], $_POST['urgent_date_start'], $_POST['urgent_date_end'], $_POST['urgent_time_end'], $urgent_status1, $_SESSION['user_id'], $_SESSION['directorate']);
    header('location: urgents_view_current_future.php');
    exit();
}