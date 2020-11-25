<!DOCTYPE html>
<?php session_start(); ?>

<html lang="zh-Hant-TW">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>SHAAAARK 生鮮食品公司</title>
</head>

<body>
	<nav class="menu">
		<ul>
			<li><a href="index.php?dest=CLIENT&page=info">客戶資料</a></li>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="index.php?dest=CLIENT&page=info">查詢</a>
				<a class="dropdown-item" href="index.php?dest=CLIENT&page=add">新增</a>
				<a class="dropdown-item" href="index.php?dest=CLIENT&page=statistics">統計</a>
			</div>
			<li><a href="data/order_data/info">訂貨資料</a></li>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="index.php?dest=ORDER&page=info">查詢</a>
				<a class="dropdown-item" href="index.php?dest=ORDER&page=add">新增</a>
				<a class="dropdown-item" href="index.php?dest=ORDER&page=statistics">統計</a>
			</div>
			<li><a href="index.php?dest=PURCHASE&page=info">進貨資料</a></li>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="index.php?dest=PURCHASE&page=info">查詢</a>
				<a class="dropdown-item" href="index.php?dest=PURCHASE&page=add">新增</a>
				<a class="dropdown-item" href="index.php?dest=PURCHASE&page=statistics">統計</a>
			</div>
			<li><a href="index.php?dest=ACCOUNT&page=info">應收帳款</a></li>
			<li><a href="index.php?dest=data&page=statistics">整合統計</a></li>
		</ul>
	</nav>