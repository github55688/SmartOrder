<!DOCTYPE HTML>

<html>
<?php
session_start();
$_SESSION["soup"] = $_POST["soup"];
include_once("connect.php");
//副餐
$sql = "SELECT * FROM menu WHERE menu_type='C'";
$result = $conn->query($sql);
$i = 0;
while ($row = $result->fetch_assoc()) {
    $side[$i] = $row["menu_name"];
    $i++;
}
$num = mysqli_num_rows($result);
?>

<head>
		<title>附餐選擇</title>
	</head>
	<body class="right-sidebar is-preload">
		<div id="page-wrapper">
			<!-- Header -->
			<div id="header">

				<!-- Inner -->
					<div class="inner">
						<header>
						<h1>附餐</h1>
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
echo "<form action='order-finish.php' method='post'>";
echo "<br>副餐:";
for ($counter = 0; $counter < $num; $counter++) {
    echo "<input type='radio' name='sidemeal' value='C0" . ($counter + 1) . "'>" . $side[$counter];
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
