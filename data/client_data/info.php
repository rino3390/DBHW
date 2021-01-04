<?php if (!login()) {
    header("Location: index.php?failed=2");
} ?>

<!--匯出-->
<?php if (isset($_POST['printTable'])) include("data/client_data/print.php") ?>

<div class="main-content">
    <div class="row" style="height:3vh;"></div>
    <div class="row" style="height:10vh;">
        <div class="col text-center">
            <h1>客戶資料</h1>
        </div>
    </div>
    <div class="row" style="height:3vh;"></div>
    <div class="row">
        <div class="col" style="padding:0px 5vw">
            <table class="table table-bordered table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" width=10%>姓名</th>
                        <th scope="col" width=12%>身分證字號</th>
                        <th scope="col" width=10%>電話</th>
                        <th scope="col" width=13%>住址</th>
                        <th scope="col" width=5%>年齡</th>
                        <th scope="col" width=8%>職業</th>
                        <th scope="col" width=10%>登載日期</th>
                        <th scope="col" width=15%>照片</th>
                        <th scope="col" width=9%>消費狀態</th>
                        <th scope="col" width=5%></th>
                    </tr>
                    <form name="search" class="form-horizontal" action="index.php?dest=CLIENT&page=info" method="post">
                        <tr>
                            <th scope="col"><input name="clientName" class="form-control" type="text" maxlength="10" value="<?php if (isset($_POST['clientName'])) echo $_POST['clientName']; ?>"></th>
                            <th scope="col"><input name="clientID" class="form-control" type="text" maxlength="10" value="<?php if (isset($_POST['clientID'])) echo $_POST['clientID']; ?>"></th>
                            <th scope="col"><input name="tel" class="form-control" type="text" maxlength="17" value="<?php if (isset($_POST['tel'])) echo $_POST['tel']; ?>"></th>
                            <th scope="col"><input name="address" class="form-control" type="text" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>"></th>
                            <th scope="col"><input name="age" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['age'])) echo $_POST['age']; ?>"></th>
                            <th scope="col"><input name="job" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['job'])) echo $_POST['job']; ?>"></th>
                            <th scope="col"><input name="date" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>"></th>
                            <th scope="col"></th>
                            <th scope="col"><input name="status" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['status'])) echo $_POST['status']; ?>"></th>
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
                    $sqlQuery = " FROM `client`";
                    $s = array("clientName", "clientID", "tel", "address", "age", "job", "date", "status");
                    for ($a = 0; $a < 8; $a++) {
                        $sqlQuery = like($sqlQuery, $s[$a], " FROM `client`");
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
                                    for ($a = 0; $a < 6; $a++)
                                        echo "<td>" . $row[$a] . "</td>";
                                    echo "<td>" . date("Y/m/d", strtotime($row[6])) . "</td>";
                                    echo "<td class='text-center'>";
                                    echo "<img src='";
                                    if ($row[7] != null) echo "data:image/png;base64, " . base64_encode($row[7]);
                                    echo "'alt='error' class='img-thumbnail' style='max-height:10vh;max-width:10vw'/>";
                                    echo "</td>";
                                    echo "<td>" . $row[8] . "</td>";
                                    echo "<td class='text-center'>";
                                    echo "		<button id='btn" . $row[1] . "' type='button' class='btn btn-info' data-toggle='modal' data-target='#myModal" . $row[1] . "'>查看</button>";
                                    echo "</td>";
                                    echo '		<div class="modal fade" id="myModal' . $row[1] . '">';
                                    echo '			<div class="modal-dialog modal-lg">';
                                    echo '				<div class="modal-content">';
                                    echo '					<div class="modal-header">';
                                    echo '						<h3 class="modal-title">' . $row[0] . '<small>  (' . $row[4] . ')</small></h3>';
                                    echo '						<button type="button" class="close" data-dismiss="modal">&times;</button>';
                                    echo '					</div>';
                                    echo '					<div class="modal-body row">';
                                    echo '						<div class="col">';
                                    echo '							<h5>身份證字號：' . $row[1] . '</h5>';
                                    echo '							<h5>電話：' . $row[2] . '</h5>';
                                    echo '							<h5>住址：' . $row[3] . '</h5>';
                                    echo '							<h5>職業：' . $row[5] . '</h5>';
                                    echo '							<h5>登載日期' . date("Y/m/d", strtotime($row[6])) . '</h5>';
                                    echo '							<h5>狀態：' . $row[8] . '</h5>';
                                    echo '						</div>';
                                    echo "						<div class='col'>";
                                    echo "							<img src='";
                                    if ($row[7] != null) echo "data:image/png;base64, " . base64_encode($row[7]);
                                    echo "' alt='error' class='img-thumbnail' style='width:50vh'/>";
                                    echo "						</div>";
                                    echo '					</div>';
                                    echo '					<div class="modal-footer">';
                                    echo '						<form name="form" enctype="multipart/form-data" action="index.php?dest=CLIENT&page=change" method="post">';
                                    echo '							<input id="ID" name="ID" class="form-control" style="display:none" type="text" maxlength="10" value="' . $row[1] . '">';
                                    echo '							<input type="submit" id="revise2submit" value="修改" class="btn btn-primary" />';
                                    echo '						</form>';
                                    echo '						<form name="form" enctype="multipart/form-data" action="index.php?dest=CLIENT&page=delete" method="post">';
                                    echo '							<input id="id" name="id" class="form-control" style="display:none" type="text" maxlength="10" value="' . $row[1] . '">';
                                    echo '							<input type="submit" id="delete" value="停用" class="btn btn-danger" />';
                                    echo '						</form>';
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
            <form method="post" action="index.php?dest=CLIENT&page=info">
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