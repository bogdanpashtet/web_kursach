<?php

$mysqli = new mysqli("localhost", "admin", "Ruslan29!", "web_kursach");
/* проверка соединения */
if (mysqli_connect_errno()) {
//    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* вывод информации о хосте */
//printf("Host info: %s\n", $mysqli->host_info);

$link = mysqli_connect("localhost", "admin", "Ruslan29!", "web_kursach"); // Соединяемся с базой

?>
