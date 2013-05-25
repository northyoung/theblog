<?php
	include ("./isloginornot.php");
	include ("../younginit.php");	
?>

<meta http-equiv="refresh" content="5;url=http://<?php echo constant('LOCALHOST')?>/admin/addarticle.php">
<?php
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
		/*
		 *参数过滤
		 */		
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
		//lable用正则表达式
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
	//等待修改的类选择方式	
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
	date_default_timezone_set('Asia/Shanghai');
	$date=date("Y-m-d H:i:s");
	
//对参数进行检查和过滤

	/*插入数据库*/
				$link=mysqli_connect("localhost",constant('DBUSER'),constant('DBPSW'));
				mysqli_select_db($link,constant('DBNAME'));
				mysqli_query($link,"SET NAMES 'UTF8'");
	$sql ="insert into young_blog(content,title,lable,class,author,date) values('$htmlData','$title','$lable','$class','$author','$date')";
	$result=mysqli_query($link,$sql);
	if($result){
		echo "成功";
	}else{
		echo "失败";
//		header("Location:editor.test.php");
	}
?>

