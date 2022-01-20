<?php
// View, Add, Edit, Delete Record
$action = $_POST['action'];

// Database Connnection for View, Edit, Delete, Add Record
include_once "../includes/dbh.php";
include_once "../doctor_schedule.php";
session_start();

?>
<?php
if ($action == "view" || $action == "edit" || $action == "delete") {
    $id = $_POST['id'];
    $_SESSION['appointment_id'] = $id;
}
?>

<?php
// SQL Query for View, Edit Record
if ($action == "view" || $action == "edit") {
    $appointment_sql_query = "SELECT * FROM appointment WHERE Appointment_ID = $id;";
    $appointment_result = mysqli_query($conn, $appointment_sql_query);
    $appointment_row = mysqli_fetch_assoc($appointment_result);

    $doctor_id = $appointment_row['Doctor_ID'];

    $doctor_sql_query = "SELECT * FROM doctor WHERE Doctor_ID = $doctor_id;";
    $doctor_result = mysqli_query($conn, $doctor_sql_query);
    $doctor_row = mysqli_fetch_assoc($doctor_result);
}

// SQL Query for Add Record
if ($action == "add") {
    $patient_sql_query = "SELECT * FROM patient;";
    $patient_result = mysqli_query($conn, $patient_sql_query);
    $patient_check = mysqli_num_rows($patient_result);

    $doctor_sql_query = "SELECT * FROM doctor;";
    $doctor_result = mysqli_query($conn, $doctor_sql_query);
    $doctor_check = mysqli_num_rows($doctor_result);
}

// SQL Query for Delete Record
if ($action == "delete") {
    $delete_sql_query = "DELETE FROM appointment WHERE Appointment_ID = $id;";
    $delete_result = mysqli_query($conn, $delete_sql_query);
    if (mysqli_affected_rows($conn) >= 1) {
        $_SESSION['message'] = "Appointment Deleted Successfully";
        $_SESSION['delete'] = true;
    } else {
        $_SESSION['message'] = "Failed to Delete Appointment";
        $_SESSION['delete'] = false;
    }
}
?>
<!-- HTML Content for View, Edit Record -->
<ul class="flex-container">
    <?php if ($action == "view" || $action == "edit") : ?>
    <li class="flex-item">
        Doctor Name <br>
        <input type="text" name="doctor-name" class="input-disabled" value="<?php echo $doctor_row['Full_name']; ?>"
            disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Patient Name <br>
        <input type="text" name="patient-name" class="input-disabled"
            value="<?php echo $appointment_row['Patient_name']; ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Patient Contact Number <br>
        <input type="text" placeholder="e.g. 999-9999999" name="contact-number" id="contact-number"
            class="input-disabled" value="<?php echo $appointment_row['Patient_contact_number']; ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Select Date <br>
        <input type="date" name="appointment-date" id="appointment-date" class="input-disabled"
            value="<?php echo $appointment_row['Date']; ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item" style="flex-basis: 45.7%;">
        Select Time <br>
        <select name="appointment-time" id="appointment-time" class="input-disabled" disabled>
            <option>
                <?php echo change_db_time($appointment_row['Start_time']) . " - " . change_db_time($appointment_row['End_time']); ?>
            </option>
        </select>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Remarks<br>
        <textarea name="remarks" id="remarks" cols="30" rows="6" class="input-disabled"
            disabled><?php echo $appointment_row['Remarks']; ?></textarea>
        <small>Error message</small>
    </li>
    <?php endif; ?>


    <!-- HTML Content for Add Record -->
    <?php if ($action == "add") : ?>
    <li class="flex-item">
        Doctor Name <br>
        <select name="doctor-id" id="doctor-name" class="remove_id">
            <option value="" selected disabled hidden>Click to select doctor</option>
            <?php if ($doctor_check > 0) : ?>
            <?php while ($doctor_row = mysqli_fetch_assoc($doctor_result)) : ?>
            <option value="<?php echo $doctor_row['Doctor_ID']; ?>">
                <?php echo $doctor_row['Full_name']; ?></option>
            <?php endwhile; ?>
            <?php endif; ?>
        </select>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Patient Name <br>
        <select name="patient-id" id="patient-name" class="remove_id">
            <option value="" selected disabled hidden>Click to select patient</option>
            <?php if ($patient_check > 0) : ?>
            <?php while ($patient_row = mysqli_fetch_assoc($patient_result)) : ?>
            <?php if (!empty($patient_row['Full_name'])) : ?>
            <option value="<?php echo $patient_row['Patient_ID'] . ":" . $patient_row['Full_name']; ?>">
                <?php echo $patient_row['Full_name']; ?></option>
            <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </select>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item" id="contact-field">
        Patient Contact Number <br>
        <input type="text" placeholder="e.g. 999-9999999" name="contact-number" id="contact-number" class="remove_id">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Select Date <br>
        <input type="date" name="appointment-date" id="appointment-date" class="remove_id">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item" style="flex-basis: 45.7%;">
        Select Time <br>
        <select name="appointment-time" id="appointment-time" class="remove_id">
            <option value="" disabled selected hidden>Select date to
                continue</option>
        </select>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Remarks<br>
        <textarea name="remarks" id="remarks" cols="30" rows="6" class="remove_id"></textarea>
        <small>Error message</small>
    </li>
    <?php endif; ?>
</ul>

<!-- HTML Content for View Record -->
<?php if ($action == "view") : ?>
<script>
$("#view-form input-disabled").removeAttr("placeholder");
$("#view-form .input-disabled").removeAttr('id');
$("#edit-form .input-disabled").removeAttr('id');
$("#add-form .remove_id").removeAttr('id');
</script>
<?php endif; ?>

<!-- HTML Content for Edit Record -->
<?php if ($action == "edit") : ?>
<div class="submit-container">
    <input class="submit-btn bg-color-light-green" type="submit" name="update" value="Update">
</div>
<script>
$("#view-form .input-disabled").removeAttr('id');
$("#add-form .remove_id").removeAttr('id');
$("#edit-form #appointment-date").prop('disabled', false);
$("#edit-form #appointment-time").prop('disabled', false);
</script>
<script defer src="scripts/edit_date_limit.js"></script>
<?php endif; ?>

<!-- HTML Content for Add Record -->
<?php if ($action == "add") : ?>
<div class="submit-container">
    <input class="submit-btn bg-color-eastern-blue" type="submit" name="add" value="Submit">
</div>
<script>
$("#view-form .input-disabled").removeAttr('id');
$("#edit-form .input-disabled").removeAttr('id');
</script>
<script defer src="scripts/add_date_limit.js"></script>
<?php endif; ?>

<!-- Close Database Connection -->
<?php
mysqli_close($conn);
?>