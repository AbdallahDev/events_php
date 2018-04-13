<?php

include_once 'include/check_session.php';
include '../BLL/committees.php';
$committee = new committees();
$committee->committee_delete($_GET['committee_id']);
header('location: committees.php?directorate=' . $_SESSION['directorate']);
exit();
