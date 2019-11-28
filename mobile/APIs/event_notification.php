<?php

//This file will be continuous for the events_insert.php file because it's 
//included there.
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
        , 'AAAAeotQvx8:APA91bF0Llvsw2XqmQ4IW-HJMEEgVriiBO2qbKIsrdZt2EKN2Lq66Vec2V9faJi89gQkoN4FBd6_jynTc3vPm8TFrYcW_NhopsDBFJvbkcuWv16G2-hj2_Nsa-qrof0FmShfYN1A9L79');

//Below I'll select all the devices data from the DB to send them notifications.
//
include_once '../mobile/BLL/device_token.php';
$devices_data = new device_token();
$rs_devices_data = $devices_data->get_all_device_token();
//This array instance is to store the devices tokens that don't have ios to 
//send them at once to the FCM sending function, instead of sending 
//a notification to each one separately.
$android_tokens = array();
//This array instance used to store the device's data that have ios to send 
//them FCM notification and to increase the app badge.
$ios_data = array();
//Below I'll loop over the device's data to store them in the two different 
//arrays ($android_tokens, $ios_data) based if the data belong to a device has 
//ios or not.
while ($row_devices_data = $rs_devices_data->fetch_assoc()) {
    //Here I'll check if the row belongs to a device that has ios, to store its 
    //data in the array $ios_data.
    if ($row_devices_data['device_is_ios'] == 1) {
        
    }
}

//These variables are to store all the needed information for the notification
//like the event title, subject, date and time.
$notification_title = $committee_name;
$notification_subject = $_POST['subject'];
$notification_date = $_POST['event_date'];
//This is the 'event time' variable that declared in the events_insert.php file 
//to store the time when the event will be held.
$notification_time = $event_time;

//Here I'll call the function that will send the FCM notification to the mobile 
//devices.
send_notification($notification_title, $notification_subject
        , $notification_date, $notification_time, $android_tokens);

//this function to send the push notification
function send_notification($notification_title, $notification_subject
, $notification_date, $notification_time, $registration_ids) {
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
        'sound' => 'default',
        'badge' => 1,
    );

    //This field is to set the "time_to_live" for the FCM message, that 
    //specifies for how long the message will be alive before it disappears 
    //because some times the devices will be offline or turned off.
    $android = array(
        //Here I'll set time to 36 hours (129600 seconds) before the message dies.
        'ttl' => "129600");

    $fields = array
        (
        //Below I've sat the registration ids array for the 'to' field, so I can 
        //send the FCM messages to multiple devices at once.
        'registration_ids' => $registration_ids,
        'data' => $data,
        'notification' => $notification,
        'android' => $android
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
