<?php
include_once "includes/header.php";
?>
<main id="main">
    <h1 class="title">Doctors</h1>
    <br>
    <hr>
    <article id="doctors">
        <div class="content-container">
            <button data-modal-target="#add" title="Add Doctor" id="add-button">Add Doctor</button>
            <div class="table-container">
                <table>
                    <tr>
                        <th class="padding-left">Doctor Image</th>
                        <th class="padding-left">Doctor Name</th>
                        <th class="padding-left">Email Address</th>
                        <th class="padding-left">Password</th>
                        <th class="padding-left">Contact Number</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM doctor ORDER BY Full_name ASC";
                    $result = $conn->query($sql);
                    $result_check = mysqli_num_rows($result);
                    $doctor_array = array();
                    ?>
                    <?php if ($result_check > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <?php
                            $doctor_ID = "D" . $row['Doctor_ID'];
                            array_push($doctor_array, $doctor_ID);

                            ?>
                    <tr>
                        <td style="text-align: center;"><img
                                src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']); ?>"
                                alt="doctor_image">
                        </td>
                        <td class="padding-left"><?php echo $row['Full_name']; ?></td>
                        <td class="padding-left"><?php echo $row['Email_address']; ?></td>
                        <td class="padding-left"><?php echo $row['Password']; ?></td>
                        <td class="padding-left"><?php echo $row['Contact_number']; ?></td>
                        <td style="text-align: center;">
                            <i data-modal-target="#view" title="View" class="fas fa-eye"
                                id="view-button-<?php echo $doctor_ID; ?>"></i>
                            <i data-modal-target="#edit" title="Edit" class="fas fa-edit"
                                id="edit-button-<?php echo $doctor_ID; ?>"></i>
                            <a href="admin_doctors.php"><i title="Delete" class="fas fa-trash-alt"
                                    id="delete-button-<?php echo $doctor_ID; ?>"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="6">
                            <h2 class="no-record">No Records Found</h2>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </article>

    <!-- View Doctor -->
    <div class="modal" id="view">
        <!-- Modal content -->
        <div class="modal-content" id="view-doctor">
            <button close-button class="close">&times;</button>
            <h1>View Doctor Details</h1>
            <form id="view-form">
            </form>
        </div>
    </div>

    <!-- Edit Doctor -->
    <div class="modal" id="edit">
        <!-- Modal content -->
        <div class="modal-content" id="edit-doctor">
            <button close-button class="close">&times;</button>
            <h1>Edit Doctor Details</h1>
            <form action="manage_doctor.php" id="edit-form" method="post" enctype="multipart/form-data"
                onsubmit="return validate_edit_doctor();">
            </form>
        </div>
    </div>


    <!-- Add Doctor -->
    <div class="modal" id="add">
        <!-- Modal content -->
        <div class="modal-content" id="add-doctor">
            <button close-button class="close">&times;</button>
            <h1>Add New Doctor</h1>
            <form action="manage_doctor.php" id="add-form" method="post" enctype="multipart/form-data"
                onsubmit="return validate_add_doctor();">
            </form>
        </div>
    </div>
    <div id="overlay"></div>
</main>

<script>
$(document).ready(function() {
    <?php foreach ($doctor_array as $doctor_id) : ?>

    // Load View Doctor Data When Clicked
    $("#view-button-<?php echo $doctor_id; ?>").click(function() {
        var id = "<?php echo str_replace("D", "", $doctor_id) ?>";
        var action = "view";
        $("#view-form").load("manage_doctor_data.php", {
            id: id,
            action: action
        });
    });

    // Load Edit Doctor Data When Clicked
    $("#edit-button-<?php echo $doctor_id; ?>").click(function() {
        var id = "<?php echo str_replace("D", "", $doctor_id) ?>";
        var action = "edit";
        $("#edit-form").load("manage_doctor_data.php", {
            id: id,
            action: action
        });
    });

    // Load Delete Doctor Data When Clicked
    $("#delete-button-<?php echo $doctor_id; ?>").click(function() {
        if (confirm("Are you sure you want to delete this record?")) {
            var id = "<?php echo str_replace("D", "", $doctor_id) ?>";
            var action = "delete";
            $(window).load("manage_doctor_data.php", {
                id: id,
                action: action
            });
        }
    });

    <?php endforeach; ?>

    // Load Add Doctor Data When Clicked
    $("#add-button").click(function() {
        var action = "add";
        $("#add-form").load("manage_doctor_data.php", {
            action: action
        });
    });
});
</script>

<?php
include_once "includes/alert_message.php";
include_once "includes/footer.php";
?>