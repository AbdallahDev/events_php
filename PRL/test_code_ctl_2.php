<?php

include_once 'include/check_session.php';
include_once '../BLL/committees.php';

$array1 = array();
$event_entities = new committees();
$rs = $event_entities->event_entities_category_all_get($_POST['id']);
while ($row = $rs->fetch_assoc()) {
    array_push($array1, $row);
}
echo json_encode($array1);
