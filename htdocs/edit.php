<!DOCTYPE HTML>

<html>

<head>
    <title>菜單管理</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<body>
    <?php
    include_once "connect.php";
    ?>
        <div id="header">
            <div class="inner">
                <header>
                    <h1>菜單管理</h1>
                </header>
            </div>
            <nav id="nav">
                <ul>
                    <li><a href="index.php">返回</a></li>
                </ul>
            </nav>
        </div>
        <form action='edit.php' method='post'>
            <h3>產品名稱 :</h3><input type='text' name='myname'>
            <h3>產品價格 :</h3><input type='text' name='myprice'>
            <h3>產品類別 :</h3>
            <select name='mytypes'>
            <option>選擇類別</option>
            <option value='A'>A</option>
            <option value='B'>B</option>
            <option value='C'>C</option>
            <option value='D'>D</option>
            </select>
            <input type='submit' name='send' value='新增'>
            <br><br><br>
        </form>

        <?php
        //表單全部不為空
        if (!empty($_POST["myname"]) && !empty($_POST["myprice"]) && !empty($_POST["mytypes"])) {
            //查詢有幾筆資料
            $mytypes = $_POST["mytypes"];
            $sql = "SELECT * FROM menu WHERE menu_type='$mytypes'";
            $result = $conn->query($sql);
            $num = mysqli_num_rows($result);
            $num++;
            //前面加零
            $stringA = '0';
            $stringB = $stringA . $num;
            //接收值
            $myname = $_POST["myname"];
            $myprice = $_POST["myprice"];
            //編號10以下
            if ($num < 10) {
                $sql = "INSERT INTO menu (menu_id, menu_type, menu_name, menu_price)
            VALUES ('$mytypes$stringB','$mytypes','$myname','$myprice')";
                if ($conn->query($sql) === true) {
                    echo "新紀錄插入成功";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            //編號10以上
            else {
                $sql = "INSERT INTO menu (menu_id, menu_type, menu_name, menu_price)
            VALUES ('$mytypes$num','$mytypes','$myname','$myprice')";
                if ($conn->query($sql) === true) {
                    echo "新紀錄插入成功";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            mysqli_free_result($result);
        }
        //點選提交AND其中有空值
        else if (!empty($_POST["send"]) &&
            (empty($_POST["myname"]) || empty($_POST["myprice"]) || empty($_POST["mytypes"]))) {
            echo '<script type="text/javascript">';
            echo 'alert("請輸入完整資訊!")';
            echo '</script>';
        }
        ?>




            <table width="720" border="1">
                <tbody>
                    <tr height="100">
                        <th scope="col">產品ID</th>
                        <th scope="col">產品類型</th>
                        <th scope="col">產品名稱</th>
                        <th scope="col">產品價格</th>
                        <th scope="col">修改/刪除</th>
                    </tr>
                    <?php
                    $id = !empty($_GET["id"]) ? $_GET["id"] : "";
                    if ($id == "") {
                        $sql = "SELECT * FROM menu";
                        $result = $conn->query($sql);
                        $num = mysqli_num_rows($result);

                        for ($i = 1; $i <= $num; $i++) {
                            $row = mysqli_fetch_row($result);
                            $menu_id = $row[0];
                            $menu_type = $row[1];
                            $menu_name = $row[2];
                            $menu_price = $row[3];
                            echo "<tr><form>";
                            echo "<td align='center'>$menu_id</td>";
                            echo "<td align='center'>$menu_type</td>";
                            echo "<td align='center'><input type=text name='menu_name' value='$menu_name'></td>";
                            echo "<td align='center'><input type=text name='menu_price' value='$menu_price'></td>";
                            echo "<td align='center'><input type='Submit' name='Submit' value='修改'/>
                        <input type='Submit'name='Submit' value='刪除'/>
                        <input type='hidden'name='id' value='$menu_id'/></td>";
                            echo "</form></tr>";
                        }
                        echo "</table>";
                    } else {
                        //取得參數
                        $n = !empty($_GET["menu_name"]) ? $_GET["menu_name"] : null;
                        $p = !empty($_GET["menu_price"]) ? $_GET["menu_price"] : null;
             
                        $Submit = !empty($_GET["Submit"]) ? $_GET["Submit"] : null;
                        if ($Submit == '修改') {
                            $sql = "UPDATE menu SET menu_name='$n',menu_price='$p' WHERE menu_id='$id'";
                            $msg = '修改完成';
                        } else if ($Submit == '刪除') {
                            $sql = "DELETE FROM menu WHERE menu_id='$id'";
                            $msg = '刪除完成';
                        } else {
                            echo '錯誤';
                            return;
                        }
                        mysqli_query($conn, $sql);
                        echo ($msg);
                        header("location: edit.php");
                    }

                    mysqli_close($conn);

                    ?>

                </tbody>
            </table>
</body>

</html>