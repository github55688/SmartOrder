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
$sql2 = "INSERT INTO 訂單 (訂單編號, 序號, 湯頭, 主餐, 副餐)
VALUES ('','','$soup','$mainmeal','$sidemeal')";
if ($conn->query($sql) === true) {
    echo "成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

<html>
<head>
<meta charset="utf-8">
<title>home3</title>
</head>
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
	  <td><?php echo $_POST["addmeal"] ?></td>
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
<div class="button">繼續點餐</div><br>
<div class="button">完成點餐</div><br><br><br>
<div class="button">取消點餐</div>

</body>
</html>
<?php session_destroy();?>