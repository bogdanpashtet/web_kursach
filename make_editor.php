<?php
session_start();

if ($_SESSION['user']['role'] == 1 or $_SESSION['user']['role'] == 2) {
    $link = new mysqli();
    require_once "templates/connection.php";

    $sql = mysqli_query($link, "SELECT role FROM users  WHERE login = '{$_GET['id']}';");

    $row = mysqli_fetch_array($sql);
    $role = $row['role'];

    if ($role == 0) {
        $sql = mysqli_query($link, "UPDATE users SET 
                    role = '1' WHERE login = '{$_GET['id']}';");
    } else {
        $sql = mysqli_query($link, "UPDATE users SET 
                    role = '0' WHERE login = '{$_GET['id']}';");
    }
}

header("Location: profile.php?id=" . $_GET['id']);