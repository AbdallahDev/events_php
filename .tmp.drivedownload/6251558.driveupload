<?php

include '../BLL/backgrounds.php';
$background = new backgrounds();
if (isset($_POST['background_status1'])) {
    $background->background_all_status(0);
    $background_status1 = 1;
} else {
    $background_status1 = 0;
}
$background->background_edit($background_status1, $_POST['background_id']);
header("location: backgrounds.php");
