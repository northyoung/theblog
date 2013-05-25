<?php
include('../younginit.php');

?>

<meta http-equiv="Refresh" Content="5;Url=http://<?php echo constant('LOCALHOST')?>/admin/delarticle.php">


<?php
include ("./isloginornot.php");
		
		$gid ='';
		$_POST['gid']=trim($_POST['gid']);
		if (!empty($_POST['gid'])) {
		if (get_magic_quotes_gpc()) {
			$gid = stripslashes($_POST['gid']);
			}else{
			$gid = $_POST['gid'];
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

					$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
					mysqli_select_db($link,constant('DBNAME'));


				mysqli_query($link,"SET NAMES 'UTF8'");

		$sql = "delete from `young_blog` where gid='$gid'";
		$result = mysqli_query($link,$sql);
		if($result=true&&(mysqli_affected_rows($link)!=0)){
			echo "执行成功";
		}else{
			echo "删除失败";
		}
?>
