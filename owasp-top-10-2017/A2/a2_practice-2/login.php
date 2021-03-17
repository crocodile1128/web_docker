<?php
  if(!defined('INDEX')) {
    die('Direct access is not permitted');
  }

  if ($_SESSION['username'] !== null) {
    echo "<script>location='/?page=admin';</script>";
    die();
  }
?>
<h2>Login</h2>
<div class="row">
  <!-- source code: /check.phps -->
  <form method="POST" action="check.php" role="form">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
    </div>
    <input type="submit" value="Submit" class="btn"/>
    <input type="reset" value="Clear" class="btn"/>  
    <a href="/?page=register">Register</a>
  </form>
 </div>
</div>
