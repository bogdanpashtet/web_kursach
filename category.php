<?php
session_start();

if ($_SESSION['user']) {
    $enter = $_SESSION['user']['login'];
} else {
    $enter = "Вход";
}

$title = $_GET['category'];

include_once ("templates/header.html");

$link = "";

require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT snake_name, name, date FROM articles where category = '" . $title . "';");


require_once "functions/output_articles_func.php";
$content = output_articles($sql);

include_once ("templates/main_part.html");

include_once ("templates/footer.html");

?>