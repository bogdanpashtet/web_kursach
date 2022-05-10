<?php

$title = "Создать статью";
//$title = $_GET['category'];
//$title = $_GET['snake_name'];


$link = "";

require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT snake_name, name, date FROM articles order by date desc limit 5;");

$content = file_get_contents("templates/create_edit_article.html");

require_once "templates/layout.html";

?>
