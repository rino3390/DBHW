<?php if (!login()) {
    header("Location: index.php?failed=2");
}
?>

<?php /*add*/
if (isset($_POST['id']) && isset($_POST['date'])) {
    include("./data/linkSQL.php");
    mysqli_set_charset($connection, "utf8mb4");
    $sql = "INSERT INTO `order` (`supplierID`, `productID`, `number`,`unit`,`price`,`location`,`standard`,`purchaseDate`) VALUES ('" . $_POST['id'] . "', '" . $today . "', '" . $_POST['date'] . "')";
    if ($connection->query($sql) === TRUE) {
        echo "<script>alert('新增成功');</script>";
    } else {
        echo "執行失敗：" . $connection->error;
    }
}
?>

<script>
    function check() {
        if (document.getElementById("id").value.replace(/\s+/g, "") == "") {
            alert("供應商編號不可為空");
            return false;
        }
        if (document.getElementById("productName").value.replace(/\s+/g, "") == "") {
            alert("貨物編號不可為空");
            return false;
        }
        if (document.getElementById("num").value.replace(/\s+/g, "") == "") {
            alert("進貨數量不可為空");
            return false;
        }
        if (document.getElementById("unit").value.replace(/\s+/g, "") == "") {
            alert("單位不可為空");
            return false;
        }
        if (document.getElementById("price").value.replace(/\s+/g, "") == "") {
            alert("單價不可為空");
            return false;
        }
        if (document.getElementById("loc").value.replace(/\s+/g, "") == "") {
            alert("庫存位置不可為空");
            return false;
        }
        if (document.getElementById("status").value.replace(/\s+/g, "") == "") {
            alert("規格不可為空");
            return false;
        }
        return true;
    }
</script>

<div class="main-content">
    <div class="row" style="height:3vh;"></div>
    <div class="row" style="height:10vh;">
        <div class="col text-center">
            <h1>新增訂單</h1>
        </div>
    </div>
    <div class="row" style="height:3vh;"></div>
    <div class="row">
        <div class="col" style="padding:0px 5vw">
            <form name="form" enctype="multipart/form-data" action="index.php?dest=ORDER&page=add" method="post" onsubmit="if(check())return true; else return false;" onkeydown="if(event.keyCode==13){document.getElementById('add').click();return false;}">
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <td class="table-secondary">
                                <h4>供應商編號</h4>
                            </td>
                            <td>
                                <input id="id" name="id" class="form-control" type="text" maxlength="10">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>貨物編號</h4>
                            </td>
                            <td>
                                <input id="productName" name="productName" class="form-control" type="text" maxlength="10">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>進貨數量</h4>
                            </td>
                            <td>
                                <input id="num" name="num" class="form-control" type="text" maxlength="10">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>單位</h4>
                            </td>
                            <td>
                                <input id="unit" name="unit" class="form-control" type="text" maxlength="10">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>單價</h4>
                            </td>
                            <td>
                                <input id="price" name="price" class="form-control" type="text" maxlength="6">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>庫存位置</h4>
                            </td>
                            <td>
                                <input id="loc" name="loc" class="form-control" type="text" maxlength="5">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>規格</h4>
                            </td>
                            <td>
                                <input id="status" name="status" class="form-control" type="text" maxlength="5">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-center">
                                <input type="submit" id="submit" value="新增" style="width:100%;display:none;" class="btn btn-primary" />
                                <!--新增按鈕-->
                                <button id="add" type="button" class="btn btn-default btn-info btn-block m-auto" style="width:65vw;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">新增</button>
                                <!--新增確認框-->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="message-text" class="control-label">是否新增？</label>
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