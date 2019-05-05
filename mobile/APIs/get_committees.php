<?php

//this file get all the entities (committees) that related to a specific entities category.

//this var store the entities category that provided by the url
$category = $_GET['category'];

include_once '../BLL/committees.php';
$committees = new committees();
$committees_array = array();
//here i get all the entities related to a specific entity category
$rs_committees = $committees->get_entities_specific_category($category);
while ($row_committees = $rs_committees->fetch_assoc()) {
    array_push($committees_array, $row_committees);
}
echo json_encode($committees_array);
