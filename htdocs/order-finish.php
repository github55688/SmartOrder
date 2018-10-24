<!doctype html>
<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
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

<table width="850" height="414" border="1">
  <tbody>
    <tr>
    <th width="168" scope="col">序號</th>
    <th width="230" scope="col">湯頭</th>
    <th width="220" scope="col">主餐</th>
		<th width="204" scope="col">副餐</th>
		<th width="204" scope="col">加點</th>
    </tr>
    <tr>
    <th scope="row"></th>
    <td><?php echo $_SESSION["soup"] ?></td>
    <td><?php echo $_SESSION["mainmeal"] ?></td>
	  <td><?php echo $_POST["sidemeal"] ?></td>
	  <td><?php //echo $_POST["addmeal"] ?></td>
    </tr>
    <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>

<?php
unset($_SESSION["temp"], $_SESSION["soup"], $_SESSION["mainmeal"]);

?>

<div class="button"><a href="situation2.php">繼續點餐</a></div><br>
<div class="button"><a href="index.php">完成點餐</a></div><br><br><br>
<div class="button">取消點餐</div>

</body>
</html>

<?php
$date=date("Ym");
$result = mysqli_query($conn, "SELECT MAX(訂單編號) AS max_id FROM 訂單 Where Left(訂單編號,6)='$date'");
$row = mysqli_fetch_array($result);
echo "最大訂單編號: " . $row["max_id"];

if(empty( $row["max_id"]))
{
$abc=$date.'001';
}
else
{
$abc=$row["max_id"]+1;
}
echo $abc;
$var = $_SESSION["var"];
echo "目前序號" . $var;

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
?>