<?php
    $db_host = "mssql";
    $db_name = "mssql_union";
    $db_user = "sa";
    $db_password = "yourStrong(!)Password";
    $dsn = "sqlsrv:Server=$db_host;Database=$db_name";
    
    try {
        $db = new PDO($dsn, $db_user, $db_password);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
?>
