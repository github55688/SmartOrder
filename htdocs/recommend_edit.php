<!DOCTYPE HTML>
<html>
<head>
    <title>規則管理</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/mainn.css" />
    <link rel="icon" href="assets/css/tools.png" type="image/ico" />
</head>
<?php
include_once "connect.php";
ob_start(); //打開緩衝區
?>
<!--------------------->
<body>
<ul>
  <li><a href="index.php"><div class='one'>首頁</div></a></li>
  <li><a href="do.php"><div class='two'> 匯出</div></a></li>
</ul>

<h1>推薦規則管理</h1>
<!-- ... 插入規則 ... -->
<div class='middle1'>
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
    &emsp;性別 :
    <select name='gender'>
        <option></option>
        <option value='boy'>男</option>
        <option value='girl'>女</option>
    </select>
    &emsp;年齡 :
    <select name='age'>
        <option></option>
        <option value='young'>青年</option>
        <option value='mid'>中年</option>
        <option value='old'>老年</option>
        <option value='null'>不設定</option>
    </select>
    &emsp;主餐 :
    <select name='mainmeal'>
        <option></option>
<?php
$result = $conn->query("SELECT menu_id,menu_name FROM menu WHERE menu_type='B'");
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['menu_id'] . "'>" . $row['menu_name'] . "</option>";
}
?>
    </select>
    &emsp;湯頭 :
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
    &emsp;&emsp;<input id='my1' type='submit' name='send' value='+'>
    </span>
</form>
</div>
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

<!-- ... 表格顯示 ... --><br>
<table class="bordered">
<thead>
    <tr>
    <th>情境</th>
    <th>性別</th>
    <th>年齡</th>
    <th>主餐</th>
    <th>湯頭</th>
    <th>刪除</th>
    </tr>
</thead>
<?php
$id = !empty($_GET["id"]) ? $_GET["id"] : "";
if ($id == "") {
    $sql_rule = "SELECT * FROM 推薦";
    $result_rule = $conn->query($sql_rule);
    $num = mysqli_num_rows($result_rule);

    for ($i = 1; $i <= $num; $i++) {
        $row_rule = mysqli_fetch_row($result_rule);
        $menu_id = $row_rule[0];
        $menu_type = $row_rule[1]; //situation
        $menu_name = $row_rule[2]; //gender
        $menu_price = $row_rule[3]; //age
        $menu_inventory = $row_rule[4]; //mainmeal
        $rrr = $row_rule[5]; //soup
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
        <td>$menu_type</td>
        <td>$menu_name</td>
        <td>$menu_price</td>
        <td>$menu_inventory</td>
        <td>$rrr</td>
        <td>
        <input id='my3' type='Submit'name='Submit' value='Delete'/>
        <input type='hidden'name='id' value='$menu_id'/>
        </td>
        </form></tr>";
    }
} else {
    $Submit = !empty($_GET["Submit"]) ? $_GET["Submit"] : null;
    if ($Submit == 'Delete') {
        $sql = "DELETE FROM 推薦 WHERE 編號='$id'";
        $conn->query($sql);
        header("location: recommend_edit.php");
    } else {
        echo '錯誤';
        return;
    }

}
?>
</table>

<!-- ... 插入規則 ... --><br><br>
<h1>主廚規則管理</h1>
<form action='recommend_edit.php' method='post'>
&emsp;&emsp;&emsp;主餐 :
    <select name='mainmeal2'>
        <option></option>
<?php
$result = $conn->query("SELECT menu_id,menu_name FROM menu WHERE menu_type='B'");
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['menu_id'] . "'>" . $row['menu_name'] . "</option>";
}
?>
    </select>
    &emsp;&emsp;湯頭 :
    <select name='soup2'>
        <option></option>
<?php
$result = $conn->query("SELECT menu_id,menu_name FROM menu WHERE menu_type='A'");
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['menu_id'] . "'>" . $row['menu_name'] . "</option>";
}
?>
    </select>
    &emsp;&emsp;<input id='my2' type='submit' name='send2' value='+'>
    </span>
</form>

<!-- ... 點選插入 ... -->
<?php
if (!empty($_POST['mainmeal2']) && !empty($_POST['soup2'])) {
    $mainmeal2 = $_POST['mainmeal2'];
    $soup2 = $_POST['soup2'];
    $sql = "INSERT INTO 主廚 (主餐, 湯頭) VALUES ('$mainmeal2','$soup2')";
    $conn->query($sql);
} else if (!empty($_POST["send2"]) && (empty($_POST["mainmeal2"]) || empty($_POST["soup2"]))) {
    echo '<script type="text/javascript">alert("請輸入完整資訊!")</script>';
}
?>
<!-- ... 表格顯示 ... --><br>
<table class="bordered">
<thead>
    <tr>
    <th>主餐</th>
    <th>湯頭</th>
    <th>刪除</th>
    </tr>
</thead>
<?php
$id_chef = !empty($_GET["id_chef"]) ? $_GET["id_chef"] : "";
if ($id_chef == "") {
    $sql_chef = "SELECT * FROM 主廚";
    $result_chef = $conn->query($sql_chef);
    $num = mysqli_num_rows($result_chef);

    for ($i = 1; $i <= $num; $i++) {
        $row_chef = mysqli_fetch_row($result_chef);
        $menu_id2 = $row_chef[0];
        $menu_type2 = $row_chef[1]; //mainmeal
        $menu_name2 = $row_chef[2]; //soup

        $result2_chef = mysqli_query($conn, "SELECT menu_name AS named FROM menu Where menu_id='$menu_type2'");
        $name1 = mysqli_fetch_row($result2_chef);
        $menu_type2 = $name1[0];
        $result3_chef = mysqli_query($conn, "SELECT menu_name AS named FROM menu Where menu_id='$menu_name2'");
        $name2 = mysqli_fetch_row($result3_chef);
        $menu_name2 = $name2[0];
        echo "<tr><form>
        <td>$menu_type2</td>
        <td>$menu_name2</td>
        <td>
        <input id='my3' type='Submit'name='Submit2' value='Delete2'/>
        <input type='hidden'name='id_chef' value='$menu_id2'/>
        </td>
        </form></tr>";
    }
} else {
    $Submit2 = !empty($_GET["Submit2"]) ? $_GET["Submit2"] : null;
    if ($Submit2 == 'Delete2') {
        $sql = "DELETE FROM 主廚 WHERE 編號='$id_chef'";
        $conn->query($sql);
        header("location: recommend_edit.php");
    } else {
        echo '錯誤';
        return;
    }
}
ob_end_flush(); //輸出全部內容到瀏覽器
?>

</body>
</html>