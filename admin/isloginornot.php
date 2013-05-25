<?php
	if(!isset($_COOKIE["cookie"])||$_COOKIE["cookie"]!=md5("thenorthyoung")){
		header("Location:howtologin.php");
		exit;
	}
?>
