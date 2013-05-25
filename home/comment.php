<?php

$commentName='';
$commentText='';
$commentEmail='';
$commentTime='';
$tmp_num='';
$_POST['comment_name']=trim($_POST['comment_name']);
$_POST['comment_text']=trim($_POST['comment_text']);
$_POST['comment_email']=trim($_POST['comment_email']);
	if(!empty($_POST['comment_name'])){
		if(!get_magic_quotes_gpc()){
			$commentName=addslashes($_POST['comment_name']);
		}else{
			$commentName=$_POST['comment_name'];
		}
		$commentName=htmlspecialchars($commentName);
	}else{
		echo "sorry...昵称不能为空";	
	    echo "<a href=\"javascript:history.back()\">返回</a>";
	}	
	if(!empty($_POST['comment_email'])){
		if(!get_magic_quotes_gpc()){
			$commentEmail = addslashes($_POST['comment_email']);
		}else{
			$commentEmail = $_POST['comment_email'];
		}
		if(!preg_match_all("/([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?/i",$commentEmail)){
			echo "请输入正确的email格式";
			echo "<a href=\"javascript:history.back()\">返回</a>";
		}
	}
	if(!empty($_POST['comment_text'])){
		if(!get_magic_quotes_gpc()){
			$commentText = addslashes($_POST['comment_text']);
		}else{
			$commentText = $_POST['comment_text'];
		}
		$commentText=htmlspecialchars($commentText);
	}else{
		echo "您的留言内容不能为空";
	    echo "<a href=\"javascript:history.back()\">返回</a>";
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
	$link = mysqli_connect("localhost","root","123456") or die("数据库无法连接");
	mysqli_select_db($link,"youngdb") or die('数据库无法选择');
	$sql="select gid from young_blog limit $tmp_num,1 ";
	$result=mysqli_query($link,$sql) or die('执行失败') ;
	$a_num=mysqli_fetch_assoc($result); //a_num是文章在数据库中的gid
	$sql="insert into young_comments (gid,comment_name,comment_email,comment_text,comment_time) values ({$a_num['gid']},'$commentName','$commentEmail','$commentText','$commentTime')";
	$result=mysqli_query($link,$sql) or die('无法插入数据');
	if(!$result){
		echo "评论失败<br>";
		echo $tmp_num.'<br>';
		echo $a_num['gid'].'<br>';
		echo $commentName.'<br>';
		echo $commentEmail.'<br>';
		echo $commentText.'<br>';
		echo $commentTime.'<br>';
		echo "<a href=\"javascript:history.back()\">返回</a>";
	}else{
		echo "<a href=".$post_url.'>评论成功</a>';
	}
	mysqli_close($link);
?>
