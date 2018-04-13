<?php

include_once 'include/check_session.php';
include '../BLL/committees.php';
$committee = new committees();
$committee->committee_edit($_POST['committee_name'], $_POST['committee_id']);
header('location: committees.php?directorate=' . $_SESSION['directorate']);
exit();
