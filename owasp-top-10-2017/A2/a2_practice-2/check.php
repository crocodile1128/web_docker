<?php 
    ini_set("session.cookie_httponly", 1);
    session_start();

    include "user_info.php";

    $username = $_POST['username']; 
    $password = $_POST['password'];
    if ($username === "") {
        echo "<script>alert('username plz');location='/?page=login';</script>";
    } else if ($password === "") {
        echo "<script>alert('password plz');location='/?page=login';</script>";
    } else {
        $result = user_info($username);
        $row = $result->fetch();
        if($row['password'] === md5($password)) {
            $_SESSION['username'] = $username;
            echo "<script>location='/?page=admin';</script>";
        } else {
            echo "<script>alert('wrong password');location='/?page=login';</script>";
        }
    }
?>
