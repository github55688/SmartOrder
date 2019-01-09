<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="assets/css/sales.css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.flot.js"></script>
    <script type="text/javascript" src="js/jquery.flot.time.js"></script>
    <script type="text/javascript" src="/js/jquery.flot.symbol.js"></script>
    <script type="text/javascript" src="/js/jquery.flot.axislabels.js"></script>
    <script type="text/javascript" src="/js/jquery.flot.pie.js"></script>
    <?php include_once "sale_code.php"?>
    <script src="sales_month.js"></script>
    <script src="sales_oneweek.js"></script>
</head>

<body>
    <div id="container">
        <div id="word">月營收表</div>
        <div id="flot-placeholder"></div><br>
        <div id="table1"></div><br>
        <div id="popular_month"></div>
        <br><br>
        <div id="word">每週營收</div>
        <div id="now_week_display"></div>
        <div id="buttons">
        <button onclick="zero()">本週</button>
        <button onclick="one()">上週</button>
        <button onclick="two()">二週前</button>
        <button onclick="three()">三週前</button>
        </div>
        
        <div id="flot-placeholder2"></div><br>
        <div id="table2"></div>
    </div>
</body>

</html>