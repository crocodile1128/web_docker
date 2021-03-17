<?php 
    ini_set("session.cookie_httponly", 1);
    session_start(); 

    // 將 session 清空
    unset($_SESSION['username']);
    echo '登出中......';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
?>
