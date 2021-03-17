<?php
  ini_set("session.cookie_httponly", 1);
  session_start();

  if(!defined('INDEX')) {
    die('Direct access is not permitted');
  }

  if ($_SESSION['username'] !== null) {
    echo "<script>location='/?page=admin';</script>";
    die();
  }
?>
<h2>Register</h2>
<div class="alert alert-danger" role="alert">We're currently under construction. Sorry QQ</div>
