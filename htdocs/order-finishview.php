
<!DOCTYPE HTML>
<?php
include_once "connect.php";
?>
<html>
<head>
    <title>訂單</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/finish.css" />
</head>

<body>

<div class="hh1">訂單</div>

<ul>

<li><a href="situation2.php"><div class='two'>繼續點餐</div></a></li>

</ul>
<!-- ... 表格顯示 ... -->
<table class="bordered">
<tr>
<th>訂單編號</th>
<th>序號</th>
<th>湯頭</th>
<th>主餐</th>
<th>副餐</th>
<th>金額</th>
<th>加點</th>
<th>修改/刪除</th>
</tr>

<?php
$id = !empty($_GET["id"]) ? $_GET["id"] : "";
if ($id == "") {
$result = mysqli_query($conn, "SELECT MAX(訂單編號) AS max_id FROM 訂單");
$row = mysqli_fetch_array($result);
$sql0 = "SELECT * FROM 訂單 Where 訂單編號='$row[max_id]'";
$result = $conn->query($sql0);
$num = mysqli_num_rows($result);
$total = 0;
for ($i = 1; $i <= $num; $i++) {
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
    $result_add = mysqli_query($conn, "SELECT 商品名稱,數量 FROM 加點 Where 訂單編號='$訂單編號'AND 序號 ='$序號'");

    echo "<tr><form>";
    echo "<td>$訂單編號</td>";
    echo "<td>$序號</td>";
    echo "<td>$row_soup[soup]</td>";
    echo "<td>$row_main[main]</td>";
    echo "<td>$row_side[side]</td>";
    echo "<td>$row_price[price]</td><td>";
    while ($rowadd = $result_add->fetch_assoc()) {
        if ($rowadd['數量'] != 0) {
            $fff = $rowadd['商品名稱'];
            $result_name = mysqli_query($conn, "SELECT menu_name AS qqq FROM menu Where menu_id='$fff'");
            $row_add = mysqli_fetch_array($result_name);
            echo $row_add['qqq'] . " " . $rowadd['數量'] . " ";
        }
    }
    echo "<td align='center'>
   <!-- <input type='Submit' name='Submit' value='修改'/> -->
         <input type='Submit'name='Submit' value='刪除'/>
                        <input type='hidden'name='id' value='$序號'/>
                        <input type='hidden'name='a' value='$訂單編號'/></td>";
    echo "</td></form></tr>";
    $total = $total + $row_price["price"];
}

echo "</table>";
echo "<div style=text-align:right><h2>總金額: $total</h2>";
}else{
    $Submit = !empty($_GET["Submit"]) ? $_GET["Submit"] : null;
    $訂單編號= !empty($_GET["a"]) ? $_GET["a"] : null;
    if ($Submit == '刪除') {
        $sql = "DELETE FROM 訂單 WHERE 序號='$id' AND 訂單編號='$訂單編號'";
        $msg = '刪除完成';
    } else {
        echo '錯誤';
        return;
    }
    mysqli_query($conn, $sql);
                        echo ($msg);
                        //header("location: order-finishview.php");
}
mysqli_close($conn);
?>
</table>
<ul>
<li><a href="index.php"><div class='one' id='redword'>取消點餐</div></a></li>
<li><a href="pdf.php"><div class='three'>完成點餐</div></a></li>

</ul>
</body>
</html>