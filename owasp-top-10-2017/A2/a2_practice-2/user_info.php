<?php
    function user_info($username) {
        include "db_connect.php";
        $username = addslashes($username);
        $sql = "SELECT * FROM users WHERE username = '{$username}'";
        return $db->query($sql);
    }
?>
