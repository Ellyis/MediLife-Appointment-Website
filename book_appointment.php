<?php
session_start();
include_once "includes/dbh.php";

$doctor_id = $_SESSION['doctor_id'];

if (isset($_POST['submit'])) {

    // Requires login in order to book appointment
    if (!isset($_SESSION['patient_id'])) {
        $_SESSION['book'] = false;
        $_SESSION['message'] = "Please login before booking any appointment";
        header("Location: login.php");
    } else {
        $full_name = $_POST['full-name'];
        $contact_number = $_POST['contact-number'];
        $date = $_POST['appointment-date'];
        $start_time = $_POST['appointment-time'];
        $end_time = date('H:i', strtotime('+30minutes', strtotime($start_time)));
        $remarks = $_POST['remarks'];
        $patient_id = $_SESSION['patient_id'];
        $sql_query = "INSERT INTO appointment (Patient_name, Patient_contact_number, Date, Start_time, End_time, Remarks, Doctor_ID, Patient_ID, Admin_ID) VALUES ('$full_name', '$contact_number', '$date', '$start_time', '$end_time', '$remarks', '$doctor_id', $patient_id , '1')";
        $result = mysqli_query($conn, $sql_query);
        if (mysqli_affected_rows($conn) >= 1) {
            $_SESSION['book'] = true;
            $_SESSION['message'] = "Appointment Booked Succesfully";
        }
        if ($result == false) {
            $_SESSION['book'] = false;
            $_SESSION['message'] = "Failed to Book Appointment";
        }
        unset($_SESSION['doctor_id']);
        $sql_query = "SELECT * FROM doctor WHERE Doctor_ID = '$doctor_id';";
        $result = mysqli_query($conn, $sql_query);
        $row = mysqli_fetch_assoc($result);
        header("Location: specific_doctor.php?doctor=" . $row['Full_name']);
    }
}

mysqli_close($conn);