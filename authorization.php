<?php
session_start();

if ($_SESSION['user']) {
    header('Location: profile.php');
}

$title = "Вход";
include_once "templates/header.html";

if ($_SESSION['message']) {
    $msg = '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
}
include_once "templates/authorization.html";

unset($_SESSION['message']);

if(array_key_exists('submit_button', $_POST)) {

    $link = "";
    require_once 'templates/connection.php';

    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $check_user = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "login" => $user['login'],
            "role" => $user['role'],
            "status" => $user['status']
        ];

        header('Location: profile.php');

    } else {
        $_SESSION['message'] = 'Не верный логин или пароль';
        header('Location: /authorization.php');
    }
}

include_once "templates/footer.html";

?>