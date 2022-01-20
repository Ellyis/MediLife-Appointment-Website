<?php
include_once "includes/header.php";
?>
<section id="contact-us" class="bg-color-light-blue">
    <form action="add_inquiry.php" name="contact-us-form" method="post" onsubmit="return validate_contact_us();">
        <h1>Contact Us</h1>
        <ul>
            <li class="flex-item">
                Full Name: <br>
                <input type="text" name="full-name" id="full-name">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </li>
            <li class="flex-item">
                Email: <br>
                <input type="text" name="email-address" id="email-address">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </li>
            <li class="flex-item">
                Contact Number: <br>
                <input type="tel" name="contact-number" id="contact-number" placeholder="e.g. 999-9999999">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </li>
            <li class="flex-item">
                Your Inquiry: <br>
                <textarea name="inquiry" id="inquiry" cols="30" rows="10"></textarea>
                <small>Error message</small>
            </li>
        </ul>
        <input type="submit" name="submit" value="Submit Form">
    </form>
</section>
<script>
<?php if (isset($_SESSION['send']) && isset($_SESSION['message'])) : ?>
window.onload = function() {
    alert("<?php echo $_SESSION['message'] ?>")
}

<?php
        unset($_SESSION['send']);
        unset($_SESSION['message']);
    endif;
    ?>
</script>
<?php
include_once "includes/footer.php";
?>