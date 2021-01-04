<?php if (!login()) {
	header("Location: index.php?failed=2");
}
?>

<?php
include("./data/linkSQL.php");
$sql = "SELECT COUNT(*) FROM `collection_view` WHERE `orderID` LIKE '" . $_POST['id'] . "'";
if ($result = $connection->query($sql)) {
	$row = $result->fetch_row();
	if ($row[0] == 0) {
		echo "<script>alert('查無此用戶請重新輸入');</script>";
	} else {
		$sql = "SELECT * FROM `collection_view` WHERE `orderID` LIKE '" . $_POST['id'] . "'";
		if ($result = $connection->query($sql)) {
			$row = $result->fetch_row();
		} else {
			echo "執行失敗：" . $connection->error;
		}
	}
} else {
	echo "執行失敗：" . $connection->error;
}
?>

<script>
	function check() {
		if (document.getElementById("money").value.replace(/\s+/g, "") == "") {
			alert("金額不得為空。");
			return false;
		} else if (document.getElementById("money").value > document.getElementById("need").value) {
			alert("超過待催繳金額。");
			return false;
		} else {
			var re = /^[0-9]*$/;
			if (!re.test(document.getElementById("money").value)) {
				alert("金額須為數字");
				return false;
			}
		}
		return true;
	}
</script>

<div class="main-content">
	<div class="row" style="height:3vh;"></div>
	<div class="row" style="height:10vh;">
		<div class="col text-center">
			<h1>用戶收款</h1>
		</div>
	</div>
	<div class="row" style="height:3vh;"></div>
	<div class="row">
		<div class="col" style="padding:0px 5vw">
			<form name="form" enctype="multipart/form-data" action="index.php?dest=ACCOUNT&page=changeComplete" method="post" onsubmit="if(check())return true; else return false;" onkeydown="if(event.keyCode==13){document.getElementById('add').click();return false;}">
				<table class="table table-bordered table-sm">
					<tbody>
						<tr>
							<td class="table-secondary">
								<h4>客戶姓名</h4>
							</td>
							<td>
								<input id="ID" name="ID" class="form-control" type="text" maxlength="10" style="display:none" value="<?php echo $row[6] ?>">
								<?php echo $row[0] ?>
							</td>
						</tr>
						<tr>
							<td class="table-secondary">
								<h4>待催收金額</h4>
							</td>
							<td>
								<input id="need" name="need" class="form-control" type="text" maxlength="10" style="display:none" value="<?php echo $row[5] ?>">
								<?php echo $row[5]?>
							</td>
						</tr>
						<tr>
							<td class="table-secondary">
								<h4>收款金額</h4>
							</td>
							<td>
								<input id="havepay" name="havepay" class="form-control" type="text" maxlength="16" style="display:none" value="<?php echo ($row[2] - $row[5]) ?>">
								<input id="money" name="money" class="form-control" type="text" maxlength="16" value="">
							</td>
						</tr>
						<tr>
						<tr>
							<td colspan="2" class="text-center">
								<input type="submit" id="submit" value="收款" style="width:100%;display:none;" class="btn btn-primary" />
								<!--新增按鈕-->
								<button id="add" type="button" class="btn btn-default btn-info btn-block m-auto" style="width:65vw;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">收款</button>
								<!--新增確認框-->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-body">
												<form>
													<div class="form-group">
														<label for="message-text" class="control-label">確認收款?</label>
													</div>
												</form>
												<button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
												<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="document.getElementById('submit').click();">確認</button>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
	<div class="row" style="height:3vh;"></div>
</div>