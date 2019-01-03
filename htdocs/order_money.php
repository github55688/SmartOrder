<?php
include "connect.php";
$result = mysqli_query($conn, "SELECT MAX(訂單編號) AS max_id FROM 訂單");
$row = mysqli_fetch_array($result);
$sql0 = "SELECT * FROM 訂單 Where 訂單編號='$row[max_id]'";
$result = $conn->query($sql0);
$num = mysqli_num_rows($result);
$total = 0;
for ($i = 0; $i < $num; $i++) {
    $smalltotal = 0;
    $j = 0;
    $row0 = mysqli_fetch_row($result);
    $訂單編號 = $row[0];
    $序號 = $row0[1];
    $湯頭 = $row0[2];
    $主餐 = $row0[3];
    $副餐 = $row0[4];
    $result_soup = mysqli_query($conn, "SELECT menu_name AS soup FROM menu Where menu_id='$row0[2]'");
    $row_soup = mysqli_fetch_array($result_soup);
    $result_main = mysqli_query($conn, "SELECT menu_name AS main FROM menu Where menu_id='$row0[3]'");
    $row_main = mysqli_fetch_array($result_main);
    $result_side = mysqli_query($conn, "SELECT menu_name AS side FROM menu Where menu_id='$row0[4]'");
    $row_side = mysqli_fetch_array($result_side);
    $result_price = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$row0[3]'");
    $row_price = mysqli_fetch_array($result_price);
    $result_add = mysqli_query($conn, "SELECT 商品名稱, 數量 FROM 加點 Where 訂單編號='$訂單編號' AND 序號 ='$序號'");
    while ($add = $result_add->fetch_assoc()) {
        $egname = $add['商品名稱'];
        $chname = mysqli_query($conn, "SELECT menu_name AS qqq FROM menu Where menu_id='$egname'");
        $addprice = mysqli_query($conn, "SELECT menu_price AS price FROM menu Where menu_id='$egname'");
        $row_addprice = mysqli_fetch_array($addprice);
        $total = $total + $row_addprice['price'] * $add['數量'];
        $smalltotal = $smalltotal + $row_addprice['price'] * $add['數量'];
        $row_add = mysqli_fetch_array($chname);
        $html2[$i][$j] = $row_add['qqq'] . "&emsp;" . $row_addprice['price'] . " *" . $add['數量'];
        $html3[$i][$j] = "$".$row_addprice['price'] * $add['數量'];
        $j++;
    }
    //單人小計
    $smalltotal = $smalltotal + $row_price["price"];
    //訂單總和
    $total = $total + $row_price["price"];
    $html[$i] = '序號' . $序號 . '<br><br>' .
        $row_soup['soup'] . '+' . $row_main['main'] . '+' . $row_side['side'] .
        '&emsp;$' . $row_price['price'];
    $html4[$i] = '小計:&emsp;$' . $smalltotal;
}
