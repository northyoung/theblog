<?php
require("./younginit.php");
if(isset($_GET['class'])){
			header("Content-Type:text/html;charset=utf-8");
			include "./page.class.php";
			$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
			mysqli_select_db($link,constant('DBNAME'));

			mysqli_query($link,"SET NAMES 'UTF8'");
			$tmpclass = $_GET['class'];
			$result=mysqli_query($link,"select * from young_blog where class='$tmpclass'");
			$total=mysqli_num_rows($result);
			$num=5;
			$page=new Page($total, $num, "");
			$sql="select * from young_blog where class='$tmpclass'{$page->limit}";
			$result=mysqli_query($link,$sql) or die("语句执行失败");
			$id=1;
			$sid=1;
			$cid=1;
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
						echo "<span class='title_class'><a href='{$url}class=".$row['class']."'>".$row['class']."</a></span>";
						echo "<span class='lable'><a href='{$url}lable=".$row['lable']."'>".$row['lable']."</a></span>";
						
					}
					unset($cid);

					echo "";
					echo "<br><br><div class='fpage'>".$page->fpage(array(3,4,5,6,7,0,1,2,8)).'</div><br>';	
					echo "</div>";

					$id = 1;
					$sql="select title,date from young_blog order by gid";
					echo "<div id=\"right_page\" style=\"font-family:'Microsoft YaHei';\">";
					echo "<img src='./image/widgetsep.png'></img>";
					echo "<ul id='right_page_update'>";
					echo '<h3>最新文章</h3>';
					$result=mysqli_query($link,$sql);
					while($row=mysqli_fetch_assoc($result)){
						echo "<a href=http://".constant("LOCALHOST")."/?title={$id}>".$row['title']."</a>";
						$id++;
						echo '<br>';
					}
					unset($id);
					echo "</ul>";
					$sid=1;
					echo "<img src='./image/widgetsep.png'></img>";
					echo "<ul id='right_page_class'>";
					echo '<h3>分类</h3>';

					$sql = "select class from young_blog group by class order by gid";
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
					echo "</div>";



					echo "<div style='clear:both'></div>";
					echo "<div id='footer' style='font-family:Microsoft YaHei'>";
					echo "<br>";
					echo "<br>";
					echo "<br>";
					echo "power by <a href='http://".constant("LOCALHOST")."'>YOUNG</a>";
					echo "<br>";
					echo "<br>";
					echo "<br>";
					echo "</div>";



exit;
}
?>

