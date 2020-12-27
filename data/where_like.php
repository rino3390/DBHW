<?php
	//輸出查詢條件
	function like($sqlQueryT,$str){
		if(isset($_POST[$str])){
			if($_POST[$str]!=""){
				$sqlQueryT=$sqlQueryT." and `".$str."` like '".$_POST[$str]."'";
			}
		}
		return $sqlQueryT;
	}
?>