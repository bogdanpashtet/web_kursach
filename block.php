<?php
session_start();

if ($_SESSION['user']['role'] == 1  or $_SESSION['user']['role'] == 2) {
    $link = new mysqli();
    require_once "templates/connection.php";

    $sql = mysqli_query($link, "SELECT status FROM users  WHERE login = '{$_GET['id']}';");

    $row = mysqli_fetch_array($sql);
    $status = $row['status'];

    if ($status == 0) {
        $sql = mysqli_query($link, "UPDATE users SET 
                    status = '1' WHERE login = '{$_GET['id']}';");
    } else {
        $sql = mysqli_query($link, "UPDATE users SET 
                    status = '0' WHERE login = '{$_GET['id']}';");
    }

}

header("Location: profile.php?id=" . $_GET['id']);
