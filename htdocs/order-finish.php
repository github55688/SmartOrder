<!DOCTYPE HTML>

<html>
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
$sql = "INSERT INTO home1 (situation, gender, age, soup, mainmeal, sidemeal)
VALUES ('$situation','$gender','$age','$soup','$mainmeal','$sidemeal')";
if ($conn->query($sql) === true) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo $addmeal[0] . $amount[0];
?>

    <head>
        <title>訂單</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    </head>


    <body>


        <div id="page-wrapper">
            <div id="header">
                <div class="inner">
                    <header>
                        <h1>訂單</h1>
                    </header>
                </div>
                <nav id="nav">
                    <ul>
                        <li><a href="index.php">取消點餐</a></li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper style1">
                <div class="container">
                    <div>
                        <article id="main" class="special">
                            <table width="720" border="1">
                                <tbody>
                                    <tr height="100">
                                        <th scope="col"><h3>訂單編號</h3></th>
                                        <th scope="col"><h3>序號</h3></th>
                                        <th scope="col"><h3>湯頭</h3></th>
                                        <th scope="col"><h3>主餐</h3></th>
                                        <th scope="col"><h3>副餐</h3></th>
                                        <th scope="col"><h3>金額</h3></th>
                                    </tr>
                                    <?php
unset($_SESSION["temp"], $_SESSION["soup"], $_SESSION["mainmeal"]);

$var = $_SESSION["var"];
//echo "目前序號" . $var;
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

$sql2 = "INSERT INTO 訂單 (訂單編號, 序號, 湯頭, 主餐, 副餐)
                                        VALUES ('$abc','$var','$soup','$mainmeal','$sidemeal')";
if ($conn->query($sql2) === true) {
    echo "";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}
//序號加一
$var++;
$_SESSION["var"] = $var;

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
    echo "<tr><form>";
    echo "<td align='center'><h2>$訂單編號</h2></td>";
    echo "<td align='center'><h2>$序號</hh23></td>";
    echo "<td align='center'><h2>$row_soup[soup]</h2></td>";
    echo "<td align='center'><h2>$row_main[main]</h2></td>";
    echo "<td align='center'><h2>$row_side[side]</h2></td>";
    echo "<td align='center'><h2>$row_price[price]</h2></td>";
    echo "</form></tr>";
    $total = $total + $row_price["price"];
}

echo "</table>";
echo "<div style=text-align:right><h2>總金額: $total</h2>";

?>
                                        <br>
                                </tbody>
                            </table>
                            <div class="button"><a href="situation2.php">繼續點餐</a></div><br>
                            <div class="button"><a href="pdf.php">完成點餐</a></div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </body>


</html>