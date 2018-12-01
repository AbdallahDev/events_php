<?php

include_once '../BLL/committees.php';
$committees = new committees();
$committees_array = array();
$rs_committees = $committees->committees_get();
while ($row_committees = $rs_committees->fetch_assoc()) {
    array_push($committees_array, $row_committees);
}
echo json_encode($committees_array);
