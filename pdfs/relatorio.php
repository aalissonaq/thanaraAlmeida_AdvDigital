<?php
date_default_timezone_set('America/Fortaleza');
// require dirname(__DIR__, 1) . '/vendor/autoload.php';

require '../data/conexao.php';
require '../data/outfunc.php';
require '../util/util.php';

$conexao = novaConexao();

$sql = "SELECT * FROM processos as p
INNER JOIN pessoa as c ON p.idcliente = c.idPessoa
WHERE p.idprocesso = {$_GET['process']}";
$result = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$dprocesso = $result[0];



/*$sql = "SELECT * FROM person
        INNER JOIN projects
        ON person.id = projects.id_person_client
        INNER JOIN types_project
        ON projects.id_type_project = types_project.id
        WHERE projects.uuid = '{$_GET['id']}'";*/

// $sql = "SELECT * FROM vw_proposal
//         WHERE uuid = '{$_GET['id']}'";
// $result = $connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// $refer = $result[0];

// echo "<pre>";
// //print_r($refer);
// echo "</pre>";

/*
$sql = "SELECT * FROM person
        INNER JOIN projects
        ON person.id = projects.id_person_client
        WHERE person.id = '{$_GET['idcliente']}'";
$result = $connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$uuid = $_GET['uuid'];
$sql = "SELECT * FROM projects WHERE uuid = '112abf8b-6343-46ce-8ab3-1f584e2e6c71'";
$result = $connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$refer = $result[0];
* *************************** */
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
      demostrativo Financeiro
    </h2>

    <div class="containerProcesso">

      <div class="">
        <h3 class="" style="text-transform: uppercase;">
          <i class="mdi mdi-scale-balance mdi-24px fa fa-fw mr-1"></i>
          <?= $dprocesso['niprocesso'] . ' - ' . $dprocesso['objprocesso'] ?>
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="d-flex">
          <div class="mr-5 d-flex flex-column">
            <span class="text-primary" style="text-transform: uppercase; font-weight: bold;">
              <i class="mdi mdi-pound mdi-18px fa fa-fw mr-1"></i>
              Nº do Porcesso:
            </span>
            <span class="text-muted ml-4 " style="text-transform: uppercase;">
              <?= MascaraCNJ(str_pad($dprocesso['numprocesso'], 20, "0", STR_PAD_LEFT)); ?>
            </span>
          </div>
          <div class="mr-5 d-flex flex-column">
            <span class="text-primary" style="text-transform: uppercase; font-weight: bold;">
              <i class="mdi mdi-state-machine mdi-18px fa fa-fw mr-1"></i>
              Status do Porcesso:
            </span>
            <span class="text-muted text-uppercase ml-4" style="text-transform: uppercase;">
              <?= $dprocesso['statusprocesso'] != 'concluido' ? 'ATIVO' : 'INATIVO';  ?>
            </span>
          </div>

          <div class="mr-5 d-flex flex-column">
            <span class="text-primary" style="text-transform: uppercase; font-weight: bold;">
              <i class="mdi mdi-list-status mdi-18px fa fa-fw mr-1"></i>
              Etapa do Processo:
            </span>
            <span class="text-muted text-uppercase ml-4">
              <?php
              switch ($dprocesso['statusprocesso']) {
                case 'aguardando':
                  echo 'Aguardando Documento';
                  break;
                case 'pericia':
                  echo 'Perícia ou Agendamento';
                  break;
                case 'prorrogacao':
                  echo 'Prorrogação';
                  break;
                case 'exigencia':
                  echo 'Exigência';
                  break;
                case 'aguardandoINSS':
                  echo 'Aguardando Resposta do INSS';
                  break;
                case 'justFederal':
                  echo 'Justiça Federal';
                  break;
                case 'concluido':
                  echo 'Concluído';
                  break;
                case 'analise':
                  echo 'Análise';
                  break;
                case 'justComum':
                  echo 'Justiça Comum';
                  break;
                case 'concluso':
                  echo 'Concluso';
                  break;

                default:
                  echo 'Aguardando Documento';
                  break;
              };
              ?>
            </span>
          </div>
        </div>
        <div class="">
          <div class="d-flex flex-column">
            <span class="text-primary" style="text-transform: uppercase; font-weight: bold;">
              <i class="mdi mdi-file mdi-18px fa fa-fw mr-1"></i>
              Descrição do Processo:
            </span>
            <span class="text-muted text-uppercase text-justify ml-4">
              <?= $dprocesso['descricaoprocesso']; ?>
            </span>
          </div>
        </div>
        <div class="d-flex ">
          <div class="d-flex flex-column mr-5">
            <span class="text-primary" style="text-transform: uppercase; font-weight: bold;">
              <i class="mdi mdi-account mdi-18px fa fa-fw mr-1"></i>
              Cliente:
            </span>
            <span class="" style="text-transform: uppercase;">
              <?= $dprocesso['nmPessoa']; ?>
            </span>
          </div>

          <div class="d-flex flex-column">
            <span class="text-primary" style="text-transform: uppercase; font-weight: bold;">
              <i class="mdi mdi-account mdi-18px fa fa-fw mr-1"></i>
              Contra Parte no Proceso:
            </span>
            <span class="text-muted text-uppercase ml-4">
              <?= $dprocesso['contraparte']; ?>
            </span>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <!--  <div class="card-footer">
  The footer of the card
</div> -->
      <!-- /.card-footer -->
    </div>
    <hr />
    <p style="text-transform: uppercase; font-weight: bold; text-align: center;">DADOS DO LANÇAMENTOS</p>
    <hr />
    <?php
    $queryFinancialReleaseInstallments = "SELECT * FROM financial_release as fr
                                          INNER JOIN processos as p ON fr.id_process = p.idprocesso
                                          WHERE fr.id_process = '{$_GET['process']}' AND fr.id = '{$_GET['fr']}'";
    $result = $conexao->query($queryFinancialReleaseInstallments)->fetchAll(PDO::FETCH_ASSOC);
    $dadoFR = $result[0];

    $subT = "SELECT SUM(installments_amount) as total FROM financial_release_installments
    WHERE id_financial_release = '{$_GET['fr']}' AND is_paid = 0";
    $result = $conexao->query($subT)->fetchAll(PDO::FETCH_ASSOC);
    $subToral = $result[0]['total'];

    ?>
    <div class="d-flex flex-column">
      <div class="text-muted text-uppercase">
        <strong class="text-primary">
          CATEGORIA:&nbsp;
        </strong>
        <?= $dadoFR['type']; ?>
      </div>
      <div class="text-muted text-uppercase">
        <strong class="text-primary">
          DESCRIÇÃO:&nbsp;
        </strong>
        <?= strtoupper($dadoFR['description']) ?>
      </div>
      <div class="text-muted">
        <strong class="text-primary">
          VALOR TOTAL:&nbsp;
        </strong>
        <?= "R$ " . number_format($dadoFR['amount'], 2, ',', '.'); ?>
      </div>
    </div>

    <div class="text-muted">
      <strong class="text-primary">
        SALDO DEVEDOR:&nbsp;
      </strong>
      <?= "R$ " . number_format($subToral, 2, ',', '.'); ?>
    </div>


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
