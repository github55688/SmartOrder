<!DOCTYPE HTML>
<html>
	<head>
		<title>情境選擇</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="right-sidebar is-preload">
		<div id="page-wrapper">
			<div id="header">
					<div class="inner">
						<header>
						<h1>情境1</h1>
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
										<form action="situation2.php" method="post">
										<p>情境選擇</p>
										<input type="radio" name="situation" value="family">家人
										<input type="radio" name="situation" value="friend">朋友
										<input type="radio" name="situation" value="boyandgirl">情侶
										<input type="radio" name="situation" value="one">個人
										<input type="radio" name="situation" value="other">其他
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
