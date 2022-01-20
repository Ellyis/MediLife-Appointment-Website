<?php

session_start();
include_once "../includes/dbh.php";
include_once "../doctor_schedule.php";

$doctor_id = $_POST['doctor_id'];
$date = $_POST['date'];
$date = date("Y-m-d", strtotime($date));
$day = $_POST['day'];
if ($day == "6") {
    $schedule_start_time = $weekend_schedule;
} else {
    $schedule_start_time = $weekday_schedule;
}

$appointment_details_sql = "SELECT * FROM appointment WHERE Doctor_ID = '$doctor_id' AND Date = '$date';";
$appointment_details = $conn->query($appointment_details_sql);
$appointment_details_check = mysqli_num_rows($appointment_details);

if ($appointment_details_check > 0) {
    $booked_slots_start_time = array();
    while ($row = mysqli_fetch_assoc($appointment_details)) {
        array_push($booked_slots_start_time, change_db_time($row['Start_time']));
    }

    $available_slots = array_diff($schedule_start_time, $booked_slots_start_time);
    foreach ($available_slots as $slot) {
        echo "<option value='$slot'> " . $slot . " - " . date('H:i', strtotime('+30minutes', strtotime($slot))) . "</option>";
    }
} else {
    foreach ($schedule_start_time as $slot) {
        echo "<option value='$slot'> " . $slot . " - " . date('H:i', strtotime('+30minutes', strtotime($slot))) . "</option>";
    }
}