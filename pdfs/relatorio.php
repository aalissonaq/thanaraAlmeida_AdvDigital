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
      opacity: 0.6;
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
      font-size: 25px;
      color: #59372c;
      margin-top: 1rem;
      text-align: center;
    }

    .title_p1 {
      font-size: 15px;
      color: #212761 text-align: center;
    }

    .dtCapa {
      position: fixed;
      bottom: 5px;
      left: 30%;
      text-align: center;
      color: darkorange;
    }

    #table_material tbody tr:nth-child(2n+2) {
      background: #FFE4B5;
      opacity: 0.4;
    }
  </style>

<body style="background-image: url(<?= dirname(__DIR__, 1) ?>/pdfs/bg2.png); background-repeat: no-repeat; background-size:400pt 180pt; background-position: center center;">
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
          </h1>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="d-flex">
          <div class="mr-5 d-flex flex-column">
            <span class="text-primary">
              <i class="mdi mdi-pound mdi-18px fa fa-fw mr-1"></i>
              Nº do Porcesso:
            </span>
            <span class="text-muted ml-4">
              <?= MascaraCNJ(str_pad($dprocesso['numprocesso'], 20, "0", STR_PAD_LEFT)); ?>
            </span>
          </div>
          <div class="mr-5 d-flex flex-column">
            <span class="text-primary">
              <i class="mdi mdi-state-machine mdi-18px fa fa-fw mr-1"></i>
              Status do Porcesso:
            </span>
            <span class="text-muted text-uppercase ml-4">
              <?= $dprocesso['statusprocesso'] != 'concluido' ? 'ATIVO' : 'INATIVO';  ?>
            </span>
          </div>

          <div class="mr-5 d-flex flex-column">
            <span class="text-primary">
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
        <br />
        <div class="">
          <div class="d-flex flex-column">
            <span class="text-primary">
              <i class="mdi mdi-file mdi-18px fa fa-fw mr-1"></i>
              Descrição do Processo:
            </span>
            <span class="text-muted text-uppercase text-justify ml-4">
              <?= $dprocesso['descricaoprocesso']; ?>
            </span>
          </div>
        </div>
        <br />
        <div class="d-flex ">
          <div class="d-flex flex-column mr-5">
            <span class="text-primary">
              <i class="mdi mdi-account mdi-18px fa fa-fw mr-1"></i>
              Cliente:
            </span>
            <span class="" style="text-transform: uppercase;">
              <?= $dprocesso['nmPessoa']; ?>
            </span>
          </div>

          <div class="d-flex flex-column">
            <span class="text-primary">
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

    <table id="table_material" border="0" style=" width: 100%; border-style: solid; border-collapse:collapse; text-align: center;">
      <thead style="color:#59372c; background-color:orange; border-bottom-color: indigo;">
        <tr>
          <th>#</th>
          <th>data vencimnto</th>
          <th>valor</th>
          <th>status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        for ($i = 1; $i < 50; $i++) {
        ?>
          <tr>
            <td><?= $i ?></td>
            <td>00/00/0000</td>
            <td>R$ 000,00</td>
            <td>pendente</td>
          </tr>
        <?php } ?>

      </tbody>
    </table>



  </div>


</body>

</html>
