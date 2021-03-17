<?php
    $db_host = "mssql";
    $db_name = "mssql_error";
    $db_user = "sa";
    $db_password = "yourStrong(!)Password";
    $dsn = "sqlsrv:Server=$db_host;Database=$db_name";
    
    try {
        $db = new PDO($dsn, $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
?>
