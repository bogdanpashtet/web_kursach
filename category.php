<?php
session_start();

if ($_SESSION['user']) {
    $enter = $_SESSION['user']['login'];
} else {
    $enter = "Вход";
}

$title = $_GET['category'];


include_once ("templates/header.html");

$category_output = ["Программирование", "Математика", "Физика", "Химия", "Медицина", "Литература", "Искусство", "Экономика"];

for ($i = 0; $i < count($category_output); $i++) {
    if ($category_output[$i] == $_GET['category']) {
        $filled_article_category = $filled_article_category . '<option selected value=" ' . $category_output[$i] . ' ">' . $category_output[$i] . '</option>';
    } else {
        $filled_article_category = $filled_article_category . '<option value="' . $category_output[$i] . '">' . $category_output[$i] . '</option>';
    }
}

$link = new mysqli();
require_once("templates/connection.php");


    $st = "SELECT `snake_name`, `name`, `date` FROM `articles` where (`category` = '" . $title . "')";


$sql = mysqli_query($link, $st);

if (mysqli_num_rows($sql) == 0) {
    $content = "<div class='empty'>Здесь пока ничего нет :(</div>";
}
else{
    require_once "functions/output_articles_func.php";
    $content = output_articles($sql);
}

include_once ("templates/main_part.html");

include_once ("templates/footer.html");