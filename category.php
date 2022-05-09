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

$mysqli = new mysqli("localhost", "admin", "Ruslan29!", "web_kursach");
/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
/* вывод информации о хосте */
printf("Host info: %s\n", $mysqli->host_info);


$link = mysqli_connect("localhost", "admin", "Ruslan29!", "lab2"); // Соединяемся с базой

// Ругаемся, если соединение установить не удалось
if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
}

$content = "<p>$title</p>";

include_once "templates/layout.html";

?>