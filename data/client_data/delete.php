<?php if (!login()) {
	header("Location: index.php?failed=2");
}
?>

<?php /*add*/
if (isset($_POST['id'])) {
	include("./data/linkSQL.php");
	mysqli_set_charset($connection, "utf8mb4");
	$sql = "UPDATE `client` SET `status` = '停用' WHERE `clientID`='".$_POST['id']."'";
	if ($connection->query($sql) === TRUE) {
		echo "<script>alert('已將該客戶狀態更改為停用');</script>";
	} else {
		echo "執行失敗：" . $connection->error;
	}
}
?>

<div class="main-content">
	<div class="row" style="height:3vh;"></div>
	<div class="row" style="height:10vh;">
		<div class="col text-center">
			<h1>停用客戶</h1>
		</div>
	</div>
	<div class="row" style="height:3vh;"></div>
	<div class="row">
		<div class="col" style="padding:0px 5vw">
			<form name="form" enctype="multipart/form-data" action="index.php?dest=CLIENT&page=delete" method="post"  onkeydown="if(event.keyCode==13){document.getElementById('add').click();return false;}">
				<table class="table table-bordered table-sm">
					<tbody>
						<tr>
							<td class="table-secondary">
								<h4>客戶身分證字號</h4>
							</td>
							<td>
								<input id="id" name="id" class="form-control" type="text" maxlength="12">
							</td>
						</tr>
						<tr>
							<td colspan="2" class="text-center">
								<input type="submit" id="submit" value="刪除" style="width:100%;display:none;" class="btn btn-primary" />
								<!--新增按鈕-->
								<button id="add" type="button" class="btn btn-default btn-info btn-block m-auto" style="width:65vw;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">停用</button>
								<!--新增確認框-->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-body">
												<form>
													<div class="form-group">
														<label for="message-text" class="control-label">確定停用?</label>
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