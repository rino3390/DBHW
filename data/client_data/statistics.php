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
    <div class="row" style="height:3vh;"></div>
    <div class="row">
        <div class="col" style="padding:0px 5vw">
            <form name="form" enctype="multipart/form-data" action="index.php?dest=CLIENT&page=add" method="post" onsubmit="if(check())return true; else return false;" onkeydown="if(event.keyCode==13){document.getElementById('add').click();return false;}">
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <td class="table-secondary">
                                <h4>客戶人數</h4>
                            </td>
                            <td>
                                <?php
                                // 儲存MySQL/MariaDB 指令
                                $sqlQuery = "SELECT COUNT(*) FROM `client` ";
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    if ($row = $result->fetch_row()) {
                                        echo  $row[0] . "人";
                                    } else {
                                        echo "取得失敗";
                                    }
                                } else {
                                    echo "執行失敗：" . $connection->error;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>客戶平均年齡</h4>
                            </td>
                            <td>
                                <?php
                                // 儲存MySQL/MariaDB 指令
                                $sqlQuery = "SELECT AVG(age) FROM `client`";
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    if ($row = $result->fetch_row()) {
                                        echo $row[0] . "歲";
                                    } else {
                                        echo "取得失敗";
                                    }
                                } else {
                                    echo "執行失敗：" . $connection->error;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>正常用戶</h4>
                            </td>
                            <td>
                                <?php
                                // 儲存MySQL/MariaDB 指令
                                $sqlQuery = "SELECT COUNT(*) FROM `client` WHERE `status` = '正常'";
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    if ($row = $result->fetch_row()) {
                                        echo  $row[0] . "人";
                                    } else {
                                        echo "取得失敗";
                                    }
                                } else {
                                    echo "執行失敗：" . $connection->error;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>停用用戶</h4>
                            </td>
                            <td>
                                <?php
                                // 儲存MySQL/MariaDB 指令
                                $sqlQuery = "SELECT COUNT(*) FROM `client` WHERE `status` = '正常'";
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    if ($row = $result->fetch_row()) {
                                        echo  $row[0] . "人";
                                    } else {
                                        echo "取得失敗";
                                    }
                                } else {
                                    echo "執行失敗：" . $connection->error;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>全年定貨總額</h4>
                            </td>
                            <td>
                                <?php
                                // 儲存MySQL/MariaDB 指令
                                $sqlQuery = "SELECT COUNT(*) FROM `client` WHERE `status` = '正常'";
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    if ($row = $result->fetch_row()) {
                                        echo  $row[0] . "人";
                                    } else {
                                        echo "取得失敗";
                                    }
                                } else {
                                    echo "執行失敗：" . $connection->error;
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <div class="row" style="height:10vh;">
        <div class="col text-center">
            <h1>年收入</h1>
        </div>
    </div>
    <div class="row">
        <div class="col" style="padding:0px 5vw">
            <form name="form" enctype="multipart/form-data" action="index.php?dest=CLIENT&page=add" method="post" onsubmit="if(check())return true; else return false;" onkeydown="if(event.keyCode==13){document.getElementById('add').click();return false;}">
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <th scope="col" width=10%>年分</th>
                            <th scope="col" width=10%>收入</th>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>客戶平均年齡</h4>
                            </td>
                            <td>
                                <?php
                                // 儲存MySQL/MariaDB 指令
                                $sqlQuery = "SELECT AVG(age) FROM `client`";
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    if ($row = $result->fetch_row()) {
                                        echo $row[0] . "歲";
                                    } else {
                                        echo "取得失敗";
                                    }
                                } else {
                                    echo "執行失敗：" . $connection->error;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>正常用戶</h4>
                            </td>
                            <td>
                                <?php
                                // 儲存MySQL/MariaDB 指令
                                $sqlQuery = "SELECT COUNT(*) FROM `client` WHERE `status` = '正常'";
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    if ($row = $result->fetch_row()) {
                                        echo  $row[0] . "人";
                                    } else {
                                        echo "取得失敗";
                                    }
                                } else {
                                    echo "執行失敗：" . $connection->error;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>停用用戶</h4>
                            </td>
                            <td>
                                <?php
                                // 儲存MySQL/MariaDB 指令
                                $sqlQuery = "SELECT COUNT(*) FROM `client` WHERE `status` = '正常'";
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    if ($row = $result->fetch_row()) {
                                        echo  $row[0] . "人";
                                    } else {
                                        echo "取得失敗";
                                    }
                                } else {
                                    echo "執行失敗：" . $connection->error;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>全年定貨總額</h4>
                            </td>
                            <td>
                                <?php
                                // 儲存MySQL/MariaDB 指令
                                $sqlQuery = "SELECT COUNT(*) FROM `client` WHERE `status` = '正常'";
                                // 執行MySQL/MariaDB 指令
                                if ($result = $connection->query($sqlQuery)) {
                                    if ($row = $result->fetch_row()) {
                                        echo  $row[0] . "人";
                                    } else {
                                        echo "取得失敗";
                                    }
                                } else {
                                    echo "執行失敗：" . $connection->error;
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <div class="row" style="height:3vh;"></div>
</div>