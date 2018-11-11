<?php
$sql = "SELECT COUNT(*) AS cc, $thispage FROM home1 GROUP BY $thispage ORDER BY cc DESC LIMIT 3";
$result = $conn->query($sql);
$i = 0;
while ($row = $result->fetch_assoc()) {
    $good[$i] = $row[$thispage];
    $result2 = mysqli_query($conn, "SELECT menu_name AS $thispage FROM menu Where menu_id='$good[$i]'");
    $name = mysqli_fetch_row($result2);
    echo '&emsp;&emsp;&emsp;&ensp;第' . ++$i . '名:' . '&emsp;' . $name[0] . '<br>';
}
