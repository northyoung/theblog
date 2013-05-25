<?php
include ("./isloginornot.php");
include('../younginit.php');


		$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
		mysqli_select_db($link,constant('DBNAME'));
		mysqli_query($link,"SET NAMES 'UTF8'");
		$sql = "select class_id,class_name from young_class order by class_id";
		$result = mysqli_query($link,$sql);
		while($num=mysqli_fetch_assoc($result))
			echo $num['class_id'].'.'.$num['class_name'].'<br>';
	?>


<html>
	<head>
	</head>
	<body>
		<form name="gid_class" method="post" action=delcpost.php>
			<font>请输入要删除类的id号码</font><br>
			<input name="id"></input><br> 
		</form>
	</body>
</html>
