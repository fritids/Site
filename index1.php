<?php 
include 'core/init.php';
include 'includes/overall/header.php'; 
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<h1>Home</h1>
<p>Just a template.</p>
<?php
if (isset($session_user_id)) {
    if (has_access($session_user_id, 1) === true) {
        echo "Admin!";
    } else if (has_access($session_user_id, 2) === true) {
        echo "Moderator!";
    }
}
include 'includes/overall/footer.php'; 
?>
