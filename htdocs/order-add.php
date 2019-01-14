<!DOCTYPE HTML>

<html>
<head>
        <title>訂單</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="assets/css/add.css" />
    </head>
<?php
session_start();
$_SESSION["sidemeal"] = $_POST["sidemeal"];
include_once "connect.php";
$sql = "SELECT * FROM menu WHERE menu_type='D'";
$result = $conn->query($sql);
$i = 0;
while ($row = $result->fetch_assoc()) {
    $add[$i] = $row["menu_name"];
    $i++;
}
$num = mysqli_num_rows($result);
//餐點選項按鈕
echo "<form action='order-finish.php' method='post'>";
for ($counter = 0; $counter < $num; $counter++) {
    echo "<div class='border1'>";
    echo "<input type='hidden' name='addmeal[]' value='D0" . ($counter + 1) . "'>";
    echo "<div class='food'>" . $add[$counter] . "</div>";
    echo "
    <select name='amount[]'>
        <option value='0'>0</option>
        <option value='1'>1</option>
        <option value='2'>2</option>
    </select></div>";
}
echo "<br><input type='submit' value='GO'></form>";

//echo "<input type='hidden' id='add0" . ($counter + 1) . "' name='addmeal[]' value='D0" . ($counter + 1) . "'>";
?>
</html>