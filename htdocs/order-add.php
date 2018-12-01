<!DOCTYPE HTML>

<html>
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
    echo "<div>";
    echo "<input type='hidden' id='add0" . ($counter + 1) . "' name='addmeal[]' value='D0" . ($counter + 1) . "'>";
    echo "<h2>" . $add[$counter] . "</h2>";
    echo "</div>";
    echo "
    <select name='amount[]'>
        <option value='0'>0</option>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
        <option value=>6</option>
        <option value=>7</option>
        <option value=>8</option>
        <option value=>9</option>
        <option value=>10</option>
    </select><br>";
}
echo "<br><input type='submit' value='GO'></form>";
?>
</html>