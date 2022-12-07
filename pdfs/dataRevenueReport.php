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








// $sql = "SELECT * FROM processos as p
// INNER JOIN pessoa as c ON p.idcliente = c.idPessoa
// WHERE p.idprocesso = {$_GET['process']}";
// $result = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// $dprocesso = $result[0];


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
      left: 12%;
      width: 78%;
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
      background: rgb(255, 228, 181, .5);
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

    <table id="table_material" border="0" style=" width: 100%; border-style: solid; border-collapse:collapse; text-align: center;">
      <thead style="color:#fff; background-color:#59372c; border-bottom-color: #123455; text-transform: uppercase;">
        <tr>
          <th>#</th>
          <th>data vencimnto</th>
          <th>valor</th>
          <th>status</th>
          <th>
            em
          </th>
        </tr>
      </thead>
      <tbody>
        <?php

        $count = 1;
        // foreach ($result as  $release)

        $sql = "SELECT * FROM financial_release_installments
          WHERE id_financial_release = '{$dadoFR['id']}'";
        $result = $conexao->query($sql);
        $i = 1;

        foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $installment) {
        ?>
          <tr>
            <td>
              <?= str_pad($i, 2, "0", STR_PAD_LEFT); ?>
            </td>
            <td>
              <?= date('d/m/Y', strtotime($installment['due_date'])); ?>
            </td>
            <td><?= "R$ " . number_format($installment['installments_amount'], 2, ',', '.'); ?></td>
            <td style="text-transform: uppercase;">

              <span class="badge badge-<?= $colorStatus ?> " style='font-size: 0.9rem; padding:<?= $padding ?>; font-weight: 400; letter-spacing: 0.2em; line-height: 16px; width: 100%;'>
                <?php
                if ($installment['is_paid'] == '0'  && $installment['due_date'] >= date('Y-m-d', time())) {
                  echo '<span style="color:#59372c; font-weight: lighter;">Pendente</span>';
                } elseif ($installment['is_paid'] == '0' && $installment['due_date'] < date('Y-m-d', time())) {
                  echo '<span style="color:red; font-weight: bold;">Atrasado</span>';
                } elseif ($installment['is_paid'] == '3') {
                  echo '<span style="color:blue; font-weight: lighter;">Renegociado</span>';
                  //echo date('d/m/Y', strtotime($installment['payday_installments']));
                } else {
                  echo ' <span style="color:green; font-weight: bold;">Pago</span>';
                  //echo date('d/m/Y', strtotime($installment['payday_installments']));
                }
                ?>
                <? $installment['is_paid'] == '0' ? 'Pendente' : 'Pago' ?>
              </span>
            </td>
            <td>
              <?= $installment['is_paid'] != '0' ? date('d/m/Y', strtotime($installment['payday_installments'])) : '--' ?>
            </td>
          </tr>
        <?php $i++;
        } ?>

      </tbody>
    </table>
  </div>
</body>

</html>
