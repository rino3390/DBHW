<?php if (!login()) {
    header("Location: index.php?failed=2");
} ?>

<div class="main-content">
    <div class="row" style="height:3vh;"></div>
    <div class="row" style="height:10vh;">
        <div class="col text-center">
            <h1>收帳款資料</h1>
        </div>
    </div>
    <div class="row" style="height:3vh;"></div>
    <div class="row">
        <div class="col" style="padding:0px 5vw">
            <table class="table table-bordered table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" width=10%>客戶姓名</th>
                        <th scope="col" width=10%>身分證字號</th>
                        <th scope="col" width=10%>應收金額</th>
                        <th scope="col" width=10%>應收日期</th>
                        <th scope="col" width=10%>實收日期</th>
                        <th scope="col" width=10%>待催收金額</th>
                        <th scope="col" width=5%></th>
                    </tr>
                    <form name="search" class="form-horizontal" action="index.php?dest=CLIENT&page=info" method="post">
                        <tr>
                            <th scope="col"><input name="clientName" class="form-control" type="text" maxlength="10" value="<?php if (isset($_POST['clientName'])) echo $_POST['clientName']; ?>"></th>
                            <th scope="col"><input name="clientID" class="form-control" type="text" maxlength="10" value="<?php if (isset($_POST['clientID'])) echo $_POST['clientID']; ?>"></th>
                            <th scope="col"><input name="price" class="form-control" type="text" maxlength="17" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>"></th>
                            <th scope="col"><input name="recieveDate" class="form-control" type="text" value="<?php if (isset($_POST['recieveDate'])) echo $_POST['recieveDate']; ?>"></th>
                            <th scope="col"><input name="actualDate" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['actualDate'])) echo $_POST['actualDate']; ?>"></th>
                            <th scope="col"><input name="pay" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['pay'])) echo $_POST['pay']; ?>"></th>
                            <th scope="col"><input name="submit" class="btn btn-default btn-info btn-block" type="submit" value="搜尋"></th>
                        </tr>
                    </form>
                </thead>
                <tbody>
                    <?php
                    //引入SQL連線
                    include("./data/linkSQL.php");
                    //function of 判斷是否有搜尋條件&加進SQL
                    include("./data/where_like.php");
                    // 儲存MySQL/MariaDB 指令
                    $sqlQuery = " FROM `collection_view`";
                    $s = array("clientName", "clientID", "price", "recieveDate", "actualDate", "pay", "submit");
                    for ($a = 0; $a < 7; $a++) {
                        $sqlQuery = like($sqlQuery, $s[$a], " FROM `collection_view`");
                    }
                    $_SESSION['sqlQuery'] = $sqlQuery;
                    $sqlQuery2 = "SELECT COUNT(*)" . $sqlQuery;
                    if ($result = $connection->query($sqlQuery2)) {
                        $row = $result->fetch_row();
                        if ($row[0] == 0) {
                            echo "<tr><td class='text-center' colspan='9'>無資料</td></tr>";
                        } else {
                            $sqlQuery = "SELECT *" . $sqlQuery;
                            // 執行MySQL/MariaDB 指令
                            if ($result = $connection->query($sqlQuery)) {
                                // 取得結果
                                while ($row = $result->fetch_row()) {
                                    echo '	<tr>';
                                    for ($a = 0; $a < 3; $a++)
                                        echo "<td>" . $row[$a] . "</td>";
                                    echo "<td>" . date("Y/m/d", strtotime($row[3])) . "</td>";
                                    if ($row[4] == "0000-00-00") echo "<td>未收到金額。</td>";
                                    else echo "<td>" . date("Y/m/d", strtotime($row[4])) . "</td>";
                                    echo "<td>" . $row[5] . "</td>";
                                    echo '		<div class="modal fade" id="myModal' . $row[1] . '">';
                                    echo '			<div class="modal-dialog modal-lg">';
                                    echo '				<div class="modal-content">';
                                    echo '					<div class="modal-header">';
                                    echo '						<h3 class="modal-title">' . $row[0] . '<small> ' . $row[1] . '</small><small> (' . $row[5] . ')</small></h3>';
                                    echo '						<button type="button" class="close" data-dismiss="modal">&times;</button>';
                                    echo '					</div>';
                                    echo '					<div class="modal-body row">';
                                    echo '						<div class="col">';
                                    echo '							<h5>職等：' . $row[2] . '</h5>';
                                    echo '							<h5>薪資：' . $row[3] . '</h5>';
                                    echo '							<h5>電話：' . $row[4] . '</h5>';
                                    echo '						</div>';
                                    echo '					</div>';
                                    echo '					<div class="modal-footer">';
                                    echo '						<form name="form" enctype="multipart/form-data" action="revise2.php" method="post">';
                                    echo '							<input id="ID" name="ID" class="form-control" style="display:none" type="text" maxlength="10" value="' . $row[1] . '">';
                                    echo '							<input type="submit" id="revise2submit" value="修改" class="btn btn-primary" />';
                                    echo '						</form>';
                                    echo '						<form name="form" enctype="multipart/form-data" action="delete.php" method="post">';
                                    echo '							<input id="ID" name="ID" class="form-control" style="display:none" type="text" maxlength="10" value="' . $row[1] . '">';
                                    echo '							<input type="submit" id="deletesubmit" value="查詢並進行刪除" style="width:100%;display:none;" class="btn btn-primary" />';
                                    echo '							<!--查詢並進行刪除按鈕-->';
                                    echo '							<button id="delete" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">刪除</button>';
                                    echo '							<!--查詢並進行刪除確認框-->';
                                    echo '							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">';
                                    echo '								<div class="modal-dialog" role="document">';
                                    echo '									<div class="modal-content">';
                                    echo '										<div class="modal-header">';
                                    echo '											<h4 class="modal-title" id="exampleModalLabel">刪除</h4>';
                                    echo '											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
                                    echo '										</div>';
                                    echo '										<div class="modal-body">';
                                    echo '											<form>';
                                    echo '												<div class="form-group">';
                                    echo '													<label for="message-text" class="control-label">是否查詢並進行刪除？</label>';
                                    echo '												</div>';
                                    echo '											</form>';
                                    echo '										</div>';
                                    echo '										<div class="modal-footer">';
                                    echo '											<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="document.getElementById(\'deletesubmit\').click();">確認</button>';
                                    echo '											<button type="button" class="btn btn-default" data-dismiss="modal">返回</button>';
                                    echo '										</div>';
                                    echo '									</div>';
                                    echo '								</div>';
                                    echo '							</div>';
                                    echo '						</form>';
                                    //echo '						<button type="button" class="btn btn-danger" data-dismiss="modal">關閉</button>';
                                    echo '					</div>';
                                    echo '				</div>';
                                    echo '			</div>';
                                    echo '		</div>';
                                    echo "	</tr>";
                                }
                                // 釋放資源
                                $result->close();
                            } else {
                                echo "執行失敗：" . $connection->error;
                            }
                        }
                    } else {
                        echo "執行失敗：" . $connection->error;
                    }
                    // 關閉 MySQL/MariaDB 連線
                    $connection->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!--自動download-->
            <a id="dl" style="display: none" href="<?php if (isset($fileName)) echo $fileName; ?>#" download>Download</a>
            <?php if (isset($fileName)) echo "<script>document.getElementById('dl').click();</script>"; ?>
            <!--匯出執行表單-->
            <form method="post" action="search.php">
                <input id="printTable" name="printTable" class="btn btn-default btn-info btn-block m-auto" style="display: none" type="submit" value="匯出">
            </form>
            <!--匯出按鈕-->
            <button type="button" class="btn btn-default btn-info btn-block m-auto " style="padding-left:100px;width:50vw;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">匯出</button>

            <!--匯出確認框-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">匯出</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">是否匯出？</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('printTable').click();">確認</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="height:3vh;"></div>
</div>