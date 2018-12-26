<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'order_money.php';
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<p align="center" style="font-family: BIG5">台灣火鍋 礁溪營業所</p>');
$mpdf->WriteHTML('<p align="center" style="font-family: BIG5">===================</p>');
$mpdf->WriteHTML('<p align="center" style="font-family: BIG5">訂單編號 : '.$訂單編號.'</p>');
$mpdf->WriteHTML('<p align="center" style="font-family: BIG5">===================</p>');
$i=0;
while(!empty($html[$i])){
$mpdf->WriteHTML('<p align="center" style="font-family: BIG5">'. $html[$i].'</p>');
$i++;
}
$mpdf->WriteHTML('<p align="center" style="font-family: BIG5">----------------------------------------</p>');
$mpdf->WriteHTML('<p align="center" style="font-family: BIG5">總金額 : '.$total.'</p>');
$mpdf->Output();
exit;
