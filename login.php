<?php
include 'core/init.php';
if (empty($_POST) === false ) {
    $username       = $_POST['username'];
    $password       = $_POST['password'];
    $remember_me    = $_POST['remember'];
    if (empty($username) === true || empty($password) === true) {
        $errors[] = 'Вы должны ввести логин и пароль!';
    } else if (user_exists($username) === false) {
        $errors[] = 'Такой пользователь не зарегистрирован!' ;
    } else if (user_active($username) === false) {
        $errors[] = 'Ваш аккаунт не активирован!';
    } else {

        if (strlen($password) > 32) {
            $errors[] = 'Пароль слишком длинный!';
        }

        $login = login($username, MD5($password));
        if ($login === false) {
            $errors[] = 'Логин или пароль введены не правильно!';
        } else {
            if ($remember_me === '1') {
                setCookie("username", $username, time()+ 604800, "/");
                setCookie("password", md5($password), time()+ 604800, "/");
            }
            $_SESSION['user_id'] = $login;

            echo "good";
        }
    }
} else {
    $errors[] = 'No data received.';
}
if (empty($errors) === false) {

    echo output_errors($errors);
}
?>
