<?php

include_once 'include/check_session.php';
include_once '../BLL/urgents.php';
$urgent = new urgents();
$urgent->urgent_delete($_GET['id']);
header('location: urgents_view_current_future.php');
exit();
