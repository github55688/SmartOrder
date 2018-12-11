<?php
$situation = $_SESSION["situation"]; //情境
$gender = $_SESSION["temp"][0]; //性別
$age = $_SESSION["temp"][1]; //年齡
$mainmeal = $_POST["mainmeal"]; //主餐

$sql = "SELECT 湯頭 FROM 推薦 WHERE 來源='$source' AND
    主餐='$mainmeal' AND (情境='$situation' OR 情境='all') AND (性別='$gender' OR 性別='all') AND (年齡='$age' OR 年齡='all')";
$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
        $nameid = $row["湯頭"];
        $name = mysqli_query($conn, "SELECT menu_name AS namename FROM menu Where menu_id='$nameid'");
        $row_soup = mysqli_fetch_array($name);
        echo "推薦湯頭: " . $row_soup["namename"] . "<br>";
    }
} else {
    echo "暫無推薦";
}
