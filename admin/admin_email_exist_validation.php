<?php
session_start();
include_once "../includes/dbh.php";

if (isset($_POST['check_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['input_email']);
    $action = mysqli_real_escape_string($conn, $_POST['action']);
    if ($action == "edit-patient") {
        $id = $_SESSION['get_patient_id'];
        $email_sql = "SELECT * FROM (
            SELECT Email_address FROM admin
            UNION
            SELECT Email_address FROM doctor 
            UNION
            SELECT Email_address FROM patient WHERE Patient_ID != '$id'
            ) AS All_email
            WHERE All_email.Email_address = '$email';";
    } else if ($action == "edit-doctor") {
        $id = $_SESSION['doctor_id'];
        $email_sql = "SELECT * FROM (
            SELECT Email_address FROM admin
            UNION
            SELECT Email_address FROM doctor WHERE Doctor_ID != '$id'
            UNION
            SELECT Email_address FROM patient
            ) AS All_email
            WHERE All_email.Email_address = '$email';";
    } else if ($action == "profile-details") {
        $id = $_SESSION['admin_id'];
        $email_sql = "SELECT * FROM (
            SELECT Email_address FROM admin WHERE Admin_ID != '$id'
            UNION
            SELECT Email_address FROM doctor 
            UNION
            SELECT Email_address FROM patient
            ) AS All_email
            WHERE All_email.Email_address = '$email';";
    } else { // If action is add-patient or add-doctor
        $email_sql = "SELECT * FROM (
            SELECT Email_address FROM admin
            UNION
            SELECT Email_address FROM doctor
            UNION
            SELECT Email_address FROM patient
            ) AS All_email
            WHERE All_email.Email_address = '$email';";
    }
    $result = $conn->query($email_sql);
    $result_check = mysqli_num_rows($result);
    if ($result_check > 0) {
        echo "Email already exists. Please enter another one.";
    } else {
        echo "Email is available.";
    }
}