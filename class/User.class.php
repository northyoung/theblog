<?php
	class User extends BaseLogic{
		function __construct($showError=TRUE){
			parent::__construct($showError);
			$this->tabName = TAB_PREFIX."user";
			$this->fieldList=array("userName","userPwd");
		}
		function validateForm($user=1){
			$result=true;
			if(!Validate::required($_POST['userName'])) {
				$this->messList[] = "用户名称不能为空.";
				$result=false;
			}
			if(!Validate::checkLength($_POST['userName'], 20)) {
				$this->messList[] = "用户名称的长度不能大于20.";
				$result=false;
			}
			if(!Validate::required($_POST['userPwd'])) {
				$this->messList[] = "用户密码不能为空.";
				$result=false;
			}
			if($_POST['userPwd']!=$_POST['userpwdok']) {
				$this->messList[] = "两次密码输入不一致.";
				$result=false;
			}
			if(!Validate::required($_POST['email'])) {
				$this->messList[] = "用户电子邮件不能为空.";
				$result=false;
			}
			if(!Validate::match($_POST['email'], "/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/")) {
				$this->messList[] = "不是正确的电子邮件格式.";
				$result=false;
			}
			if($user){
				if($this->getUserName($_POST["userName"])) {
				$this->messList[] = "该用户已经存在.";
				$result=false;
				}
			}	
			if(!$this->checkCode($_POST["vdcode"])) {
				$this->messList[] = "验证码输入错误.";
				$result=false;
			}

			return  $result;
		}
		function getUserName($username){
			$result=$this->mysqli->query("SELECT userName FROM {$this->tabName} WHERE id = '{$username}'");
			if($result->num_rows>0){
				return true;
			}else{
				return false;	
			}
		}
		private function checkCode($vdcode){ 
			if(trim($vdcode)==$_SESSION['validationcode']){
				return true;
			}else{
				return false;
			}
		}
	/*	function userAdd($post) {	
			$post["regTime"]=time();
			$post["userPwd"]=md5($post["userPwd"]);
			if($this->add($post)){
				$this->messList[] = "用户添加成功.";
				return true;
			}else{
				$this->messList[] = "添加用户失败.";
				return false;
			}
		}	*/
		function logic($uname,$pwd,$admin=null){
			if(empty($admin)){
				$sql="SELECT id FROM {$this->tabName} WHERE userName = '{$uname}' AND userPwd = MD5('{$pwd}')";
			}else if($admin="admin"){
				$sql="SELECT id FROM {$this->tabName} WHERE userName = '{$uname}' AND userPwd = MD5('{$pwd}') AND id=1";
			}
			$result=$this->mysqli->query($sql);
			if($result && $result->num_rows>0){ //成功登陆
				$data=$result->fetch_assoc();
				$_SESSION['isLogin'] =true;
				$_SESSION['uid']=$data['id'];
				$_SESSION['uname']=$uname;
				return 1;
			}else{
				return 0;
			}
		}
		function logout(){ //注销
			$_SESSION = array();
			if(isset($_COOKIE[session_name()])){
				setcookie(session_name(),'',time()-42000,'/');
			}
			session_destroy();
		}
		function isLogic(){
			if(!empty($_SESSION['isLogic']))
				return 1;
			else
				return 0;
		}
       /*		function delUser($id){
			id
		}*/
		function getRowTotal(){  //获取查询数据数量
			$result=$this->mysqli->query("SELECT * FROM {$this->tabName}");
			return $result->num_rows;
		}

		/*function getAllusers($offset,$num){
		
		}
		function modUser($postList){
			
		}*/

}
?>
