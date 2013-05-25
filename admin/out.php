<?PHP
	include('../younginit.php');
?>

<meta http-equiv="Refresh" content="1;Url=http://<?php echo constant('LOCALHOST')?>/admin/howtologin.php">
<meta http-equiv="Content-Type" Content="text/html; Charset=utf-8">
<?php 
	if(setcookie("cookie","",time()-3600, constant('LOCALHOST')."/admin")){
		echo "删除COOKIE成功";
	}else{
		echo "删除COOKIE失败";
	}
?>

