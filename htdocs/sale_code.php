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
//查詢近12個月
//金額
$Monthly = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
//筆數
$Monthly_num = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
for ($i = -11, $j = 0; $i <= 0; $i++, $j++) {
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
//查詢前第13個月營收
$date_month2 = date("Ym", strtotime(-12 . ' month'));
$result12 = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,6)='$date_month2'");
while ($row = $result12->fetch_assoc()) {
    $main_id = $row['主餐'];
    $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
    $price = mysqli_fetch_assoc($price);
    $Monthly[12] = $Monthly[12] + $price['price'];
}
$result12 = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,6)='$date_month2'");
while ($row = $result12->fetch_assoc()) {
    $add_id = $row['商品名稱'];
    $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
    $price = mysqli_fetch_assoc($price);
    $Monthly[12] = $Monthly[12] + $price['price'] * $row['數量'];
}

//-----------週------------
//查詢本周營收
$str_week = ["last sunday midnight", "monday midnight", "tuesday midnight", "wednesday midnight", "thursday midnight", "friday midnight", "saturday midnight"];
//金額
$Weekly = array(0, 0, 0, 0, 0, 0, 0);
//顯示日期
$date_this_week = array(0, 0, 0, 0, 0, 0, 0);
//筆數
$Weekly_num = array(0, 0, 0, 0, 0, 0, 0);
for ($i = 0; $i < 7; $i++) {
    $d = strtotime('today');
    $start_week = strtotime($str_week[$i], $d);
    $start = date('Ymd', $start_week);
    $result = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,8)='$start'");
    $Weekly_num[$i] = mysqli_num_rows($result);
    while ($row = $result->fetch_assoc()) {
        $main_id = $row['主餐'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
        $price = mysqli_fetch_assoc($price);
        $Weekly[$i] = $Weekly[$i] + $price['price'];
    }
    $result = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,8)='$start'");
    while ($row = $result->fetch_assoc()) {
        $add_id = $row['商品名稱'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
        $price = mysqli_fetch_assoc($price);
        $Weekly[$i] = $Weekly[$i] + $price['price'] * $row['數量'];
    }
    $date_this_week[$i] = date('Y-m-d', $start_week);
}

