<?php
    // we have a flag.php at web root directory
    if (isset($_GET['page'])) {
        $inc = sprintf("%s.php", $_GET['page']);
        include $inc;
    } else {
        echo "<script>location='/?page=upload';</script>";
        die();
    }
?>
