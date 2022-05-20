<?php
session_start();

if ($_SESSION['user']) {
    $enter = $_SESSION['user']['login'];
} else {
    header('Location: authorization.php');
    $_SESSION['message'] = 'Чтобы просмотреть профиль участников - сначала зарегистрируйтесть или авторизируйтесь на сайте.';
}

$username = $_GET["id"];

$link = new mysqli();
require_once("templates/connection.php");

$sql = mysqli_query($link, "SELECT status, role FROM users where login = '" . $username . "';");

$row = mysqli_fetch_array($sql);

$status = $row['status'];

if ($status == 1) {
    $status = "Активен";
}else {
    $status = "Заблокирован";
}

$role = $row['role'];

if ($role == 0) {
    $role = "Пользоватеь";
}elseif ($role == 1) {
    $role = "Редактор";
}else {
    $role = "Администратор";
}


if ($_SESSION['user']['login'] == $username){
    $exit = '<p class="logout"><a href="/logout.php">Выйти с профиля</a></p>';
    $create_article = '<p><a class="write_article" href="/create_edit_article.php">Написать статью</a></p>';
}

if ($_SESSION['user']['role'] == 2 && !($_SESSION['user']['login'] == $username)){
    $exit = '<p class="logout"><a href="/block.php?id=' . $username . '">Изменить статус.</a></p>
             <p class="logout"><a href="/make_editor.php?id=' . $username . '">Изменить роль.</a></p>';
}

if ($_SESSION['user']['role'] == 1 && !($_SESSION['user']['login'] == $username) && $role="Пользователь") {
    $exit = '<p class="logout"><a href="/block.php?id=' . $username . '">Изменить статус.</a></p>';
}

$title = "Профиль";

include_once "templates/header.html";

$sql = mysqli_query($link, "SELECT snake_name, name, date FROM articles where owner = '" . $username . "';");

if (mysqli_num_rows($sql) === 0) {
    $content = "<div class='empty'>Здесь пока ничего нет :(</div>";
}
else{
    require_once "functions/output_articles_func.php";
    $content = output_articles($sql);
}

include_once "templates/profile_template.html";

include_once "templates/footer.html";
