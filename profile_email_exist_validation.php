<?php
session_start();
include_once "includes/dbh.php";

if (isset($_POST['check_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['input_email']);
    $id = $_SESSION['patient_id'];

    // Check if email exist or not
    $email_sql = "SELECT * FROM (
            SELECT Email_address FROM admin
            UNION
            SELECT Email_address FROM doctor 
            UNION
            SELECT Email_address FROM patient WHERE Patient_ID != '$id'
            ) AS All_email
            WHERE All_email.Email_address = '$email';";
    $result = $conn->query($email_sql);
    $result_check = mysqli_num_rows($result);
    if ($result_check > 0) {
        echo "Email already exists. Please enter another one.";
    } else {
        echo "Email is available.";
    }
}