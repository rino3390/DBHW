<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Bootstrap Navigation Bar</title>
    <link rel="stylesheet" type="text/css" href="./CSS/main.css" charset="utf-8"/>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"><!--匯入bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!--匯入jQuery-->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script><!--匯入bootstrap javascript-->
</head>

<body>
    <nav class="nav navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Brand</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a data-toggle="tab" href="#home">Home</a></li>
                <li><a data-toggle="tab" href="#menu1">Page 1</a></li>
                <li><a data-toggle="tab" href="#menu2">Page 2</a></li>
            </ul>
        </div>
    </nav>
    <?php echo("這裡是首頁"); ?><br>
    /*置頂*/<br>
    position:fixed; /* 絕對定位，fixed是相對於瀏覽器窗口定位。 */<br>
    margin-top:50px; /* 距離窗口頂部距離 */<br>
    left:0; /* 距離窗口左邊的距離 */<br>
    width:100%; /* 寬度設置爲100% */<br>
    height:90px; /* 高度 */<br>
    z-index:99; /* 層疊順序，數值越大就越高。頁面滾動的時候就不會被其他內容所遮擋。 */<br> 
</body>