<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'order_money.php';
$mpdf = new \Mpdf\Mpdf([
'mode' => 'utf-8',
'format' => [57,90],
'default_font_size' => '9',
'margin_left'=>'3',
'margin_right'=>'3'
]);
$mpdf->WriteHTML('<p align="center" style="font-family: BIG5">台灣火鍋 礁溪營業所</p>');
$mpdf->WriteHTML('<p align="center" style="font-family: BIG5">訂單編號 : ' . $訂單編號 . '</p>');

$i = 0;
while (!empty($html[$i])) {
    $j = 0;
    $mpdf->WriteHTML('<p align="left" style="font-family: BIG5">' . $html[$i] . '</p>');
    while (!empty($html2[$i][$j])) {
        $mpdf->WriteHTML('<p align="left" style="font-family: BIG5">' . $html2[$i][$j] ."&emsp;". $html3[$i][$j]. '</p>');
        $j++;
    }
    $mpdf->WriteHTML('<p align="right" style="font-family: BIG5">'.'小計:&emsp;&emsp;'. $html4[$i] . '</p>');
    $i++;
}
$mpdf->WriteHTML('<p align="center" style="font-family: BIG5">總金額 : ' . $total . '</p>');
$mpdf->Output();
exit;
