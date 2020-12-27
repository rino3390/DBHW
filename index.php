<!--這是所有頁面的共用入口，因為要修改的就只有中間的內容而已-->

<?php
include('model/header.php');   		// 載入共用的頁首

//定義路徑 (只有一層的不定義)
define("CLIENT", "data/client_data/");
define("ACCOUNT", "data/account/");
define("ORDER", "data/order_data/");
define("PURCHASE", "data/purchase_data/");

//檢查登入狀態
include("checklogin.php");
//如果有接收到登入資訊
if(isset($_POST["account"]) && isset($_POST["pwd"])){
	//嘗試接收登入
	if (file_exists('./data/linkSQL.php')) {
		include("./data/linkSQL.php");
	} else if (file_exists('../linkSQL.php')) {
		include("../linkSQL.php");
	} else {
		echo "登入資訊檔消失";
	}
	//確認身分
	if ($_POST["account"] == $dbuser && $_POST["pwd"] == $dbpassword) {
		$_SESSION['account'] = $dbuser;
		$_SESSION['pwd'] = $dbpassword;
		echo "<script>alert('成功進入系統')</script>";
	} else {
		header("Location: index.php?page=login&failed=1"); 
	}
}
//登出
if (isset($_GET['Logout']) && $_GET['Logout'] == 1) {
	echo "<script>alert('已登出本系統')</script>";
	if (isset($_SESSION['account'])) unset($_SESSION['account']);
	if (isset($_SESSION['pwd'])) unset($_SESSION['pwd']);
	if (isset($_SESSION['sqlQuery'])) unset($_SESSION['sqlQuery']);
}

if(isset($_GET["failed"]) && $_GET["failed"] == 2){
	if (isset($_SESSION['account'])) unset($_SESSION['account']);
	if (isset($_SESSION['pwd'])) unset($_SESSION['pwd']);
	if (isset($_SESSION['sqlQuery'])) unset($_SESSION['sqlQuery']);
	echo "<script>alert('無權限訪問')</script>";
}

//如果有宣告目的地，先進入該path
$dest = isset($_GET['dest']) ? (defined($_GET['dest']) ? constant($_GET['dest']) : $_GET['dest']."/"): "";
//如果page已定義，載入該頁面
$page = (isset($_GET['page']) AND !empty($_GET['page'])) ? $_GET['page']: "main";

include('model/nav.php');   		// 載入共用的頁首
include($dest.$page.'.php');		// 中間的內容 (路徑+頁面)
include('model/footer.php'); 		// 載入共用的頁尾

?>
