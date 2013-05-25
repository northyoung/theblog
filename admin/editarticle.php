<?php
include ("./isloginornot.php");
include('../younginit.php');

?>
<html>
	<head>
		<title>文章添加管理</title>
		<meta charset="utf-8" />
		<title>KindEditor PHP</title>
		<link rel="stylesheet" href="../YOUNG/editor/themes/default/default.css" />
		<link rel="stylesheet" href="../eidtor/plugins/code/prettify.css" />
		<script charset="utf-8" src="../editor/kindeditor.js"></script>
		<script charset="utf-8" src="../editor/lang/zh_CN.js"></script>
		<script charset="utf-8" src="../editor/plugins/code/prettify.js"></script>
		<script>
			KindEditor.ready(function(K) {
				var editor1 = K.create('textarea[name="content1"]', {
					cssPath : '../editor/plugins/code/prettify.css',
					uploadJson : '../editor/php/upload_json.php',
					fileManagerJson : '../editor/php/file_manager_json.php',
					allowFileManager : true,
					afterCreate : function() {
						var self = this;
						K.ctrl(document, 13, function() {
							self.sync();
							K('form[name=article]')[0].submit();
						});
						K.ctrl(self.edit.doc, 13, function() {
							self.sync();
							K('form[name=article]')[0].submit();
						});
					}
				});
				prettyPrint();
			});
		</script>
	</head>
	<?php
			$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
			mysqli_select_db($link,constant('DBNAME'));
			mysqli_query($link,"SET NAMES 'UTF8'");


		$sql = "select gid,title from young_blog order by gid";
		$result = mysqli_query($link,$sql);
		while($num=mysqli_fetch_assoc($result))
			echo $num['gid'].'.'.$num['title'].'<br>';
		$count =mysqli_affected_rows($link);		
	?>
	<body><!--获取gid--> 
		<form name="gidtolcoal" method="post" action=editarticle.php>
			<font>请输入要修改文章的gid号码</font><br>
			<input name="gid"></input><br> 
		</form>
	<?php
		$title ='';
		$author ='';
		$lable ='';
		$htmlData ='';
		$class ='';
		if(!empty($_POST['gid'])){
			if(!get_magic_quotes_gpc()){
				$gid = addslashes($_POST['gid']);
			}else{
				$gid = $_POST['gid'];
			}
			if(!is_numeric($gid)){
				echo "请输入正确的gid";
				exit;	
			}
		}
		
		if(isset($gid)){	
			$gid = trim($gid);
		$sql ="select title,author,class,lable,content from young_blog where gid='$gid'";
		$result = mysqli_query($link,$sql) ;
		$num = mysqli_fetch_assoc($result) or die("您输入的数据不存在");
		$title = $num['title'];
		$author = $num['author'];
		$lable = $num['lable'];
		$class = $num['class'];	
		$htmlData =$num['content'];
		}

?>
		<form name="article" method="post" action="editapost.php">
			<input name="gid_post" type="hidden" value=<?php echo $gid ?>></input><br>
			<font>标题</font><br>
			<input name="title" value=<?php echo $title ?>></input><br>
			<font>标签(以分号分开)</font><br>
			<input name="lable" value=<?php echo $lable ?> ></input><br>
			<font>分类</font><br>
			<?php
					$sql="select class_name from young_class order by class_id";
					$result=mysqli_query($link,$sql);
					echo "<select name='class'>";
					while($row=mysqli_fetch_assoc($result)){
						echo "<option value=".$row['class_name'].">".$row['class_name']."</option>"; //value 更新值
					}
					echo "</select><br>";
			?>
			<font>作者</font><br>
			<input name="author" value=<?php echo $author ?>></input><br>
			<font>内容</font><br>
			<textarea name="content1" style="width:700px;height:200px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>	<br />
			<input type="submit" name="button" value="提交内容" /> 
		</form>
	</body>
</html>

<?php
	mysqli_close($link);
?>
