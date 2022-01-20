<?php

session_start();
include_once "../includes/dbh.php";
include_once "../doctor_schedule.php";

$appointment_id = $_SESSION['appointment_id'];

$date = $_POST['date'];
$date = date("Y-m-d", strtotime($date));
$day = $_POST['day'];
if ($day == "6") {
    $schedule_start_time = $weekend_schedule;
} else {
    $schedule_start_time = $weekday_schedule;
}

$current_appointment_details_sql = "SELECT * FROM appointment WHERE Appointment_ID = '$appointment_id';";
$current_appointment_details = $conn->query($current_appointment_details_sql);
$current_appointment_result = mysqli_fetch_assoc($current_appointment_details);

$doctor_id = $current_appointment_result['Doctor_ID'];
$current_date = $current_appointment_result['Date'];
$current_start_time = change_db_time($current_appointment_result['Start_time']);


$appointment_details_sql = "SELECT * FROM appointment WHERE Doctor_ID = '$doctor_id' AND Date = '$date';";
$appointment_details = $conn->query($appointment_details_sql);

$booked_slots_start_time = array();

while ($row = mysqli_fetch_assoc($appointment_details)) {
    array_push($booked_slots_start_time, change_db_time($row['Start_time']));
}

$available_slots = array_diff($schedule_start_time, $booked_slots_start_time);

if (!empty($booked_slots_start_time)) {
    array_push($available_slots, $current_start_time);
}
sort($available_slots);
?>
<?php foreach ($available_slots as $slot) : ?>
<option value="<?php echo $slot ?>"
    <?php echo ($slot == $current_start_time && $date == $current_date) ? "selected" : ""; ?>>
    <?php echo $slot . " - " . date('H:i', strtotime('+30minutes', strtotime($slot))) ?>
</option>
<?php endforeach; ?>