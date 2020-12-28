    <?php

include_once 'include/check_session.php';
include_once '../BLL/user_committee.php';
include_once '../BLL/users.php';

//bellow i want to check if the user has anything in the database before deletion, like events, session...etc, because if he has it's not allowed to delete him, because everything related to him after deletion will be hidden
//
//bellow i'll check the events for the user
include_once '../BLL/events.php';
$user_event = new events();
$rs_user_event = $user_event->get_events_user($_GET['userId'], $_GET['userId']);
//bellow i'll check the session for the user
include_once '../BLL/sessions.php';
$user_session = new sessions();
$rs_user_session = $user_session->get_sessions_user($_GET['userId'], $_GET['userId']);

//bellow i'll check if the user is admin and there is regular user belong to him, because in that case he can't be deleted, because if he deleted the users that belong to him won't be viewed and accessed
$user = new users();
$rs_user = $user->get_user($_GET['userId']); //here i'll get the user data to get his type
$row_user = $rs_user->fetch_assoc();
if ($row_user['user_type'] == 1) {//here i check if the user type is admin
    $rs_user = $user->get_all_users_regular_in_directorate($row_user['user_type'], $row_user['directorate']); //here i get all the regular users on the directorate of the admin

    if (($rs_user->num_rows == 0) && ($rs_user_event->num_rows == 0) && ($rs_user_session->num_rows == 0)) {//here if the result is true that means there is nothing in the database related to the user
        //create new user_committee class object to delete all the committess related
        //to that user
        $user_committee = new user_committee();
        $user_committee->user_committee_delete($_GET['userId']);

        //create new user class object to delete the user
        $user = new users();
        $user->delete_user($_GET['userId']);

        header('location:users.php');
        exit();
    } else {//this means that the user has users or events or session related to him, so i'll send error to the users page
        header('location:users.php?error=1');
        exit();
    }
} elseif ($row_user['user_type'] == 2) {//here if the user is regular user
    if (($rs_user_event->num_rows == 0) && ($rs_user_session->num_rows == 0)) {//here if the result is true that means there is nothing in the database related to the user
        //create new user_committee class object to delete all the committess related
        //to that user
        $user_committee = new user_committee();
        $user_committee->user_committee_delete($_GET['userId']);

        //create new user class object to delete the user
        $user = new users();
        $user->delete_user($_GET['userId']);

        header('location:users.php');
        exit();
    } else {//this means that the user has events or session related to him, so i'll send error to the users page
        header('location:users.php?error=1');
        exit();
    }
}

