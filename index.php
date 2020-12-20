<!--這是所有頁面的共用入口，因為要修改的就只有中間的內容而已-->



<?php
//定義路徑 (只有一層的不定義)
define("CLIENT", "data/client_data/");
define("ACCOUNT", "data/account/");
define("ORDER", "data/order_data/");
define("PURCHASE", "data/purchase_data/");

//如果有宣告目的地，先進入該path
$dest = isset($_GET['dest']) ? (defined($_GET['dest']) ? constant($_GET['dest']) : $_GET['dest']."/"): "";
//如果page已定義，載入該頁面
$page = (isset($_GET['page']) AND !empty($_GET['page'])) ? $_GET['page']: "main";

include('model/header.php');   		// 載入共用的頁首
include($dest.$page.'.php');		// 中間的內容 (路徑+頁面)
include('model/footer.php'); 		// 載入共用的頁尾

?>
