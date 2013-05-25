<?php
	include"./testip.php";
	include"./class/validationcode.class.php";
			if(isset($_GET['title'])){ 
				if(isset($_GET['page'])){
					$tmptitle=$_GET['title']+($_GET['page']-1)*5-1;
				}else{
					$tmptitle=$_GET['title']-1; 
				}
				$link=mysqli_connect("localhost", constant('DBUSER'), constant('DBPSW')) or die("连接失败");
				mysqli_select_db($link,constant('DBNAME'));
				mysqli_query($link,"SET NAMES 'UTF8'");

				$sql="select * from young_blog order by gid DESC limit {$tmptitle},1";
				$result=mysqli_query($link,$sql) or die("执行失败");				
				$num = mysqli_fetch_assoc($result) or die("数据有误");


                                if(!isset($_COOKIE[$num['gid']])){        //访问统计函数
                                                setcookie($num['gid'],md5($num['gid']),time()+60*60,"/");
                                                mysqli_query($link,"update `young_blog` set `visit`=`visit`+1 where `gid`={$num['gid']}") or die("执行失败");   //访问量
								}
				echo '<br>';
				echo '<br>';

				echo '<br>';
				echo "<div class='post_title'>".$num['title'].'</div>';
				echo '<br>';
				echo "<span class='post_author'>作者:".$num['author']."</span> <span class='post_createtime'>发布于:".$num['date']." </span><span class='post_lastchangetime'>最后修改时间:".$num['lastchangetime']."</span>";
				echo "<div class='post_content'>".$num['content'].'</div>';
				echo '<br>';
				echo '<br>';
				echo '<br>';
				echo '<br>';
				echo '<br>';
				//	echo $num['gid'];
				echo "<a name='comments'></a>";	
				$sql="select * from young_comments where gid={$num['gid']} order by id";
				$result=mysqli_query($link,$sql) or die("执行失败");
				while($comments = mysqli_fetch_assoc($result)){
					echo "<div class='about_comment'>";
					echo "<div class='comment_name'>评论者&nbsp;&nbsp;&nbsp;&nbsp;<span class=comment_name_1>".$comments['comment_name']."</span></div>";
					if(!empty($comments['comment_yourpage'])){
						echo "<div class='comment_web'>个人主页&nbsp;<a href=http://{$comments['comment_yourpage']} target='_blank'>".$comments['comment_yourpage']."</a></div>";
					}
					echo "<div class='comment_time'>".$comments['comment_time']."</div>";
					echo "<div class='comment_text'>".$comments['comment_text']."</div>";
					echo "</div>";
					if($comments['is_admin']){
						echo "<div class='admin_comment'>";
						echo "<img class='admin_name' src='./image/favicon.ico'><span class='admin_huifu'>&nbsp;回复&nbsp;</span>".$comments['comment_name'];
						echo "<div class='admin_text'>&nbsp;".$comments['admin_comment']."</div>";
						echo "</div>";
					}
				}
				//echo "<div class='comment_name'>".$comments['comment_name']."</div>";
				//评论提交表单
				echo $_COOKIE[$num['gid']];

				echo '<br>';
				echo '<br>';
				echo "<form id='comment_s' method='post' action='./comment.php'>";
				echo "昵称 * <br><input name='comment_name'>";
				echo '<br>';
				echo "邮箱 * (我们会对您的邮箱进行保密)<br> <input name='comment_email'>";
				echo '<br>';
				echo "个人主页<br>";
				echo "<input name='comment_yourpages'><br>";
				echo "内容 * <br><textarea name='comment_text' cols='50' rows='10' name='comment_text'></textarea><br>";
				echo "<input name='title' type='hidden' value=".$_GET['title'].'>';
				echo "<input name='page' type='hidden' value=".$_GET['page'].'>';
				echo "<input name='url' type='hidden' value=http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'>';
				echo "robot?";
				echo "<br>";
				echo "<input name='val' maxlength='4'>";
				echo "<br>";
				echo "看不清？ 点我";
				echo "<br>";
				echo "<img src='./code.php' onclick=this.src='code.php?'+Math.random()>";
				echo "<br>";
				echo "<br>";
				echo "<input type='submit' value='写好啦'>";
				echo "</form>";
				echo '<br>';

				exit;
			}	//------------------end if get title-------------------
?>


