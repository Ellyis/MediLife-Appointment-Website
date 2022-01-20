<?php
session_start();
include_once "includes/dbh.php";

if (isset($_POST['login-btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['login-email']);
    $password = mysqli_real_escape_string($conn, $_POST['login-password']);

    $is_admin_email_sql = "SELECT * FROM admin WHERE Email_address = '$email';";
    $is_patient_email_sql = "SELECT * FROM patient WHERE Email_address = '$email';";
    $admin_result = $conn->query($is_admin_email_sql);
    $admin_result_check = mysqli_num_rows($admin_result);
    $patient_result = $conn->query($is_patient_email_sql);
    $patient_result_check = mysqli_num_rows($patient_result);

    if ($admin_result_check > 0) {
        $row = mysqli_fetch_assoc($admin_result);
        if ($row['Password'] == $password) {
            $_SESSION['message'] = "Welcome back";
            $_SESSION['login'] = true;
            $_SESSION['admin_email'] = $email;
            $_SESSION['admin_id'] = $row['Admin_ID'];
            header("Location: ./admin/admin.php");
        } else {
            $_SESSION['message'] = "Wrong password";
            $_SESSION['login'] = false;
            header("Location: ./login.php");
        }
    } else if ($patient_result_check > 0) {
        $row = mysqli_fetch_assoc($patient_result);
        if ($row['Password'] == $password) {
            $_SESSION['message'] = "Welcome to MediLife";
            $_SESSION['login'] = true;
            $_SESSION['patient_email'] = $email;
            $_SESSION['patient_id'] = $row['Patient_ID'];
            header("Location: ./index.php");
        } else {
            $_SESSION['message'] = "Wrong password";
            $_SESSION['login'] = false;
            header("Location: ./login.php");
        }
    } else {
        $_SESSION['message'] = "Email is not registered";
        $_SESSION['login'] = false;
        header("Location: ./login.php");
    }
}

mysqli_close($conn);