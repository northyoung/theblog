<meta http-equiv="Content-Type" Content="text/html;Charset=utf-8">

<?php
	if($_COOKIE["cookie"]==md5("thenorthyoung"))
	header("Location:./admin.php");
?>
<head>
	<title>测试函数</title>
</head>
<body>
	<form method="post" action="login.test.php" id="login-form">
		<ul>
			<li class="dark-row">
				<span class="list_width">用户名</span>
				<input type="text" class="text-box" size="15" name="uname">
			</li>
			<li>
				<span class="list_width">密&nbsp;&nbsp;码</span>
				<input type="password" class="text-box" size="15"name="pwd">
			</li>
			<li class="dark-row">
				<input type="hidden" name="action" value="logic">
				<span class="list_width">&nbsp;</span>
				<input type="submit" class="button" value="登录系统"/>
			</li>
		</ul>
	</form>
</body>	




