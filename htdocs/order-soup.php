<!DOCTYPE HTML>

<html>
<?php
session_start();
include_once("connect.php");
$_SESSION["mainmeal"] = $_POST["mainmeal"];
//湯頭
$sql = "SELECT * FROM menu WHERE menu_type='A'";
$result = $conn->query($sql);
$i = 0;
while ($row = $result->fetch_assoc()) {
    $soup[$i] = $row["menu_name"];
    $i++;
}
$num = mysqli_num_rows($result);
?>

<head>
	<title>湯頭選擇</title>
</head>

<body class="right-sidebar is-preload">
	<div id="page-wrapper">
		<!-- Header -->
		<div id="header">

			<!-- Inner -->
			<div class="inner">
				<header>
					<h1>湯頭</h1>
				</header>
			</div>
			<!-- Nav -->
			<nav id="nav">
				<ul>
					<li><a href="index.php">取消點餐</a></li>
				</ul>
			</nav>
		</div>
		<!-- Main -->
		<div class="wrapper style1">
			<div class="container">
				<div class="row gtr-200">
					<div class="col-8 col-12-mobile" id="content">
						<article id="main">
<?php
//餐點選項按鈕
echo "<form action='order-side.php' method='post'>";
echo "<br>湯頭:";
for ($counter = 0; $counter < $num; $counter++) {
    echo "<input type='radio' name='soup' value='A0" . ($counter + 1) . "'>" . $soup[$counter];
}

echo "<br><input type='submit' value='GO'></form>";
?>
						</article>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>