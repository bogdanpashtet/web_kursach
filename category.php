<?php

switch (($_GET['category'])) {
    case "programming":
        $title = "Программирование";
        break;
    case "math":
        $title = "Математика";
        break;
    case "physics":
        $title = "Физика";
        break;
    case "chemistry":
        $title = "Химия";
        break;
    case "medicine":
        $title = "Медицина";
        break;
    case "literature":
        $title = "Литература";
        break;
    case "art":
        $title = "Искусство";
        break;
    case "economics":
        $title = "Экономика";
        break;
}

$link = "";
$content = '';

require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT name, snake_name FROM articles where category = '" . $title . "';");

//if ($sql) {
//    $content = $content . '<p>Успех!.</p>';
//} else {
//    $content = $content . '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
//}

$rows_name = [];
$rows_snake_case = [];
while($row = mysqli_fetch_array($sql)) {
    $rows_name[] = $row['0'];
    $rows_snake_case[] = $row['1'];
}

$content = '
<div><a href="article.php?snake_name=' . $rows_snake_case['1'] . '">' . $rows_name['1'] . '</a></div>' . '
<div><a href="article.php?snake_name=' . $rows_snake_case['0'] . '">' . $rows_name['0'] . '</a></div>'
;

include_once "templates/layout.html";

?>