<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="assets/css/sales.css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.flot.js"></script>
    <script type="text/javascript" src="js/jquery.flot.time.js"></script>
    <script type="text/javascript" src="/js/jquery.flot.symbol.js"></script>
    <script type="text/javascript" src="/js/jquery.flot.axislabels.js"></script>
    <?php include_once "sale_code.php"?>
    <script src="sales_month.js"></script>
</head>

<body>
    <div id="container">
        <div id="word">月營收表</div><br>
        <div id="flot-placeholder"></div><br>
        <div id="table"></div><br>
        <div id="popular_month"></div>
        <br><br>
    </div>
</body>

</html>