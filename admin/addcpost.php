<?php
include ("./isloginornot.php");
include('../younginit.php');
?>
<meta http-equiv="Refresh" Content="5;Url=http://<?php echo constant('LOCALHOST')?>/admin/addclass.php">
<?php
	$_POST['addClass'] = trim($_POST['addClass']);
	if(!empty($_POST['addClass'])){
		if(!get_magic_quotes_gpc()){
			$className = addslashes($_POST['addClass']);
		}else{
			$className = $_POST['addClass'];
		}
		$className = htmlspecialchars($className);
		if(100<strlen($className)){
			echo "您输入的类型名字过长<br>";
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}
	}else{
		echo "请输入分类名称<br>";
		echo "<a href=\"javascript:history.back()\">返回</a>";
		exit;
	}
		$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
		mysqli_select_db($link,constant('DBNAME'));

				mysqli_query($link,"SET NAMES 'UTF8'");

	$sql = "insert into young_class(class_name) values('$className')";
	$result = mysqli_query($link,$sql);
	if($result){
		echo "插入分类成功";
	}else{
		echo "插入分类失败";
	}
?>
