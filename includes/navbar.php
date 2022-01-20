<header>
    <a href="index.php"><img title="Home" src="images/logo.png" alt="logo" id="logo" /></a>
    <?php if (!isset($_SESSION['patient_email'])) : ?>
    <div id="account" class="d-block">
        <ul>
            <li>
                <a href="login.php">
                    <span id="log-in" class="color-black">Log In<span>
                </a>
            </li>
            <li><a href="signup.php" id="signup" class="bg-color-eastern-blue bold">Sign Up</a></li>
        </ul>
    </div>
    <?php else : ?>
    <div class="dropdown">
        <h1><i class="fas fa-user"></i><?php echo ucfirst(explode('@', $_SESSION['patient_email'])[0]); ?> &#9662;</i>
        </h1>
        <ul class="dropdown-content">
            <li><a href="appointments.php">Appointments</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
    <?php endif; ?>
</header>
<nav>
    <div id="topnav" class="text-center bg-color-blue-sapphire">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="doctors.php">Doctors</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
        </ul>
    </div>
</nav>