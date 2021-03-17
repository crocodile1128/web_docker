<?php
    ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <title>Multilingual Page</title>
        <style>
            .rtl {
                direction: rtl;
            }
        </style>
    </head>
    <body>
<?php
    $dir = "";
    if(isset($_GET['page'])) {
        $dir = str_replace(['.', '/'], '', $_GET['page']);
    }
    if(empty($dir)) {
?>
        <ul>
            <li><a href="/index.php?page=Web">Web</a></li>
            <li><del>Security</del></li>
            <li><a href="/index.php?page=Basic">Basic</a></li>
            <li><a href="/flag.php">Flag</a></li>
        </ul>
<?php
    } else {
        foreach(explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']) as $lang) {
            $l = trim(explode(";", $lang)[0]);
?>
        <p<?=($l==='he')?" class=rtl":""?>>
<?php
    include "$dir/$l.php";
?>
        </p>
<?php
        }
    }
?>
    </body>
</html>
