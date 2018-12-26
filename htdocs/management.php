<!DOCTYPE HTML>

<?php
include_once "connect.php";
$today = 0;
$date = date("Ymd");
$result1 = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,8)='$date'");
$result2 = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,8)='$date'");
while ($row1 = $result1->fetch_assoc()) {
    $main_id = $row1['主餐'];
    $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
    $price = mysqli_fetch_assoc($price);
    $today = $today + $price['price'];
}
while ($row2 = $result2->fetch_assoc()) {
    $add_id = $row2['商品名稱'];
    $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
    $price = mysqli_fetch_assoc($price);
    $today = $today + $price['price'] * $row2['數量'];
}

?>
<html>
<head>
    <title>主餐選擇</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<body class="right-sidebar is-preload">
    <div id="page-wrapper">
        <!-- Header -->
        <div id="header">
            <!-- Inner -->
            <div class="inner">
                <header>
                    <h1>當月營業額: <?php echo $today; ?></h1>
                </header>
            </div>
            <!-- Nav -->
            <nav id="nav">
                <ul>
                    <li><a href="index.php">回首頁</a></li>
                </ul>
            </nav>
        </div>
        <!-- Main -->
        <div class="wrapper style1">
            <div class="container">
                <div class="row">
                <article class="col-6 col-12-mobile special">
                <div align="center">
        <input type="button" value="菜單管理" onclick="location.href='edit.php'">
        </div>
                        </article>
                        <article class="col-6 col-12-mobile special">
                        <div align="center">
        <input type="button" value="規則管理" onclick="location.href='recommend_edit.php'">
        </div>
                        </article>
        </div>
        </div>
        </div>