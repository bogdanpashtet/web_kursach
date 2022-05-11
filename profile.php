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

require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT snake_name, name, date FROM articles where owner = '" . $username . "';");

// стили для статей
$content = '
<link rel="stylesheet" href="styles/article_list_style.css">
<div>';

// --------- выводим статьи ---------
while($row = mysqli_fetch_array($sql)) {
    $content = $content . "<a class='articles' href='article.php?snake_name={$row['0']}'>{$row['1']}<div>{$row['2']}</div></a>";
}

include_once "templates/profile_template.html";

include_once "templates/footer.html";

?>