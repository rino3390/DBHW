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
		$today = date("Y/m/d");
		$sql = "UPDATE `order` SET `actualDate` = '" . $today . "'";
		$sql = $sql . " WHERE `orderID` = '" . $_POST['id'] . "';";
		if ($connection->query($sql) === TRUE) {
			header('Location: index.php?dest=ORDER&page=info');
		} else {
			echo "執行失敗：" . $connection->error;
		}
	}
} else {
	echo "執行失敗：" . $connection->error;
}
?>