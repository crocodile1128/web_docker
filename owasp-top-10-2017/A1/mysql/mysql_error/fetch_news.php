<?php
    function fetch_news() {
        include "db_connect.php";
        $sql = "SELECT id, title FROM news";
        return $db->query($sql);
    }
    function fetch_news_from_id($id) {
        include "db_connect.php";
        $sql = "SELECT title, content FROM news WHERE id=$id";
        if (stristr($sql, 'union') === false) {
            return $db->query($sql);
        }
        die("'UNION' detected. Hacker Warning!");
    }
?>
