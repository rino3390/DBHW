<?php if (!login()) {
    header("Location: index.php?failed=2");
}
?>

<?php /*add*/
if (isset($_POST['id']) && isset($_POST['date'])) {
    include("./data/linkSQL.php");
    mysqli_set_charset($connection, "utf8mb4");
    //先新增訂單
    $today = date("Y/m/d");
    $sql = "INSERT INTO `order` (`clientID`, `orderDate`, `expectDate`) VALUES ('" . $_POST['id'] . "', '" . $today . "', '" . $_POST['date'] . "')";
    //訂單新增成功
    if ($connection->query($sql) === TRUE) {
        $last_id = $connection->insert_id;
        //新增訂單-商品關聯
        for ($a = 1; $a <= 5; $a++) {
            if (isset($_POST['productName' . $a]) && $_POST['productName' . $a] != "") {
                $sql = "INSERT INTO `order_product` (`orderID`, `productID`, `number`,`unit`,`supplierID`) VALUES ('" . $last_id . "', '" . $_POST['productName'. $a]  . "', '" . $_POST['productNum'. $a] . "', '" . $_POST['unit'. $a] . "', '" . $_POST['supplier'. $a]. "')";
                if ($connection->query($sql) === TRUE) {
                } else {
                    //新增失敗會刪除訂單
                    $sql = "DELETE FROM `order` WHERE `orderID`=.$last_id.";
                    echo "執行失敗：" . $connection->error;
                    break;
                }
            }
        }
        echo "<script>alert('新增成功');</script>";
    } else {
        echo "執行失敗：" . $connection->error;
    }
}
?>

