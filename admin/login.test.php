<?php
	include("../younginit.php");
	/*
	 *登录验证类
	 *
	 */
	$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
	mysqli_select_db($link,constant('DBNAME'));

	mysqli_query($link,"SET NAMES 'UTF8'");

	$today = date("Y-m-d H:i:s");
	$password=md5($_POST['pwd']);
	$uname=$_POST['uname'] ;
	$query="SELECT * FROM young_user WHERE userName='$uname' AND userPwd='$password'";
	$result = @mysqli_query($link,$query);
	$numrows = mysqli_num_rows($result);

	if($numrows == 0){
		header("Location:logindefault.php");
	}else{
		header("Location:./admin.php");
		$cookieName=md5('thenorthyoung');
		setcookie("cookie",$cookieName,time()+3600*24,constant('LOCALHOST')."/admin");
	}
?>
