<!DOCTYPE HTML>

<html>

<head>
    <title>規則管理</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/mai.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<body>
    <?php
include_once "connect.php";
?>
    <div id="header">
        <div class="inner">
            <header>
                <h1>規則管理</h1>
            </header>
        </div>
        <nav id="nav">
            <ul>
                <li><a href="index.php">返回</a></li>
            </ul>
        </nav>
    </div>
    <form action='recommend_edit.php' method='post'>
        <h3>情境 :</h3>
        <select name='situation'>
            <option></option>
            <option value='family'>家人</option>
            <option value='friend'>朋友</option>
            <option value='boyandgirl'>情侶</option>
            <option value='one'>個人</option>
            <option value='other'>其他</option>
        </select>
        <h3>性別 :</h3>

        <select name='gender'>
            <option></option>
            <option value='boy'>男</option>
            <option value='girl'>女</option>
        </select>
        <h3>年齡 :</h3>
        <select name='age'>
            <option></option>
            <option value='young'>青年</option>
            <option value='mid'>中年</option>
            <option value='old'>老年</option>
            <option value='null'>不設定</option>
        </select>
        <h3>主餐 :</h3>
        <select name='mainmeal'>
            <option></option>
            <?php
$result = $conn->query("SELECT menu_id,menu_name FROM menu WHERE menu_type='B'");
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['menu_id'] . "'>" . $row['menu_name'] . "</option>";
}
?>
        </select>
        <h3>湯頭 :</h3>
        <select name='soup'>
            <option></option>
            <?php
$result = $conn->query("SELECT menu_id,menu_name FROM menu WHERE menu_type='A'");
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['menu_id'] . "'>" . $row['menu_name'] . "</option>";
}
?>
            <option value='null'>不設定</option>
        </select>
        <input type='submit' name='send' value='新增規則'>
        <br><br><br>
    </form>

    <?php
//如果其中任一不為空
if (!empty($_POST['situation']) && !empty($_POST['gender']) && !empty($_POST['age']) && !empty($_POST['mainmeal']) && !empty($_POST['soup'])) {

    $situation = $_POST['situation'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $mainmeal = $_POST['mainmeal'];
    $soup = $_POST['soup'];
    $sql1 = "INSERT INTO 推薦 (情境, 性別, 年齡, 主餐, 湯頭) VALUES ('$situation','$gender','$age','$mainmeal','$soup')";
    $sql2 = "INSERT INTO 推薦 (情境, 性別, 年齡, 主餐, 湯頭) VALUES ('$situation','$gender',NULL,'$mainmeal','$soup')";
    $sql3 = "INSERT INTO 推薦 (情境, 性別, 年齡, 主餐, 湯頭) VALUES ('$situation','$gender','$age','$mainmeal',NULL)";
    $sql4 = "INSERT INTO 推薦 (情境, 性別, 年齡, 主餐, 湯頭) VALUES ('$situation','$gender',NULL,'$mainmeal',NULL)";
    ($age == 'null' && $soup == 'null' ? $sql = $sql4 :
        ($age != 'null' && $soup == 'null' ? $sql = $sql3 :
            ($age == 'null' && $soup != 'null' ? $sql = $sql2 : $sql = $sql1)));
    $conn->query($sql);
}
//點選提交 其中有空值
else if (!empty($_POST["send"]) &&
    (empty($_POST["situation"]) || empty($_POST["gender"]) || empty($_POST["age"]) || empty($_POST["mainmeal"]) || empty($_POST["soup"]))) {
    echo '<script type="text/javascript">';
    echo 'alert("請輸入完整資訊!")';
    echo '</script>';
}
?>
<!-- ... 表格顯示 ... -->
    <table width="720" border="1">
        <tbody>
            <tr height="100">
                <th scope="col">編號</th>
                <th scope="col">情境</th>
                <th scope="col">性別</th>
                <th scope="col">年齡</th>
                <th scope="col">主餐</th>
                <th scope="col">湯頭</th>
                <th scope="col">修改/刪除</th>
            </tr>
            <?php
$id = !empty($_GET["id"]) ? $_GET["id"] : "";
if ($id == "") {
    $sql = "SELECT * FROM 推薦";
    $result = $conn->query($sql);
    $num = mysqli_num_rows($result);

    for ($i = 1; $i <= $num; $i++) {
        $row = mysqli_fetch_row($result);
        $menu_id = $row[0];
        $menu_type = $row[1]; //situation
        $menu_name = $row[2]; //gender
        $menu_price = $row[3]; //age
        $menu_inventory = $row[4]; //mainmeal
        $rrr = $row[5]; //soup
        switch ($menu_type) {
            case 'family':
                $menu_type = '家人';
                break;
            case 'friend':
                $menu_type = '朋友';
                break;
            case 'boyandgirl':
                $menu_type = '情侶';
                break;
            case 'one':
                $menu_type = '個人';
                break;
            case 'other':
                $menu_type = '其他';
                break;
        }
        switch ($menu_name) {
            case 'boy':
                $menu_name = '男';
                break;
            case 'girl':
                $menu_name = '女';
                break;
        }
        switch ($menu_price) {
            case 'young':
                $menu_price = '青年';
                break;
            case 'mid':
                $menu_price = '中年';
                break;
            case 'old':
                $menu_price = '老年';
                break;
        }
        $result2 = mysqli_query($conn, "SELECT menu_name AS named FROM menu Where menu_id='$menu_inventory'");
        $name1 = mysqli_fetch_row($result2);
        $menu_inventory = $name1[0];
        $result3 = mysqli_query($conn, "SELECT menu_name AS named FROM menu Where menu_id='$rrr'");
        $name2 = mysqli_fetch_row($result3);
        $rrr = $name2[0];
        echo "<tr><form>
        <td align='center'>$menu_id</td>
        <td align='center'>
        $menu_type
        </td>
        <td align='center'>
        $menu_name
        </td>
        <td align='center'>
        $menu_price
        </td>
        <td align='center'>
        $menu_inventory
        </td>
        <td align='center'>
        $rrr
        </td>
        <td align='center'>
        <input type='Submit'name='Submit' value='刪除'/>
        <input type='hidden'name='id' value='$menu_id'/></td>
        </form></tr>";
    }
    echo "</table>";
} else {
    //取得參數
    $nn = !empty($_GET["menu_type"]) ? $_GET["menu_type"] : null;
    $n = !empty($_GET["menu_name"]) ? $_GET["menu_name"] : null;
    $p = !empty($_GET["menu_price"]) ? $_GET["menu_price"] : null;
    $in = !empty($_GET["menu_inventory"]) ? $_GET["menu_inventory"] : null;
    $ing = !empty($_GET["rrr"]) ? $_GET["rrr"] : null;
    $Submit = !empty($_GET["Submit"]) ? $_GET["Submit"] : null;

    if ($Submit == '刪除') {
        $sql = "DELETE FROM 推薦 WHERE 編號='$id'";
        $msg = '刪除完成';
    } else {
        echo '錯誤';
        return;
    }
    mysqli_query($conn, $sql);
    echo ($msg);
    header("location: recommend_edit.php");
}
?>

        </tbody>
    </table>
</body>

</html>