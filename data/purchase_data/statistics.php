<?php if (!login()) {
    header("Location: index.php?failed=2");
} ?>

<?php include("./data/linkSQL.php"); ?>

<div class="main-content">
    <div class="row" style="height:3vh;"></div>
    <div class="row" style="height:10vh;">
        <div class="col text-center">
            <h1>各項統計</h1>
        </div>
    </div>

    <div class="row" style="height:10vh;">
        <div class="col text-center">
            <h1>供應商每週</h1>
        </div>
    </div>
    <div class="row">
        <div class="col" style="padding:0px 5vw">
            <form name="form" enctype="multipart/form-data" action="index.php?dest=CLIENT&page=add" method="post" onsubmit="if(check())return true; else return false;" onkeydown="if(event.keyCode==13){document.getElementById('add').click();return false;}">
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <th scope="col" width=10%>供應商</th>
                            <th scope="col" width=10%>週</th>
                            <th scope="col" width=10%>總額</th>
                        </tr>
                        <?php
                        // 儲存MySQL/MariaDB 指令
                        $sqlQuery = "SELECT COUNT(*) FROM `supplier_weekpay`";
                        if ($result = $connection->query($sqlQuery)) {
                            $sqlQuery = "SELECT * FROM `supplier_weekpay`";
                            $row = $result->fetch_row();
                            if ($row[0] == 0) {
                                echo "<tr><td class='text-center' colspan='9'>無資料</td></tr>";
                            } else {
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    // 取得結果
                                    while ($row = $result->fetch_row()) {
                                        echo '	<tr>';
                                        for ($a = 0; $a < 3; $a++)
                                            echo "<td>" . $row[$a] . "</td>";
                                    }
                                    echo '	</tr>';
                                }
                            }
                        } else {
                            echo "執行失敗：" . $connection->error;
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="row" style="height:10vh;">
        <div class="col text-center">
            <h1>供應商每日</h1>
        </div>
    </div>
    <div class="row">
        <div class="col" style="padding:0px 5vw">
            <form name="form" enctype="multipart/form-data" action="index.php?dest=CLIENT&page=add" method="post" onsubmit="if(check())return true; else return false;" onkeydown="if(event.keyCode==13){document.getElementById('add').click();return false;}">
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <th scope="col" width=10%>供應商</th>
                            <th scope="col" width=10%>日</th>
                            <th scope="col" width=10%>總額</th>
                        </tr>
                        <?php
                        // 儲存MySQL/MariaDB 指令
                        $sqlQuery = "SELECT COUNT(*) FROM `supplier_daypay`,`supplier` WHERE `supplier`.`supplierID` = `supplier_daypay`.`supplierID`";
                        if ($result = $connection->query($sqlQuery)) {
                            $sqlQuery = "SELECT * FROM `supplier_daypay`,`supplier` WHERE `supplier`.`supplierID` = `supplier_daypay`.`supplierID`";
                            $row = $result->fetch_row();
                            if ($row[0] == 0) {
                                echo "<tr><td class='text-center' colspan='9'>無資料</td></tr>";
                            } else {
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    // 取得結果
                                    while ($row = $result->fetch_row()) {
                                        echo '	<tr>';
                                        for ($a = 0; $a < 3; $a++)
                                            echo "<td>" . $row[$a] . "</td>";
                                    }
                                    echo '	</tr>';
                                }
                            }
                        } else {
                            echo "執行失敗：" . $connection->error;
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="row" style="height:3vh;"></div>
</div>