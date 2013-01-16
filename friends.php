<?php 
include 'core/init.php';

if (isset($_POST['func']) === true && $_POST['func'] === 'add') {
    add_friend_request($_POST['friend'], $_POST['user']);
    echo "Friend request add";
}
if ($_GET['state'] === 'accept' || $_GET['state'] === 'decline') {
    request_accept($_GET['friend'], $_GET['user'], $_GET['state']);
    header('Location: request.php');
}

?>