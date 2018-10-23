<?php
$action = $_GET['action'];
if ($action == 'export') {
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
} else if ($action == 'convert') {
    //$path="C:\Users\abc\downloads";
    $filename1 = date('Ymd') . '.csv';
    //$filename2 = date('Ymd').'.arff';
    $path2 = 'C:\Users\abc\downloads\\';
    $output = shell_exec('java -cp "C:\Program Files\Weka-3-8\weka.jar" weka.associations.Apriori -N 40 -T 0 -C 0.8 -D 0.05 -U 1.0 -M 0.1 -S -1.0 -c -1 -t ' . $path2 . $filename1);
    /*$str = strchr($output, "1.");
    $str_sec = explode(". ",$str); //分割字串 存到陣列
    for($counter = 1; $counter < 99; $counter++){
    if(!empty($str_sec[$counter])){
    echo substr($str_sec[$counter],0,-2);//去除最後兩個字元
    echo '<br>';
    }
    }*/
    echo $output;
}

function export_csv($filename, $data)
{
    header("Content-type:text/csv");
    header("Content-Disposition:attachment;filename=" . $filename);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    echo $data;
}
