<?php

$title = $_GET['category'];

$link = "";

require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT snake_name, name, date FROM articles where category = '" . $title . "';");

// стили для статей
$content = '
<link rel="stylesheet" href="styles/article_list_style.css">
<div>';

// --------- выводим статьи ---------
while($row = mysqli_fetch_array($sql)) {
    $content = $content . '<a class="articles" href="article.php?snake_name=' . $row['0'] . '">' . $row['1'] . '<div>' . $row['2'] . '</div>' . '</a>';
}

$content = $content . '</div>';
// --------- выводим статьи ---------

include_once "templates/layout.html";

?>