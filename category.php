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


echo $title;

$content = "<p>$title</p>";

include_once "templates/layout.html";

?>