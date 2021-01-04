<?php if (!login()) {
	header("Location: index.php?failed=2");
}
?>

<?php
include("./data/linkSQL.php");
$sql = "SELECT COUNT(*) FROM `client` WHERE `clientID` LIKE '" . $_POST['ID'] . "'";
if ($result = $connection->query($sql)) {
	$row = $result->fetch_row();
	if ($row[0] == 0) {
		echo "<script>alert('查無此用戶請重新輸入');</script>";
	} else {
		$sql = "SELECT * FROM `client` WHERE `clientID` LIKE '" . $_POST['ID'] . "'";
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
		if (document.getElementById("name").value.replace(/\s+/g, "") == "") {
			alert("姓名不得為空");
			return false;
		}
		if (document.getElementById("ID").value.replace(/\s+/g, "") == "") {
			alert("身份證字號不得為空");
			return false;
		}
		if (document.getElementById("tel").value.replace(/\s+/g, "") == "") {
			alert("電話不得為空");
			return false;
		} else {
			var re = /^[0-9]*$/;
			if (!re.test(document.getElementById("tel").value)) {
				alert("電話須為數字");
				return false;
			}
		}
		if (document.getElementById("address").value.replace(/\s+/g, "") == "") {
			alert("住址不得為空");
			return false;
		}
		if (document.getElementById("age").value.replace(/\s+/g, "") == "") {
			alert("年齡不得為空");
			return false;
		} else {
			var re = /^[0-9]*$/;
			if (!re.test(document.getElementById("age").value)) {
				alert("年齡須為數字");
				return false;
			}
		}
		if (document.getElementById("job").value.replace(/\s+/g, "") == "") {
			alert("職業不得為空");
			return false;
		}
		return true;
	}
</script>

<div class="main-content">
	<div class="row" style="height:3vh;"></div>
	<div class="row" style="height:10vh;">
		<div class="col text-center">
			<h1>修改客戶資料</h1>
		</div>
	</div>
	<div class="row" style="height:3vh;"></div>
	<div class="row">
		<div class="col" style="padding:0px 5vw">
			<form name="form" enctype="multipart/form-data" action="index.php?dest=CLIENT&page=changeComplete" method="post" onsubmit="if(check())return true; else return false;" onkeydown="if(event.keyCode==13){document.getElementById('add').click();return false;}">
				<table class="table table-bordered table-sm">
					<tbody>
						<tr>
							<td class="table-secondary">
								<h4>客戶姓名</h4>
							</td>
							<td>
								<input id="name" name="name" class="form-control" type="text" maxlength="12" value="<?php echo $row[0] ?>">
							</td>
						</tr>
						<tr>
							<td class="table-secondary">
								<h4>客戶身分證字號</h4>
							</td>
							<td>
								<input id="newID" name="newID" class="form-control" type="text" maxlength="10" value="<?php echo $row[1] ?>">
								<input id="ID" name="ID" class="form-control" type="text" maxlength="10" style="display:none" value="<?php echo $row[1] ?>">
							</td>
						</tr>
						<tr>
							<td class="table-secondary">
								<h4>電話</h4>
							</td>
							<td>
								<input id="tel" name="tel" class="form-control" type="text" maxlength="16" value="<?php echo $row[2] ?>">
							</td>
						</tr>
						<tr>
							<td class="table-secondary">
								<h4>住址</h4>
							</td>
							<td>
								<input id="address" name="address" class="form-control" type="text" maxlength="30" value="<?php echo $row[3] ?>">
							</td>
						</tr>
						<tr>
							<td class="table-secondary">
								<h4>年齡</h4>
							</td>
							<td>
								<input id="age" name="age" class="form-control" type="text" maxlength="4" value="<?php echo $row[4] ?>">
							</td>
						</tr>
						<tr>
							<td class="table-secondary">
								<h4>職業</h4>
							</td>
							<td>
								<input id="job" name="job" class="form-control" type="text" maxlength="12" value="<?php echo $row[5] ?>">
							</td>
						</tr>
						<tr>
							<td class="table-secondary">
								<h4>日期</h4>
							</td>
							<td>
								<input id="date" name="date" type="date" value="<?php echo $row[6] ?>">
							</td>
						</tr>
						<tr>
							<td class="table-secondary">
								<h4>照片</h4>
							</td>
							<td>
								<input id="userImage" name="userImage" type="file" class="form-control-file border" accept="image/*" />
								<?php echo "<img id='myimg' src='";
								if ($row[7] != null) echo "data:image/png;base64, " . base64_encode($row[7]);
								else echo $row[7];
								echo "' alt='error' class='img-thumbnail' style='display:block;max-height:10vh;max-width:10vw'/>"; ?>
							</td>
						</tr>
						<tr>
							<td class="table-secondary">
								<h4>消費狀態</h4>
							</td>
							<td>
								<select id="status" name="status" class="form-control" value="<?php echo $row[8] ?>">
									<option value="正常">正常</option>
									<option value="停用">停用</option>
								</select>
							</td>
						</tr>
						<tr>
						<tr>
							<td colspan="2" class="text-center">
								<input type="submit" id="submit" value="修改" style="width:100%;display:none;" class="btn btn-primary" />
								<!--新增按鈕-->
								<button id="add" type="button" class="btn btn-default btn-info btn-block m-auto" style="width:65vw;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">新增</button>
								<!--新增確認框-->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-body">
												<form>
													<div class="form-group">
														<label for="message-text" class="control-label">是否修改？</label>
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