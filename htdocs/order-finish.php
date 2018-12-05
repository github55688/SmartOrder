<!DOCTYPE HTML>
<?php
include_once "connect.php";
session_start();
$situation = $_SESSION["situation"];
$gender = $_SESSION["temp"][0];
$age = $_SESSION["temp"][1];
$soup = $_SESSION["soup"];
$mainmeal = $_SESSION["mainmeal"];
$sidemeal = $_SESSION["sidemeal"];
$addmeal = $_POST["addmeal"];
$amount = $_POST["amount"];
//分析用資料庫
$sql = "INSERT INTO home1 (situation, gender, age, soup, mainmeal, sidemeal)
VALUES ('$situation','$gender','$age','$soup','$mainmeal','$sidemeal')";
if ($conn->query($sql) === true) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//清除
unset($_SESSION["temp"], $_SESSION["soup"], $_SESSION["mainmeal"], $_SESSION["sidemeal"]);

//編號、序號
$var = $_SESSION["var"];
$date = date("Ym");
$result = mysqli_query($conn, "SELECT MAX(訂單編號) AS max_id FROM 訂單 Where Left(訂單編號,6)='$date'");
$row = mysqli_fetch_array($result);
echo "";
if ($var == '1') {
    if (empty($row["max_id"])) {
        $abc = $date . '001';
    } else {
        $abc = $row["max_id"] + 1;
    }
    echo "";
} else {
    $abc = $row["max_id"];
}
//插入訂單資料庫
$sql2 = "INSERT INTO 訂單 (訂單編號, 序號, 湯頭, 主餐, 副餐)
                                        VALUES ('$abc','$var','$soup','$mainmeal','$sidemeal')";
if ($conn->query($sql2) === true) {
    echo "";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}
//插入加點資料庫
$abcd = 0;
while (!empty($addmeal[$abcd])) {
    if ($amount[$abcd] != 0) {
        $sqladd = "INSERT INTO 加點 (訂單編號, 序號, 商品名稱,數量) VALUES ('$abc','$var','$addmeal[$abcd]','$amount[$abcd]')";
        $conn->query($sqladd);
    }
    $abcd++;
}
//序號加一
$var++;
$_SESSION["var"] = $var;
?>
<!-- ... HTML ... -->
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
</tr>

<?php
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

    echo "<tr>";
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
    echo "</td></tr>";
    $total = $total + $row_price["price"];
}

echo "</table>";
echo "<div style=text-align:right><h2>總金額: $total</h2>";

?>
</table>
<ul>
<li><a href="index.php"><div class='one' id='redword'>取消點餐</div></a></li>
<li><a href="pdf.php"><div class='three'>完成點餐</div></a></li>

</ul>
</body>
</html>