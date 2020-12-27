<?php
	//回傳是否登入狀態
	function login(){
		if(file_exists('./data/linkSQL.php')){
			include ("./data/linkSQL.php");
		}else if(file_exists('../linkSQL.php')){
			include ("../linkSQL.php");
		}else{
			echo "登入資訊檔消失";
		}
		if(isset($_SESSION['account'])&&$_SESSION['account']==$dbuser &&isset($_SESSION['pwd'])&&$_SESSION['pwd']==$dbpassword)
			return true;
		else
			return false;
	}
?>