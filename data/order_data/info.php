<?php if (!login()) {
    header("Location: index.php?failed=2");
} ?>

<div class="main-content">
    <div class="row" style="height:3vh;"></div>
    <div class="row" style="height:10vh;">
        <div class="col text-center">
            <h1>訂貨資料</h1>
        </div>
    </div>
    <div class="row" style="height:3vh;"></div>
    <div class="row">
        <div class="col" style="padding:0px 5vw">
            <table class="table table-bordered table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" width=10%>身分證字號</th>
                        <th scope="col" width=8%>訂貨日期</th>
                        <th scope="col" width=8%>預計遞交日期</th>
                        <th scope="col" width=8%>實際遞交日期</th>
                        <th scope="col" width=8%>訂貨品名</th>
                        <th scope="col" width=8%>單位</th>
                        <th scope="col" width=5%>數量</th>
                        <th scope="col" width=10%>單價</th>
                        <th scope="col" width=10%>訂貨金額</th>
                        <th scope="col" width=10%>供應商名稱</th>
                        <th scope="col" width=10%>供應商編號</th>
                        <th scope="col" width=5%></th>
                    </tr>
                    <form name="search" class="form-horizontal" action="index.php?dest=CLIENT&page=info" method="post">
                        <tr>
                            <th scope="col"><input name="clientID" class="form-control" type="text" maxlength="10" value="<?php if (isset($_POST['clientID'])) echo $_POST['clientID']; ?>"></th>
                            <th scope="col"><input name="orderDate" class="form-control" type="text" maxlength="10" value="<?php if (isset($_POST['orderDate'])) echo $_POST['orderDate']; ?>"></th>
                            <th scope="col"><input name="expectDate" class="form-control" type="text" maxlength="17" value="<?php if (isset($_POST['expectDate'])) echo $_POST['expectDate']; ?>"></th>
                            <th scope="col"><input name="actualDate" class="form-control" type="text" value="<?php if (isset($_POST['actualDate'])) echo $_POST['actualDate']; ?>"></th>
                            <th scope="col"><input name="productName" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['productName'])) echo $_POST['productName']; ?>"></th>
                            <th scope="col"><input name="unit" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['unit'])) echo $_POST['unit']; ?>"></th>
                            <th scope="col"><input name="num" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['num'])) echo $_POST['num']; ?>"></th>
                            <th scope="col"><input name="price" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>"></th>
                            <th scope="col"><input name="sum" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['sum'])) echo $_POST['sum']; ?>"></th>
                            <th scope="col"><input name="supplierName" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['supplierName'])) echo $_POST['supplierName']; ?>"></th>
                            <th scope="col"><input name="supplierID" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['supplierID'])) echo $_POST['supplierID']; ?>"></th>
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
                    $sqlQuery = " FROM `oder_view`";
                    $s = array("clientID", "orderDate", "expectDate", "actualDate", "productName", "unit", "num", "price", "sum", "supplierName", "supplierID");
                    for ($a = 0; $a < 11; $a++) {
                        $sqlQuery = like($sqlQuery, $s[$a], " FROM `oder_view`");
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
                                    echo "<td>" . $row[0] . "</td>";
                                    for ($a = 1; $a < 4; $a++)
                                        echo "<td>" . date("Y/m/d", strtotime($row[$a])) . "</td>";
                                    for ($a = 4; $a < 11; $a++)
                                        echo "<td>" . $row[$a] . "</td>";
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
                                    echo '							<h5>出生：' . date("Y/m/d", strtotime($row[6])) . '</h5>';
                                    echo '							<h5>錄用：' . date("Y/m/d", strtotime($row[7])) . '</h5>';
                                    echo '							<h5 style="display:inline-block">住址：</h5><h5 style="display:inline-block">' . $row[8] . '</h5>';
                                    echo '						</div>';
                                    echo "						<div class='col'>";
                                    echo "							<img src='";
                                    if ($row[7] != null) echo "data:image/png;base64, " . base64_encode($row[7]);
                                    else echo $row[9];
                                    echo "' alt='error' class='img-thumbnail' style='width:50vh'/>";
                                    echo "						</div>";
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