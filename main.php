<head>
    <link rel="stylesheet" type="text/css" href="./CSS/main.css" charset="utf-8"/>
</head>

<body>
    <?php echo("這裡是首頁"); ?><br>
    /*置頂*/<br>
    position:fixed; /* 絕對定位，fixed是相對於瀏覽器窗口定位。 */<br>
    margin-top:50px; /* 距離窗口頂部距離 */<br>
    left:0; /* 距離窗口左邊的距離 */<br>
    width:100%; /* 寬度設置爲100% */<br>
    height:90px; /* 高度 */<br>
    z-index:99; /* 層疊順序，數值越大就越高。頁面滾動的時候就不會被其他內容所遮擋。 */<br>
</body>