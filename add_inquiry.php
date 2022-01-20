<?php
session_start();
include_once "includes/dbh.php";

if (isset($_POST['submit'])) {
    $full_name = $_POST['full-name'];
    $email_address = $_POST['email-address'];
    $contact_number = $_POST['contact-number'];
    $message = $_POST['inquiry'];

    $sql_query = "INSERT INTO inquiry (Full_name, Email_address, Contact_number, Message, Admin_ID) VALUES ('$full_name', '$email_address', '$contact_number', '$message', 1)";
    $result = mysqli_query($conn, $sql_query);

    if (mysqli_affected_rows($conn) >= 1) {
        $_SESSION['send'] = true;
        $_SESSION['message'] = "Inquiry successfully sent";
    }
    if ($result == false) {
        $_SESSION['send'] = false;
        $_SESSION['message'] = "Failed to send inquiry";
    }

    mysqli_close($conn);
    header("Location: contact_us.php");
}