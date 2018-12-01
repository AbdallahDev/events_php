<?php

//this file get all the entity categories for the phone app.

include_once '../BLL/event_entity_category.php';
$categories = new event_entity_category();
$categories_array = array();
$rs_categories = $categories->get_categories();
while ($row_categories = $rs_categories->fetch_assoc()) {
    array_push($categories_array, $row_categories);
}
echo json_encode($categories_array);
