<?php
    function fetch_news() {
        include "db_connect.php";
        $sql = "SELECT id, title FROM News";
        return $db->query($sql);
    }
    function fetch_news_from_id($id) {
        include "db_connect.php";
        $sql = "SELECT title, content FROM News WHERE ID=$id";
        if (stristr($sql, 'union') === false) {
            return $db->query($sql);
        }
        die("'UNION' detected. Hacker Warning!");
    }
?>
