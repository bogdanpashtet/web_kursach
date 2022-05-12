<?php
session_start();

if ($_SESSION['user']) {
    $enter = $_SESSION['user']['login'];
} else {
    $enter = "Вход";
}

$link = new mysqli();

require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT * FROM articles where snake_name = '" . $_GET['snake_name'] . "';");

$row = mysqli_fetch_array($sql);

$title = $row['name'];

include_once ("templates/header.html");

$name = $row['name'];
$text = $row['text'];
$author = $row['author'];
$date = $row['date'];
$owner = "<a href='profile.php?id={$row['owner']}'>{$row['owner']}</a>";

if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
if ($_SESSION['user']) {
    if ($enter == $owner or $_SESSION['user']['role'] == 1) {
        $edit_article = '<button class="button1"><a href="create_edit_article.php?snake_name_url=' . $row['snake_name'] . '">Редактировать статью</a></button>
    <form method="post"><button class="button1" type="submit" name="submit_button" id="submit_button">Удалить</button></form>';
    }
}

if(array_key_exists('submit_button', $_POST)) {

    $sql1 = mysqli_query($link,
        "DELETE FROM articles where snake_name = '" . $_GET['snake_name'] . "';");

    $col = mysqli_fetch_array($sql1);

    header("Location: profile.php");
}


include_once ("templates/article_template.html");


include_once ("templates/footer.html");
