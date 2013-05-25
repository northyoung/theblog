<?php include ("./isloginornot.php");
	  include ("../younginit.php");
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
	<body>
		<form name="article" method="post" action="addapost.php">
			<font>标题</font><br>
			<input name="title"></input><br>
			<font>标签(以分号分开)</font><br>
			<input name="lable"></input><br>
			<font>分类</font><br>
			<?php
				$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
				mysqli_select_db($link,constant('DBNAME'));
				mysqli_query($link,"SET NAMES 'UTF8'");
				$sql="select class_name from young_class order by class_id";
				$result = mysqli_query($link,$sql);
					echo "<select name='class'>";
				while($row=mysqli_fetch_assoc($result)){
					echo "<option value=".$row['class_name'].">".$row['class_name']."</option>";
				}
				echo "</select><br>";
?>
			<font>作者</font><br>
			<input name="author"></input><br>
			<font>内容</font><br>
			<textarea name="content1" style="width:700px;height:200px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>	<br />
			<input type="submit" name="button" value="提交内容" /> 
		</form>
	</body>
</html>

<?php
	mysqli_close($link);
?>
