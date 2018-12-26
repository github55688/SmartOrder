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
$date = date("Ymd");
$result = mysqli_query($conn, "SELECT MAX(訂單編號) AS max_id FROM 訂單 Where Left(訂單編號,8)='$date'");
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
header('Location: order-finishview.php');
?>