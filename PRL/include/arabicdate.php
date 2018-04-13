<?php

function ArabicDate() {
    $months = array("Jan" => "1", "Feb" => "2", "Mar" => "3", "Apr" => "4", "May" => "5", "Jun" => "6", "Jul" => "7", "Aug" => "8", "Sep" => "9", "Oct" => "10", "Nov" => "11", "Dec" => "12");
    $your_date = date('y-m-d'); // The Current Date
    $en_month = date("M", strtotime($your_date));
    foreach ($months as $en => $ar) {
        if ($en == $en_month) {
            $ar_month = $ar;
        }
    }

    $find = array("Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri");
    $replace = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
    $ar_day_format = date('D'); // The Current Day
    $ar_day = str_replace($find, $replace, $ar_day_format);

    header('Content-Type: text/html; charset=utf-8');
    $standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $eastern_arabic_symbols = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");
    $current_date = $ar_day . ' ' . date('d') . ' / ' . $ar_month . ' / ' . date('Y');
    $arabic_date = str_replace($standard, $eastern_arabic_symbols, $current_date);

    return $arabic_date;
}
