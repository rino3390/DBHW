<?php if (!login()) {
    header("Location: index.php?failed=2");
} ?>

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
                        <th scope="col" width=8%>姓名</th>
                        <th scope="col" width=12%>身分證字號</th>
                        <th scope="col" width=10%>電話</th>
                        <th scope="col" width=12%>住址</th>
                        <th scope="col" width=5%>年齡</th>
                        <th scope="col" width=10%>登載日期</th>
                        <th scope="col" width=15%>照片</th>
                        <th scope="col" width=8%>消費狀態</th>
                        <th scope="col" width=5%></th>
                    </tr>
                    <form name="search" class="form-horizontal" action="index.php?dest=CLIENT&page=info" method="post">
                        <tr>
                            <th scope="col"><input name="clientName" class="form-control" type="text" maxlength="10" value="<?php if (isset($_POST['clientName'])) echo $_POST['clientName']; ?>"></th>
                            <th scope="col"><input name="clientID" class="form-control" type="text" maxlength="10" value="<?php if (isset($_POST['clientID'])) echo $_POST['clientID']; ?>"></th>
                            <th scope="col"><input name="tel" class="form-control" type="text" maxlength="17" value="<?php if (isset($_POST['tel'])) echo $_POST['tel']; ?>"></th>
                            <th scope="col"><input name="address" class="form-control" type="text" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>"></th>
                            <th scope="col"><input name="age" class="form-control" type="text" maxlength="8" value="<?php if (isset($_POST['age'])) echo $_POST['age']; ?>"></th>
                            <th scope="col"><input name="date" class="form-control" type="date" maxlength="8" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>"></th>
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
                    $s = array("clientName", "clientID", "tel", "address", "age", "job", "date", "pic", "status");
                    for ($a = 0; $a < 5; $a++) {
                        //$sqlQuery = like($sqlQuery, $s[$a]);
                    }
                    $_SESSION['sqlQuery'] = $sqlQuery;
                    $sqlQuery2 = "SELECT COUNT(*)" . $sqlQuery;
                    if ($result = $connection->query($sqlQuery2)) {
                        $row = $result->fetch_row();
                        if ($row[0] == 0) {
                            echo "<tr><td class='text-center' colspan='8'>無資料</td></tr>";
                        } else {
                            $sqlQuery = "SELECT *" . $sqlQuery;
                            // 執行MySQL/MariaDB 指令
                            if ($result = $connection->query($sqlQuery)) {
                                // 取得結果
                                while ($row = $result->fetch_row()) {
                                    echo '	<tr>';
                                    for ($a = 0; $a < 3; $a++)
                                        echo "	<td>" . $row[$a] . "</td>";
                                    echo "		<td>" . date("Y/m/d", strtotime($row[3])) . "</td>";
                                    echo "		<td>" . $row[4] . "</td>";
                                    echo "		<td>" . $row[5] . "</td>";
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
            <div class="col text-center">
                <button type="button" class="btn btn-default btn-info btn-block m-auto " style="width:50vw;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">匯出</button>
            </div>
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