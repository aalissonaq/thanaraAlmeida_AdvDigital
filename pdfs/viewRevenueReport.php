<?php
// require __DIR__ . '/../vendor/autoload.php';
require dirname(__DIR__, 1) . '/vendor/autoload.php';

$nomeMeses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junio', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro',);

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->setChroot(__DIR__);
$options->set('defaultFont', 'Helvetica', 'Roboto');
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

//$dompdf->loadHtmlFile(__DIR__ . '/base.html');

ob_start();
require __DIR__ . "/dataRevenueReport.php";
//require __DIR__ . "/proposta.php?{$_GET['id']}";
// $dompdf->set_option('dpi', '200');
$dompdf->loadHtml(ob_get_clean());

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$mes = $_GET['mes'];
$currentDate = date('Y-m-d_H-i-s');
$ano =  date("Y", time());

$dompdf->stream("Relatório de Receitas {$nomeMeses[$m - 1]} de {$ano}.pdf", array("Attachment" => false));
