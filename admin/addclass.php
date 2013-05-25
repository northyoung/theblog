<?php include ("./isloginornot.php");
?>
<html>
	<head>
		<title>添加分类管理</title>
	</head>

	<body>
		<font>请输入添加的分类名称</font>
		<form name="addclass" method="POST" action="./addcpost.php">
			<input name="addClass" value=""><br>
			<input type="submit" value="submit">
		</form>
	</body>
</html>
