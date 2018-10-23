<!DOCTYPE HTML>

<html>
<?php
session_start();
$_SESSION["situation"] = $_POST["situation"];
?>
	<head>
		<title>情境選擇</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="right-sidebar is-preload">
		<div id="page-wrapper">
			<div id="header">
					<div class="inner">
						<header>
						<h1>情境2</h1>
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
							<div class="row gtr-200">
								<div class="col-8 col-12-mobile" id="content">
									<article id="main">
										<form action="order-main.php" method="post">
										<p>性別選擇</p>
										<input type="radio" name="gender" value="boy">男
										<input type="radio" name="gender" value="girl">女
										<br>
										<p>年齡層</p>
										<input type="radio" name="age" value="young">青年
										<input type="radio" name="age" value="mid">中年
										<input type="radio" name="age" value="old">老年
										<br>
										<input type="submit" value="NEXT">
										</form>
									</article>
								</div>
							</div>
						</div>
					</div>
		</div>
</body>
</html>
