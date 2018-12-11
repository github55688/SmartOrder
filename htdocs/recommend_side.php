<?php
$situation = $_SESSION["situation"]; //情境
$gender = $_SESSION["temp"][0]; //性別
$age = $_SESSION["temp"][1]; //年齡
$mainmeal = $_SESSION["mainmeal"]; //主餐
$soup=$_POST["soup"];//湯頭

$sql = "SELECT 副餐 FROM 推薦 WHERE 來源='$source' AND
    主餐='$mainmeal' AND 湯頭='$soup' AND (情境='$situation' OR 情境='all') AND (性別='$gender' OR 性別='all') AND (年齡='$age' OR 年齡='all')";
$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
        $nameid = $row["副餐"];
        $name = mysqli_query($conn, "SELECT menu_name AS namename FROM menu Where menu_id='$nameid'");
        $row_soup = mysqli_fetch_array($name);
        echo "推薦: " . $row_soup["namename"] . "<br>";
    }
} else {
    echo "暫無推薦";
}