<?php
	include('../younginit.php');
?>
<meta http-equiv="Refresh" Content="5;Url=http://<?php echo constant('LOCALHOST')?>/admin/editarticle.php" >

<?php
include ("./isloginornot.php");

//从addarticle.php中获取表单内容
	$htmlData = '';
	$title = '';
	$lable = '';
	$class = '';
	$author= '';
	$_POST['content1']=trim($_POST['content1']);
	$_POST['title']=trim($_POST['title']);
	$_POST['lable']=trim($_POST['lable']);
	$_POST['author']=trim($_POST['author']);
	$_POST['gid_post']=trim($_POST['gid_post']);

	if (!empty($_POST['content1'])) {
		if (!get_magic_quotes_gpc()) {
			$htmlData = addslashes($_POST['content1']);
		} else {
			$htmlData = $_POST['content1'];
		}
		if($htmlData>4000000000){
			echo"文章内容超过了最大长度限制.<br>";
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}
	}else{
		echo "文章内容不能为空.<br>";
		echo "<a href=\"javascript:history.back()\">返回</a>";
		exit;
	}
	if(!empty($_POST['title'])) {
		if(!get_magic_quotes_gpc()) {
			$title = addslashes($_POST['title']);
		} else {
			$title = $_POST['title'];
		}
		$title = htmlspecialchars($title);
		if(60<strlen($title)){
			echo "您输入的标题过长了.<br>";
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}
	}else{
		echo"标题不能为空.<br>";
		echo "<a href=\"javascript:history.back()\">返回</a>";
		exit;
		}

	if(!empty($_POST['lable'])) {
		if(!get_magic_quotes_gpc()) {
			$lable = addslashes($_POST['lable']);
		} else {
			$lable = $_POST['lable'];
		}
		$lable = htmlspecialchars($lable);
		if(100<strlen($title)){
			echo "标签长度过长.<br>";
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}
	}else{
		echo "没有添加文章标签.<br>";
		echo "<a href=\"javascript:history.back()\">返回</a>";
		exit;
	}
	if(!empty($_POST['class'])) {
		if(!get_magic_quotes_gpc()) {
			$class = addslashes($_POST['class']);
		} else {
			$class = $_POST['class'];
		}
	}
	if(!empty($_POST['author'])) {
		if(!get_magic_quotes_gpc()) {
			$author= addslashes($_POST['author']);
		} else {
			$author=$_POST['author'];
		}
		$author=htmlspecialchars($author);
		if(40<strlen($author)){
			echo "您输入的作者超过了限定长度.<br>";
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}
	}else{
		echo "没有填写文章作者.<br>";
		echo "<a href=\"javascript:history.back()\">返回</a>";
		exit;
	}
		if(!empty($_POST['gid_post'])){
			if(!get_magic_quotes_gpc()){
				$gid = addslashes($_POST['gid_post']);
			}else{
				$gid = $_POST['gid_post'];
			}
			if(!is_numeric($gid)){
				echo "您输入的gid有误";
				echo "<a href=\"javascript:history.back()\">返回</a>";
				exit;
			}
		}else{
			echo "输入不能为空";
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}
	date_default_timezone_set('Asia/Shanghai');
	$date=date("Y-m-d H:i:s");
	if(!isset($gid)){
		echo "您还没有输入gid号码";
		header("/editarticle.php");
		exit;
	}
//对参数进行检查和过滤

/*插入数据库*/
		$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
		mysqli_select_db($link,constant('DBNAME'));
		mysqli_query($link,"SET NAMES 'UTF8'");
	$sql ="UPDATE young_blog SET content='$htmlData',title='$title',author='$author',lastchangetime='$date',class='$class',lable='$lable' WHERE gid='$gid'";
	$result=mysqli_query($link,$sql);
	if($result){
		echo "更新成功";
	}else{
		echo "更新失败";
//		header("Location:editor.test.php");
	}
?>