//一周前
$Weekly1 = array(0, 0, 0, 0, 0, 0, 0);
$Weekly1_num = array(0, 0, 0, 0, 0, 0, 0);
$date_last1_week = array(0, 0, 0, 0, 0, 0, 0);
for ($i = 0; $i < 7; $i++) {
    $d = strtotime('1 weeks ago');
    $start_week = strtotime($str_week[$i], $d);
    $start = date('Ymd', $start_week);
    //echo $start.",";
    $result = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,8)='$start'");
    $Weekly1_num[$i] = mysqli_num_rows($result);
    while ($row = $result->fetch_assoc()) {
        $main_id = $row['主餐'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
        $price = mysqli_fetch_assoc($price);
        $Weekly1[$i] = $Weekly1[$i] + $price['price'];
    }
    $result = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,8)='$start'");
    while ($row = $result->fetch_assoc()) {
        $add_id = $row['商品名稱'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
        $price = mysqli_fetch_assoc($price);
        $Weekly1[$i] = $Weekly1[$i] + $price['price'] * $row['數量'];
    }
    $date_last1_week[$i] = date('Y-m-d', $start_week);
}
//二周前
$Weekly2 = array(0, 0, 0, 0, 0, 0, 0);
$Weekly2_num = array(0, 0, 0, 0, 0, 0, 0);
$date_last2_week = array(0, 0, 0, 0, 0, 0, 0);
for ($i = 0; $i < 7; $i++) {
    $d = strtotime('2 weeks ago');
    $start_week = strtotime($str_week[$i], $d);
    $start = date('Ymd', $start_week);
    //echo $start.",";
    $result = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,8)='$start'");
    $Weekly2_num[$i] = mysqli_num_rows($result);
    while ($row = $result->fetch_assoc()) {
        $main_id = $row['主餐'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
        $price = mysqli_fetch_assoc($price);
        $Weekly2[$i] = $Weekly2[$i] + $price['price'];
    }
    $result = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,8)='$start'");
    while ($row = $result->fetch_assoc()) {
        $add_id = $row['商品名稱'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
        $price = mysqli_fetch_assoc($price);
        $Weekly2[$i] = $Weekly2[$i] + $price['price'] * $row['數量'];
    }
    $date_last2_week[$i] = date('Y-m-d', $start_week);
}
//三周前
$Weekly3 = array(0, 0, 0, 0, 0, 0, 0);
$Weekly3_num = array(0, 0, 0, 0, 0, 0, 0);
$date_last3_week = array(0, 0, 0, 0, 0, 0, 0);
for ($i = 0; $i < 7; $i++) {
    $d = strtotime('3 weeks ago');
    $start_week = strtotime($str_week[$i], $d);
    $start = date('Ymd', $start_week);
    //echo $start.",";
    $result = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,8)='$start'");
    $Weekly3_num[$i] = mysqli_num_rows($result);
    while ($row = $result->fetch_assoc()) {
        $main_id = $row['主餐'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
        $price = mysqli_fetch_assoc($price);
        $Weekly3[$i] = $Weekly3[$i] + $price['price'];
    }
    $result = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,8)='$start'");
    while ($row = $result->fetch_assoc()) {
        $add_id = $row['商品名稱'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
        $price = mysqli_fetch_assoc($price);
        $Weekly3[$i] = $Weekly3[$i] + $price['price'] * $row['數量'];
    }
    $date_last3_week[$i] = date('Y-m-d', $start_week);
}
//四周前
$Weekly4 = array(0, 0, 0, 0, 0, 0, 0);
//$Weekly4_num = array(0, 0, 0, 0, 0, 0, 0);
for ($i = 0; $i < 7; $i++) {
    $d = strtotime('4 weeks ago');
    $start_week = strtotime($str_week[$i], $d);
    $start = date('Ymd', $start_week);
    //echo $start.",";
    $result = mysqli_query($conn, "SELECT 主餐 FROM 訂單 Where Left(訂單編號,8)='$start'");
    //$Weekly4_num[$i] = mysqli_num_rows($result);
    while ($row = $result->fetch_assoc()) {
        $main_id = $row['主餐'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$main_id'");
        $price = mysqli_fetch_assoc($price);
        $Weekly4[$i] = $Weekly4[$i] + $price['price'];
    }
    $result = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where Left(訂單編號,8)='$start'");
    while ($row = $result->fetch_assoc()) {
        $add_id = $row['商品名稱'];
        $price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$add_id'");
        $price = mysqli_fetch_assoc($price);
        $Weekly4[$i] = $Weekly4[$i] + $price['price'] * $row['數量'];
    }
}
?>

<script type="text/javascript">
    // pass PHP variable declared above to JavaScript variable
    var Monthly = <?php echo json_encode($Monthly) ?>;
    var Monthly_num = <?php echo json_encode($Monthly_num) ?>;
    var Weekly = <?php echo json_encode($Weekly) ?>;
    var Weekly_num = <?php echo json_encode($Weekly_num) ?>;
    var Weekly1 = <?php echo json_encode($Weekly1) ?>;
    var Weekly1_num = <?php echo json_encode($Weekly1_num) ?>;
    var Weekly2 = <?php echo json_encode($Weekly2) ?>;
    var Weekly2_num = <?php echo json_encode($Weekly2_num) ?>;
    var Weekly3 = <?php echo json_encode($Weekly3) ?>;
    var Weekly3_num = <?php echo json_encode($Weekly3_num) ?>;
    var Weekly4 = <?php echo json_encode($Weekly4) ?>;
    var date_this_week = <?php echo json_encode($date_this_week) ?>;
    var date_last1_week = <?php echo json_encode($date_last1_week) ?>;
    var date_last2_week = <?php echo json_encode($date_last2_week) ?>;
    var date_last3_week = <?php echo json_encode($date_last3_week) ?>;

    var popular_month = <?php echo json_encode($popular_month) ?>;
</script>