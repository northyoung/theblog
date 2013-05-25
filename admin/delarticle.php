<?php
include ("./isloginornot.php");
include('../younginit.php');

		$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
		mysqli_select_db($link,constant('DBNAME'));
		mysqli_query($link,"SET NAMES 'UTF8'");
		$sql = "select gid,title from young_blog order by gid";
		$result = mysqli_query($link,$sql);
		while($num=mysqli_fetch_assoc($result))
			echo $num['gid'].'.'.$num['title'].'<br>';
	?>


<html>
	<head>
	</head>
	<body>
		<form name="gid_article" method="post" action=delapost.php>
			<font>请输入要删除文章的gid号码</font><br>
			<input name="gid"></input><br> 
		</form>
	</body>
</html>
