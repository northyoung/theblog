<?php
//数据验证类
class Validate{
	static function noZero($data){
		if(trim($data)==0){
			return false;
		}else {
			return true;
		}
	}
	static function required($data){
		if(trim($data)==""){
			return false;
		}else{
			return true;
		}
	}
	static function checkLength($data,$len){
		if(!is_int($len)){
			echo "您输入的长度参数有误";
		}else{
			if(strlen($data)>$len){
				return false;
			}else{
				return true;
			}
		}
	}
	static function isNumber($data){
		$re = "/^\d+$/";
		if(preg_match($re,$data)){
			return  true;
		}else{
			return false;
		}
	}
	static function equal($data1,$data2){
		if($data1 == $data2){
			return true;
		}else{
			return false;
		}
	}
}
?>
