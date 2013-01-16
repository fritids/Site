<?php
session_start();
//error_reporting(0);
ini_set('output_buffering', 1);
$base_url = "http://" . $_SERVER['SERVER_NAME'] . "/";
require 'database/connect.php';
require 'function/general.php';
require 'function/users.php';
require 'function/city.php';

$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
$current_file = end($current_file);


if (logged_in() === true) {
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email', 'password_recover', 'type', 'allow_email', 'profile', 'city_id');
    if (user_active($user_data['username']) === false) {
        session_destroy();
        header('Location: index.php');
        exit();
    }
    if ($current_file !== 'changepassword.php' && $user_data['password_recover'] == 1) {
        header('Location: changepassword.php?force');
        exit();
    }
}else{
    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        // если же такие имеются
        // то пробуем авторизовать пользователя по этим логину и паролю
        $username = mysql_real_escape_string($_COOKIE['username']);
        $password = mysql_real_escape_string($_COOKIE['password']);

        $login = login($username, MD5($password));
        if ($login === false) {

            $_SESSION['user_id'] = $login;
            // не забываем, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
        }
        else {
            // только мы не будем давай ссылку на форму авторизации
            // вдруг человек и не хочет был авторизованым
            // а пришел просто поглядеть на наши страницы как гость
        }
    }
}

$errors = array();
?>
