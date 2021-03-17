<?php
    include "db_connect.php";
    $username = addslashes($_POST['username']);
    $email = addslashes($_POST['email']);
    $inputEmail = addslashes($_POST['inputEmail']);
    if ($email !== $inputEmail) {
        die("You are not the owner of this account!");
    }
    $sql = "SELECT password FROM users WHERE username = '{$username}'";
    $result = $db->query($sql);

    $row = $result->fetch();
    echo json_encode(array('password' => $row['password']));
?>
