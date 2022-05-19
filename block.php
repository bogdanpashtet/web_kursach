<?php
session_start();

if ($_SESSION['user']['role'] == 1) {
    $link = new mysqli();
    require_once "templates/connection.php";

    $sql = mysqli_query($link, "UPDATE users SET 
                    status = '0' WHERE login = '{$_POST['username']}';");
}
