<?php

$title = "Создать статью";
//$title = $_GET['category'];
//$title = $_GET['snake_name'];

$content = file_get_contents("templates/create_edit_article.html");

require_once "templates/layout.html";

?>
