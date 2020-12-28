<?php if (!login()) {
    header("Location: index.php?failed=2");
}
?>

<?php /*add*/
if (isset($_POST['name']) && isset($_POST['ID']) && isset($_POST['tel']) && isset($_POST['address']) && isset($_POST['age']) && isset($_POST['job']) && isset($_POST['date'])&& count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        include("./data/linkSQL.php");
        mysqli_set_charset($connection, "utf8mb4");
        $tmpname = $_FILES['userImage']['tmp_name'];
        $fp = fopen($tmpname, 'r');
        $fileContent = fread($fp, filesize($tmpname));
        $file_uploads = base64_encode($fileContent);
        $sql = "INSERT INTO `client` (`clientName`, `clientID`, `tel`, `address`, `age`, `job`, `date`, `pic`, `status`) VALUES ('" . $_POST['name'] . "', '" . $_POST['ID'] . "', '" . $_POST['tel'] . "', '" . $_POST['address'] . "', '" . $_POST['age'] . "', '" . $_POST['job'] . "', '" . $_POST['date'] . "', '" . $_FILES['userImage']['type'] . ";base64," . $file_uploads . "','正常')";
        if ($connection->query($sql) === TRUE) {
            echo "<script>alert('新增成功');</script>";
        } else {
            echo "執行失敗：" . $connection->error;
        }
    }
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
        if (document.getElementById("date").value.replace(/\s+/g, "") == "") {
            alert("日期不得為空");
            return false;
        }
        if (document.getElementById("userImage").value.replace(/\s+/g, "") == "") {
            alert("照片不得為空");
            return false;
        }
        return true;
    }
</script>

<div class="main-content">
    <div class="row" style="height:3vh;"></div>
    <div class="row" style="height:10vh;">
        <div class="col text-center">
            <h1>新增客戶資料</h1>
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
                                <h4>客戶姓名</h4>
                            </td>
                            <td>
                                <input id="name" name="name" class="form-control" type="text" maxlength="12">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>客戶身分證字號</h4>
                            </td>
                            <td>
                                <input id="ID" name="ID" class="form-control" type="text" maxlength="10">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>電話</h4>
                            </td>
                            <td>
                                <input id="tel" name="tel" class="form-control" type="text" maxlength="16">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>住址</h4>
                            </td>
                            <td>
                                <input id="address" name="address" class="form-control" type="text" maxlength="30">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>年齡</h4>
                            </td>
                            <td>
                                <input id="age" name="age" class="form-control" type="text" maxlength="4">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>職業</h4>
                            </td>
                            <td>
                                <input id="job" name="job" class="form-control" type="text" maxlength="12">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>日期</h4>
                            </td>
                            <td>
                                <input id="date" name="date" type="date">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">
                                <h4>照片</h4>
                            </td>
                            <td>
                                <input id="userImage" name="userImage" type="file" class="form-control-file border" accept="image/*" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
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