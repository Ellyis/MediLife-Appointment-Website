<?php
session_start();
include_once "../includes/dbh.php";


if (isset($_POST['update'])) {
    $id = $_SESSION['admin_id'];

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

    // Check if email exist or not
    $email_sql = "SELECT * FROM (
        SELECT Email_address FROM admin WHERE Admin_ID != '$id'
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
        $_SESSION['update'] = false;

        header("Location: admin_profile.php");
    } else {
        $update_sql_query = "UPDATE admin SET Email_address = '$email_address', Password = '$password', Full_name = '$full_name', Contact_number = '$contact_number', Address_line_1 = '$address_line_1', Address_line_2 = '$address_line_2', Zip_code = '$zip_code', City = '$city', State = '$state', Country = '$country' WHERE Admin_ID = '$id'";

        $update_result = mysqli_query($conn, $update_sql_query);

        // If database is updated
        if (mysqli_affected_rows($conn) >= 1) {
            $_SESSION['message'] = "Record Updated Successfully";
            $_SESSION['update'] = true;
            $_SESSION['admin_email'] = $email_address;
        }

        // If SQL fails to run
        if ($update_result == false) {
            $_SESSION['message'] = "Failed to Update Record";
            $_SESSION['update'] = false;
        }
        header("Location: admin_profile.php");
    }
}