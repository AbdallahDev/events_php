<?php

include_once 'include/check_session.php';
include_once '../BLL/users.php';
include_once '../BLL/user_committee.php';

//check if the user is super admin
if ($_SESSION['user_type'] == 0) {
    $directorate = $_POST['directorate'];
    $department = 0;
    $user_type = 1;
} else {
    $directorate = $_SESSION['directorate'];
    $department = $_POST['department'];
    $user_type = 2;
}

//create new user object from the class to add the new user
$user = new users();
//adding new user
$user->add_user($_POST['name'], $_POST['userid'], sha1($_POST['password']), $user_type, $directorate, $department);

//create new user_committee object to add the committees for the user
$user_committee = new user_committee();
if (isset($_POST['committee'])) {
    foreach ($_POST['committee'] as $committee_id) {
        $user_committee->user_committee_insert($_POST['userid'], $committee_id);
    }
}

header('location: users.php');
exit();
