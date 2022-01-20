<?php
session_start();
include_once "includes/dbh.php";

// Account Authentication
if (!isset($_SESSION['patient_id']) && !isset($_SESSION['patient_email'])) {
    $_SESSION['login'] = false;
    $_SESSION['message'] = "Unauthorize access! Please login to continue";
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MediLife</title>
    <?php
    include_once "includes/links.php";
    include_once "includes/scripts.php";
    ?>
</head>

<body>
    <header>
        <a href="index.php"><img title="Home" src="images/logo.png" alt="logo" id="logo" /></a>
        <div class="dropdown">
            <h1><i class="fas fa-user"></i><?php echo ucfirst(explode('@', $_SESSION['patient_email'])[0]); ?>
                &#9662;</i></h1>
            <ul class="dropdown-content">
                <li><a href="appointments.php">Appointments</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </header>