<?php
    // Get input
    $target = $_GET['user'];
    $cmd = 'cat /etc/passwd | awk \'BEGIN{ FS=":"; USER="' . $target . '" } { if (USER == $1) print $6 }\'';
    if ((stristr($target, '}') === FALSE)
        && (stristr($target, '\\\'') === FALSE)
        && (stristr($target, 'bin') === FALSE)) {
        $ret = shell_exec($cmd);
        // Feedback to the end user
        echo "<pre>{$target}'s home directory is {$ret}</pre>";
    } else {
        die('Invalid char(s) detected!');
    }
    echo "<!-- {$cmd} -->";
?>
