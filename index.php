<?php

session_start();

$title = "Архив статей";

$content = file_get_contents("templates/main_page_template.html");

$content = $content . "
    <h1>Говно</h1>
    <h1>Говно</h1>
    <h1>Говно</h1>
    <h1>Говно</h1>
    <h1>Говно</h1>
    <h1>Говно</h1>
    <h1>Говно</h1>
    <h1>Говно</h1>
    <h1>Говно</h1>
    <h1>Говно</h1>
    <h1>Говно</h1>Ы
    <h1>Говно</h1>
    <h1>Говно</h1>
    <h1>Говно</h1>
";

require_once "templates/layout.html";

?>