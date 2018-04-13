<?php

include_once '../BLL/halls.php';
$hall = new halls();
$rs_hall = $hall->halls_get_all();
while ($row_hall = $rs_hall->fetch_assoc()) {
    echo '<option value="' . $row_hall['hall_id']
    . '">' . $row_hall['hall_name']
    . '</option><br>';
}