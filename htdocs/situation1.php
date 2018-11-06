<!DOCTYPE HTML>

<html>
<?php
session_start();

?>

    <head>
        <title>情境選擇</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    </head>

    <body>
        <div id="page-wrapper">
            <div id="header">
                <div class="inner">
                    <header>
                        <h1>情境選擇</h1>
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
                    <div class="row">
                        <article class="col-4 col-12-mobile special">
                            <form action="situation2.php" method="post">
                                <div>
                                    <input type="radio" id="control_01" name="situation" value="family">
                                    <label for="control_01">
								<h2>家人</h2>
								<p>Family/家族/가족/Familia/ครอบครัว</p>
							</label>
                                </div>
                        </article>
                        <article class="col-4 col-12-mobile special">
                            <div>
                                <input type="radio" id="control_02" name="situation" value="friend">
                                <label for="control_02">
								<h2>朋友</h2>
								<p>Friend/フレンド/친구/Amigo/เพื่อน</p>
							</label>
                            </div>
                        </article>
                        <article class="col-4 col-12-mobile special">
                            <div>
                                <input type="radio" id="control_03" name="situation" value="boyandgirl">
                                <label for="control_03">
								<h2>情侶</h2>
								<p>Couple/カップル/커플/Pareja/คนรัก</p>
							</label>
                            </div>
                        </article>
                        <article class="col-4 col-12-mobile special">
                            <div>
                                <input type="radio" id="control_04" name="situation" value="one">
                                <label for="control_04">
								<h2>個人</h2>
								<p>individual/シングル/싱글/Soltero/เดียว</p>
							</label>
                            </div>
                        </article>
                        <article class="col-4 col-12-mobile special">
                            <div>
                                <input type="radio" id="control_05" name="situation" value="other">
                                <label for="control_05">
								<h2>其他</h2>
								<p>other/その他/기타/Otros/อื่น ๆ</p>
							</label>
                            </div>
                        </article>
                        <article class="col-4 col-12-mobile special">
                        </article>
                        <div>
                            <input type="submit" value="NEXT">
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </body>

</html>