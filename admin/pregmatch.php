<?php
	//添加文章标题  
	define("PREG_TITLE","/^[A-Za-z0-9_\x80-\xff]+$/");
	//文章标签
	define("PREG_LABLE","/^[A-Za-z0-9_\x80-\xff]+$/");
	//文章作者
	define("PREG_AUTHOR","/^[A-Za-z0-9_\x80-\xff]+$/");
	//删除，修改文章用到的正则；更改删除分类用到的正则
	define("UNSIGNED_INT","/^[0-9]\d*$/");
?>