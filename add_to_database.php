<?php

$link = "";

require_once("templates/connection.php");

if (isset($_POST['article_category']) &&
    isset($_POST['article_name']) &&
    isset($_POST['article_date']) &&
    isset($_POST['article_author']) &&
    isset($_POST['editor1']))
{

    //----------преобразователь в sneak_case----------
    $snake_name = mb_strtolower($_POST['article_name']);

    $snake_name = str_replace(' ', '_', $snake_name);

    $snake_name = str_replace(array('.',','),  '', $snake_name);
    //----------преобразователь в sneak_case----------

    $sql = mysqli_query($link,
        "INSERT INTO articles (name, author, date, category, snake_name, text) VALUES(
                                                                     '{$_POST['article_name']}',
                                                                     '{$_POST['article_author']}',
                                                                     '{$_POST['article_date']}',
                                                                     '{$_POST['article_category']}',
                                                                     '{$snake_name}',
                                                                     '{$_POST['editor1']}');
                        ");

//    Если вставка прошла успешно
    if ($sql) {
        echo '<p>Данные успешно добавлены на сайт.</p>';
    } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
}

/* закрытие соединения */
$link->close();

header("Location: create_edit_article.php");

?>
