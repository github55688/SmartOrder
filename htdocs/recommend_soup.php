<?php //推薦湯頭
$situation = $_SESSION["situation"]; //情境
$gender = $_SESSION["temp"][0]; //性別
$age = $_SESSION["temp"][1]; //年齡
$mainmeal = $_POST["mainmeal"]; //主餐
$apple = $_SESSION["apple"];
$GLOBALS['v'] = '0';

define("SQLL", array(
    //情境+性別+年齡+主餐--->湯頭 (1)0
    "SELECT 湯頭 FROM 推薦 WHERE 主餐='$mainmeal' AND 情境='$situation' AND 性別='$gender' AND 年齡='$age'",
    //情境+性別+主餐--->湯頭 (1)1
    "SELECT 湯頭 FROM 推薦 WHERE 主餐='$mainmeal' AND 情境='$situation' AND 性別='$gender' AND 年齡 IS NULL",
    //情境+年齡+主餐--->湯頭 (1)2
    "SELECT 湯頭 FROM 推薦 WHERE 主餐='$mainmeal' AND 情境='$situation' AND 年齡='$age' AND 性別 IS NULL",
    //情境+主餐--->湯頭 (1)3
    "SELECT 湯頭 FROM 推薦 WHERE 主餐='$mainmeal' AND 情境='$situation'",
));

switch ($apple) {
    case 1:
        run($conn, SQLL[0]);
        break;
    case 2:
        run($conn, SQLL[1]);
        break;
    case 3:
        run($conn, SQLL[2]);
        break;
    case 4:
        run($conn, SQLL[3]);
        break;
    case 5:
        echo "暫無此規則";
        break;

}

function run($conn, $sql)
{
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "推薦湯頭: " . $row["湯頭"] . "<br>";
        }
    } else {
        echo "暫無此規則";
    }
}
