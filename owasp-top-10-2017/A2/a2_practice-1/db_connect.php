<?php
    $db_host = "mysql";
    $db_name = "A2-Practice1";
    $db_user = "root";
    $db_password = "root";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    
    try {
        $db = new PDO($dsn, $db_user, $db_password);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
?>
