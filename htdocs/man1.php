<?php //推薦主餐
$situation = $_SESSION["situation"];
$gender = $_POST["gender"];
$age = $_POST["age"];

//情境+性別+年齡--->主餐 (1)
$sql = "SELECT 情境, 性別, 年齡, 主餐 FROM 推薦 WHERE 情境='$situation' AND 性別='$gender' AND 年齡='$age'";
$result = $conn->query($sql);
$num = mysqli_num_rows($result);
if ($num > 0) {
    run1($result);
} else {
    //情境+性別or年齡--->主餐 (2)
    $sql = "SELECT 情境, 性別, 年齡, 主餐 FROM 推薦 WHERE 情境='$situation' AND (性別='$gender' OR 年齡='$age') AND (性別 IS NULL OR 年齡 IS NULL)";
    $result = $conn->query($sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        run2($gender, $age, $result);
    } else {
        //情境--->主餐 (3)
        $sql = "SELECT 情境, 性別, 年齡, 主餐 FROM 推薦 WHERE 情境='$situation' AND 性別 IS NULL AND 年齡 IS NULL ";
        $result = $conn->query($sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            run3($result);
        } else {
            echo "暫無此規則";
        }
    }
}

function run1($result)
{
    while ($row = $result->fetch_assoc()) {
        echo "規則<br>";
        echo "1.情境" . $row["情境"] . "<br>";
        echo "2.性別" . $row["性別"] . "<br>";
        echo "3.年齡" . $row["年齡"] . "<br>";
        echo "推薦: " . $row["主餐"] . "<br>";
        $_SESSION["apple"] = '1';
    }
}
function run2($gender, $age, $result)
{
    while ($row = $result->fetch_assoc()) {
        echo "規則<br>";
        if ($gender == $row["性別"]) {
            echo "1.情境" . $row["情境"] . "<br>";
            echo "2.性別" . $row["性別"] . "<br>";
            $_SESSION["apple"] = '2';
        } else if ($age == $row["年齡"]) {
            echo "1.情境" . $row["情境"] . "<br>";
            echo "2.年齡" . $row["年齡"] . "<br>";
            $_SESSION["apple"] = '3';
        }
        echo "推薦: " . $row["主餐"] . "<br>";
    }
}function run3($result)
{
    while ($row = $result->fetch_assoc()) {
        echo "規則<br>";
        echo "1.情境" . $row["情境"] . "<br>";
        echo "推薦: " . $row["主餐"] . "<br>";
        $_SESSION["apple"] = '4';
    }
}
