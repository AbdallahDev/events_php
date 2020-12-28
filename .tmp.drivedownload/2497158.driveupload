<?php

include_once 'include/check_session.php';
include_once '../BLL/sessions.php';
$session_insert = new sessions();
$session_insert->session_delete($_GET['id']);
header('location: sessions_current_future.php');
exit();
