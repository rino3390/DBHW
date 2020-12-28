<?php
	//輸出查詢條件
	function like($sqlQueryT,$str, $ori){
		if(isset($_POST[$str])){
			if($_POST[$str]!=""){
				//如果是第一個條件
				if ($sqlQueryT == $ori){
					$sqlQueryT = $sqlQueryT . "WHERE `" . $str . "` like '%" . $_POST[$str] . "%'";
				}
				else
					$sqlQueryT=$sqlQueryT." and `".$str."` like '%".$_POST[$str]."%'";
			}
		}
		return $sqlQueryT;
	}
?>