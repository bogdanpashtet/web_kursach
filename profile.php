<?php
session_start();

if ($_SESSION['user']) {
    $enter = $_SESSION['user']['login'];
} else {
    $enter = "Вход";
}

$title = "Профиль";

include_once "templates/header.html";

$username = $enter;

$link = "";
require_once "templates/connection.php";

$sql = mysqli_query($link, "SELECT snake_name, name, date FROM articles where owner = '" . $username . "';");

require_once "functions/output_articles_func.php";
$content = output_articles($sql);

include_once "templates/profile_template.html";

include_once "templates/footer.html";

?>