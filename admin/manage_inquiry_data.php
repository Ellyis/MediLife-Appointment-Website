<?php
// View and Delete Record
$action = $_POST['action'];
$id = $_POST['id'];

// Database Connnection for View and Delete Record
include_once "../includes/dbh.php";
include_once "../doctor_schedule.php";
session_start();
?>

<!-- SQL Query for View Record -->
<?php
if ($action == "view") {
    $sql_query = "SELECT * FROM inquiry WHERE Inquiry_ID = $id;";
    $result = mysqli_query($conn, $sql_query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!-- SQL Query for Delete Record -->
<?php
if ($action == "delete") {
    $delete_sql_query = "DELETE FROM inquiry WHERE Inquiry_ID = $id;";
    $delete_result = mysqli_query($conn, $delete_sql_query);
    if (mysqli_affected_rows($conn) >= 1) {
        $_SESSION['message'] = "Record Deleted Successfully";
        $_SESSION['delete'] = true;
    } else {
        $_SESSION['message'] = "Failed to Delete Record";
        $_SESSION['delete'] = false;
    }
}
?>

<!-- HTML Content for View Record -->
<?php if ($action == "view") : ?>
<ul class="flex-container">
    <li class="flex-item">
        Full Name <br>
        <input type="text" name="full-name" id="full-name" class="input-disabled"
            value="<?php echo $row['Full_name']; ?>" disabled>
    </li>
    <li class="flex-item">
        Email Address <br>
        <input type="text" name="email-address" id="email-address" class="input-disabled"
            value="<?php echo $row['Email_address']; ?>" disabled>
    </li>
    <li class="flex-item">
        Contact Number <br>
        <input type="tel" name="contact-number" id="contact-number" class="input-disabled"
            value="<?php echo $row['Contact_number']; ?>" disabled>
    </li>
    <li class="flex-item">
        Message<br>
        <textarea name="message" id="message" cols="30" rows="7" class="input-disabled"
            disabled><?php echo $row['Message']; ?></textarea>
    </li>
</ul>
<?php endif; ?>

<!-- Close Database Connection -->
<? mysqli_close($conn); ?>