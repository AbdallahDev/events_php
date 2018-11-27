<?php
include_once 'include/check_session.php';
include '../BLL/events.php';
$event = new events();
$event->delete_event($_GET['id']);
header('location: events_preview_current_future.php');
exit();