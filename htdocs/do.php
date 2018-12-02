<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "good";
$conn = new mysqli($servername, $username, $password, $dbname);
$result = mysqli_query($conn, "SELECT * FROM home1 ORDER BY id ASC");
$str = "situation,gender,age,soup,mainmeal,sidemeal\n";
$str = iconv('UTF-8', 'BIG5', $str);
while ($row = mysqli_fetch_array($result)) {
    $str .= $row['situation'] . ',' . $row['gender'] . ',' . $row['age'] . ',' . $row['soup'] . ',' . $row['mainmeal'] . ',' . $row['sidemeal'] . "\n"; //用引文逗號分開
}
$filename = date('Ymd') . '.csv'; //設定檔名
export_csv($filename, $str); //匯出
mysqli_close($conn);

function export_csv($filename, $data)
{
    header("Content-type:text/csv");
    header("Content-Disposition:attachment;filename=" . $filename);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    echo $data;
}
