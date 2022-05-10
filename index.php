<?php

session_start();

$title = "Архив статей";

$link = "";
$content = '';

require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT name, snake_name, date FROM articles order by date desc;");

$rows_name = [];
$rows_snake_case = [];
$rows_snake_date = [];

while($row = mysqli_fetch_array($sql)) {
    $rows_name[] = $row['0'];
    $rows_snake_case[] = $row['1'];
    $rows_snake_date[] = $row['2'];
}

$content = file_get_contents("templates/main_page_template.html");

$content = $content . '
<style>
.articles {
    display: flex;
    flex-direction: column;
    color: #333333;
    font-size: 14px;
    margin: 3%;
    padding: 3%;
    border: #46a049 3px solid;
}

</style>
<div>
<a class="articles" href="article.php?snake_name=' . $rows_snake_case['0'] . '">' . $rows_name['0'] . '<div>' . $rows_snake_date['0'] . '</div>' . '</a>' . '
<a class="articles" href="article.php?snake_name=' . $rows_snake_case['1'] . '">' . $rows_name['1'] . '<div>' . $rows_snake_date['1'] . '</div>' . '</a>' . '
<a class="articles" href="article.php?snake_name=' . $rows_snake_case['2'] . '">' . $rows_name['2'] . '<div>' . $rows_snake_date['2'] . '</div>' . '</a>' .
'</div>'
;



require_once "templates/layout.html";

?>