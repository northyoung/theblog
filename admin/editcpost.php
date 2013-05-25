<?php
	include('../younginit.php');
?>

<meta http-equiv="Refresh" Content="5;Url=http://<?php echo constant('LOCALHOST')?>/admin/editclass.php">
<?php
include ("./isloginornot.php");

	$_POST['editPost1']=trim($_POST['editPost1']);
	if(!empty($_POST['editPost1'])){
		if(!get_magic_quotes_gpc){
			$editName=addslashes($_POST['editPost1']);
		}else{
			$editName=$_POST['editPost1'];
		}
		$editName=htmlspecialchars($editName);
	}else{
		echo "分类名称不能为空";
		echo "<a href=\"javascript:history.back()\">返回</a>";
		exit;
	}	
	if(!empty($_POST['editNum1'])){
		if(!get_magic_quotes_gpc){
			$editNum=addslashes($_POST['editNum1']);
		}else{
			$editNum=$_POST['editNum1'];
		}
		if(!is_numeric($editNum)){
			echo "请输入正确的id";
			exit;	
		}
	}
	if(!isset($editNum)){
		echo "您还没有输入id值";
		exit();
	}	
		$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
		mysqli_select_db($link,constant('DBNAME'));

		mysqli_query($link,"SET NAMES 'UTF8'");

		$sql = "update young_class set class_name='$editName' where class_id='$editNum'";
		$result=mysqli_query($link, $sql);
		if($result&&(mysqli_affected_rows($link)!=0)){
			echo "更新数据成功";
		}else{
			echo "更新数据失败";
		}
?>
