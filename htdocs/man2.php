<?php //推薦湯頭
$situation = $_SESSION["situation"]; //情境
$gender = $_SESSION["temp"][0]; //性別
$age = $_SESSION["temp"][1]; //年齡
$mainmeal = $_POST["mainmeal"]; //主餐
$apple = $_SESSION["apple"];
$banana = 0;
//情境+性別+年齡+主餐--->湯頭 (1)
$sql11 = "SELECT 湯頭 FROM 推薦 WHERE 主餐='$mainmeal' AND 情境='$situation' AND 性別='$gender' AND 年齡='$age'";
//情境+性別+主餐--->湯頭 (1)
$sql12 = "SELECT 湯頭 FROM 推薦 WHERE 主餐='$mainmeal' AND 情境='$situation' AND 性別='$gender' AND 年齡 IS NULL";
//情境+年齡+主餐--->湯頭 (1)
$sql13 = "SELECT 湯頭 FROM 推薦 WHERE 主餐='$mainmeal' AND 情境='$situation' AND 年齡='$age' AND 性別 IS NULL";
//情境+主餐--->湯頭 (1)
$sql14 = "SELECT 湯頭 FROM 推薦 WHERE 主餐='$mainmeal' AND 情境='$situation'";
//情境+性別+年齡--->湯頭 (2)
$sql2 = "SELECT 湯頭 FROM 推薦 WHERE 情境='$apple1' AND 性別='$gender' AND 年齡='$age'";

switch ($apple) {
    case 1:
        run11($conn, $sql11);
        break;
    case 2:
        run11($conn, $sql12);
        break;
    case 3:
        run11($conn, $sql13);
        break;
    case 4:
        run11($conn, $sql14);
        break;

}

function run11($conn, $sql)
{
    $result = $conn->query($sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "推薦湯頭: " . $row["湯頭"] . "<br>";
        }
    } else {
        $GLOBLE['$banana'] + 1;
        switch ($GLOBLE['$banana']) {
            case 1:
                run11($conn, $sql2);
                break;
            case 2:
                run11($conn, $sql3);
                break;
            case 3:
                run11($conn, $sql4);
                break;
            case 4:
                run11($conn, $sql5);
                break;

        }
    }

}

function run22($conn)
{
//情境+性別+年齡--->湯頭 (2)
    $sql2 = "SELECT 湯頭 FROM 推薦 WHERE 情境='$apple1' AND 性別='$gender' AND 年齡='$age'";
    $result = $conn->query($sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "推薦湯頭: " . $row["湯頭"] . "<br>";
        }
    } else {
        run33();
    }

}

//情境+性別or年齡--->湯頭 (3)
function run33()
{
    $sql = "SELECT 湯頭 FROM 推薦 WHERE 情境='$apple1' AND (性別='$gender' OR 年齡='$age') AND (性別 IS NULL OR 年齡 IS NULL)";
    $result = $conn->query($sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "推薦湯頭: " . $row["湯頭"] . "<br>";
        }
    } else {
        run44();
    }

}

//情境+性別or年齡--->湯頭 (4)
function run44()
{

}