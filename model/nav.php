<body>
	<div class="navbar-fixed-top">
		<!--導覽列固定頁首-->
		<h2>SHAAAARK 生鮮食品公司</h2>
		<nav class="nav navbar-default">
			<div class="container-fluid">
				<!--bootstrp容器 將寬度設定為auto，所以當縮放瀏覽器時，它會保持全屏大小，始終保持100%的寬度-->
				<ul class="nav nav-tabs">
					<!--選單的底線-->
					<li class="dropdown"><a href="index.php">Home</a></li>
					<li class="dropdown"><a class="dropdown-toggle " data-toggle="dropdown" href="index.php?dest=CLIENT&page=info">客戶資料<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<!--客戶資料-->
							<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=info">查詢</a></li>
							<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=add">新增</a></li>
							<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=delete">停用</a></li>
							<li><a class="dropdown-item" href="index.php?dest=CLIENT&page=statistics">統計</a></li>
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="index.php?dest=ORDER&page=info">訂貨資料<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<!--訂貨資料-->
							<li><a class="dropdown-item" href="index.php?dest=ORDER&page=info">查詢</a></li>
							<li><a class="dropdown-item" href="index.php?dest=ORDER&page=add">新增</a></li>
							<li><a class="dropdown-item" href="index.php?dest=ORDER&page=delete">刪除</a></li>
							<li><a class="dropdown-item" href="index.php?dest=ORDER&page=statistics">統計</a></li>
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="index.php?dest=PURCHASE&page=info">進貨資料<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<!--進貨資料-->
							<li><a class="dropdown-item" href="index.php?dest=PURCHASE&page=info">查詢</a></li>
							<li><a class="dropdown-item" href="index.php?dest=PURCHASE&page=add">新增</a></li>
							<li><a class="dropdown-item" href="index.php?dest=PURCHASE&page=delete">刪除</a></li>
							<li><a class="dropdown-item" href="index.php?dest=PURCHASE&page=statistics">統計</a></li>
						</ul>
					</li>
					<li class="dropdown"><a href="index.php?dest=ACCOUNT&page=info">應收帳款</a></li>
					<li class="dropdown"><a href="index.php?dest=data&page=statistics">整合統計</a></li>
					<ul class="nav navbar-nav navbar-right">
						<?php if (login()) echo "<li><a data-toggle=\"tab\" href=\"#\"><a href=\"index.php?Logout=1\"><span class=\"glyphicon glyphicon-log-out\"></span>Log out</a></li>";
						else echo "<li><a data-toggle=\"tab\" href=\"#\"><a href=\"index.php?page=login\"><span class=\"glyphicon glyphicon-log-in\"></span> Log in</a></li>";

						?>
					</ul>
				</ul>
			</div>
		</nav>
	</div>