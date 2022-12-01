<?php

function init_b6_calender()
{
    global $date_actual_cell;
    global $date_first_cell;
    global $thisMonthLength;
    global $lastMonthLength;
    global $length_calender_table;
    $date_actual_cell = strtotime('now');
    $date_first_cell = strtotime('last Monday of previous month');
    $thisMonthLength = date('t', $date_actual_cell);
    $lastMonthLength = date('t', $date_first_cell);
    $length_calender_table = 42;
}

function set_b6_calender($days)
{
    global $date_actual_cell;
    global $date_first_cell;
    global $thisMonthLength;
    global $lastMonthLength;
    global $length_calender_table;
    $date_actual_cell = strtotime($days . ' days');
    $date_first_cell = strtotime('last Monday of previous month');
    $thisMonthLength = date('t', $date_actual_cell);
    $lastMonthLength = date('t', $date_first_cell);
    $length_calender_table = 42;
}
