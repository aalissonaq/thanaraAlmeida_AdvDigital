<?php
date_default_timezone_set('America/Fortaleza');
// require dirname(__DIR__, 1) . '/vendor/autoload.php';

require '../data/conexao.php';
require '../data/outfunc.php';
require '../util/util.php';

$conexao = novaConexao();

$mes = str_pad($_GET['mes'], 2, "0", STR_PAD_LEFT);
$nomeMeses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junio', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro',);
if (!isset($_GET['mes'])) {
  $m = date('m', time());
  $mesAtual = date('m/Y', time());
  $dateAtualStart = date('Y-m-01', time());
  $dateAtualEnd = date('Y-m-30', time());
} else {
  $m = $_GET['mes'];
  $mesAtual = date("{$mes}/Y", time());
  $dateAtualStart = date("Y-{$mes}-01", time());
  $dateAtualEnd = date("Y-{$mes}-30", time());
}


// ---buscar dados---
isset($_GET['mes']) ? $mr = $mes . '/' . date("Y") : $mr = date("m/Y", time());
$sql = "SELECT * FROM financial_release as fr
        INNER JOIN financial_release_installments AS fri ON fri.id_financial_release = fr.id
        INNER JOIN processos AS p ON fr.id_process = p.idprocesso
        INNER JOIN pessoa as pers on pers.idPessoa = p.idcliente
        INNER JOIN clientes AS cli ON cli.idPessoa = pers.idPessoa
        WHERE (fri.competence = '{$mr}') AND is_paid <'3'
ORDER BY fri.due_date ASC";

$resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
// ----------------------------------------------------------------
?>
<html>

<head>

  <style>
    @page {
      margin: 130px 0px;
    }

    #header {
      position: fixed;
      left: 0px;
      top: -130px;
      right: 0px;
      height: 275px;
      background-image: url('<?= dirname(__DIR__, 1) ?>/pdfs/top2.png');
      background-repeat: no-repeat;
      background-size: 200pt 100pt;
      background-position: center center;
      z-index: -1;
    }

    #footer {
      position: fixed;
      left: 0px;
      bottom: -110px;
      right: 0px;
      height: 50px;
      opacity: 1;
      background-image: url('<?= dirname(__DIR__, 1) ?>/pdfs/base2.png');
      background-repeat: no-repeat;
      background-size: 500pt 17pt;
      background-position: bottom center;
      z-index: -1;
    }

    #footer .page:after {
      content: counter(page, georgian);
      margin-left: 30pt;
    }

    #content {
      position: relative;
      top: 83px;
      left: 7%;
      width: 87%;
    }

    /* --- dados dp processo --- */
    #containerProcesso {
      background-color: #f6f6f6;
    }

    /* ------ */

    .title {
      font-size: 1.3rem;
      color: #59372c;
      margin-top: 2.5rem;
      text-align: center;
    }

    .title_p1 {
      font-size: 15px;
      color: #212761;
      text-align: center;
    }

    .dtCapa {
      position: fixed;
      bottom: 5px;
      left: 30%;
      text-align: center;
      color: darkorange;
    }

    #table_material tbody tr:nth-child(2n+2) {
      /* background: #FFE4B5; */
      background: rgba(89, 55, 44, .2);
      text-transform: uppercase;
    }
  </style>

