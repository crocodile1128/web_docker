<?php
    // Get input
    $target = $_GET['nslookup'];
    $ret = shell_exec('nslookup ' . $target);
    // Feedback for the end user
    echo "<pre>{$ret}</pre>";
?>
