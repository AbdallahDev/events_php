<?php
include_once 'include/check_session.php';
include_once '../BLL/events.php';
$event = new events();
$rs = $event->get_events();