<body style="background-image: url(<?= dirname(__DIR__, 1) ?>/pdfs/bg3.png); background-repeat: no-repeat; background-size:420pt 212pt; background-position: center center;">
  <div id="header">

  </div>
  <div id="footer">
    <p class="page">
    </p>
  </div>
  <div id="content">

    <!-- <p style="page-break-before: always;"></p> -->
    <h2 class="title" style="text-transform: uppercase; text-align: center;">
      <i class="mdi mdi-scale-balance mdi-24px fa fa-fw mr-1"></i>
      Receitas do mês de <?= $nomeMeses[$m - 1] . ' de ' . date("Y", time()); ?>
    </h2>

    <hr />

    <table id="table_material" border="0" style=" width: 100%; border-style: solid; border-collapse:collapse; text-align: center; text-transform: uppercase;">
      <thead style="color:#fff; background-color:#59372c; border-bottom-color: #123455; text-transform: uppercase; font-size: .8rem;">
        <tr>
          <!-- <th>#</th> -->
          <th>Vencimnto</th>
          <th>Dados da Receita </th>
          <th>valor</th>
          <th>status</th>
          <th>em</th>
        </tr>
      </thead>
      <tbody style="font-size: .75rem;">
        <?php
        foreach ($resultado as $release) {
        ?>
          <tr>
            <td style="padding: .5rem;">
              <?= date('d/m/Y', strtotime($release['due_date'])); ?>
            </td>

            <td style="text-align: left; padding: 5px; text-transform: uppercase;">
              <div class="d-flex align-items-center">
                <div class="d-flex flex-column">
                  <div class="text-muted" style="padding-bottom: .3rem;">
                    <strong class="text-primary">Cliente:&nbsp;</strong><br /><?= $release['nmPessoa']; ?>
                  </div>
                  <div class="text-muted">
                    <strong class="text-primary">Processo:&nbsp;</strong><br /><?= $release['niprocesso'] . ' - ' .  $release['objprocesso']; ?>
                  </div>

                </div>
              </div>
            </td>

            <td style="padding: 1rem;">
              R$&nbsp;<?= formatMoedaBr($release['installments_amount']); ?>
            </td>
            <td style="padding: 1rem;">
              <?php
              if ($release['is_paid'] == 1) {
                echo ' <span style="color:green; font-weight: bold;">Pago</span>';
                $receirasConfirmada += $release['installments_amount'];
              } elseif ($release['is_paid'] == '0'  && $release['due_date'] >= date('Y-m-d', time())) {
                echo '<span style="color:#59372c; font-weight: lighter;">Pendente</span>';
              } elseif ($release['is_paid'] == '0' && $release['due_date'] < date('Y-m-d', time())) {
                echo '<span style="color:red; font-weight: bold;">Atrasado</span>';
              }
              ?>
            </td>
            <td>
              <?= $release['is_paid'] != '0' ? date('d/m/Y', strtotime($release['payday_installments'])) : '--' ?>
            </td>
          </tr>
        <?php
          $receirasEsperada += $release['installments_amount'];
          $i++;
        }
        ?>
      </tbody>
      <tfoot style="">
        <tr style="color:#fff; background-color:rgba(89, 55,44,.8); border-bottom-color: #123455; text-transform: uppercase; font-size: .8rem; ">
          <!-- <th>#</th> -->
          <!-- <th>Vencimnto</th> -->
          <th colspan="2" style="text-align: right; padding: .5rem 0;">Total de Receita esperada no mês </th>
          <th style="text-align: right;">
            R$&nbsp; <?= formatMoedaBr($receirasEsperada); ?>
          </th>
          <th></th>
          <th></th>
        </tr>
        <tr style="color:#1a2a47; background-color:#f4f4f4; border-bottom-color: #123455; text-transform: uppercase; font-size: .8rem; text-align: right;">
          <!-- <th>#</th> -->
          <!-- <th>Vencimnto</th> -->
          <th colspan="2" style="text-align: right;">Total de Receita confirmada no mês </th>
          <th style="color: green; text-align: right;">
            R$&nbsp; <?= formatMoedaBr($receirasConfirmada); ?>
          </th>
          <th></th>
          <th></th>
        </tr>
        <tr style="color:#1a2a47; background-color:#f4f4f4; border-bottom-color: #123455; text-transform: uppercase; font-size: .8rem; text-align: right;">
          <!-- <th>#</th> -->
          <!-- <th>Vencimnto</th> -->
          <th colspan="2" style="text-align: right;">Total de Receita Pendente no mês </th>
          <th style="color: #fb7b24; text-align: right;">
            <?php $receirasPendente = $receirasEsperada - $receirasConfirmada; ?>
            R$&nbsp; <?= formatMoedaBr($receirasPendente); ?>
          </th>
          <th></th>
          <th></th>
        </tr>

      </tfoot>
    </table>
  </div>
</body>

</html>
