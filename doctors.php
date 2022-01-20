<?php
include_once "includes/header.php";
include_once "includes/dbh.php";
?>
<main id="doctor-content-wrapper">
    <h1>Our Doctors</h1>
    <div class="grid-container">
        <?php
        $sql = "SELECT * FROM Doctor ORDER BY Full_name ASC";
        $result = $conn->query($sql);
        $result_check = mysqli_num_rows($result);
        ?>
        <?php if ($result_check > 0) : ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <a href="specific_doctor.php?doctor=<?php echo $row['Full_name']; ?>">
            <div class='grid-item'>
                <img title="<?php echo $row['Full_name']; ?>"
                    src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']); ?>" alt='doctor_image'>
                <h2><?php echo $row['Full_name']; ?></h2>
                <p><?php echo $row['Specialty']; ?></p>
            </div>
        </a>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>
<?php
include_once "includes/footer.php";
mysqli_close($conn);
?>