<!DOCTYPE HTML>

<html>
<?php
session_start();
if (!empty($_SESSION["situation"])) {
    echo "繼續點餐，現在情境" . $_SESSION["situation"];
} else {
    $_SESSION["situation"] = $_POST["situation"];
    echo "現在情境" . $_SESSION["situation"];
}
echo "現在序號" . $_SESSION["var"];
?>

    <head>
        <title>情境選擇</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
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
                    <article id="main" class="special">
                        <h3>性別 :</h3><br>
                    </article>
                    <div class="row">
                        <article class="col-3 col-12-mobile special">
                            <form action="order-main.php" method="post">
                                <div>
                                    <input type="radio" id="gender_01" name="gender" value="boy">
                                    <label for="gender_01">
                                        <h2>男</h2>
                                    </label>
                                </div>
                        </article>
                        <article class="col-3 col-12-mobile special">
                            <div>
                                <input type="radio" id="gender_02" name="gender" value="girl">
                                <label for="gender_02">
                                        <h2>女</h2>
                                    </label>
                            </div>
                        </article>
                    </div><br>
                    <h3>年齡層 :</h3><br>
                    <div class="row">
                        <article class="col-4 col-12-mobile special">
                            <div>
                                <input type="radio" id="age_01" name="age" value="young">
                                <label for="age_01">
                                        <h2>青年</h2>
                                    </label>
                            </div>
                        </article>
                        <article class="col-4 col-12-mobile special">
                            <div>
                                <input type="radio" id="age_02" name="age" value="mid">
                                <label for="age_02">
                                        <h2>中年</h2>
                                    </label>
                            </div>
                        </article>
                        <article class="col-4 col-12-mobile special">
                            <div>
                                <input type="radio" id="age_03" name="age" value="old">
                                <label for="age_03">
                                        <h2>老年</h2>
                                    </label>
                            </div>
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