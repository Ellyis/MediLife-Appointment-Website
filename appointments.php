<?php
include_once "includes/account_header.php";
include_once "doctor_schedule.php";
?>
<main id="main">
    <article id="appointments">
        <div class="content-container">
            <div class="title-container">
                <h2>My Appointments</h2>
            </div>
            <div class="table-container">
                <table>
                    <tr>
                        <th class="padding-left">Appointment_ID</th>
                        <th class="padding-left">Patient Name</th>
                        <th class="padding-left">Doctor Name</th>
                        <th class="padding-left">Date</th>
                        <th class="padding-left">Start Time</th>
                        <th class="padding-left">End Time</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                    <?php
                    $patient_id = $_SESSION['patient_id'];
                    $appointment_sql = "SELECT * FROM appointment WHERE Patient_ID = $patient_id ORDER BY Appointment_ID ASC";
                    $appointment_result = $conn->query($appointment_sql);
                    $appointment_result_check = mysqli_num_rows($appointment_result);
                    $appointment_array = array();
                    ?>
                    <?php if ($appointment_result_check > 0) : ?>
                    <?php while ($appointment = mysqli_fetch_assoc($appointment_result)) : ?>
                    <?php
                            $appointment_id = "A" . $appointment['Appointment_ID'];
                            array_push($appointment_array, $appointment_id);

                            $doctor_id = $appointment['Doctor_ID'];

                            $doctor_sql = "SELECT * FROM doctor WHERE Doctor_ID = '$doctor_id'";
                            $doctor_result = $conn->query($doctor_sql);
                            $doctor = mysqli_fetch_assoc($doctor_result);
                            ?>
                    <tr>
                        <td class="padding-left"><?php echo $appointment['Appointment_ID']; ?></td>
                        <td class="padding-left"><?php echo $appointment['Patient_name']; ?></td>
                        <td class="padding-left"><?php echo $doctor['Full_name']; ?></td>
                        <td class="padding-left"><?php echo $appointment['Date']; ?></td>
                        <td class="padding-left"><?php echo change_db_time($appointment['Start_time']); ?></td>
                        <td class="padding-left"><?php echo change_db_time($appointment['End_time']); ?></td>
                        <td style="text-align: center;">
                            <i data-modal-target="#view" title="View" class="fas fa-eye"
                                id="view-button-<?php echo $appointment_id; ?>"></i>
                            <a href="appointments.php"><i title="Delete" class="fas fa-trash-alt"
                                    id="delete-button-<?php echo $appointment_id; ?>"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="7">
                            <h2 class="no-record">No Appointments Found</h2>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </article>

    <!-- View Appointment -->
    <div class="modal" id="view">
        <!-- Modal content -->
        <div class="modal-content" id="view-appointment">
            <button close-button class="close">&times;</button>
            <h1>View Appointment Details</h1>
            <form action="" id="view-form">
            </form>
        </div>
    </div>
    <div id="overlay"></div>
</main>
<script>
$(document).ready(function() {
    <?php foreach ($appointment_array as $appointment_id) : ?>

    // Load View Appointment Data When Clicked
    $("#view-button-<?php echo $appointment_id; ?>").click(function() {
        var id = "<?php echo str_replace("A", "", $appointment_id) ?>";
        var action = "view";
        $("#view-form").load("admin/manage_appointment_data.php", {
            id: id,
            action: action
        });
    });

    // Load Delete Appointment Data When Clicked
    $("#delete-button-<?php echo $appointment_id; ?>").click(function() {
        if (confirm("Are you sure you want to delete this appointment?")) {
            var id = "<?php echo str_replace("A", "", $appointment_id) ?>";
            var action = "delete";
            $(window).load("admin/manage_appointment_data.php", {
                id: id,
                action: action
            });
        }
    });
    <?php endforeach; ?>
});

// Alert message if record deleted
<?php if (isset($_SESSION['delete']) && isset($_SESSION['message'])) : ?>
window.onload = function() {
    alert("<?php echo $_SESSION['message'] ?>")
};
<?php
        unset($_SESSION['delete']);
        unset($_SESSION['message']);
    endif;
    ?>
</script>
<?php
include_once "includes/footer.php";
?>