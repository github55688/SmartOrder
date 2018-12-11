<?php //推薦主餐
$situation = $_SESSION["situation"];
$gender = $_POST["gender"];
$age = $_POST["age"];

$result = $conn->query("SELECT 情境, 性別, 年齡, 主餐 FROM 推薦 WHERE 來源='$source' AND (情境='$situation' OR 情境='all') AND (性別='$gender' OR 性別='all') AND (年齡='$age' OR 年齡='all')");
$num = mysqli_num_rows($result);
if ($num > 0) {
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        switch ($row["情境"]) {
            case 'family':
                $row["情境"] = '家人';
                break;
            case 'friend':
                $row["情境"] = '朋友';
                break;
            case 'couple':
                $row["情境"] = '情侶';
                break;
            case 'personal':
                $row["情境"] = '個人';
                break;
            case 'other':
                $row["情境"] = '其他';
                break;
            case 'all':
                $row["情境"] = '不拘';
                break;
        }
        switch ($row["性別"]) {
            case 'male':
                $row["性別"] = '男';
                break;
            case 'female':
                $row["性別"] = '女';
                break;
            case 'all':
                $row["性別"] = '不拘';
                break;
        }
        switch ($row["年齡"]) {
            case 'young':
                $row["年齡"] = '青年';
                break;
            case 'mid':
                $row["年齡"] = '中年';
                break;
            case 'old':
                $row["年齡"] = '老年';
                break;
            case 'all':
                $row["年齡"] = '不拘';
                break;
        }
        $good[$i] = $row["主餐"];
        $result2 = mysqli_query($conn, "SELECT menu_name AS name1 FROM menu Where menu_id='$good[$i]'");
        $name = mysqli_fetch_row($result2);
        echo "1.情境: " . $row["情境"] . "<br>";
        echo "2.性別: " . $row["性別"] . "<br>";
        echo "3.年齡: " . $row["年齡"] . "<br>";
        echo "推薦: " . $name[0] . "<br>";
        $i++;
    }
} else {
    echo "暫無推薦";
}
