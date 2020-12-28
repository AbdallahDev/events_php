<?php

include_once 'include/check_session.php';
include_once '../BLL/users.php'; //here i include this file to be able to update the users data with the editing
include_once '../BLL/user_committee.php'; //here i include this file to be able to insert committees for the edited user, if he has ones
//create user object
$user = new users();

//bellow i'll check if the user tries to edit himself or other user.
if (isset($_POST['user_id']) && ($_POST['user_id'] == $_SESSION['user_id'])) {//here i check if the user id sent from the form is equal to user id in the session
    $user->update_user_edit_himself($_POST['name'], $_POST['user_id']); //here i'll update just the user name, because if the user tries to edit himself he will just be able to edit the name and the password
} else {//here if the sueperadmin or the admin who tries to edit other user
    if ($_SESSION['user_type'] == 0) {//here i check if the superadmin who is the one who making the editing
        //bellow i'll check if the user that being edited has any regular users belong to him, because in that case he can't be edited by changing his directorate, because if his directorate changed the users that belong to him won't be viewed and accessed
        //bellow i'll check if the user directorate has changed
        $user = new users();
        $rs_user = $user->get_user($_POST['user_id']); //here i'll get the user data to get his directorate
        $row_user = $rs_user->fetch_assoc();
        if ($row_user['directorate'] == $_POST['directorate']) {//here i check if the directorate hasn't changed
            $department = 0; //here i set the department as 0, because all the edited users here will be admins and they don't belong to any department
            $user->update_user($_POST['name'], $_POST['user_id'], $_POST['user_type'], $_POST['user_id'], $_POST['directorate'], $department);
        } else { //here i redirecte to the users page with error, because the user can't be edited
            header("location:users.php?error=2");
            exit();
        }
    } elseif ($_SESSION['user_type'] == 1) {//here i check if the user type is admin with value 1, to set the directorate and the department of each edited user
        if ($_SESSION['directorate'] == 2) {//here i check if the user type is admin and belongs to the legislative affairs directorate, so i need here to set the department and the committes if the user has ones
            //bellow i'll check if the user department has changed
            $user = new users();
            $rs_user = $user->get_user($_POST['user_id']); //here i'll get the user data to get his department
            $row_user = $rs_user->fetch_assoc();
            if ($row_user['department'] != $_POST['department']) {//here i check if the user department is not the same as new choosed one after the editing, because if they are not the same i'll check if he has events or session, because it can't be changed in that case
                //bellow i'll check if the user has events or session relate to him, because his department can't be changed in that case, because all the events or the session belong to him will disappear and can't be accessed
                //                
                //bellow i'll check if the user has events
                include_once '../BLL/events.php';
                $user_event = new events();
                $rs_user_event = $user_event->get_events_user($_POST['user_id'], $_POST['user_id']);
                //bellow i'll check if the user has sessions
                include_once '../BLL/sessions.php';
                $user_session = new sessions();
                $rs_user_session = $user_session->get_sessions_user($_POST['user_id'], $_POST['user_id']);
                if ($rs_user_event->num_rows == 0 && $rs_user_session->num_rows == 0) {//here i check if their isn't events or sessions related to the user
                    $user->update_user($_POST['name'], $_POST['user_id'], $_POST['user_type'], $_POST['user_id'], $_SESSION['directorate'], $_POST['department']); //here i update the user with posted department id
                } else { //here i redirecte to the users page with error, because the user can't be edited
                    header("location:users.php?error=2");
                    exit();
                }
            } else { //here i allow to edit the user because his department has not changed
                $user->update_user($_POST['name'], $_POST['user_id'], $_POST['user_type'], $_POST['user_id'], $_SESSION['directorate'], $_POST['department']); //here i update the user with posted department id
            }
        } else {//here if the edited user dosen't belong to the legislative affairs directorate, so he won't belong to any department
            $department = 0; //here i set the department as 0, because all the edited users here belongs to directorates that don't have departments
            $user->update_user($_POST['name'], $_POST['user_id'], $_POST['user_type'], $_POST['user_id'], $_SESSION['directorate'], $department); //the directorate here will be the same as the one in the session, because the edited user will be blonging to the same one that the admin belongs to
        }
    }
}

if (!empty($_POST['committee'])) {//here i check if the edited user has committees
    $user_committee = new user_committee();
    $user_committee->user_committee_delete($_POST['user_id']); //here i make sure to delete all the committees that the user had before a new ones added, because maybe on of the old committees that the user has has been deselected this time so i neeed to remove it
    foreach ($_POST['committee'] as $committee_id) {//here i add the committees that has been choosen for the user
        $user_committee->user_committee_insert($_POST['user_id'], $committee_id);
    }
}

if (isset($_POST['department']) && $_POST['department'] == 2) {//here i'll delete all the committees related to the user if he changed the department to sessions
    $user_committee = new user_committee();
    $user_committee->user_committee_delete($_POST['user_id']); //here i make sure to delete all the committees that the user had because now he belongs to sessions department
}

if (isset($_POST['password']) && !empty(trim($_POST['password']))) {//here i check if the password is  set, and didn't lef with just spaces, so i can updated in the database, and that for all the users even if they updated for themselfs or for others
    $user->update_user_password(sha1($_POST['password']), $_POST['user_id']);
}

header("location:users.php");
exit();
