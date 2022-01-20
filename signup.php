<?php
session_start();
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

<body id="signup-page">
    <section class="entry-form">
        <form name="login" action="signing_up.php" method="post" class="text-center"
            onsubmit="return validate_signup();">
            <a href="index.php"><img title="Home" class="entry-logo" src="images/transparent_logo.png" alt="logo"></a>
            <br>
            <h1>MediLife Account Signup</h1>
            <ul>
                <li id="signup-email-box">
                    <input type="text" name="signup-email" id="signup-email" placeholder="Email">
                    <br>
                    <div id="email-error"></div>
                </li>
                <li id="signup-password-box">
                    <input type="password" name="signup-password" id="signup-password" placeholder="Password">
                    <br>
                    <div id="password-error"></div>
                </li>
                <li id="signup-confirm-password-box">
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
                    <div id="confirm-password-error"></div>
                </li>
            </ul>
            <input type="submit" name="signup-btn" value="Sign Up">
            <br>
            <span>Already registered?&nbsp;</span><a class="no-underline" href="login.php">Login</a>
        </form>
    </section>
</body>

</html>
<?php
if (isset($_SESSION['signup']) && $_SESSION['signup'] == false) {
    echo "<script>window.onload = function() {
            alert('" . $_SESSION['message'] . "')
          };</script>";
    unset($_SESSION['signup']);
}
?>