<!-- Script for all pages -->
<script defer src="scripts/index.js"></script>

<!-- Jquery Script -->
<script src="scripts/jquery.js"></script>

<!-- Validate Email Exist Error Script -->
<script defer src="scripts/email_exist_error.js"></script>

<!-- Activate Modal Script -->
<script defer src="admin/scripts/modal.js"></script>

<!-- Form Validation Script -->
<script defer src="admin/scripts/form_validation.js"></script>

<!-- Prevent Resubmission Form From Popping Up Script -->
<script defer src="admin/scripts/prevent_form_resubmission.js"></script>

<!-- Next Banner Script -->
<?php
$file_name = explode("/", $_SERVER['SCRIPT_NAME'])[2];
if ($file_name == "index.php") :
?>
<script defer src='scripts/banner.js'></script>
<?php endif; ?>