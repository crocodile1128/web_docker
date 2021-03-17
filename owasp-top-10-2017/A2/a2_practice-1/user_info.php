<?php
    function user_info($username) {
        include "db_connect.php";
        $username = addslashes($username);
        $sql = "SELECT email FROM users WHERE username = '{$username}'";
        return $db->query($sql);
    }

    $username = $_POST['username'];
    $result = user_info($username);
    $row = $result->fetch();
    if ($row['email'] !== null) {
        echo json_encode(array('email' => $row['email']));
    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    }
?>
