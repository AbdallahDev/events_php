<?php

include_once 'include/check_session.php';
include_once '../BLL/backgrounds.php';
$background = new backgrounds();
$rs_background = $background->background_get($_GET['id']);
$row_background = $rs_background->fetch_assoc();
unlink($row_background['background_path']);
$background->background_delete($_GET['id']);
header('location: backgrounds.php?path=' . $row_background['background_path']);
exit();
