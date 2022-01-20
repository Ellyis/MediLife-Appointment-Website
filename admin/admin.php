<?php
include_once "includes/header.php";

// Change integer to string datatype
function to_string($int)
{
    if ($int < 10) {
        $int = "0" . strval($int);
    } else {
        $int = strval($int);
    }
    return $int;
}

// Today Total Appointment
$today = date("Y-m-d");
$today_appointment_sql_query = "SELECT * FROM appointment WHERE Date = '$today';";
$today_appointment_result = mysqli_query($conn, $today_appointment_sql_query);
$today_appointment = to_string(mysqli_num_rows($today_appointment_result));

// Last 7 Days Total Appointments
$last_week = date('Y-m-d', strtotime('-7 day', strtotime($today)));
$last_week_appointment_sql_query = "SELECT * FROM appointment WHERE (Date BETWEEN '$last_week' AND '$today');";
$last_week_appointment_result = mysqli_query($conn, $last_week_appointment_sql_query);
$last_week_appointment = to_string(mysqli_num_rows($last_week_appointment_result));

// Total Appointments Booked
$total_appointment_sql_query = "SELECT * FROM appointment;";
$total_appointment_result = mysqli_query($conn, $total_appointment_sql_query);
$total_appointment = to_string(mysqli_num_rows($total_appointment_result));

// Total Registered Patients
$patient_sql_query = "SELECT * FROM patient;";
$patient_result = mysqli_query($conn, $patient_sql_query);
$patient = to_string(mysqli_num_rows($patient_result));

// Total Registered Doctors
$doctor_sql_query = "SELECT * FROM doctor;";
$doctor_result = mysqli_query($conn, $doctor_sql_query);
$doctor = to_string(mysqli_num_rows($doctor_result));


?>
<main id="main">
    <h1 class="title">Dashboard</h1>
    <br>
    <hr>
    <article id="dashboard">
        <div class="flex-container">
            <div class="flex-item">
                <h2>Today Total Appointments</h2>
                <p><?php echo $today_appointment; ?></p>
            </div>
            <div class="flex-item">
                <h2>Last 7 Days Total Appointments</h2>
                <p><?php echo $last_week_appointment; ?></p>
            </div>
            <div class="flex-item">
                <h2>Total Appointments Booked</h2>
                <p><?php echo $total_appointment; ?></p>
            </div>
            <div class="flex-item">
                <h2>Total Registered Patients</h2>
                <p><?php echo $patient; ?></p>
            </div>
            <div class="flex-item">
                <h2>Total Registered Doctors</h2>
                <p><?php echo $doctor; ?></p>
            </div>

        </div>
    </article>
</main>
<?php
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    echo "<script>window.onload = function() {alert('" . $_SESSION['message'] . "')};</script>";
    unset($_SESSION['login']);
    unset($_SESSION['message']);
}
include_once "includes/footer.php";


?>