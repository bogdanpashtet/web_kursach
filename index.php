<?php
session_start();

if ($_SESSION['user']) {
    $enter = $_SESSION['user']['login'];
} else {
    $enter = "Вход";
}

$title = "Архив статей";

$link = "";

include_once ("templates/header.html");

require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT snake_name, name, date FROM articles order by date desc limit 5;");

$content = file_get_contents("templates/main_page_template.html");

require_once "functions/output_articles_func.php";
$content = output_articles($sql, $content);

include_once ("templates/main_part.html");

include_once ("templates/footer.html");

?>