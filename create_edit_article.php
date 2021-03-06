<?php
session_start();

if ($_SESSION['user']) {

    $enter = $_SESSION['user']['login'];

    $link = new mysqli();
    require_once "templates/connection.php";

    if (isset($_GET['snake_name_url'] )) {

        $title = "Изменить статью";
        include_once ("templates/header.html");

        if ($_SESSION['message']) {
            $msg = '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
        }

        unset($_SESSION['message']);

        $sql = mysqli_query($link, "SELECT * FROM articles where snake_name = '" . $_GET['snake_name_url'] . "';");

        $row = mysqli_fetch_array($sql);

        if ($enter === $row['owner'] or !($_SESSION['user']['role'] == 0)) {

            $filled_article_name = $row['name'];
            $filled_article_text = $row['text'];
            $filled_article_author = $row['author'];
            $filled_article_date = date($row['date']);

            $filled_article_category = "";

            $category_output = ["Программирование", "Математика", "Физика", "Химия", "Медицина", "Литература", "Искусство", "Экономика"];

            for ($i = 0; $i < count($category_output); $i++) {
                if ($category_output[$i] == $row['category']) {
                    $filled_article_category = $filled_article_category . '<option selected value=" ' . $category_output[$i] . ' ">' . $category_output[$i] . '</option>';
                } else {
                    $filled_article_category = $filled_article_category . '<option value="' . $category_output[$i] . '">' . $category_output[$i] . '</option>';
                }
            }

            include_once("templates/create_edit_article.html");

            if (array_key_exists('sub', $_POST)) {

                $sql = mysqli_query($link,
                    "UPDATE articles SET 
                    name = '{$_POST['article_name']}', 
                    author = '{$_POST['article_author']}', 
                    date = '{$_POST['article_date']}', 
                    category = '{$_POST['article_category']}', 
                    text = '{$_POST['editor1']}' 
                WHERE snake_name = '{$_GET['snake_name_url']}';
                        ");

                $_SESSION['message'] = 'Статья успешно сохранена.';

                $snake_name = $_GET['snake_name_url'];

                header("Location: create_edit_article.php?snake_name_url=" . $snake_name);
            }

        } else {
            $msg = '<p class="msg"> ' . 'У Вас нет прав на редактирование данной статьи.' . ' </p>';
            include_once "templates/error_page.html";
        }

    }
    else {
        $title = "Создать статью";
        include_once ("templates/header.html");

        $filled_article_category = '
            <option value="Программирование">Программирование</option>
            <option value="Математика">Математика</option>
            <option value="Физика">Физика</option>
            <option value="Химия" selected>Химия</option>
            <option selected value="Медицина">Медицина</option>
            <option value="Литература">Литература</option>
            <option value="Искусство">Искусство</option>
            <option value="Экономика">Экономика</option>
    ';

        include_once ("templates/create_edit_article.html");

        if(array_key_exists('sub', $_POST)){

            //----------преобразователь в sneak_case----------
            $snake_name = mb_strtolower($_POST['article_name']);

            $snake_name = str_replace(' ', '_', $snake_name);

            $snake_name = str_replace(array('.', ',', '-'),  '', $snake_name);
            //----------преобразователь в sneak_case----------

            $sql = mysqli_query($link,
                "INSERT INTO articles (name, author, date, category, snake_name, text, owner) VALUES(                                                                 
                                                         '{$_POST['article_name']}',
                                                         '{$_POST['article_author']}',
                                                         '{$_POST['article_date']}',
                                                         '{$_POST['article_category']}',
                                                         '" . $snake_name . "',
                                                         '{$_POST['editor1']}',
                                                         '{$_SESSION['user']['login']}');
                    ");

            $_SESSION['message'] = 'Статья успешно сохранена.';

            header("Location: create_edit_article.php?snake_name_url=" . $snake_name);


        }
    }

    /* закрытие соединения */
    $link->close();

} else {
    $enter = "Вход";
    $title = "Создать статью";
    include_once ("templates/header.html");

    $msg = '<p class="msg"> ' . 'Сначала авторизируйтесь на сайте' . ' </p>';

    include_once "templates/error_page.html";
}

include_once ("templates/footer.html");


