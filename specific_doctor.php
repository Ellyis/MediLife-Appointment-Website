<?php
include_once "includes/header.php";
include_once "includes/dbh.php";
include_once "includes/scripts.php";
$doctor_name = $_GET['doctor'];
$doctor_details_sql = "SELECT * FROM doctor WHERE Full_name = '$doctor_name';";
$doctor_details = $conn->query($doctor_details_sql);
$doctor_details_check = mysqli_num_rows($doctor_details);
if ($doctor_details_check > 0) {
    $doctor_row = mysqli_fetch_assoc($doctor_details);
    $_SESSION['doctor_id'] = $doctor_row['Doctor_ID'];
} else {
}
if (isset($_SESSION['patient_email'])) {
    $patient_sql = "SELECT * FROM patient WHERE Email_address = '" . $_SESSION['patient_email'] . "';";
    $patient_details = $conn->query($patient_sql);
    $patient_details_check = mysqli_num_rows($patient_details);
    if ($patient_details_check > 0) {
        $patient_row = mysqli_fetch_assoc($patient_details);
    }
}
?>

<main id="specific-doctor-content">
    <div class="flex-container">
        <div class="flex-item profile-img">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($doctor_row['Image']); ?>">
        </div>
        <div class="flex-item doctor-details">
            <h1><?php echo $doctor_row['Full_name']; ?></h1>
            <h2><?php echo $doctor_row['Gender']; ?></h2>
            <ul>
                <li><i class="fas fa-envelope"></i>&nbsp; <?php echo $doctor_row['Email_address']; ?></li>
                <li><i class="fas fa-phone-alt"></i>&nbsp; <?php echo $doctor_row['Contact_number']; ?></li>
            </ul>

            <table border="1">
                <tr>
                    <th style="width: 25%;">Specialty</th>
                    <td><?php echo $doctor_row['Specialty']; ?></td>
                </tr>
                <tr>
                    <th>Qualification</th>
                    <td><?php echo $doctor_row['Qualification']; ?></td>
                </tr>
                <tr>
                    <th>Languages</th>
                    <td><?php echo $doctor_row['Languages']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <button data-modal-target="#book" title="Book Appointment" id="book-button">Book Appointment</button>

    <!-- Book Appointment -->
    <div class="modal" id="book">
        <!-- Modal content -->
        <div class="modal-content" id="book-appointment">
            <button close-button class="close">&times;</button>
            <h1>Appointment Form</h1>
            <form id="appointment-form" name="appointment-form" action="book_appointment.php" method="post"
                onsubmit="return validate_book_appointment();">
                <ul>
                    <li class="flex-item">
                        Request Appointment With <br>
                        <input type="text" name="doctor-name" style="background-color:lightgrey;"
                            value="<?php echo $doctor_name ?>" disabled>
                    </li>
                    <li class="flex-item">
                        Full Name <br>
                        <input type="text" name="full-name" id="patient-name"
                            value="<?php echo (empty($patient_row['Full_name'])) ? "" : $patient_row['Full_name']; ?>">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </li>
                    <li class="flex-item">
                        Contact Number <br>
                        <input type="tel" name="contact-number" id="contact-number"
                            value="<?php echo (empty($patient_row['Contact_number'])) ? "" : $patient_row['Contact_number']; ?>">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </li>
                    <li class="flex-item">
                        Select Date <br>
                        <input type="date" name="appointment-date" id="appointment-date">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </li>
                    <li class="flex-item">
                        Select Time <br>
                        <select name="appointment-time" id="appointment-time">
                            <option value="" disabled selected hidden>Select date to
                                continue</option>
                        </select>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </li>
                    <li class="flex-item">
                        Remarks<br>
                        <textarea name="remarks" id="remarks" cols="30" rows="10"></textarea>
                        <small>Error message</small>
                    </li>
                </ul>
                <div class="submit-container">
                    <input class="submit-btn bg-color-eastern-blue" name="submit" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <div id="overlay"></div>
</main>

<script defer src="scripts/date_limit.js"></script>
<script>
// Alert message if appointment booked
<?php if (isset($_SESSION['book']) && isset($_SESSION['message'])) : ?>
window.onload = function() {
    alert("<?php echo $_SESSION['message'] ?>")
};
<?php
        unset($_SESSION['book']);
        unset($_SESSION['message']);
    endif;
    ?>
</script>
<?php
include_once "includes/footer.php";
mysqli_close($conn);
?>