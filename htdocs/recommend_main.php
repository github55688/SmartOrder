<?php //推薦主餐
$situation = $_SESSION["situation"];
$gender = $_POST["gender"];
$age = $_POST["age"];

//情境+性別+年齡--->主餐 (1)
$result = $conn->query("SELECT 情境, 性別, 年齡, 主餐 FROM 推薦 WHERE 情境='$situation' AND 性別='$gender' AND 年齡='$age'");
$num = mysqli_num_rows($result);
if ($num > 0) {
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        echo "規則<br>";
        echo "1.情境" . $row["情境"] . "<br>";
        echo "2.性別" . $row["性別"] . "<br>";
        echo "3.年齡" . $row["年齡"] . "<br>";
        $good[$i] = $row["主餐"];
        $result2 = mysqli_query($conn, "SELECT menu_name AS name1 FROM menu Where menu_id='$good[$i]'");
        $name = mysqli_fetch_row($result2);
        echo "推薦: " . $name[0] . "<br>";
        $i++;
    }
    $_SESSION["apple"] = '1';
} else { //情境+性別or年齡--->主餐 (2)
    $result = $conn->query("SELECT 情境, 性別, 年齡, 主餐 FROM 推薦 WHERE 情境='$situation' AND (性別='$gender' OR 年齡='$age') AND (性別 IS NULL OR 年齡 IS NULL)");
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $i = 0;
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
            $good[$i] = $row["主餐"];
            $result2 = mysqli_query($conn, "SELECT menu_name AS name1 FROM menu Where menu_id='$good[$i]'");
            $name = mysqli_fetch_row($result2);
            echo "推薦: " . $name[0] . "<br>";
            $i++;
        }
    } else {
        //情境--->主餐 (3)
        $result = $conn->query("SELECT 情境, 性別, 年齡, 主餐 FROM 推薦 WHERE 情境='$situation' AND 性別 IS NULL AND 年齡 IS NULL");
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "規則<br>";
                echo "1.情境" . $row["情境"] . "<br>";
                $good[$i] = $row["主餐"];
                $result2 = mysqli_query($conn, "SELECT menu_name AS name1 FROM menu Where menu_id='$good[$i]'");
                $name = mysqli_fetch_row($result2);
                echo "推薦: " . $name[0] . "<br>";
                $i++;
            }
            $_SESSION["apple"] = '4';
        } else {
            $_SESSION["apple"] = '5';
            echo "暫無此規則";

        }
    }
}
