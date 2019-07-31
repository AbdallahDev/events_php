<?php

//bellow is all the code related the push notification
//and i but it down here so i can get the variables from the form with conditions
//applied to it above, like the appointment time and event date.
//
//here i'll send notification with the event details
//
//bellow i'll check if the user choosed the entity name from the event entity 
//dropdwon menu or typed it the event entity textbox
if (empty(trim($event_entity_name))) {
    //this means here that the user choosed the event entity name from the 
    //dropdown menu, coz the $event_entity_name variable value is empty, 
    //that means the value in the event entity textbox is empty.
    //
    //bellow i'll select the committee name to send it with the notificaiton
    include_once '../BLL/committees.php';
    $committee = new committees();
    $rs_committee = $committee->committee_get($_POST['committee']);
    $row_committee = $rs_committee->fetch_assoc();
    $committee_name = $row_committee['committee_name'];
} else {
    //this means here that the user typed the event entity name in the 
    //event entity textbox.
    $committee_name = $event_entity_name;
}

//this api key for the firebase server, this api key has been taken from the firebase
//console to send push notification
//$registrationIds = ;
define('API_ACCESS_KEY'
        , 'AAAAU17sMTY:APA91bEN1tQzD7EFvVt-np4eBDJ_-vh6k_uGsKtr4aPBAHuaoBKblywO-BjlhA_2xuShgbx8s6ARgrexac5lxuEjfl33I823nhtT7vTDXjbm_zSsQP2Pp8Gcs_5XnOBuf4zNQ3DLAN_Q');

//bellow i'll select all the device tokens in the db to send them notifications

$device_token = new device_token();
$rs_device_token = $device_token->get_all_device_token();
//This array declaration is to store the devices tokens to send them at once to 
//the FCM sending function, instead of sending each token alone.
$registration_ids = array();
//Below I'll loop over the device tokens to store them in the registration_ids 
//array.
while ($row_device_token = $rs_device_token->fetch_assoc()) {
    //this variable to store all the needed information for the notification
    //like the event title, subject, date and time.
    $notification_title = $committee_name;
    $notification_subject = $_POST['subject'];
    $notification_date = $_POST['event_date'];
    //this variable event time declared in the events_insert.php file
    $notification_time = $event_time;
    $device_token = $row_device_token['device_token'];

    send_notification($notification_title, $notification_subject
            , $notification_date, $notification_time, $device_token);
}

//this function to send the push notification
function send_notification($notification_title, $notification_subject
, $notification_date, $notification_time, $device_token) {
    //this data represents the data that will be sent to user when the firebase
    //notification sent
    $data = array(
        'title' => $notification_title,
        'body' => $notification_subject,
        'date' => $notification_date,
        'time' => $notification_time
    );

    //I'll send this notification with the message because if the mobile app is 
    //terminated the data will be lost, so, in that case, I'll show this message.
    $notification = array(
        'title' => $notification_title,
        'body' => $notification_subject,
        'sound' => 'default'
    );

    $fields = array
        (
        'to' => $device_token,
        'data' => $data,
        'notification' => $notification
    );

    $headers = array
        (
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );

#Send Reponse To FireBase Server	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    echo $result;
    curl_close($ch);
}
