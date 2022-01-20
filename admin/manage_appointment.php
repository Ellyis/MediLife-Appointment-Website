<?php
session_start();
include_once "../includes/dbh.php";

if (isset($_POST['update']) || (isset($_POST['add']))) {

    // Get data from HTML Form
    $doctor_id = trim($_POST['doctor-id']);
    $patient_detail = trim($_POST['patient-id']);
    $patient_id = explode(":", $patient_detail)[0];
    $patient_name = explode(":", $patient_detail)[1];
    $patient_contact_number = trim($_POST['contact-number']);
    $date = trim($_POST['appointment-date']);
    $start_time = trim($_POST['appointment-time']);
    $end_time = date('H:i', strtotime('+30minutes', strtotime($start_time)));
    $remarks = trim($_POST['remarks']);

    if (isset($_POST['update'])) {
        $appointment_id = $_SESSION['appointment_id'];
        $sql_query = "UPDATE appointment SET Date = '$date', Start_time = '$start_time', End_time = '$end_time' WHERE Appointment_ID = '$appointment_id'";
        $result = mysqli_query($conn, $sql_query);

        // If database is updated
        if (mysqli_affected_rows($conn) >= 1) {
            $_SESSION['update'] = true;
            $_SESSION['message'] = "Record Updated Successfully";
        }

        // If SQL fails to run
        if ($result == false) {
            $_SESSION['update'] = false;
            $_SESSION['message'] = "Failed to Update Record";
        }
        unset($_SESSION['appointment_id']);
    }

    if (isset($_POST['add'])) {
        $sql_query = "INSERT INTO appointment (Patient_name, Patient_contact_number, Date, Start_time, End_time, Remarks, Doctor_ID, Patient_ID, Admin_ID) VALUES ('$patient_name', '$patient_contact_number', '$date', '$start_time', '$end_time', '$remarks', '$doctor_id', '$patient_id', 1)";
        $result = mysqli_query($conn, $sql_query);

        // If database is updated
        if (mysqli_affected_rows($conn) >= 1) {
            $_SESSION['add'] = true;
            $_SESSION['message'] = "Record Added Successfully";
        }

        // If SQL fails to run
        if ($result == false) {
            $_SESSION['add'] = false;
            $_SESSION['message'] = "Failed to Add Record";
        }
    }

    header("Location: admin_appointments.php");
}