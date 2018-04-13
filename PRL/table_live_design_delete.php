<?php

include_once 'include/check_session.php';
include_once '../BLL/table_live_design.php';
$table_live_design = new table_live_design();
$table_live_design->table_live_design_delete($_GET['id']);
header('location: table_live_design_view.php');
exit();
