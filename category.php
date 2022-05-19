<?php
session_start();

if ($_SESSION['user']) {
    $enter = $_SESSION['user']['login'];
} else {
    $enter = "Вход";
}

$title = $_GET['category'];

include_once ("templates/header.html");

include_once "templates/search.html";

$link = new mysqli();
require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT snake_name, name, date FROM articles where category = '" . $title . "';");

if (mysqli_num_rows($sql) === 0) {
    $content = "<div class='empty'>Здесь пока ничего нет :(</div>";
}
else{
    require_once "functions/output_articles_func.php";
    $content = output_articles($sql);
}

include_once ("templates/main_part.html");

include_once ("templates/footer.html");