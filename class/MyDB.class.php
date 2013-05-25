<?php
	class MyDB{
		protected $mysqli;
		protected $showError;

		public function __construct ($showError=TRUE){
			$this->mysqli = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME);
			if(mysqli_connect_errno()){
				$errormessage = "'链接失败，原因为:'.mysqli_connect_error()";				
				echo '<p><font color="red">'.htmlspecialchars($errorMessage).'</font></p>';
			}
			$this->mysqli=FALSE;
			exit;
		}
		public function getVersion(){
			return $this->mysqli->server_info;
		}
		public function getDBSize($dbName,$tblPrefix=null){
			$sql = "SHOW TABLE STATUS FROM " . $dbname;
			if($thlPrefix != null){
				$sql .= " LIKE '$tblPrefix%'";
			}
			$result = $this->mysqli->query($sql);
			$size = 0;
			while($row = $result->fetch_assoc())
				$size += $row["Data_length"]+$row["Index_length"];
			return $size;
		}
		public function close(){
			if($this->mysqli){
				$this->mysqli->close();
			}
			$this->mysqli = FALSE;
		}
		public function __destruct(){
			$this->close();	
		}
	}	

?>
