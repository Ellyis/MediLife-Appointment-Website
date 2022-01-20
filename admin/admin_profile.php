<?php
include_once "includes/header.php";

$email = $_SESSION['admin_email'];
$sql_query = "SELECT * FROM admin WHERE Email_address = '$email';";
$result = mysqli_query($conn, $sql_query);
$row = mysqli_fetch_assoc($result);

?>
<main id="main">
    <h1 class="title">Profile</h1>
    <br>
    <hr>
    <article id="profile">
        <div class="content-container" id="profile-details">
            <div class="title-container">
                <h2>Profile Settings</h2>
                <button data-modal-target="#add" title="Edit" id="edit-button">
                    <i class="fas fa-user-edit"></i>Edit
                </button>
            </div>
            <form action="admin_update_profile.php" method="post" onsubmit="return validate_profile();">
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
                        Contact Number <br>
                        <input type="tel" name="contact-number" id="contact-number" class="input-disabled"
                            value="<?php echo $row['Contact_number'] ?>" disabled>
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
                        <input type="text" name="password" id="password" class="input-disabled"
                            value="<?php echo $row['Password'] ?>" disabled>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </li>
                    <li class="flex-item address">
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
                        <input type="text" name="zip-code" id="zip-code" class="input-disabled"
                            value="<?php echo $row['Zip_code'] ?>" disabled>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </li>
                    <li class="flex-item">
                        City <br>
                        <input type="text" name="city" id="city" class="input-disabled"
                            value="<?php echo $row['City'] ?>" disabled>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </li>
                    <li class="flex-item">
                        State/Province <br>
                        <input type="text" name="state" id="state" class="input-disabled"
                            value="<?php echo $row['State'] ?>" disabled>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </li>
                    <li class="flex-item">
                        Country <br>
                        <input type="text" name="country" id="country" class="input-disabled"
                            value="<?php echo $row['Country'] ?>" disabled>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </li>
                </ul>
                <div class="submit-container">
                    <input class="submit-btn bg-color-light-green" name="update" id="update-button" type="submit"
                        value="Update">
                </div>
            </form>
        </div>
    </article>
</main>
<script>
// Get edit and update button
var editButton = document.getElementById("edit-button");
var updateButton = document.getElementById("update-button");


// When the user clicks on the edit button,
editButton.onclick = function() {
    updateButton.style.display = "block";
    editButton.style.display = "none";
    $("input[class='input-disabled']").prop('disabled', false);
}

// When the user clicks on the update button,
updateButton.onsubmit = function() {
    editButton.style.display = "block";
    updateButton.style.display = "none";
}

// Alert message if record updated
<?php if (isset($_SESSION['update']) && isset($_SESSION['message'])) : ?>
window.onload = function() {
    alert("<?php echo $_SESSION['message'] ?>");
}
<?php
        unset($_SESSION['update']);
        unset($_SESSION['message']);
    endif;
    ?>
</script>

<!-- Validate Email Exist Error Script -->
<script defer src="scripts/admin_email_exist_error.js"></script>

<?php
include_once "includes/footer.php";
?>