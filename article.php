<?php
session_start();

if ($_SESSION['user']) {
    $enter = $_SESSION['user']['login'];
} else {
    $enter = "Вход";
}

$link = "";

require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT * FROM articles where snake_name = '" . $_GET['snake_name'] . "';");

$row = mysqli_fetch_array($sql);

$title = $row['name'];

include_once ("templates/header.html");

$name = $row['name'];
$text = $row['text'];
$author = $row['author'];
$date = $row['date'];

if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

include_once ("templates/article_template.html");

include_once ("templates/footer.html");

?>
