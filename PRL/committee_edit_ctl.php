<?php

//this file to edit the event entity, and it's called committee_edit_ctl coz 
//it's still with the old name, and i'll try to change it in the future
include_once 'include/check_session.php';
include '../BLL/committees.php';
$committee = new committees();
$committee->committee_edit($_POST['committee_name'], $_POST['event_entity_category_id'], $_POST['committee_id']);
header('location: committees.php?directorate=' . $_SESSION['directorate']);
exit();
