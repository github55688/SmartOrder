<!DOCTYPE HTML>
<html>
<head>
    <title>規則管理</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/mainn.css" />
</head>
<?php include_once "connect.php";?>
<!--------------------->
<body>
<h3><a href="index.php">返回</a></h3>
<h1>推薦規則管理</h1>
<!-- ... 插入規則 ... -->
<form action='recommend_edit.php' method='post'>
    <span>
    情境 :
    <select name='situation'>
        <option></option>
        <option value='family'>家人</option>
        <option value='friend'>朋友</option>
        <option value='boyandgirl'>情侶</option>
        <option value='one'>個人</option>
        <option value='other'>其他</option>
    </select>
    性別 :
    <select name='gender'>
        <option></option>
        <option value='boy'>男</option>
        <option value='girl'>女</option>
    </select>
    年齡 :
    <select name='age'>
        <option></option>
        <option value='young'>青年</option>
        <option value='mid'>中年</option>
        <option value='old'>老年</option>
        <option value='null'>不設定</option>
    </select>
    主餐 :
    <select name='mainmeal'>
        <option></option>
<?php
$result = $conn->query("SELECT menu_id,menu_name FROM menu WHERE menu_type='B'");
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['menu_id'] . "'>" . $row['menu_name'] . "</option>";
}
?>
    </select>
    湯頭 :
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
    <input id='my1210' type='submit' name='send' value='Go'>
    </span>
</form>

<!-- ... 點選插入 ... -->
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
    echo '<script type="text/javascript">alert("請輸入完整資訊!")</script>';
}
?>

<!-- ... 表格顯示 ... --><br><br>
<table class="bordered">
<thead>
    <tr>
        <th>#</th>
                    <th>情境</th>
                    <th>性別</th>
                    <th>年齡</th>
                    <th>主餐</th>
                    <th>湯頭</th>
                    <th>刪除</th>
    </tr></thead>
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
        <td>$menu_id</td>
        <td>
        $menu_type
        </td>
        <td>
        $menu_name
        </td>
        <td>
        $menu_price
        </td>
        <td>
        $menu_inventory
        </td>
        <td>
        $rrr
        </td>
        <td>
        <input type='Submit'name='Submit' value='Delete'/>
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
</table>

<!-- ... 插入規則 ... --><br><br>
<h1>主廚規則管理</h1>

</body>
</html>