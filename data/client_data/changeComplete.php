<?php if (!login()) {
	header("Location: index.php?failed=2");
}
?>

<?php
	//引入SQL連線
	include("data/linkSQL.php");
	mysqli_set_charset($connection, "utf8mb4");
	$sql = "SELECT COUNT(*) FROM `order` WHERE `orderID` LIKE '" . $_POST['id'] . "'";
	if ($result = $connection->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0] != 1) {
			echo "<script>alert('資料抓取錯誤。訂單編號" . $_POST['ID'] . "');</script>";
		} else {
			$sql = "UPDATE `order` SET `clientName` = '" . $_POST['name'] . "', `clientID` = '" . $_POST['newID'] . "', `tel` = '" . $_POST['tel'] . "', `address` = '" . $_POST['address'] . "', `age` = '" . $_POST['age'] . "', `job` = '" . $_POST['job'] . "', `date` = '" . $_POST['date'] . "', `status` = '" . $_POST['status'] . "'";
			$sql = $sql . " WHERE `clientID` = '" . $_POST['ID'] . "';";
			if ($connection->query($sql) === TRUE) {
				header('Location: index.php?dest=CLIENT&page=info');
			} else {
				echo "執行失敗：" . $connection->error;
			}
		}
	} else {
		echo "執行失敗：" . $connection->error;
	}
?>