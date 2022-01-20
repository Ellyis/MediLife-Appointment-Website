<?php
include_once "includes/header.php";
?>
<main id="main">
    <h1 class="title">Inquiries</h1>
    <br>
    <hr>
    <article id="inquiries">
        <div class="content-container">
            <div class="table-container">
                <table>
                    <tr>
                        <th class="padding-left">Inquiry ID</th>
                        <th class="padding-left">Full Name</th>
                        <th class="padding-left">Email Address</th>
                        <th class="padding-left">Contact Number</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM inquiry ORDER BY Inquiry_ID ASC";
                    $result = $conn->query($sql);
                    $result_check = mysqli_num_rows($result);
                    $inquiry_array = array();
                    ?>
                    <?php if ($result_check > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <?php
                            $inquiry_ID = "I" . $row['Inquiry_ID'];
                            array_push($inquiry_array, $inquiry_ID);

                            ?>
                    <tr>
                        <td class="padding-left"><?php echo $row['Inquiry_ID']; ?></td>
                        <td class="padding-left"><?php echo $row['Full_name']; ?></td>
                        <td class="padding-left"><?php echo $row['Email_address']; ?></td>
                        <td class="padding-left"><?php echo $row['Contact_number']; ?></td>
                        <td style="text-align: center;">
                            <i data-modal-target="#view" title="View" class="fas fa-eye"
                                id="view-button-<?php echo $inquiry_ID; ?>"></i>
                            <a href="admin_inquiries.php"><i title="Delete" class="fas fa-trash-alt"
                                    id="delete-button-<?php echo $inquiry_ID; ?>"></i>
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

    <!-- View Doctor -->
    <div class="modal" id="view">
        <!-- Modal content -->
        <div class="modal-content" id="view-inquiry">
            <button close-button class="close">&times;</button>
            <h1>View Inquiry Details</h1>
            <form id="view-form">
            </form>
        </div>
    </div>
    <div id="overlay"></div>
</main>
<script>
$(document).ready(function() {
    <?php foreach ($inquiry_array as $inquiry_id) : ?>

    // Load View Doctor Data When Clicked
    $("#view-button-<?php echo $inquiry_id; ?>").click(function() {
        var id = "<?php echo str_replace("I", "", $inquiry_id); ?>";
        var action = "view";
        $("#view-form").load("manage_inquiry_data.php", {
            id: id,
            action: action
        });
    });

    // Load Delete Doctor Data When Clicked
    $("#delete-button-<?php echo $inquiry_id; ?>").click(function() {
        if (confirm("Are you sure you want to delete this record?")) {
            var id = "<?php echo str_replace("I", "", $inquiry_id); ?>";
            var action = "delete";
            $(window).load("manage_inquiry_data.php", {
                id: id,
                action: action
            });
        }
    });
    <?php endforeach; ?>
});
</script>

<?php
include_once "includes/footer.php";
?>