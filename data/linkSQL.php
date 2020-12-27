<?php
	$server = "localhost";         	// MySQL/MariaDB伺服器
	$dbuser = "root";       		// 使用者帳號
	$dbpassword = "unlightsheri160160"; 		// 使用者密碼
	$dbname = "freshfood";    // 資料庫名稱
	// 連接 MySQL/MariaDB 資料庫
	$connection = new mysqli($server, $dbuser, $dbpassword, $dbname);
	// 檢查連線是否成功
	if ($connection->connect_error) {
		die("連線失敗：" . $connection->connect_error);
	}
?>