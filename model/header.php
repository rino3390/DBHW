<!DOCTYPE html>
<?php session_start(); ?>

<html lang="zh-Hant-TW">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>SHAAAARK 生鮮食品公司</title>

	<!--匯入CSS-->
	<link rel="stylesheet" type="text/css" href="./CSS/header.css" charset="utf-8"/>

	<!--匯入Bootstrap框架-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"><!--匯入bootstrap-->
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!--匯入jQuery-->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script><!--匯入bootstrap javascript-->
</head>

<body>
	<div class="nav navbar-dark navbar-fixed-top"><!--導覽列固定頁首-->
		<h1>SHAAAARK 生鮮食品公司</h1>
		<div class="container-fluid"><!--bootstrp容器 將寬度設定為auto，所以當縮放瀏覽器時，它會保持全屏大小，始終保持100%的寬度-->
			<div >
				<a class="navbar-brand" href="index.php?dest=CLIENT&page=main">home</a><!--網站名稱-->
			</div>
			<ul class="nav nav-tabs"><!--選單的底線-->
				<li class="dropdown"><a class="dropdown-toggle " data-toggle="dropdown" href="index.php?dest=CLIENT&page=info">客戶資料<span class="caret"></span></a>
					<ul class="dropdown-menu"><!--客戶資料-->
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=info">查詢</a></li>
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=add">新增</a></li>
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=statistics">統計</a></li>
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="data/order_data/info">訂貨資料<span class="caret"></span></a>
					<ul class="dropdown-menu"><!--訂貨資料-->
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=info">查詢</a></li>
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=add">新增</a></li>
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=statistics">統計</a></li>
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="index.php?dest=PURCHASE&page=info">進貨資料<span class="caret"></span></a>
					<ul class="dropdown-menu"><!--進貨資料-->
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=info">查詢</a></li>
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=add">新增</a></li>
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=statistics">統計</a></li>
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="index.php?dest=ACCOUNT&page=info">應收帳款<span class="caret"></span></a>
					<ul class="dropdown-menu"><!--進貨資料-->
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=info">查詢</a></li>
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=add">新增</a></li>
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=statistics">統計</a></li>
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="index.php?dest=data&page=statistics">整合統計<span class="caret"></span></a>
					<ul class="dropdown-menu"><!--進貨資料-->
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=info">查詢</a></li>
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=add">新增</a></li>
						<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=statistics">統計</a></li>
					</ul>
				</li>
				<ul class="nav navbar-nav navbar-right">
					<li><a data-toggle="tab" href="#"><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>
					<li><a data-toggle="tab" href="#">Log out</a></li>
				</ul>
			</ul>
		</div>
	</div>
</body>