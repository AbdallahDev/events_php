<?php
include_once '../BLL/urgents.php';
date_default_timezone_set('Asia/Amman');
$urgent = new urgents();
$rs_urgent = $urgent->urgent_get_live();
while ($row_urgent = $rs_urgent->fetch_assoc()) {
    if ($row_urgent['urgent_date_end'] >= date('Y-m-d')) {//here i check if the end date of the urgent is greater than or equal to the current date, because i can't view any urgent that has an end date less than the current date, because that means it has finished
        if ($row_urgent['urgent_date_start'] <= date('Y-m-d')) {//here i check if the start date of the urgent is less than or equal to the current date, because i can't view any urgent that has a start date greater than the current date, because that means it hasn't started yet
            if ($row_urgent['urgent_date_end'] >= date('Y-m-d') and $row_urgent['urgent_time_end'] >= date('H:i')) {//here i check if the end date of the urgent is less than the current date and at the same time it's end time is less than the current time, because when the end date become equal to the current date and at the same time it's end time become also greater than the current time on that date, that means the urgent has finished and i should hide it
                ?>
                <span style = "margin-left: 3%;" dir="rtl"><?PHP echo $row_urgent['urgent_text'] ?></span>&nbsp;*
                <?php
            }
        }
    }
}
