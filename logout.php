<?php
session_start();
unset($_SESSION['patient_id']);
unset($_SESSION['patient_email']);
unset($_SESSION['admin_id']);
unset($_SESSION['admin_email']);
$_SESSION['login'] = false;
$_SESSION['message'] = "Logged Out Successfully";
header("Location: login.php");
exit(0);