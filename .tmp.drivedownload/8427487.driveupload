<?php

//this file get all the entities (committees) that related to a specific 
//entities category.
//
//this var store the entities category id that provided by the url
$categoryId = filter_input(INPUT_GET, 'categoryId');

include_once '../BLL/committees.php';
$committees = new committees();
$committees_array = array();
//I'll check the categoryId, if it's 0 I'll get all the entities to be sent to 
//the mobile app to be saved in the local db, else I'll get the entities that 
//belong to a specific category.
if ($categoryId == 0) {
    $rs_committees = $committees->committees_get();
}
//here i get all the entities related to a specific entity category
else {
    $rs_committees = $committees->get_entities_specific_category($categoryId);
}
while ($row_committees = $rs_committees->fetch_assoc()) {
    array_push($committees_array, $row_committees);
}
echo json_encode($committees_array);
