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
<?php
	$_POST['editClass']=trim($_POST['editClass']);
	if(!empty($_POST['editClass'])){
		if(!get_magic_quotes_gpc){
			$editnum=addslashes($_POST['editClass']);
		}else{
			$editnum=$_POST['editClass'];
		}
		if(!is_numeric($editnum)){
			echo "您输入的id有误<br>";
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}
	}
	if(isset($editnum)){
		$sql = "select class_name from young_class where class_id='$editnum'";
		$result = mysqli_query($link,$sql);
		if(!mysqli_affected_rows($link)){
			echo "无法找到该id";
		}
		while($num=mysqli_fetch_assoc($result)){
			$editname = $num['class_name'];
		}
	}
?>

<html>
	<head>
		<title>分类更改</title>
	</head>

	<body>
		<font>请输入要更改的分类id</font>
		<form name="editclass" method="post" action ="./editclass.php">
			<input name="editClass"/><br>
			<input type="submit" value="提交ID">		
		</form>
		<font>请输入分类名称</font>
		<form name="editpost" method="post" action="./editcpost.php">
		<input name="editPost1" value="<?php echo $editname?>"/><br>
		<input name="editNum1"  type="hidden" value="<?php echo $editnum ?>"/>
		<input type="submit" value="提交"/>
		</form>
	</body>
</html>


