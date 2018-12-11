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
    <input type="radio" name="source" value="rule">規則
    <input type="radio" name="source" value="custom">自訂<br>
    情境 :
    <select name='situation'>
        <option value='all'>不拘</option>
        <option value='family'>家人</option>
        <option value='friend'>朋友</option>
        <option value='couple'>情侶</option>
        <option value='personal'>個人</option>
        <option value='other'>其他</option>
    </select>
    性別 :
    <select name='gender'>
        <option value='all'>不拘</option>
        <option value='male'>男</option>
        <option value='female'>女</option>
    </select>
    年齡 :
    <select name='age'>
        <option value='all'>不拘</option>
        <option value='young'>青年</option>
        <option value='mid'>中年</option>
        <option value='old'>老年</option>
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
    </select>
    </select>
    副餐 :
    <select name='side'>
        <option value='all'>不拘</option>
<?php
$result = $conn->query("SELECT menu_id,menu_name FROM menu WHERE menu_type='C'");
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['menu_id'] . "'>" . $row['menu_name'] . "</option>";
}
?>
    </select>
    &emsp;<input id='my1' type='submit' name='send' value='+'>
    </span>
</form>
</div>
<!-- ... 點選插入 ... -->
<?php
if (!empty($_POST['source']) && !empty($_POST['mainmeal']) && !empty($_POST['soup'])) {
    $source = $_POST['source'];
    $situation = $_POST['situation'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $mainmeal = $_POST['mainmeal'];
    $soup = $_POST['soup'];
    $side = $_POST['side'];
    $sql = "INSERT INTO 推薦 (來源, 情境, 性別, 年齡, 主餐, 湯頭, 副餐) VALUES ('$source','$situation','$gender','$age','$mainmeal','$soup','$side')";
    $conn->query($sql);
} else if (!empty($_POST["send"]) && empty($_POST["source"])) {
    echo '<script type="text/javascript">',
    'alert("請選擇來源!")',
        '</script>';

} else if (!empty($_POST["send"]) && (empty($_POST["mainmeal"]) || empty($_POST["soup"]))) {
    echo '<script type="text/javascript">',
    'alert("少了主餐或湯頭!")',
        '</script>';
}
?>

<!-- ... 表格顯示 ... --><br>
<table class="bordered">
<thead>
    <tr>
    <th>來源</th>
    <th>情境</th>
    <th>性別</th>
    <th>年齡</th>
    <th>主餐</th>
    <th>湯頭</th>
    <th>副餐</th>
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
        $menu_id = $row_rule[0]; //id
        $source = $row_rule[1]; //來源
        $menu_type = $row_rule[2]; //situation
        $menu_name = $row_rule[3]; //gender
        $menu_price = $row_rule[4]; //age
        $menu_inventory = $row_rule[5]; //mainmeal
        $rrr = $row_rule[6]; //soup
        $sss = $row_rule[7]; //side
        $result2 = mysqli_query($conn, "SELECT menu_name AS named FROM menu Where menu_id='$menu_inventory'");
        $name1 = mysqli_fetch_row($result2);
        $menu_inventory = $name1[0];
        $result3 = mysqli_query($conn, "SELECT menu_name AS named FROM menu Where menu_id='$rrr'");
        $name2 = mysqli_fetch_row($result3);
        $rrr = $name2[0];
        $result4 = mysqli_query($conn, "SELECT menu_name AS named FROM menu Where menu_id='$sss'");
        $name3 = mysqli_fetch_row($result4);
        $sss == 'all' ? $sss = '-' : $sss = $name3[0];
        switch ($source) {
            case 'rule':
                $source = '規則';
                break;
            case 'custom':
                $source = '自訂';
                break;
        }
        switch ($menu_type) {
            case 'family':
                $menu_type = '家人';
                break;
            case 'friend':
                $menu_type = '朋友';
                break;
            case 'couple':
                $menu_type = '情侶';
                break;
            case 'personal':
                $menu_type = '個人';
                break;
            case 'other':
                $menu_type = '其他';
                break;
            case 'all':
                $menu_type = '-';
                break;
        }
        switch ($menu_name) {
            case 'male':
                $menu_name = '男';
                break;
            case 'female':
                $menu_name = '女';
                break;
            case 'all':
                $menu_name = '-';
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
            case 'all':
                $menu_price = '-';
                break;
        }
        echo "
        <tr><form>
        <td>$source</td>
        <td>$menu_type</td>
        <td>$menu_name</td>
        <td>$menu_price</td>
        <td>$menu_inventory</td>
        <td>$rrr</td>
        <td>$sss</td>
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
ob_end_flush(); //輸出全部內容到瀏覽器
?>
</table>

</body>
</html>