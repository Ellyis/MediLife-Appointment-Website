<?php
session_start();
include_once "includes/dbh.php";

if (isset($_POST['check_signup_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['input_email']);
    $email_sql = "SELECT * FROM (
                  SELECT Email_address FROM admin
                  UNION
                  SELECT Email_address FROM doctor
                  UNION
                  SELECT Email_address FROM patient
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

if (isset($_POST['signup-btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['signup-email']);
    $password = mysqli_real_escape_string($conn, $_POST['signup-password']);

    $email_sql = "SELECT * FROM (
                  SELECT Email_address FROM admin
                  UNION
                  SELECT Email_address FROM doctor
                  UNION
                  SELECT Email_address FROM patient
                  ) AS All_email
                  WHERE All_email.Email_address = '$email';";
    $result = $conn->query($email_sql);
    $result_check = mysqli_num_rows($result);

    if ($result_check > 0) {
        $_SESSION['message'] = "Email already exists. Please enter another one.";
        $_SESSION['signup'] = false;
        header("Location: ./signup.php");
    } else {
        $insert_sql = "INSERT INTO patient (Email_address, Password, Full_name, Contact_number, Address_line_1, Address_line_2, Zip_code, City, State, Country, Admin_ID) VALUES ('$email','$password', NULL, NULL,  NULL, NULL, NULL, NULL, NULL, NULL, '1');";

        $insert = $conn->query($insert_sql);
        if ($insert) {
            $_SESSION['message'] = "Signup Succesful!";
            $_SESSION['signup'] = true;
            header("Location: ./login.php");
        } else {
            $_SESSION['message'] = "Signup Failed. Please try again.";
            $_SESSION['signup'] = false;
            header("Location: ./signup.php");
        }
    }
}
mysqli_close($conn);