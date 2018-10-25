<!DOCTYPE HTML>
<?php
session_start();
$_SESSION["var"] = '1';
unset($_SESSION["situation"]);
?>
<html>

<head>
	<title>起始頁面</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<body class="homepage is-preload">
	<div id="page-wrapper">

		<!-- Header -->
		<div id="header">

			<!-- Inner -->
			<div class="inner">
				<header>
					<h1>開始點餐</h1>
					<hr>
					<?php echo date("Ymd"); ?>
					<p>包 含 智 慧 推 薦 的 點 餐 系 統</p>
				</header>
				<footer>
					<a href="situation1.php" class="button">Start</a>
				</footer>
			</div>
			<!-- Nav -->
			<nav id="nav">
				<ul>
					<li><a href="index.php">開始點餐</a></li>
					<li><a href="edit.php">菜單管理</a></li>
					<li><a href="output1.php">weka</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.dropotron.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
</body>

</html>