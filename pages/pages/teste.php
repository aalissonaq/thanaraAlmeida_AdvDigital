<?php

//Configure the directory where you have the dompdf
require_once './../../plugins/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

//$dompdf = new dompdf();
//$dompdf = new DOMPDF();
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream("dadosUsuarios.pdf", ["Attachment" => false]);
