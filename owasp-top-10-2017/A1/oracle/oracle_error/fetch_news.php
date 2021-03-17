<?php
    function fetch_news() {
        include "db_connect.php";
        $sql = "SELECT id, title FROM news";
        $stid = oci_parse($db, $sql);
        $r = oci_execute($stid);
        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } else {
            return $stid;
        }
    }
    function fetch_news_from_id($id) {
        include "db_connect.php";
        $sql = "SELECT title, content FROM news WHERE id=$id";
        if (stristr($sql, 'union') === false) {
            $stid = oci_parse($db, $sql);
            $r = oci_execute($stid);
            if (!$r) {
                $e = oci_error($stid);
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            } else {
                return $stid;
            }
        }
        die("'UNION' detected. Hacker Warning!");
    }
?>
