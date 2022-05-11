<?php
session_start();
if ($_SESSION['user']) {
    header('Location: profile.php');
}

$title = "Регистрация";
include_once "templates/header.html";


if ($_SESSION['message']) {
    $msg = '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
}
include_once "templates/registration.html";

unset($_SESSION['message']);


if (array_key_exists('submit_button', $_POST)){

    $link = new mysqli();
    require_once 'templates/connection.php';

    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {

        $password = md5($password);

        $sql = mysqli_query($link, "INSERT INTO users ( login, password, role, status) 
                                    VALUES ( 
                                        '" . $login . "',  
                                        '" . $password . "', 
                                        0,
                                        1);"
        );


        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ./authorization.php');

    } else {
        $msg = '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: /registration.php');
    }

}


include_once "templates/footer.html";
