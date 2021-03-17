<?php
    $db_host = "oracle";
    $db_name = "xe";
    $db_user = "sys";
    $db_password = "oracle";
    $tns = "
    (DESCRIPTION =
        (ADDRESS_LIST =
            (ADDRESS = (PROTOCOL = TCP)(HOST = $db_host)(PORT = 1521))
        )
        (CONNECT_DATA =
            (SID = $db_name)
        )
    )
    ";
    
    $db = oci_connect($db_user, $db_password, $tns, "utf8", OCI_SYSDBA);
    if (!$db) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
?>
