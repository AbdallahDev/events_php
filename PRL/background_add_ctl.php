<?php

if (isset($_POST['submit'])) {
    include '../BLL/backgrounds.php';
    $background = new backgrounds();
    if (isset($_POST['background_status1'])) {
        $background->background_all_status(0);
        $background_status1 = 1;
    } else {
        $background_status1 = 0;
    }
    if (isset($_FILES["background_path"]["name"])) {
        $background_path = "../imgs/backgrounds/" . basename($_FILES["background_path"]["name"]);
        move_uploaded_file($_FILES["background_path"]["tmp_name"], $background_path);
        $background = new backgrounds();
        $background->background_insert($background_path, $background_status1);
    }
    header("Location: backgrounds.php");
} 