<script>
    function check() {
        if (document.getElementById("id").value.replace(/\s+/g, "") == "") {
            alert("身份證字號不得為空");
            return false;
        }
        if (document.getElementById("date").value.replace(/\s+/g, "") == "") {
            alert("預期遞交日不可為空");
            return false;
        }
        if ((document.getElementById("productName1").value.replace(/\s+/g, "") != "" ||
                document.getElementById("productNum1").value.replace(/\s+/g, "") != "" ||
                document.getElementById("unit1").value.replace(/\s+/g, "") != "" ||
                document.getElementById("supplier1").value.replace(/\s+/g, "") != "") && (
                document.getElementById("productName1").value.replace(/\s+/g, "") == "" ||
                document.getElementById("productNum1").value.replace(/\s+/g, "") == "" ||
                document.getElementById("unit1").value.replace(/\s+/g, "") == "" ||
                document.getElementById("supplier1").value.replace(/\s+/g, "") == "")) {
            alert("貨物1四個欄位都必須填值");
            return false;
        }
        if ((document.getElementById("productName2").value.replace(/\s+/g, "") != "" ||
                document.getElementById("productNum2").value.replace(/\s+/g, "") != "" ||
                document.getElementById("unit2").value.replace(/\s+/g, "") != "" ||
                document.getElementById("supplier2").value.replace(/\s+/g, "") != "") && (
                document.getElementById("productName2").value.replace(/\s+/g, "") == "" ||
                document.getElementById("productNum2").value.replace(/\s+/g, "") == "" ||
                document.getElementById("unit2").value.replace(/\s+/g, "") == "" ||
                document.getElementById("supplier2").value.replace(/\s+/g, "") == "")) {
            alert("貨物2四個欄位都必須填值");
            return false;
        }
        if ((document.getElementById("productName3").value.replace(/\s+/g, "") != "" ||
                document.getElementById("productNum3").value.replace(/\s+/g, "") != "" ||
                document.getElementById("unit3").value.replace(/\s+/g, "") != "" ||
                document.getElementById("supplier3").value.replace(/\s+/g, "") != "") && (
                document.getElementById("productName3").value.replace(/\s+/g, "") == "" ||
                document.getElementById("productNum3").value.replace(/\s+/g, "") == "" ||
                document.getElementById("unit3").value.replace(/\s+/g, "") == "" ||
                document.getElementById("supplier3").value.replace(/\s+/g, "") == "")) {
            alert("貨物3四個欄位都必須填值");
            return false;
        }
        if ((document.getElementById("productName4").value.replace(/\s+/g, "") != "" ||
                document.getElementById("productNum4").value.replace(/\s+/g, "") != "" ||
                document.getElementById("unit4").value.replace(/\s+/g, "") != "" ||
                document.getElementById("supplier4").value.replace(/\s+/g, "") != "") && (
                document.getElementById("productName4").value.replace(/\s+/g, "") == "" ||
                document.getElementById("productNum4").value.replace(/\s+/g, "") == "" ||
                document.getElementById("unit4").value.replace(/\s+/g, "") == "" ||
                document.getElementById("supplier4").value.replace(/\s+/g, "") == "")) {
            alert("貨物4四個欄位都必須填值");
            return false;
        }
        if ((document.getElementById("productName5").value.replace(/\s+/g, "") != "" ||
                document.getElementById("productNum5").value.replace(/\s+/g, "") != "" ||
                document.getElementById("unit5").value.replace(/\s+/g, "") != "" ||
                document.getElementById("supplier5").value.replace(/\s+/g, "") != "") && (
                document.getElementById("productName5").value.replace(/\s+/g, "") == "" ||
                document.getElementById("productNum5").value.replace(/\s+/g, "") == "" ||
                document.getElementById("unit5").value.replace(/\s+/g, "") == "" ||
                document.getElementById("supplier5").value.replace(/\s+/g, "") == "")) {
            alert("貨物5四個欄位都必須填值");
            return false;
        }
        if (document.getElementById("productName1").value.replace(/\s+/g, "") == "" &&
            document.getElementById("productNum1").value.replace(/\s+/g, "") == "" &&
            document.getElementById("unit1").value.replace(/\s+/g, "") == "" &&
            document.getElementById("supplier1").value.replace(/\s+/g, "") == "" &&
            document.getElementById("productName2").value.replace(/\s+/g, "") == "" &&
            document.getElementById("productNum2").value.replace(/\s+/g, "") == "" &&
            document.getElementById("unit2").value.replace(/\s+/g, "") == "" &&
            document.getElementById("supplier2").value.replace(/\s+/g, "") == "" &&
            document.getElementById("productName3").value.replace(/\s+/g, "") == "" &&
            document.getElementById("productNum3").value.replace(/\s+/g, "") == "" &&
            document.getElementById("unit3").value.replace(/\s+/g, "") == "" &&
            document.getElementById("supplier3").value.replace(/\s+/g, "") == "" &&
            document.getElementById("productName4").value.replace(/\s+/g, "") == "" &&
            document.getElementById("productNum4").value.replace(/\s+/g, "") == "" &&
            document.getElementById("unit4").value.replace(/\s+/g, "") == "" &&
            document.getElementById("supplier4").value.replace(/\s+/g, "") == "" &&
            document.getElementById("productName5").value.replace(/\s+/g, "") == "" &&
            document.getElementById("productNum5").value.replace(/\s+/g, "") == "" &&
            document.getElementById("unit5").value.replace(/\s+/g, "") == "" &&
            document.getElementById("supplier5").value.replace(/\s+/g, "") == "") {
            alert("貨物不可全為空");
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
                                <h4>客戶身分證</h4>
                            </td>
                            <td>
                                <input id="id" name="id" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>預期遞交日</h4>
                            </td>
                            <td>
                                <input id="date" name="date" class="form-control" type="date" maxlength="10">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="table-secondary">
                                <h4>貨物1</h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>編號</h4>
                            </td>
                            <td>
                                <input id="productName1" name="productName1" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>數量</h4>
                            </td>
                            <td>
                                <input id="productNum1" name="productNum1" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>單位</h4>
                            </td>
                            <td>
                                <input id="unit1" name="unit1" class="form-control" type="text" maxlength="6">
                            </td>
                            <td class="table-secondary">
                                <h4>供應商編號</h4>
                            </td>
                            <td>
                                <input id="supplier1" name="supplier1" class="form-control" type="text" maxlength="5">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="table-secondary">
                                <h4>貨物2</h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>編號</h4>
                            </td>
                            <td>
                                <input id="productName2" name="productName2" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>數量</h4>
                            </td>
                            <td>
                                <input id="productNum2" name="productNum2" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>單位</h4>
                            </td>
                            <td>
                                <input id="unit2" name="unit2" class="form-control" type="text" maxlength="6">
                            </td>
                            <td class="table-secondary">
                                <h4>供應商編號</h4>
                            </td>
                            <td>
                                <input id="supplier2" name="supplier2" class="form-control" type="text" maxlength="5">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="table-secondary">
                                <h4>貨物3</h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>編號</h4>
                            </td>
                            <td>
                                <input id="productName3" name="productName3" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>數量</h4>
                            </td>
                            <td>
                                <input id="productNum3" name="productNum3" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>單位</h4>
                            </td>
                            <td>
                                <input id="unit3" name="unit3" class="form-control" type="text" maxlength="6">
                            </td>
                            <td class="table-secondary">
                                <h4>供應商編號</h4>
                            </td>
                            <td>
                                <input id="supplier3" name="supplier3" class="form-control" type="text" maxlength="5">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="table-secondary">
                                <h4>貨物4</h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>編號</h4>
                            </td>
                            <td>
                                <input id="productName4" name="productName4" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>數量</h4>
                            </td>
                            <td>
                                <input id="productNum4" name="productNum4" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>單位</h4>
                            </td>
                            <td>
                                <input id="unit4" name="unit4" class="form-control" type="text" maxlength="6">
                            </td>
                            <td class="table-secondary">
                                <h4>供應商編號</h4>
                            </td>
                            <td>
                                <input id="supplier4" name="supplier4" class="form-control" type="text" maxlength="5">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="table-secondary">
                                <h4>貨物5</h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>編號</h4>
                            </td>
                            <td>
                                <input id="productName5" name="productName5" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>數量</h4>
                            </td>
                            <td>
                                <input id="productNum5" name="productNum5" class="form-control" type="text" maxlength="10">
                            </td>
                            <td class="table-secondary">
                                <h4>單位</h4>
                            </td>
                            <td>
                                <input id="unit5" name="unit5" class="form-control" type="text" maxlength="6">
                            </td>
                            <td class="table-secondary">
                                <h4>供應商編號</h4>
                            </td>
                            <td>
                                <input id="supplier5" name="supplier5" class="form-control" type="text" maxlength="5">
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