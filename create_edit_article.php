<?php

$link = "";
require_once("templates/connection.php");

if (isset($_GET['snake_name_url'])) {
    $title = "Изменить статью";
    include_once ("templates/header.html");

    $sql = mysqli_query($link, "SELECT * FROM articles where snake_name = '" . $_GET['snake_name_url'] . "';");

    $row = mysqli_fetch_array($sql);

    $filled_article_name = $row['name'];
    $filled_article_text = $row['text'];
    $filled_article_author = $row['author'];
    $filled_article_date = date($row['date']);

    include_once ("templates/create_edit_article.html");

    if(array_key_exists('sub', $_POST)){

        $sql = mysqli_query($link,
            "UPDATE articles SET 
                    name = '{$_POST['article_name']}', 
                    author = '{$_POST['article_author']}', 
                    date = '{$_POST['article_date']}', 
                    category = '{$_POST['article_category']}', 
                    text = '{$_POST['editor1']}' 
                WHERE snake_name = '{$_GET['snake_name_url']}';
                        ");
    }

}
else {
    $title = "Создать статью";
    include_once ("templates/header.html");

    include_once ("templates/create_edit_article.html");

    if(array_key_exists('sub', $_POST)){

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
        }

        header("Location: create_edit_article.php?snake_name_url={$snake_name}");

    }
}

/* закрытие соединения */
$link->close();

include_once ("templates/footer.html");

?>
