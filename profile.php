<?php
session_start();

if ($_SESSION['user']) {
    $enter = $_SESSION['user']['login'];
} else {
    header('Location: authorization.php');
    $_SESSION['message'] = 'Чтобы просмотреть профиль участников - сначала зарегистрируйтесть или авторизируйтесь на сайте.';
}

$username = $_GET["id"];

if ($_SESSION['user']['login'] == $username){
    $exit = '<p class="logout"><a href="/logout.php">Выйти с профиля</a></p>';
    $create_article = '<p><a class="write_article" href="/create_edit_article.php">Написать статью</a></p>';
}

$title = "Профиль";

include_once "templates/header.html";


$link = "";
require_once "templates/connection.php";

$sql = mysqli_query($link, "SELECT snake_name, name, date FROM articles where owner = '" . $username . "';");

require_once "functions/output_articles_func.php";
$content = output_articles($sql);

include_once "templates/profile_template.html";

include_once "templates/footer.html";

?>