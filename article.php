<?php

$link = "";

require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT * FROM articles where snake_name = '" . $_GET['snake_name'] . "';");

$row = mysqli_fetch_array($sql);

$title = $row['name'];

$content = "
<h1>{$row['name']}</h1>

<div>{$row['text']}</div>

<div align='center'>
    Автор статьи: {$row['author']}<br>
    Год написания статьи: {$row['date']}
</div>";

include_once "templates/layout.html";

?>
