<!-- View, Add, Edit, Delete Record -->
<?php $action = $_POST['action']; ?>

<!-- Database Connnection for View, Edit, Delete Record -->
<?php
if ($action == "view" || $action == "edit" || $action == "delete") {
    include_once "../includes/dbh.php";
    session_start();

    $id = $_POST['id'];
}
?>

<!-- SQL Query for View, Edit Record -->
<?php
if ($action == "view" || $action == "edit") {
    $sql_query = "SELECT * FROM doctor WHERE Doctor_ID = $id;";
    $result = mysqli_query($conn, $sql_query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!-- SQL Query for Delete Record -->
<?php
if ($action == "delete") {
    $delete_sql_query = "DELETE FROM doctor WHERE Doctor_ID = $id;";
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

<!-- HTML Content for View, Add, Edit Record -->
<?php if ($action == "view" || $action == "edit" || $action == "add") : ?>

<!-- Profile Picture for View Doctor -->
<?php if ($action == "view") : ?>
<img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']); ?>" alt='doctor_image'>
<?php endif; ?>

<ul class="flex-container">
    <li class="flex-item">
        Full Name <br>
        <input type="text" name="full-name" id="full-name" class="input-disabled"
            value="<?php echo $row['Full_name'] ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Gender <br>
        <select name="gender" id="gender" class="input-disabled" disabled>
            <?php if ($action == "add") : ?>
            <option value="" selected disabled hidden>Please select</option>
            <?php endif; ?>
            <option value="Male" <?php if ($action == "edit" || $action == "view") {
                                            echo ($row['Gender'] == "Male") ? "selected" : "";
                                        } ?>>Male
            </option>
            <option value="Female" <?php if ($action == "edit" || $action == "view") {
                                            echo ($row['Gender'] == "Female") ? "selected" : "";
                                        } ?>>Female
            </option>
        </select>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Email Address <br>
        <input type="text" name="email-address" id="email-address" class="input-disabled"
            value="<?php echo $row['Email_address'] ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Password <br>
        <input type="text" name="password" id="password" class="input-disabled" value="<?php echo $row['Password'] ?>"
            disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Contact Number <br>
        <input type="tel" placeholder="e.g. 999-9999999" name="contact-number" id="contact-number"
            class="input-disabled" value="<?php echo $row['Contact_number'] ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Qualification <br>
        <input type="text" name="qualification" id="qualification" class="input-disabled"
            value="<?php echo $row['Qualification'] ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Specialty <br>
        <input type="text" name="specialty" id="specialty" class="input-disabled"
            value="<?php echo $row['Specialty'] ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Languages <br>
        <input type="text" name="languages" id="languages" class="input-disabled"
            value="<?php echo $row['Languages'] ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>

    <!-- Profile Picture for Edit and Add Doctor -->
    <?php if ($action == "edit" || $action == "add") : ?>
    <li class="flex-item">
        Profile Picture <br>
        <input type="file" name="image" class="input-disabled" id="image" style="border: none; padding-left: 0;">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <?php endif; ?>

    <li class="flex-item subtitle">
        <h3>Address</h3>
    </li>
    <li class="flex-item">
        Address Line 1 <br>
        <input type="text" name="address-line-1" id="address-line-1" class="input-disabled"
            value="<?php echo $row['Address_line_1'] ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Address Line 2 (optional) <br>
        <input type="text" name="address-line-2" id="address-line-2" class="input-disabled"
            value="<?php echo $row['Address_line_2'] ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Zip/Postal Code <br>
        <input type="text" name="zip-code" id="zip-code" class="input-disabled" value="<?php echo $row['Zip_code'] ?>"
            disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        City <br>
        <input type="text" name="city" id="city" class="input-disabled" value="<?php echo $row['City'] ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        State/Province <br>
        <input type="text" name="state" id="state" class="input-disabled" value="<?php echo $row['State'] ?>" disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
    <li class="flex-item">
        Country <br>
        <input type="text" name="country" id="country" class="input-disabled" value="<?php echo $row['Country'] ?>"
            disabled>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </li>
</ul>
<?php endif; ?>

<!-- HTML Content for View Record -->
<?php if ($action == "view") : ?>
<script>
$("#view-form .input-disabled").removeAttr('id');
$("#edit-form .input-disabled").removeAttr('id');
$("#add-form .input-disabled").removeAttr('id');
</script>
<?php endif; ?>

<!-- HTML Content for Edit Record -->
<?php if ($action == "edit") : ?>
<?php $_SESSION['doctor_id'] = $row['Doctor_ID']; ?>
<div class="submit-container">
    <input class="submit-btn bg-color-light-green" type="submit" name="update" value="Update">
</div>
<script>
$("#view-form .input-disabled").removeAttr('id');
$("#add-form .input-disabled").removeAttr('id');
$("#edit-form .input-disabled").prop('disabled', false);
</script>
<?php endif; ?>

<!-- HTML Content for Add Record -->
<?php if ($action == "add") : ?>
<script>
$("#view-form .input-disabled").removeAttr('id');
$("#edit-form .input-disabled").removeAttr('id');
$("#add-form .input-disabled").prop('disabled', false);
$("#add-form .input-disabled").removeAttr("value");
</script>
<div class="submit-container">
    <input class="submit-btn bg-color-eastern-blue" type="submit" name="add" value="Submit">
</div>
<?php endif; ?>

<!-- Validate Email Exist Error Script -->
<script defer src="scripts/admin_email_exist_error.js"></script>

<!-- Close Database Connection -->
<?php
if ($action == "view" || $action == "edit" || $action == "delete") {
    mysqli_close($conn);
}
?>