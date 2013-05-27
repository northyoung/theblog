<?php

// length 剪辑的代码长度
// $content 待剪辑的文章内容

	function htmltag($tagname,$content){ //$tagname正则表达式匹配<p></p>
		global $out;
		preg_match_all($tagname,$content,$out,PREG_PATTERN_ORDER);
		$contentNum = 0;
		do{
			$tmpContent.=$out[0][$contentNum];
			$contentNum++;
		}while(strlen($tmpContent)<2000);
		unset($contentNum);
		return $tmpContent;
	}

/*	public function cutcode($content,$length){
				
}*/
//$tagname = "/<p.*?<\/p>/is";
//$content=htmltag($tagname,$content);

//echo $content;
?>
