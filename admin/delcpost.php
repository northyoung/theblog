<?php
	include('../younginit.php');
?>

<meta http-equiv="Refresh" Content="4;Url=http://<?php echo constant('LOCALHOST')?>/admin/delclass.php">

<?php
include ("./isloginornot.php");
		$id = '';
		$_POST['id'] = trim($_POST['id']);
		if (!empty($_POST['id'])) {
			if (get_magic_quotes_gpc()) {
				$id = addslashes($_POST['id']);
			}	
			 else {
				 $id = $_POST['id'];
			 }
			if(!is_numeric($id)){
				echo "您输入的id有误<br>";
				echo "<a href=\"javascript:history.back()\">返回</a>";
				exit;
			}
		}else{
			echo "id不能为空或ZERO";
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}		
		
		$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
		mysqli_select_db($link,constant('DBNAME'));
		mysqli_query($link,"SET NAMES 'UTF8'");
		$sql = "delete from `young_class` where class_id='$id'";
		$result = mysqli_query($link,$sql);
		if($result=true&&(mysqli_affected_rows($link)!=0)){
			echo "执行成功";
		}else{
			echo "执行失败或者id不存在";
		}
?>
