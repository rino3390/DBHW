<?php if (!login()) {
	header("Location: index.php?failed=2");
}
?>

<?php
	//引入SQL連線
	include("data/linkSQL.php");
	mysqli_set_charset($connection, "utf8mb4");
	$sql = "SELECT COUNT(*) FROM `collection` WHERE `orderID` LIKE '" . $_POST['ID'] . "'";
	if ($result = $connection->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0] != 1) {
			echo "<script>alert('資料抓取錯誤。訂單編號" . $_POST['ID'] . "');</script>";
		} else {
			if ($_POST['money'] == $_POST['need']){
				$today = date("Y/m/d");
				$pay = $_POST['havepay'] + $_POST['money'];
				$sql = "UPDATE `collection` SET `actualDate` = '" . $today . "', `actualPay` = '" . $pay . "'";
			}
			else{
				$pay = $_POST['havepay'] + $_POST['money'];
				$sql = "UPDATE `collection` SET `actualPay` = '" . $pay . "'";
			}
			
			$sql = $sql . " WHERE `orderID` = '" . $_POST['ID'] . "';";
			if ($connection->query($sql) === TRUE) {
				header('Location: index.php?dest=ACCOUNT&page=info');
			} else {
				echo "執行失敗：" . $connection->error;
			}
		}
	} else {
		echo "執行失敗：" . $connection->error;
	}
?>