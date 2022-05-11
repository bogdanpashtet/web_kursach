<?php

function output_articles ($sql, $content="") {
    // стили для списка статейЫ
    $content = $content . '
    <link rel="stylesheet" href="../styles/article_list_style.css">
    <div>';

    // --------- выводим статьи ---------
    while($row = mysqli_fetch_array($sql)) {
        $content = $content . "<a class='articles' href='article.php?snake_name={$row['0']}'>{$row['1']}<div>{$row['2']}</div></a>";
    }

    $content = $content . '</div>';

    return $content;
}

?>
