<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	require("./younginit.php");
?>	
<html>
	<head>
		<title>purpose</title>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
		<link rel="icon" href="http://<?php echo constant("LOCALHOST")?>/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" type="text/css" href="./css/index.css"/>
<!-- 导航栏的css--!>
		<link rel="stylesheet" type="text/css" href="./css/container.css">
		<link class="jqueryui library" rel="stylesheet" type="text/css" href="./css/jquery-ui-1.9.1.custom.min.css">
		<script class="jquery library" src="./js/jquery-1.8.3.min.js" type="text/javascript"></script>
		<script class="jqueryui library" src="./js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
<!----!>
	</head>
</html>
<?php
	$url=$_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"],'?')?'':"?");
	$parse=parse_url($url);
	if(isset($parse["query"])){
		parse_str($parse['query'],$params);
		unset($params["title"]);
		unset($params["lable"]);
		unset($params["comment"]);
		unset($params["class"]);
		$url=$parse['path'].'?'.http_build_query($params);
	}
/*
function getid(){
	$url=$_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"],'?')?'':"?");
	$parse=parse_url($url);
	if(isset($parse["query"])){
		parse_str($parse['query'],$params);
		unset($params["id"]);
		$url=$parse['path'].'?'.http_build_query($params);
	}
	echo $url;
}
function getlable(){
	$url=$_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"],'?')?'':"?");
	$parse=parse_url($url);
	if(isset($parse["query"])){
		parse_str($parse['query'],$params);
		unset($params["lable"]);
		$url=$parse['path'].'?'.http_build_query($params);
	}
	echo $url;
}
function getcommet(){
	$url=$_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"],'?')?'':"?");
	$parse=parse_url($url);
	if(isset($parse["query"])){
		parse_str($parse['query'],$params);
		unset($params["comment"]);
		$url=$parse['path'].'?'.http_build_query($params);
	}
	echo $url;
}


print_r($parse);

	if(isset($_GET['lable'])){
		echo "set lable";
	}
	if(isset($_GET['comment'])){
		echo "set commet";
	}	
 */
function ed_getTag_style()
        {
                //最小字体大小
                $minSize=10;
                //最大字体大小
                $maxSize=30;
                return 'font-size:'.floor(($minSize+lcg_value()*(abs($maxSize-$minSize)))).'px';  
        }
?>	
<html>
	<body>
		<div id="wrap">

			<div id="navigation"> 
				<ul id="nav">
				<li><a href="http://<?php echo constant("LOCALHOST")?>/home/">Home</a></li>
				<li id="selected"><a href="http://<?php echo constant("LOCALHOST")?>">Blog</a></li>
				<li><a href="http://<?php echo constant("LOCALHOST")?>/about/">About</a></li>
				</ul>
			<script type="text/javascript" src="./js/container.js"></script>
			</div>
			<div id="content" style="font-family:'Microsoft YaHei';" >
<!-- page and title --!>
<?php
		include('index.title.php');
		include('index.class.php');
		include('index.lable.php');
					include "page.class.php";
	
					$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
					mysqli_select_db($link,constant('DBNAME'));
					mysqli_query($link,"SET NAMES 'UTF8'");

					$result=mysqli_query($link,"select * from young_blog order by gid DESC");

					$total=mysqli_num_rows($result);
 
					$num=5;
	
					$page=new Page($total, $num, "");

					$sql="select * from young_blog order by gid DESC {$page->limit}";

					$result=mysqli_query($link,$sql) or die("语句执行失败");
					
					$id = 1;
					$sid =1;
					$cid =1;
					echo "<div id='main'>";
					while($row=mysqli_fetch_assoc($result)){
						echo "<div class='title'><img src='./image/favicon.ico'></img><a href='{$url}&title=".($id++)."'>".$row['title'].'</a></div>';
						echo "<div class='message'><span class='author'>".$row['author'].'</span><span class="createtime"> '.$row['date'].'</span>';					   		echo "<span class=comment><a href='{$url}&title=".($cid++)."#comments'>评论</a></span><span class='see'><a href='{$url}&title=".($sid++)."'>".$row['visit']."人阅读</a></span></div>";			
						//文章内容先进行图片匹配然后进行文字匹配
						if(strlen($row['content'])>1000){
							$tmp_content = substr($row['content'],0,1000);
						}else{
							$tmp_content=$row['content'];
						}
						echo "<div class='content'>".$tmp_content.'</div>';
						echo "<span class='title_class'><a href='{$url}&class=".$row['class']."'>".$row['class']."</a></span>";
						echo "<span class='lable'><a href='{$url}&lable=".$row['lable']."'>".$row['lable']."</a></span>";
						
					}
					unset($cid);
					echo "<br><br><div class='fpage'>".$page->fpage(array(3,4,5,6,7,0,1,2,8)).'</div><br>';	

					echo "</div>";//END MAIN
					/*右侧模块*/
					$id = 1;
					$sql="select title,date from young_blog order by gid DESC";
					echo "<div id=\"right_page\" style=\"font-family:'Microsoft YaHei';\">";
					echo "<img src='./image/widgetsep.png'></img>";
					echo "<ul id='right_page_update'>";
					echo '<h3>最新文章</h3>';
					$result=mysqli_query($link,$sql);
					while($row=mysqli_fetch_assoc($result)){
						echo "<a href=http://".constant("LOCALHOST")."/?&title={$id}>".$row['title']."</a>";
						$id++;
						echo '<br>';
					}
					unset($id);
					echo "</ul>";
					$sid=1;
					echo "<img src='./image/widgetsep.png'></img>";
					echo "<ul id='right_page_class'>";
					echo '<h3>分类</h3>';

					$sql = "select class from young_blog group by class order by gid DESC";
					$result=mysqli_query($link,$sql);
					while($row=mysqli_fetch_assoc($result)){
						echo "<a href=http://".constant("LOCALHOST")."/?class={$row['class']}>".$row['class']."</a>";
						$sid++;
						echo '<br>';
					}
					unset($sid);
					echo "</ul>";
					echo "<img src='./image/widgetsep.png'></img>";
					echo "<ul id='right_page_lable'>";
					echo "<h3>标签</h3>";
					$sql = "select lable from young_blog group by lable order by rand()";
					$result=mysqli_query($link,$sql);			
					echo "<div id='tagCloud' style='word-break:keep-all'>";
					$affnum=mysqli_affected_rows($link);
					while($row=mysqli_fetch_assoc($result)){
						$size = ed_getTag_style();
						echo "<a style=".$size." href='http://".constant("LOCALHOST")."/?lable={$row['lable']}'>".$row['lable']."</a>&nbsp;";
					}
					echo "</div>";
					unset($tmparray);
					echo "</ul>";
					echo "<img src='./image/widgetsep.png'></img>";
					echo "</div>";//END RIGHT PAGE

					/************END content PAGE***************************/					echo "</div>";

?>
				<div style="clear:both"></div>
				</div>
			</div>
			<div id="footer" style="font-family:'Microsoft YaHei';" >
				<br>
				<br>
				<br>
					power by <a href="http://<?php echo constant("LOCALHOST")?>/">YOUNG</a>
				<br>
				<br>
				<br>
			</div>
		</body>
</html>


