<?php

//bellow is all the code related the push notification
//and i but it down here so i can get the variables from the form with conditions
//applied to it above, like the appointment time and event date.
//
//here i'll send notification with the event details
//bellow i'll select the committee name to send it with the notificaiton
include_once '../BLL/committees.php';
$committee = new committees();
$rs_committee = $committee->committee_get($_POST['committee']);
$row_committee = $rs_committee->fetch_assoc();
$committee_name = $row_committee['committee_name'];

//this api key for the firebase server, this api key has been taken from the firebase
//console to send push notification
//$registrationIds = ;
define('API_ACCESS_KEY'
        , 'AAAAysijQG4:APA91bEVna5UC6cvLu8zFogm5m2F0GMCgK7LQhyaUpPuS840I6nCKIeytCtlvssjB6Vhsahc1cVZBnhtR73ZYD0lsa8urcdoqwc8ssXmwY-hJdFZgkV9UYIjGgxPL9yACi7FWBP0LOTk');

//bellow i'll select all the device tokens in the db to send them notifications

$device_token = new device_token();
$rs_device_token = $device_token->get_all_device_token();
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

    $fields = array
        (
        'to' => $device_token,
        'data' => $data
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
