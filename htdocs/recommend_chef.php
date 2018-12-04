<?php
$result = $conn->query("SELECT 主餐, 湯頭 FROM 主廚");
while ($row = $result->fetch_assoc()) {
    $goo1[$i] = $row["主餐"];
    $goo2[$i] = $row["湯頭"];
    $result2 = mysqli_query($conn, "SELECT menu_name AS name1 FROM menu Where menu_id='$goo1[$i]'");
    $name0 = mysqli_fetch_row($result2);
    $result3 = mysqli_query($conn, "SELECT menu_name AS name1 FROM menu Where menu_id='$goo2[$i]'");
    $name1 = mysqli_fetch_row($result3);
    echo $name0[0] . "+" . $name1[0] . "<br>";
}
