<?php
function get_time_slot($length, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $begin_time = $start->format('H:i'); // Get time Format in Hour and minutes
    $finish_time = $end->format('H:i');
    $i = 0;

    while ($begin_time < $finish_time) {
        $start = $begin_time;
        $end = date('H:i', strtotime('+' . $length . ' minutes', strtotime($begin_time)));
        $begin_time = $end;
        $time[$i] = $start;
        $i++;
    }
    return $time;
}

// Change the format of time taken from database
function change_db_time($time)
{
    $time = new DateTime($time);
    $new_time = $time->format('H:i');
    return $new_time;
}

$morning_slot = get_time_slot(30, '9:00', '12:30');
$afternoon_slot = get_time_slot(30, '14:00', '18:00');

$weekday_schedule = array_merge($morning_slot, $afternoon_slot);
$weekend_schedule = $morning_slot;