<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php
include("./younginit.php");
session_start();
$commentName='';
$commentText='';
$commentEmail='';
$commentTime='';
$tmp_num='';
$commentYourPage='';

$_POST['comment_name']=trim($_POST['comment_name']);
$_POST['comment_text']=trim($_POST['comment_text']);
$_POST['comment_email']=trim($_POST['comment_email']);
$_POST['comment_yourpages']=trim($_POST['comment_yourpages']);

	if(!empty($_POST['val'])){
		if(!(strtolower($_POST['val'])==strtolower($_SESSION['code']))){	
			echo "您输入的验证码有误";
			echo "<a href=\"javascript:history.go(-1)\">返回</a>";//此处有BUG
			exit;		
		}
	}else{
		echo "请输入验证码";
		echo "<a href=\"javascript:history.back()\">返回</a>";//此处有bug
		exit;
	}

	if(!empty($_POST['comment_name'])){
		if(strlen($_POST['comment_name'])>30){
			echo '您输入的名字过长';
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}
		if(!get_magic_quotes_gpc()){
			$commentName=addslashes($_POST['comment_name']);
		}else{
			$commentName=$_POST['comment_name'];
		}
		$commentName=htmlspecialchars($commentName);
	}else{
		echo "sorry...昵称不能为空";	
		echo "<a href=\"javascript:history.back()\">返回</a>";
		exit;
	}	


	if(!empty($_POST['comment_email'])){
		if(!get_magic_quotes_gpc()){
			$commentEmail = addslashes($_POST['comment_email']);
		}else{
			$commentEmail = $_POST['comment_email'];
		} 
		if(!preg_match("/^[a-z0-9]([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i",$commentEmail)){
		echo "请输入正确的email格式<br>";
		echo "<a href=\"javascript:history.back()\">返回</a>";
		exit;
		}
	}else{
			echo "请填写email地址";
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
	}


	if(!empty($_POST['comment_yourpages'])){
		if(!get_magic_quotes_gpc()){
			$commentYourPage = addslashes($_POST['comment_yourpages']);
		}else{
			$commentYourPage = $_POST['comment_yourpages'];
		}
		if(!preg_match("/^(((ht|f)tp(s?))\:\/\/)?(www.|[a-zA-Z].)[a-zA-Z0-9\-\.]+\.(com|edu|gov|mil|net|org|biz|info|name|museum|us|ca|uk)(\:[0-9]+)*(\/($|[a-zA-Z0-9\.\,\;\?\'\\\+&amp;%\$#\=~_\-]+))*$/i",$commentYourPage)){
			echo "请输入正确格式网址";
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}
	}


	if(!empty($_POST['comment_text'])){
		if(strlen($_POST['comment_text'])>1000){
			echo '您输入的内容过长';
			echo "<a href=\"javascript:history.back()\">返回</a>";
			exit;
		}
		if(!get_magic_quotes_gpc()){
			$commentText = addslashes($_POST['comment_text']);
		}else{ 
			$commentText = $_POST['comment_text'];
		}
		$commentText=htmlspecialchars($commentText);
	}else{
		echo "您的留言内容不能为空";
		echo "<a href=\"javascript:history.back()\">返回</a>";
		exit;
	}	
	$tmp_num=0;
	if(!$_POST['page']){
		$_POST['page']=1;
	}
	if(isset($_POST['title'])){
		if(isset($_POST['page'])){
			$tmp_num=$_POST['title']+($_POST['page']-1)*5-1;
		}else{
			$tmp_num=$_POST['title']-1; 
		}
	}

	if(isset($_POST['url'])){
		$post_url=$_POST['url'];
	}
		
	date_default_timezone_set("Asia/Shanghai");
	$commentTime=date("Y/m/d H:i:s");
	$link = mysqli_connect("localhost",constant('DBUSER'),constant('DBPSW')) or die("数据库无法连接");
	mysqli_select_db($link,constant('DBNAME')) or die('数据库无法选择');
	mysqli_query($link,"SET NAMES 'UTF8'");
	$sql="select gid from young_blog order by gid DESC limit $tmp_num,1";
	$result=mysqli_query($link,$sql) or die('执行失败');
	$a_num=mysqli_fetch_assoc($result); //a_num是文章在数据库中的gid
	$sql="insert into young_comments (gid,comment_name,comment_email,comment_yourpage,comment_text,comment_time) values ({$a_num['gid']},'$commentName','$commentEmail','$commentYourPage','$commentText','$commentTime')";
	$result=mysqli_query($link,$sql) or die('无法插入数据');
	if(!$result){
		echo "评论失败<br>";
	  /*echo $tmp_num.'<br>';
		echo $a_num['gid'].'<br>';
		echo $commentName.'<br>';
		echo $commentEmail.'<br>';
		echo $commentYourPage.'<br>';
		echo $commentText.'<br>';
		echo $commentTime.'<br>';*/
		echo "<a href=\"javascript:history.back()\">返回</a>";
	}else{
		echo "<a href=".$post_url.'#comments>评论成功</a>';
	}
	mysqli_close($link);
?>
