<?php
include_once "connect.php";
//-----------日------------
//查詢當日營收
$today = 0;
$date_day = date("Ymd");
$result = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,8)='$date_day'");
while ($row = $result->fetch_assoc()) {
    $main_id = $row['主餐'];
    $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
    $price = mysqli_fetch_assoc($price);
    $today = $today + $price['price'];
}
$result = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,8)='$date_day'");
while ($row = $result->fetch_assoc()) {
    $add_id = $row['商品名稱'];
    $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
    $price = mysqli_fetch_assoc($price);
    $today = $today + $price['price'] * $row['數量'];
}
//-----------月------------
//查詢近6個月
//金額
$Monthly = array(0, 0, 0, 0, 0, 0, 0);
//筆數
$Monthly_num = array(0, 0, 0, 0, 0, 0, 0);
//熱銷
$popular_month=array();
for ($i = -5, $j = 0; $i <= 0; $i++, $j++) {
    $date_month = date("Ym", strtotime($i . ' month'));
    $result = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,6)='$date_month'");
    $Monthly_num[$j] = mysqli_num_rows($result);
    //echo $date_month."-";
    while ($row = $result->fetch_assoc()) {
        $main_id = $row['主餐'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
        $price = mysqli_fetch_assoc($price);
        $Monthly[$j] = $Monthly[$j] + $price['price'];
    }
    $result = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,6)='$date_month'");
    while ($row = $result->fetch_assoc()) {
        $add_id = $row['商品名稱'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
        $price = mysqli_fetch_assoc($price);
        $Monthly[$j] = $Monthly[$j] + $price['price'] * $row['數量'];
    }

    $result = mysqli_query($conn, "SELECT COUNT(*) AS cc, 主餐 FROM 訂單 WHERE Left(訂單編號,6)='$date_month' GROUP BY 主餐 ORDER BY cc DESC LIMIT 6");
    $k = 0;
    while ($row = $result->fetch_assoc()) {
        $cc = $row['主餐'];
        $result0 = mysqli_query($conn, "SELECT menu_name AS mainmeal FROM menu Where menu_id='$cc'");
        $name = mysqli_fetch_row($result0);
        $popular_month[$j][$k] = $name[0];
        //echo "<br>[".$j."]"."[".$k."]".$popular_month[$j][$k];
        $k++;
    }
}
//echo $popular_month[10][1];
//查詢前第7個月營收
$date_month2 = date("Ym", strtotime(-6 . ' month'));
$result12 = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,6)='$date_month2'");
while ($row = $result12->fetch_assoc()) {
    $main_id = $row['主餐'];
    $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
    $price = mysqli_fetch_assoc($price);
    $Monthly[6] = $Monthly[6] + $price['price'];
}
$result12 = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,6)='$date_month2'");
while ($row = $result12->fetch_assoc()) {
    $add_id = $row['商品名稱'];
    $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
    $price = mysqli_fetch_assoc($price);
    $Monthly[6] = $Monthly[6] + $price['price'] * $row['數量'];
}
?>

<script type="text/javascript">
    // pass PHP variable declared above to JavaScript variable
    var Monthly = <?php echo json_encode($Monthly) ?>;
    var Monthly_num = <?php echo json_encode($Monthly_num) ?>;
    var popular_month = <?php echo json_encode($popular_month) ?>;
</script>