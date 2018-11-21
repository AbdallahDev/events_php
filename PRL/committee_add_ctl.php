<?php

include_once 'include/check_session.php';
include_once '../BLL/committees.php';

$committee = new committees();
$committee->committee_add($_POST['committee_name'], $_POST['event_entity_category_id']);
header('location: committees.php?directorate=' . $_SESSION['directorate']);
exit();
