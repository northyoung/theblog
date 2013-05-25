<meta http-equiv="Content-type" Content="text/html;Charset=utf-8">
<?php
	include("../younginit.php");
	$url="http://".constant('LOCALHOST')."/admin/howtologin.php";
?>

<head>
	<title>登录失败</title>
	<meta  http-equiv="refresh" content="3;url=<?php echo $url; ?>">
</head>
<body>
	<div>登录失败</div><br>
	<div>3秒之后网页自动跳转</div>
</body>
