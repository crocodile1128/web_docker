<?php
	if(!defined('INDEX')) {
		die('Direct access is not permitted');
	}

	if ($_SESSION['username'] === null) {
		echo "<script>alert('login first');location='/?page=login';</script>";
		die();
	}
	$username = $_SESSION['username'];
?>
<h2>FLAG</h2>
<b>CTF{l061c_fl0w_15_b4d455}</b>
