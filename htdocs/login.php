<html>
<?php
session_start();
include_once "connect.php";?>

    <head>
        <title>人員驗證</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/login.css" />
    </head>
<body>
<nav id="nav">
                  
					<li><a href="index.php">返回</a></li>
				  
			</nav>
<form name="form" method="post" action="login2.php">
<div class="body"></div>
		
		<div class="header">
			<div>管理員<span>登入</span></div>
		</div>
		<br>
		<div class="login">
				<input type="text" placeholder="username" name="user"><br>
				<input type="password" placeholder="password" name="password"><br>
				<input id="bt1" type="submit" value="Login">
        </div>
    </form>
        
</body> 

</html>