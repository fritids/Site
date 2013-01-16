<?php
session_start();
session_destroy();
setCookie("username", $username, time() - 604800, "/");
setCookie("password", md5($password), time() - 604800, "/");
header('Location: index.php');
?>
