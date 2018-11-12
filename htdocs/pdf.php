<?php
require "mpdf/mpdf.php";
$mpdf = new mPDF('utf-8', 'A4');
ob_start();

include 'order_money.php';

$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
