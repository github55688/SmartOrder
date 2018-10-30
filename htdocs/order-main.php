<!DOCTYPE HTML>

<html>
<?php
session_start();
$_SESSION["temp"] = array($_POST["gender"], $_POST["age"]);

include_once "connect.php";

//主餐
$sql = "SELECT * FROM menu WHERE menu_type='B'";
$result = $conn->query($sql);
$i = 0;
while ($row = $result->fetch_assoc()) {
    $main[$i] = $row["menu_name"];
    $i++;
}
$num = mysqli_num_rows($result);

?>

<head>
	<title>主餐選擇</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<body class="right-sidebar is-preload">
	<div id="page-wrapper">
		<!-- Header -->
		<div id="header">
			<!-- Inner -->
			<div class="inner">
				<header>
					<h1>主餐</h1>
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
echo "<form action='order-soup.php' method='post'>";
for ($counter = 0; $counter < $num; $counter++) {
    echo "<div>";
    echo "<input type='radio' id='main0" . ($counter + 1) . "' name='mainmeal' value='B0" . ($counter + 1) . "'>";
    echo "<label for='main0" . ($counter + 1) . "'>";
    echo "<h2>" . $main[$counter] . "</h2>";
    echo "<p>The quick brown fox jumps over the lazy dog.</p>";
    echo "</lable>";
    echo "</div>";
}
echo "<br><input type='submit' value='NEXT'></form>";
?>
						</article>
					</div>
					<div class="col-4 col-12-mobile" id="sidebar">
						<section>
							<header>
								<h3>Smart推薦區</h3>
							</header>
							<p>
								<?php include_once "man1.php";?>
							</p>
						</section>
						<br><br>
						<section>
							<header>
								<h3>熱門推薦區</h3>
							</header>
							<p>
								<?php
//熱門推薦
$sql = "SELECT COUNT(*) AS cc, mainmeal FROM home1 GROUP BY mainmeal ORDER BY cc DESC LIMIT 3";
$result = $conn->query($sql);
$i = 1;
while ($row = $result->fetch_assoc()) {
    echo "第" . $i . "名 : " . $row["mainmeal"] . "<br>";
    $i++;
}
?>
							</p>
						</section>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>