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

<body id="login-page">
    <section class="entry-form">
        <form name="login" action="logging_in.php" method="post" class="text-center"
            onsubmit="return validate_login();">
            <a href="index.php"><img title="Home" class="entry-logo" src="images/transparent_logo.png" alt="logo"></a>
            <br>
            <h1>MediLife Account Login</h1>
            <ul>
                <li id="login-email-box">
                    <input type="text" name="login-email" id="login-email" placeholder="Email">
                    <br>
                    <div id="email-error"></div>
                </li>
                <li id="login-password-box">
                    <input type="password" name="login-password" id="login-password" placeholder="Password">
                    <br>
                    <div id="password-error"></div>
                </li>
            </ul>
            <input type="submit" name="login-btn" value="Log In">
            <br>
            <a class="no-underline" href="signup.php">Register now</a>
        </form>
    </section>
</body>

</html>
<?php
if (isset($_SESSION['signup']) && $_SESSION['signup'] == true) {
    echo "<script>window.onload = function() {alert('" . $_SESSION['message'] . "')};</script>";
    unset($_SESSION['signup']);
    unset($_SESSION['message']);
}

if (isset($_SESSION['login']) && $_SESSION['login'] == false) {
    echo "<script>window.onload = function() {
                alert('" . $_SESSION['message'] . "')
            };</script>";
    unset($_SESSION['login']);
    unset($_SESSION['message']);
}

if (isset($_SESSION['book']) && isset($_SESSION['message'])) {
    echo "<script>window.onload = function() {
                alert('" . $_SESSION['message'] . "')
            };</script>";
    unset($_SESSION['book']);
    unset($_SESSION['message']);
}
?>