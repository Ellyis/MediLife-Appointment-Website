<?php
session_start();
include_once "../includes/dbh.php";
if (isset($_POST['update']) || (isset($_POST['add']))) {

    // Get data from HTML Form
    $full_name = trim($_POST['full-name']);
    $contact_number = trim($_POST['contact-number']);
    $email_address = trim($_POST['email-address']);
    $password = trim($_POST['password']);
    $address_line_1 = trim($_POST['address-line-1']);
    $address_line_2 = trim($_POST['address-line-2']);
    $zip_code = trim($_POST['zip-code']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $country = trim($_POST['country']);

    if (isset($_POST['update'])) {
        $id = $_SESSION['get_patient_id'];

        // Check if email exist or not
        $email_sql = "SELECT * FROM (
                  SELECT Email_address FROM admin
                  UNION
                  SELECT Email_address FROM doctor
                  UNION
                  SELECT Email_address FROM patient WHERE Patient_ID != '$id'
                  ) AS All_email
                  WHERE All_email.Email_address = '$email_address'";
        $result = $conn->query($email_sql);
        $result_check = mysqli_num_rows($result);

        if ($result_check > 0) {
            $_SESSION['message'] = "Email already exists. Please enter another one.";
            $_SESSION['update'] = false;
            header("Location: admin_patients.php");
        } else {
            $sql_query = "UPDATE patient SET Email_address = '$email_address', Password = '$password', Full_name = '$full_name', Contact_number = '$contact_number', Address_line_1 = '$address_line_1', Address_line_2 = '$address_line_2', Zip_code = '$zip_code', City = '$city', State = '$state', Country = '$country' WHERE Patient_ID = '$id'";
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
            unset($_SESSION['get_patient_id']);
        }
    }

    if (isset($_POST['add'])) {

        // Check if email exist or not
        $email_sql = "SELECT * FROM (
            SELECT Email_address FROM admin
            UNION
            SELECT Email_address FROM doctor
            UNION
            SELECT Email_address FROM patient
            ) AS All_email
            WHERE All_email.Email_address = '$email_address'";
        $result = $conn->query($email_sql);
        $result_check = mysqli_num_rows($result);

        if ($result_check > 0) {
            $_SESSION['message'] = "Email already exists. Please enter another one.";
            $_SESSION['add'] = false;
            header("Location: admin_patients.php");
        } else {
            $sql_query = "INSERT INTO patient (Email_address, Password, Full_name, Contact_number, Address_line_1, Address_line_2, Zip_code, City, State, Country, Admin_ID) VALUES ('$email_address', '$password', '$full_name', '$contact_number', '$address_line_1', '$address_line_2', '$zip_code', '$city', '$state', '$country', 1)";
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
    }

    mysqli_close($conn);

    header("Location: admin_patients.php");
}