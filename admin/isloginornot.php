<?php
	if(!isset($_COOKIE["cookie"])||$_COOKIE["cookie"]!=md5("admin")){
		header("Location:howtologin.php");
		exit;
	}
?>
