<?php

if (isset($_POST['submit'])) {
    include_once 'include/check_session.php';
    include_once '../BLL/table_live_design.php';
    $table_live_design = new table_live_design();
    if (isset($_POST['table_live_design_status1'])) {
        $table_live_design_status = 1;
        $table_live_design->table_live_design_enabled_status_zero($table_live_design_status); //here i call the function that will disable the last enabled design by setting it's status to zero, to make the user able to apply a new design
    } else {
        $table_live_design_status = 0;
    }
    $table_live_design->table_live_design_edit($_POST['table_live_design_font_size'], $_POST['table_live_design_event_entity_column_width'], $_POST['table_live_design_event_time_column_width'], $_POST['table_live_design_event_place_column_width'], $_POST['table_live_design_event_subject_column_width'], $table_live_design_status, $_POST['table_live_design_id']);
    header('location: table_live_design_view.php');
    exit();
}