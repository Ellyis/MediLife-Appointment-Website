<?php
include_once "includes/header.php";
?>
<main id="main">
    <h1 class="title">Patients</h1>
    <br>
    <hr>
    <article id="patients">
        <div class="content-container">
            <button data-modal-target="#add" title="Add Patient" id="add-button">Add Patient</button>
            <div class="table-container">
                <table>
                    <tr>
                        <th class="padding-left">Patient Name</th>
                        <th class="padding-left">Email Address</th>
                        <th class="padding-left">Password</th>
                        <th class="padding-left">Contact Number</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM patient ORDER BY Full_name ASC";
                    $result = $conn->query($sql);
                    $result_check = mysqli_num_rows($result);
                    $patient_array = array();
                    ?>
                    <?php if ($result_check > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <?php
                            $patient_ID = "P" . $row['Patient_ID'];
                            array_push($patient_array, $patient_ID);

                            ?>
                    <tr>
                        <td class="padding-left"><?php echo $row['Full_name']; ?></td>
                        <td class="padding-left"><?php echo $row['Email_address']; ?></td>
                        <td class="padding-left"><?php echo $row['Password']; ?></td>
                        <td class="padding-left"><?php echo $row['Contact_number']; ?></td>
                        <td style="text-align: center;">
                            <i data-modal-target="#view" title="View" class="fas fa-eye"
                                id="view-button-<?php echo $patient_ID; ?>"></i>
                            <i data-modal-target="#edit" title="Edit" class="fas fa-edit"
                                id="edit-button-<?php echo $patient_ID; ?>"></i>
                            <a href="admin_patients.php"><i title="Delete" class="fas fa-trash-alt"
                                    id="delete-button-<?php echo $patient_ID; ?>"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="5">
                            <h2 class="no-record">No Records Found</h2>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </article>

    <!-- View Patient -->
    <div class="modal" id="view">
        <!-- Modal content -->
        <div class="modal-content" id="view-patient">
            <button close-button class="close">&times;</button>
            <h1>View Patient Details</h1>
            <form id="view-form">
            </form>
        </div>
    </div>

    <!-- Edit Patient -->
    <div class="modal" id="edit">
        <!-- Modal content -->
        <div class="modal-content" id="edit-patient">
            <button close-button class="close">&times;</button>
            <h1>Edit Patient Details</h1>
            <form action="manage_patient.php" id="edit-form" method="post" onsubmit="return validate_profile();">
            </form>
        </div>
    </div>

    <!-- Add Patient -->
    <div class="modal" id="add">
        <!-- Modal content -->
        <div class="modal-content" id="add-patient">
            <button close-button class="close">&times;</button>
            <h1>Add New Patient</h1>
            <form action="manage_patient.php" id="add-form" method="post" onsubmit="return validate_profile();">
            </form>
        </div>
    </div>
    <div id="overlay"></div>
</main>

<script>
$(document).ready(function() {
    <?php foreach ($patient_array as $patient_id) : ?>

    // Load View Doctor Data When Clicked
    $("#view-button-<?php echo $patient_id; ?>").click(function() {
        var id = "<?php echo str_replace("P", "", $patient_id) ?>";
        var action = "view";
        $("#view-form").load("manage_patient_data.php", {
            id: id,
            action: action
        });
    });

    // Load Edit Doctor Data When Clicked
    $("#edit-button-<?php echo $patient_id; ?>").click(function() {
        var id = "<?php echo str_replace("P", "", $patient_id) ?>";
        var action = "edit";
        $("#edit-form").load("manage_patient_data.php", {
            id: id,
            action: action
        });
    });

    // Load Delete Doctor Data When Clicked
    $("#delete-button-<?php echo $patient_id; ?>").click(function() {
        if (confirm("Are you sure you want to delete this record?")) {
            var id = "<?php echo str_replace("P", "", $patient_id) ?>";
            var action = "delete";
            $(window).load("manage_patient_data.php", {
                id: id,
                action: action
            });
        }
    });

    <?php endforeach; ?>

    // Load Add Doctor Data When Clicked
    $("#add-button").click(function() {
        var action = "add";
        $("#add-form").load("manage_patient_data.php", {
            action: action
        });
    });
});
</script>

<?php
include_once "includes/alert_message.php";
include_once "includes/footer.php";
?>