<!DOCTYPE HTML>

<?php
session_start(); //開啟session
if (!isset($_SESSION['username'])) {
    echo "Please Login first";
    header("refresh:2;url=login.php"); //轉址
    exit(); //不執行之後的程式碼
}

include_once "connect.php";
$today = 0;
$today_num = 0;
$date = date("Ymd");
//money
$result = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,8)='$date'");
$today_num = mysqli_num_rows($result);
while ($row = $result->fetch_assoc()) {
    $main_id = $row['主餐'];
    $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
    $price = mysqli_fetch_assoc($price);
    $today = $today + $price['price'];
}
$result = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,8)='$date'");
while ($row = $result->fetch_assoc()) {
    $add_id = $row['商品名稱'];
    $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
    $price = mysqli_fetch_assoc($price);
    $today = $today + $price['price'] * $row['數量'];
}

//popular
$result = mysqli_query($conn, "SELECT COUNT(*) AS cc, 主餐 FROM 訂單 WHERE Left(訂單編號,8)='$date' GROUP BY 主餐  ORDER BY cc DESC LIMIT 3");
$i = 0;
while ($row = $result->fetch_assoc()) {
    $popular_today[$i] = $row['主餐'];
    $result2 = mysqli_query($conn, "SELECT menu_name AS mainmeal FROM menu Where menu_id='$popular_today[$i]'");
    $name = mysqli_fetch_row($result2);
    $popular_today[$i] = $name[0];
}
?>

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
                        <h2>日營業額:<?php echo $today; ?><br>
                            訂單筆數:<?php echo $today_num; ?><br><br>
                            本日熱銷<br><?php
for ($i = 0; $i < 3; $i++) {
    if (!empty($popular_today[$i])) {
        $j = $i + 1;
        echo $j . "-" . $popular_today[$i];
    }
}
?>
                        </h2>
                    </header>
                </div>
                <!-- Nav -->
                <nav id="nav">
                    <ul>
                        <li><a href="logout.php">登出</a></li>
                    </ul>
                </nav>
            </div>
            <!-- Main -->
            <div class="wrapper style1">
                <div class="container">
                    <div class="row">
                        <article class="col-4 col-12-mobile special">
                            <div align="center">
                                <input type="button" value="菜單管理" onclick="location.href='edit.php'">
                            </div>
                        </article>
                        <article class="col-4 col-12-mobile special">
                            <div align="center">
                                <input type="button" value="規則管理" onclick="location.href='recommend_edit.php'">
                            </div>
                        </article>
                        <article class="col-4 col-12-mobile special">
                            <div align="center">
                                <input type="button" value="財務統計" onclick="location.href='sales.php'">
                            </div>
                        </article>
                    </div>
                </div>
            </div>
</div>
</body>