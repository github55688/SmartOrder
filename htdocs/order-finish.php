<!doctype html>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/css/main.css" />
<noscript>
  <link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
<?php
include_once "connect.php";
session_start();
$situation = $_SESSION["situation"];
$gender = $_SESSION["temp"][0];
$age = $_SESSION["temp"][1];
$soup = $_SESSION["soup"];
$mainmeal = $_SESSION["mainmeal"];
$sidemeal = $_POST["sidemeal"];
//$addmeal=$_POST["addmeal"];
$sql = "INSERT INTO home1 (situation, gender, age, soup, mainmeal, sidemeal)
VALUES ('$situation','$gender','$age','$soup','$mainmeal','$sidemeal')";
if ($conn->query($sql) === true) {
    echo "成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

<html>

<body>
  <table width="720" border="1">
    <tbody>
      <tr height="100">
        <th scope="col">訂單編號</th>
        <th scope="col">序號</th>
        <th scope="col">湯頭</th>
        <th scope="col">主餐</th>
        <th scope="col">副餐</th>
      </tr>

      <p>&nbsp;</p>

      <?php
unset($_SESSION["temp"], $_SESSION["soup"], $_SESSION["mainmeal"]);

?>
      <?php
$var = $_SESSION["var"];
echo "目前序號" . $var;
$date=date("Ym");
$result = mysqli_query($conn, "SELECT MAX(訂單編號) AS max_id FROM 訂單 Where Left(訂單編號,6)='$date'");
$row = mysqli_fetch_array($result);
echo "最大訂單編號: " . $row["max_id"];
if($var=='1')
  {
    if(empty( $row["max_id"]))
  {
    $abc=$date.'001';
  }
  else
  {
    $abc=$row["max_id"]+1;
  }
  echo $abc;
  }
else
{
  $abc=$row["max_id"];
}


$sql2 = "INSERT INTO 訂單 (訂單編號, 序號, 湯頭, 主餐, 副餐)
VALUES ('$abc','$var','$soup','$mainmeal','$sidemeal')";
if ($conn->query($sql2) === true) {
    echo "成功";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}
$var++;
$_SESSION["var"] = $var;
//echo $_SESSION["var"];

$result = mysqli_query($conn, "SELECT MAX(訂單編號) AS max_id FROM 訂單");
$row = mysqli_fetch_array($result);
$sql0 = "SELECT * FROM 訂單 Where 訂單編號='$row[max_id]'";
$result = $conn->query($sql0);
$num = mysqli_num_rows($result);
for ($i = 1; $i <= $num; $i++) {
        $row0 = mysqli_fetch_row($result);
        $訂單編號 = $row[0];
        $序號 = $row0[1];
        $湯頭 = $row0[2];
        $主餐 = $row0[3];
        $副餐 = $row0[4];
        echo "<tr><form>";
        echo "<td align='center'>$訂單編號</td>";
        echo "<td align='center'>$序號</td>";
        echo "<td align='center'>$湯頭</td>";
        echo "<td align='center'>$主餐</td>";
        echo "<td align='center'>$副餐</td>";
        echo "</form></tr>";
    }
    echo "</table>";
?>
    </tbody>
  </table>
  <div class="button"><a href="situation2.php">繼續點餐</a></div><br>
  <div class="button"><a href="index.php">完成點餐</a></div><br><br><br>
  <div class="button">取消點餐</div>
</body>

</html>