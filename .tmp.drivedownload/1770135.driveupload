<?php

include_once '../Bll/user_committee.php';
$user_committee = new user_committee();
$rs_user_committee = $user_committee->user_committees_get($_SESSION['user_id']);

while ($row_user_committee = $rs_user_committee->fetch_assoc()) {
    echo '<option value="' . $row_user_committee['committee_id'] . '">'
    . $row_user_committee['committee_name']
    . '</option><br>';
}