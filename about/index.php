<?php
	include "../younginit.php";
?>

<html>
	<head>
		<title>purpose</title>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
		<link rel="icon" href="http://<?php echo constant("LOCALHOST")?>/image/favicon.ico" type="image/x-icon"/>

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
		$url=$parse['path'].'?'.http_build_query($params);
	}
?>
<html>
	<body>
		<div id="wrap">
<!------------------------------------------------------------------------!>
			<div id="navigation"> 
				<ul id="nav">
					<li><a href="http://<?php echo constant("LOCALHOST")?>/home/">Home</a></li>
					<li id="selected"><a href="http://<?php echo constant("LOCALHOST")?>">Blog</a></li>
					<li><a href="http://<?php echo constant("LOCALHOST")?>/about/">About</a></li>
				</ul>
			<script type="text/javascript" src="./js/container.js"></script>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			
<!------------------------------------------------------------------------!>
			<div id="header" style="font-family:'Microsoft YaHei';">
				<h2><a id="name_1"href="http://<?php echo constant("LOCALHOST")?>">工兵在东北</a></h2>
					<h3 id="name_2">任何事情都始于当初的选择</h3>
			</div>		
<!------------------------------------------------------------------------!>
			<div  id="banner">
				<img src="http://<?php echo constant("LOCALHOST")?>/image/index.jpg" height="175" width="700"></img>
			</div>
<!------------------------------------------------------------------------!>
			<div style="font-family:'Microsoft YaHei';" id="footer">
				<br>
				<br>
				<br>
				<br>
				<br>
				power by <a href="http://<?php echo constant("LOCALHOST")?>/">YOUNG</a>
				<br>
				<br>
			</div>
<!------------------------------------------------------------------------!>	
		</div>
	</body>
</html>
