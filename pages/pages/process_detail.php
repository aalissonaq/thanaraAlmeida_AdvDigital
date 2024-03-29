<?php
$idProcess = $_GET['idprocess'];

if (isset($_POST['gravarHistorico']) && $_POST['gravarHistorico'] == 'gravarHistorico') {
  $id_pessoa_cliente = $_POST['id_pessoa_cliente'];
  $id_pessoa_responsavel = $_POST['id_pessoa_responsavel'];
  $id_processo = trim(strip_tags($_GET['idprocess']));
  $titulo_historico = trim(strip_tags($_POST['titulo_historico']));
  $descricao_historico = trim(nl2br($_POST['descricao_historico']));
  $tipo_historico = $_POST['tipo_historico'];


  $sql = "INSERT INTO historico_processo (id_pessoa_cliente,id_pessoa_responsavel,id_processo,titulo_historico,descricao_historico,tipo_historico)
          VALUES ('$id_pessoa_cliente','$id_pessoa_responsavel','$id_processo','$titulo_historico','$descricao_historico','$tipo_historico')";

  if ($conexao->exec($sql)) {
    sweetalert('Sucesso', 'Histórico gravado com suscesso', 'success', 2000);
  } else {
    sweetalert('Ops !', ' Erro ao grava o Histórico, por favor tente novamente', 'error', 2000);
  }
} elseif (isset($_POST['acao']) && $_POST['acao'] == 'edtEtapa') {

  $update = "UPDATE processos SET statusprocesso = '$_POST[statusprocesso]' WHERE idprocesso = '$idProcess'";

  if ($conexao->exec($update)) {
    sweetalert('Sucesso', 'Etapa atualizada com suscesso', 'success', 2000);
  } else {
    sweetalert('Ops !', ' Erro ao atualizar a Etapa, por favor tente novamente', 'error', 2000);
  }

  $id_pessoa_cliente = trim(strip_tags($_GET['idcli']));
  $id_pessoa_responsavel = $_SESSION['ID'];
  $id_processo = trim(strip_tags($_GET['idprocess']));
  $titulo_historico = 'Atualização da Etapa do Processo';

  switch ($_POST['statusprocesso']) {
    case 'aguardando':
      $novaEtapa = 'Aguardando Documento';
      break;
    case 'pericia':
      $novaEtapa =  'Perícia ou Agendamento';
      break;
    case 'prorrogacao':
      $novaEtapa =  'Prorrogação';
      break;
    case 'exigencia':
      $novaEtapa = 'Exigência';
      break;
    case 'aguardandoINSS':
      $novaEtapa = 'Aguardando Resposta do INSS';
      break;
    case 'justFederal':
      $novaEtapa = 'Justiça Federal';
      break;
    case 'concluido':
      $novaEtapa = 'Concluído';
      break;
    default:
      $novaEtapa =  'Aguardando Documento';
      break;
  };

  $descricao_historico = "Etapa atualizada para: " . $novaEtapa;
  $tipo_historico = 'at_status';

  $sql = "INSERT INTO historico_processo (id_pessoa_cliente,id_pessoa_responsavel,id_processo,titulo_historico,descricao_historico,tipo_historico)
          VALUES ('$id_pessoa_cliente','$id_pessoa_responsavel','$id_processo','$titulo_historico','$descricao_historico','$tipo_historico')";
  $conexao->exec($sql);
} elseif (isset($_POST['acao']) && $_POST['acao'] == 'edtProcesso') {
  $dados['objprocesso'] = strip_tags(strip_tags(trim($_POST['objprocesso'])));
  $dados['contraparte'] = strip_tags(strip_tags(trim($_POST['contraparte'])));
  $dados['descricaoprocesso'] = strip_tags(strip_tags(trim($_POST['descricaoprocesso'])));
  $dados['numprocesso'] = $_POST['numprocesso'] == '' ? '0' : strip_tags(strip_tags(trim(tiraMascara($_POST['numprocesso']))));
  $dados['areaprocesso'] = strip_tags(strip_tags(trim($_POST['areaprocesso'])));
  $dados['statusprocesso'] = strip_tags(strip_tags(trim($_POST['statusprocesso'])));

  $update = atualizar('processos', $dados, "idprocesso = {$idProcess}");

  if ($update) {
    sweetalert('Sucesso', 'processo atualizada com suscesso', 'success', 2000);
  } else {
    sweetalert('Ops !', ' Erro ao atualizar a processo, por favor tente novamente', 'error', 2000);
  }
}


?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 style="font-family:'Advent Pro', sans-serif; letter-spacing: .06rem; font-weight: 300;">Detalhamento do Processo</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif; letter-spacing: .06rem;">
          <li class="breadcrumb-item"><a href="?page=inicio">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=profileCliente&id=<?= $_GET["idcli"] ?>">Perfil do Usuários</a></li>
          <li class="breadcrumb-item active">Datalhes do Processo</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <!-- <h3 class="card-title">Projects Detail</h3> -->

      <div class="card-tools">
        <button onclick="history.go(-1)" class="btn btn-tool text- d-print-none">
          <!-- <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i> -->
          <i class="mdi mdi-arrow-left-bold-circle-outline fa fa-2x align-middle "></i>
          Voltar ao Peril do Cliente
        </button>
        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <buttn type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></buttn> -->
      </div>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1" <!-- info box -->
          <div class="row mr-2">
            <div class="col-12 col-sm-4 col-md-4">
              <a href="#">
                <div class="small-box bg-gradient-default">
                  <div class="inner mx-3">
                    <?php
                    $today = date("Y-m-d", time());
                    $sql = "SELECT * FROM tarefas WHERE idProcesso = '$idProcess' AND dtTarefa = '$today'";
                    $resultado = $conexao->query($sql);
                    // print_r($resultado);
                    // print_r(get_class_methods($resultado));
                    ?>
                    <h3><?= str_pad($resultado->rowCount(), 3, "0", STR_PAD_LEFT); ?></h3>
                    <h6 class="">Tarefas para hoje</h6>
                  </div>
                  <div class="icon">
                    <!-- <i class="far fa-clock"></i> -->
                    <i class="mdi mdi-calendar-clock-outline "></i>
                  </div>

                </div>
              </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-4 col-md-4">
              <a href="#">
                <div class="small-box bg-gradient-default">
                  <div class="inner mx-3">
                    <?php

                    $sql = "SELECT * FROM tarefas WHERE idProcesso = '$idProcess'";
                    $resultado = $conexao->query($sql);
                    // print_r($resultado);
                    // print_r(get_class_methods($resultado));
                    ?>


                    <h3><?= str_pad($resultado->rowCount(), 3, "0", STR_PAD_LEFT); ?></h3>
                    <h6>Todas as Tarefas</h6>
                  </div>
                  <div class="icon">
                    <!-- <i class="far fa-clock"></i> -->
                    <i class="mdi mdi-calendar-clock-outline "></i>
                  </div>

                </div>
              </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-4 col-md-4">
              <a href="#">
                <div class="small-box bg-gradient-default">
                  <div class="inner mx-3">
                    <?php

                    $sql = "SELECT * FROM tarefas WHERE idProcesso = '$idProcess' AND finalizada = '1'";
                    $resultado = $conexao->query($sql);
                    // print_r($resultado);
                    // print_r(get_class_methods($resultado));
                    ?>

                    <h3><?= str_pad($resultado->rowCount(), 3, "0", STR_PAD_LEFT); ?></h3>
                    <h6>Tarefas Finalizadas</h6>
                  </div>
                  <div class="icon">
                    <!-- <i class="far fa-clock"></i> -->
                    <i class="mdi mdi-calendar-clock-outline "></i>
                  </div>

                </div>
              </a>
              <!-- /.info-box -->
            </div>
            <!-- <div class="col-12 col-sm-4">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <span class="info-box-text text-center text-muted">Estimated project duration</span>
                  <span class="info-box-number text-center text-muted mb-0">20 <span>
                </div>
              </div>
            </div> -->
          </div>

          <div class="row pr-3">


            <!-- TAREFA DO PROCESSO -->
            <div class="card col-12 col-md-12 ">
              <div class="card-header">
                <h2 class="card-title text-uppercase h3">Tarefas do Processo</h2>

                <div class="card-tools">
                  <button type="button" class="btn btn-sm btn-outline-primary mr-4 " data-toggle="modal" data-target="#modal-novaTarefa" onclick="modalIdProcesso(<?= $dadosProcesso['idprocesso'] ?>)">
                    <i class="fas fa-plus"></i>
                    Adicionar Tarefa
                  </button>

                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">

                    <ul class="nav nav-pills mt-3 mb-1">
                      <li class="nav-item ">
                        <a class="nav-link" href="#todayTask" data-toggle="tab">
                          <i class="align-middle mdi mdi-calendar-multiple mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                          <span class="align-middle">
                            Tarefas de hoje
                          </span>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="#allTask" data-toggle="tab">
                          <i class="align-middle mdi mdi-calendar-clock mdi-24px fa fa-fw"></i>&nbsp;&nbsp;
                          <span class="align-middle">
                            Todas as Tarefas
                          </span>
                        </a>
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="todayTask" role="tabpanel" aria-labelledby="todayTask-tab">
                        <!-- Tarefas de hoje -->
                        <div class="table-responsive ">
                          <table id="tabela" class="table table-sm table-striped table-hover">
                            <thead class="" style="font-family: 'Advent Pro', sans-serif; font-weight: 100;">
                              <tr>
                                <th class="col-md-auto text-center align-middle ">Tarefa</th>
                                <th class="col-md-2 text-center align-middle ">status</th>
                                <th class="col-md-2 text-center align-middle ">Responsável</th>
                                <th class="col-md-1 text-center align-middle ">Data e Hora</th>
                                <th class="col-md-1 text-center align-middle">
                                  <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $sql = "SELECT * FROM tarefas
                                      INNER JOIN processos
                                      ON tarefas.idProcesso = processos.idprocesso
                                      WHERE tarefas.idpessoa = {$_GET['idcli']} AND (tarefas.dtTarefa = CURDATE() OR tarefas.dtTarefa < CURDATE()) AND finalizada = 0 ORDER BY dtTarefa ASC";
                              $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                              $count = 1;
                              foreach ($resultado as $task) {
                              ?>
                                <tr scope="row" class="">

                                  <td class="text-uppercase align-middle">
                                    <div class="d-flex align-items-center">
                                      <div class="mr-2 ">
                                        <?php
                                        switch ($task['prioridade']) {
                                          case 'baixa':
                                            echo '<i title="Baixa" class=" text-info mdi mdi-alert-circle-outline mdi-24px align-middle">&nbsp;</i>';
                                            break;

                                          case 'media':
                                            echo '<i title="Média" class="text-orange mdi mdi-alert-octagon-outline mdi-24px align-middle">&nbsp;</i>';
                                            break;

                                          case 'alta':
                                            echo '<i title="Alta" class="text-danger mdi mdi-car-brake-alert mdi-24px align-middle">&nbsp;</i>';
                                            break;

                                          default:
                                            echo '<i class="mdi mdi-alert-box-outline mdi-18px align-middle">&nbsp;</i>';
                                            break;
                                        }
                                        // echo str_pad($count, 3, "0", STR_PAD_LEFT);
                                        // $count++;
                                        ?>
                                      </div>
                                      <div class="d-flex flex-column">
                                        <div class="text-muted">
                                          <strong class="text-primary">Processo:&nbsp;</strong><?= $task['niprocesso'] . ' - ' .  $task['objprocesso']; ?>
                                        </div>
                                        <div class="text-muted">
                                          <strong class="text-primary">Tarefa:&nbsp;</strong><?= lmWord($task['decricaoTarefa'], 100); ?>
                                        </div>
                                        <div class="text-muted">
                                          <strong class="text-primary">Contra-Parte:&nbsp;</strong><?= lmWord($task['contraparte'], 70); ?>
                                        </div>

                                      </div>
                                    </div>
                                  </td>
                                  <td class="text-uppercase align-middle text-center" style="font-weight: 300;">
                                    <?php
                                    $today = date("Y-m-d", time());
                                    if ($task['dtTarefa'] < $today) {
                                      echo "<span class='badge badge-pill badge-danger px-2 py-1'>Atrasada</span>";
                                    } else {
                                      echo "<span class='badge badge-pill badge-warning px-4 py-1'>Hoje</span>";
                                    }
                                    ?>
                                  </td>

                                  <td class=" text-uppercase align-middle" style="font-size: .8rem; ">
                                    <?php
                                    $sql = "SELECT * FROM pessoa WHERE idPessoa = '" . $task['idResponsavel'] . "'";
                                    $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($resultado as $pessoa) {
                                      echo $pessoa['nmPessoa'];
                                    }
                                    ?>

                                  </td>

                                  <td class="text-uppercase align-middle text-center">
                                    <?php
                                    echo date('d/m/Y', strtotime($task['dtTarefa']));
                                    echo " AS ";
                                    echo date('H:i', strtotime($task['hora']));
                                    ?>


                                  </td>

                                  <td class="text-uppercase align-middle  ">
                                    <ul class="nav justify-content-center d-flex justify-content-evenly">

                                      <li class="nav-item">
                                        <a href="?page=task_detail&task=<?= $task['idtarefas'] ?>" class="btn btn-tool" target="" title="Visializar Processo" rel="noopener noreferrer">
                                          <i class="mdi mdi-file-eye-outline mdi-24px "></i>
                                        </a>
                                      </li>

                                    </ul>
                                  </td>
                                </tr>
                              <?php } ?>

                            </tbody>
                          </table>
                        </div>
                        <!-- /.tarefas -->

                      </div>
                      <div class="tab-pane fade  " id="allTask" role="tabpanel" aria-labelledby="allTask-tab">

                        <!-- Todas as Tarefas  -->
                        <div class="table-responsive">
                          <table id="tabela" class="table table-sm table-striped table-hover">
                            <thead class="" style="font-weight: 300; font-family: 'Advent Pro', sans-serif;">
                              <tr>
                                <th class="col-4 text-center align-middle">Tarefa</th>
                                <th class="col-2 text-center align-middle">status</th>
                                <th class="col-3 text-center align-middle">Responsável</th>
                                <th class="col-2 text-center align-middle">Data e Hora</th>
                                <th class="col-auto text-center align-middle">
                                  <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $sql = "SELECT * FROM tarefas
                                      INNER JOIN processos
                                      ON tarefas.idProcesso = processos.idprocesso
                                      WHERE tarefas.idpessoa = {$_GET['idcli']} AND tarefas.idProcesso  = {$_GET['idprocess']} ORDER BY dtTarefa ASC";
                              // $sql = "SELECT * FROM tarefas WHERE idProcesso = {$_GET['idprocess']} ORDER BY dtTarefa ASC";
                              $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                              $count = 1;
                              foreach ($resultado as $task) {
                              ?>
                                <tr scope="row" class="" <?= $task['finalizada'] == '1' ? $colorBG = '#c6e5b1' : $colorBG = '' ?> style="background-color: <?= $colorBG ?>;">

                                  <td class="text-uppercase align-middle">
                                    <div class="d-flex align-items-center">
                                      <div class="mr-2 ">
                                        <?php
                                        switch ($task['prioridade']) {
                                          case 'baixa':
                                            echo '<i title="Baixa" class=" text-info mdi mdi-alert-circle-outline mdi-24px align-middle">&nbsp;</i>';
                                            break;

                                          case 'media':
                                            echo '<i title="Média" class="text-orange mdi mdi-alert-octagon-outline mdi-24px align-middle">&nbsp;</i>';
                                            break;

                                          case 'alta':
                                            echo '<i title="Alta" class="text-danger mdi mdi-car-brake-alert mdi-24px align-middle">&nbsp;</i>';
                                            break;

                                          default:
                                            echo '<i class="mdi mdi-alert-box-outline mdi-18px align-middle">&nbsp;</i>';
                                            break;
                                        }
                                        // echo str_pad($count, 3, "0", STR_PAD_LEFT);
                                        // $count++;
                                        ?>
                                      </div>
                                      <div class="d-flex flex-column">
                                        <div class="text-muted">
                                          <strong class="text-primary">Processo:&nbsp;</strong><?= $task['niprocesso'] . ' - ' .  $task['objprocesso']; ?>
                                        </div>
                                        <div class="text-muted">
                                          <strong class="text-primary">Tarefa:&nbsp;</strong><?= lmWord($task['decricaoTarefa'], 100); ?>
                                        </div>
                                        <div class="text-muted">
                                          <strong class="text-primary">Contra-Parte:&nbsp;</strong><?= lmWord($task['contraparte'], 70); ?>
                                        </div>

                                      </div>
                                    </div>
                                  </td>
                                  <td class="text-uppercase align-middle text-center" style="font-weight: 300;">
                                    <?php
                                    switch ($task['finalizada']) {
                                      case '1':
                                        echo "<span class='badge badge-pill badge-success px-2 py-1'>Finalizada <i class='mdi mdi-checkbox-marked-circle-outline'></i></span>";
                                        echo "<br/>
      <small>
      Finalizada em:
      </small><br/>" . date('d/m/Y', strtotime($task['dtFinalizacao'])) . " AS " . date('H:i', strtotime($task['dtFinalizacao'])) . "";
                                        break;


                                      case '0':
                                        $today = date("Y-m-d", time());
                                        if ($task['dtTarefa'] < $today) {
                                          echo "<span class='badge badge-pill badge-danger px-2 py-1'>Atrasada</span>";
                                        } elseif ($task['dtTarefa'] > $today) {
                                          echo "<span class='badge badge-pill badge-info px-2 py-1'>Futura</span>";
                                        } else {
                                          echo "<span class='badge badge-pill badge-warning px-4 py-1'>Hoje</span>";
                                        }
                                        break;
                                      default:

                                        break;
                                    }
                                    ?>
                                  </td>
                                  <td class=" text-uppercase align-middle" style="font-size: .8rem; ">
                                    <?php
                                    $sql = "SELECT * FROM pessoa WHERE idPessoa = '" . $task['idResponsavel'] . "'";
                                    $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($resultado as $pessoa) {
                                      echo $pessoa['nmPessoa'];
                                    }
                                    ?>
                                  </td>
                                  <td class="text-uppercase align-middle text-center">
                                    <?php
                                    echo date('d/m/Y', strtotime($task['dtTarefa']));
                                    echo " AS ";
                                    echo date('H:i', strtotime($task['hora']));

                                    ?>
                                    <div class="text-muted">

                                    </div>
                                  </td>
                                  <td class="text-uppercase align-middle  ">
                                    <ul class="nav justify-content-center d-flex justify-content-evenly">
                                      <li class="nav-item">
                                        <a href="?page=task_detail&task=<?= $task['idtarefas'] ?> " class="btn btn-tool" target="" title="Visializar Processo" rel="noopener noreferrer">
                                          <i class="mdi mdi-file-eye-outline mdi-24px "></i>
                                        </a>
                                      </li>
                                    </ul>
                                  </td>
                                </tr>
                              <?php } ?>

                            </tbody>
                          </table>
                        </div>
                        <!-- /.tarefas -->

                      </div>

                    </div>





                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer">
                The footer of the card
              </div> -->
              <!-- /.card-footer -->
            </div>
            <!--  HISTÓRICO DO PROCESSO -->
            <div class="card col-12 col-md-12">
              <div class="card-header">
                <h2 class="card-title text-uppercase h3">Histórico do Processo</h2>

                <div class="card-tools">

                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="row justify-content-between">
                      <h4> </h4>
                      <button type="button" class="btn btn-lg btn-outline-primary mr-4 " data-toggle="modal" data-target="#modal-novoHistorico">
                        <i class="fas fa-plus"></i>
                        Adicionar Histórico
                      </button>
                    </div>
                    <!-- <div class="post">
              <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                  <span class="username">
                    <a href="#">Jonathan Burke Jr.</a>
                  </span>
                  <span class="description">Shared publicly - 7:45 PM today</span>
                </div> -->
                    <!-- /.user-block -->
                    <!-- <p>
                  Lorem ipsum represents a long-held tradition for designers,
                  typographers and the like. Some people hate it and argue for
                  its demise, but others ignore.
                </p> -->

                    <!-- <p>
                  <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                </p>
              </div>-->
                    <div class="row">
                      <?php
                      $idprocess = $_GET['idprocess'];
                      $sql = "SELECT * FROM historico_processo WHERE id_processo = '$idprocess' ORDER BY data_cadastro DESC";
                      $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($resultado as $row) {

                      ?>

                        <!-- Timeline   -->
                        <!-- Main node for this component -->
                        <div class="timeline  col-12">
                          <!-- Timeline time label -->
                          <div class="time-label ">
                            <span class="bg-green">
                              <?= date("d M Y ", strtotime($row['data_cadastro'])); ?>
                            </span>
                          </div>
                          <div>
                            <!-- Before each timeline item corresponds to one icon on the left scale -->

                            <?php
                            switch ($row['tipo_historico']) {
                              case 'at_status':
                                $icon = 'sync';
                                break;
                              case 'contato':
                                $icon =  'comment-dots';
                                break;
                              case 'tarefa':
                                $icon =  'tasks';
                                break;

                              default:
                                $icon =  'history';
                                break;
                            };
                            ?>

                            <i class="fas fa-<?= $icon ?> bg-blue"></i>
                            <!-- Timeline item -->
                            <div class="timeline-item ">
                              <!-- Time -->
                              <span class="time"><i class="fas fa-clock"></i>
                                <?= date("H:i", strtotime($row['data_cadastro'])); ?>
                              </span>
                              <!-- Header. Optional -->
                              <h3 class="timeline-header ">
                                <a href="#" class="text-uppercase">
                                  <?= $row['titulo_historico'] ?>
                                </a> ...
                              </h3>
                              <!-- Body -->
                              <div class="timeline-body text-justify px-4 ">
                                <?= $row['descricao_historico'] ?>
                              </div>
                              <!-- Placement of additional controls. Optional -->
                              <div class="timeline-footer ">
                                <?php
                                if ($row['id_pessoa_responsavel'] == $_SESSION['ID'] || $_SESSION['NIVEL'] <= 1) {
                                ?>
                                  <!-- <button type="button" class="btn btn-sm btn-outline-primary mr-1 float-right" data-toggle="modal" data-target="#modal-edtHistorico" onclick="setIdHistoric(<?= $row['id_historico'] ?>)" style="margin-top:-1.7rem;">
                                    <i class="mdi mdi-pencil-outline "></i>
                                    Editar
                                  </button> -->
                                  <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-edtHistorico" style="border-radius: 7px;">
                                    <i class="mdi mdi-pencil-outline "></i>
                                    Editar</a>
                                  <!-- <a class="btn btn-danger btn-sm">Delete</a> -->
                                <?php
                                }
                                ?>
                              </div>

                            </div>
                          </div>
                          <!-- The last icon means the story is complete -->
                          <!-- <div>
                            <i class="fas fa-clock bg-gray"></i>
                          </div> -->
                        </div>
                      <?php } ?>
                      <!-- /.timeline -->
                    </div>


                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer">
                The footer of the card
              </div> -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </div>


        </div>
        <div class="col-12 col-md-12 col-lg-4 order-1 order-sm-1 order-md-2 mb-4 border-left px-4 ">
          <?php
          $sql = "SELECT * FROM processos
                  INNER JOIN pessoa ON processos.idcliente = pessoa.idPessoa
                  WHERE idprocesso = '$idProcess'";
          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
          foreach ($resultado as $dadoProcesso) {
          ?>
            <div class="row d-flex justify-content-between  ">
              <h4 class="col-11 text-primary text-justify">
                <i class="fas fa-balance-scale mx-1"> - </i>

                <?= $dadoProcesso['niprocesso'] . ' - ' . $dadoProcesso['objprocesso'] ?>
              </h4>
              <a href="" title="Editar Processo" data-toggle="modal" data-target="#modal-edtProdesso">
                <i class="mdi mdi-pencil text-secondary mdi-24px"></i>
              </a>
            </div>
            <div class="row mt-1">
              <div class="col-5">
                <p class="text-sm">Nº do Processo
                  <span class="d-block text-muted text-uppercase">
                    <?=
                    isset($dadoProcesso['numprocesso']) && $dadoProcesso['numprocesso'] > 0 ? MascaraCNJ(str_pad($dadoProcesso['numprocesso'], 19, "0", STR_PAD_LEFT)) : 'Processo sem Número';
                    ?>
                  </span>
                </p>
              </div>
              <div class="col-5">
                <p class="text-sm">Etapa do Processo
                  <a href="" class=" mr-4 " data-toggle="modal" data-target="#modal-edtEtapa">
                    <span class="d-block text-muted" style="font-size:.8rem">
                      <?php
                      switch ($dadoProcesso['statusprocesso']) {
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
                      <i class="mdi mdi-rotate-3d-variant"></i>
                    </span>
                  </a>
                </p>
              </div>
              <div class="col-2">
                <p class="text-sm">Status
                  <span class="d-block text-muted">
                    <?= $dadoProcesso['statusprocesso'] != 'concluido' ? 'ATIVO' : 'INATIVO';  ?>
                  </span>
                </p>
              </div>
            </div>
            <span class="">
              Descrição do Processo<br />
            </span>
            <p class="text-muted text-justify">
              <?= $dadoProcesso['descricaoprocesso'] ?>
            </p>

            <br>
            <div class="text-muted">
              <p class="text-sm">Cliente
                <b class="d-block text-uppercase">
                  <?= $dadoProcesso['nmPessoa'] ?>
                </b>
              </p>
              <p class="text-sm">Contras Parte
                <b class="d-block text-uppercase">
                  <?= $dadoProcesso['contraparte'] ?>
                </b>
              </p>
            </div>
          <?php } ?>
          <!-- ARQUIVOS -->
          <!-- <div class="row justify-content-between mt-5 ">
            <h5 class=" text-primary">
              <i class="mdi mdi-file-outline mx-2"></i>
              Arquivos
            </h5>
            <?php

            ?>

            <span class="text-sm " id="storange">
              <?php
              $storange = 5;
              $unit = 'GB';
              $path = './upload/';
              $percentage = GetDirectoryPercentageUsed($path, $storange, $unit);
              if ($percentage <= 50.00) {
                echo "<script>
                        var el = document.getElementById('storange');
                        el.classList.add('text-teal');
                      </script>";
              } elseif ($percentage <= 75.00) {
                echo "<script>
                        var el = document.getElementById('storange');
                        el.classList.remove('text-gray');
                        el.classList.add('text-warning');
                      </script>";
              } else {
                echo "<script>
                        var el = document.getElementById('storange');
                        el.classList.remove('text-gray');
                        el.classList.remove('text-warning');
                        el.classList.add('text-danger');
                      </script>";
              }
              echo $percentage . "% de amazenamento ultilizado de $storange $unit";
              ?>
            </span>

            <a href="" title="Adicionar Arquivo" class="">
              <i class="mdi mdi-upload text-secondary mdi-24px"></i>
            </a>
          </div>

          <ul class="list-unstyled">
            <li>
              <a href="" class="btn-link text-secondary">
                <i class="far fa-fw fa-file-word"></i>&nbsp;
                Functional-requirements.docx</a>
            </li>
            <li>
              <a href="" class="btn-link text-secondary">
                <i class="far fa-fw fa-file-pdf"></i>&nbsp;
                UAT.pdf</a>
            </li>
            <li>
              <a href="" class="btn-link text-secondary">
                <i class="far fa-fw fa-envelope"></i>&nbsp;
                Email-from-flatbal.mln</a>
            </li>
            <li>
              <a href="" class="btn-link text-secondary">
                <i class="far fa-fw fa-image "></i>&nbsp;
                Logo.png</a>
            </li>
            <li>
              <a href="" class="btn-link text-secondary">
                <i class="far fa-fw fa-file-word"></i>&nbsp;
                Contract-10_12_2014.docx</a>
            </li>
          </ul>
          <div class="text-center mt-5 mb-3">

            <a href="#" class="btn btn-sm btn-outline-primary" id="btnUpFile">
              <i class="fa fa-upload mx-2 "></i>
              Adicioar Arquivo</a>
            <?php
            if ($percentage >= 100) {
              echo "<script>
                      var btnUpFile = document.getElementById('btnUpFile');
                      btnUpFile.classList.add('d-none');
                    </script>";
            } else {
              echo "<script>
                      var btnUpFile = document.getElementById('btnUpFile');
                      btnUpFile.classList.remove('d-none');
                    </script>";
            }
            ?>
                    </div> -->
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- MODAL EDITAR ETAPA -->
<div class="modal fade" id="modal-edtEtapa">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 400; letter-spacing: 1px;">Editar Etapa</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->
        <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data" />

        <input type="hidden" name="id_pessoa_responsavel" id="id_pessoa_responsavel" value="<?= $_SESSION['ID']; ?>" />
        <input type="hidden" name="id_processo" id="id_processo" value="" />
        <input type="hidden" name="id_pessoa_cliente" id="" value="<?= $_GET['idcli']; ?>" />

        <div class="form-row">
          <div class=" col-12">
            <label for="statusprocesso">Etapa
              <span class="text-orange">*</span>
            </label>
            <select class="form-control text-uppercase" required name="statusprocesso" id="statusprocesso">

                    <option value="inicial" <?=$dadoProcesso['statusprocesso'] ='inicial'? 'selected':''  ?>>protocolo inicial </option>
                    <option  value="aguardando" <?=$dadoProcesso['statusprocesso'] ='inicial'? 'selected':''  ?>>Aguardando Documento</option>
                    <option value="analise" <?=$dadoProcesso['statusprocesso'] ='inicial'? 'selected':''  ?>>Análise</option>
                    <option value="aguardandoINSS" <?=$dadoProcesso['statusprocesso'] ='inicial'? 'selected':''  ?>>Aguardando Resposta do INSS</option>
                    <option value="concluso" <?=$dadoProcesso['statusprocesso'] ='inicial'? 'selected':''  ?>>Concluso </option>
                    <option value="cumprimento" <?=$dadoProcesso['statusprocesso'] ='inicial'? 'selected':''  ?>>Cumprimento </option>
                    <option value="concluido" <?=$dadoProcesso['statusprocesso'] ='inicial'? 'selected':''  ?>>Concluído </option>
                    <option value="exigencia" <?=$dadoProcesso['statusprocesso'] ='inicial'? 'selected':''  ?>>Exigência</option>
                    <option value="justComum" <?=$dadoProcesso['statusprocesso'] ='inicial'? 'selected':''  ?>>Justiça Comum</option>
                    <option value="justFederal" <?=$dadoProcesso['statusprocesso'] ='inicial'? 'selected':''  ?>>Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>
                    <option value="prazo">Prazo</option>
                    <option value="recurso">Recurso</option>
                    <option value="sentença">sentença</option>

              <?php
              //               $process = $_GET['idprocess'];
              //               $sql = "SELECT * FROM processos WHERE idprocesso ='$process' ";
              //               $result = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
              // foreach ($result as ) {

              switch ($dadoProcesso['statusprocesso']) {
                case 'aguardando': ?>
                  <option value="aguardando" selected>Aguardando Documento</option>
                  <option value="analise">Análise</option>
                  <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                  <option value="concluso">Concluso </option>
                  <option value="concluido">Concluído </option>
                  <option value="exigencia">Exigência</option>
                  <option value="justComum">Justiça Comum</option>
                  <option value="justFederal">Justiça Federal </option>
                  <option value="pericia">Perícia ou Agendamento</option>
                  <option value="prorrogacao">Prorrogação</option>
                <?php
                  break;
                case 'analise': ?>
                  <option value="aguardando">Aguardando Documento</option>
                  <option value="analise" selected>Análise</option>
                  <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                  <option value="concluso">Concluso </option>
                  <option value="concluido">Concluído </option>
                  <option value="exigencia">Exigência</option>
                  <option value="justComum">Justiça Comum</option>
                  <option value="justFederal">Justiça Federal </option>
                  <option value="pericia">Perícia ou Agendamento</option>
                  <option value="prorrogacao">Prorrogação</option>
                <?php
                  break;
                case 'aguardandoINSS': ?>
                  <option value="aguardando">Aguardando Documento</option>
                  <option value="analise">Análise</option>
                  <option value="aguardandoINSS" selected>Aguardando Resposta do INSS</option>
                  <option value="concluso">Concluso </option>
                  <option value="concluido">Concluído </option>
                  <option value="exigencia">Exigência</option>
                  <option value="justComum">Justiça Comum</option>
                  <option value="justFederal">Justiça Federal </option>
                  <option value="pericia">Perícia ou Agendamento</option>
                  <option value="prorrogacao">Prorrogação</option>
                <?php
                  break;
                case 'concluso': ?>
                  <option value="aguardando">Aguardando Documento</option>
                  <option value="analise">Análise</option>
                  <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                  <option value="concluso" selected>Concluso </option>
                  <option value="concluido">Concluído </option>
                  <option value="exigencia">Exigência</option>
                  <option value="justComum">Justiça Comum</option>
                  <option value="justFederal">Justiça Federal </option>
                  <option value="pericia">Perícia ou Agendamento</option>
                  <option value="prorrogacao">Prorrogação</option>
                <?php
                  break;
                case 'concluido': ?>
                  <option value="aguardando">Aguardando Documento</option>
                  <option value="analise">Análise</option>
                  <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                  <option value="concluso">Concluso </option>
                  <option value="concluido" selected>Concluído </option>
                  <option value="exigencia">Exigência</option>
                  <option value="justComum">Justiça Comum</option>
                  <option value="justFederal">Justiça Federal </option>
                  <option value="pericia">Perícia ou Agendamento</option>
                  <option value="prorrogacao">Prorrogação</option>
                <?php
                  break;
                case 'exigencia': ?>
                  <option value="aguardando">Aguardando Documento</option>
                  <option value="analise">Análise</option>
                  <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                  <option value="concluso">Concluso </option>
                  <option value="concluido">Concluído </option>
                  <option value="exigencia" selected>Exigência</option>
                  <option value="justComum">Justiça Comum</option>
                  <option value="justFederal">Justiça Federal </option>
                  <option value="pericia">Perícia ou Agendamento</option>
                  <option value="prorrogacao">Prorrogação</option>
                <?php
                  break;
                case 'justComum': ?>
                  <option value="aguardando">Aguardando Documento</option>
                  <option value="analise">Análise</option>
                  <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                  <option value="concluso">Concluso </option>
                  <option value="concluido">Concluído </option>
                  <option value="exigencia">Exigência</option>
                  <option value="justComum" selected>Justiça Comum</option>
                  <option value="justFederal">Justiça Federal </option>
                  <option value="pericia">Perícia ou Agendamento</option>
                  <option value="prorrogacao">Prorrogação</option>
                <?php
                  break;
                case 'justFederal': ?>
                  <option value="aguardando">Aguardando Documento</option>
                  <option value="analise">Análise</option>
                  <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                  <option value="concluso">Concluso </option>
                  <option value="concluido">Concluído </option>
                  <option value="exigencia">Exigência</option>
                  <option value="justComum">Justiça Comum</option>
                  <option value="justFederal" selected>Justiça Federal </option>
                  <option value="pericia">Perícia ou Agendamento</option>
                  <option value="prorrogacao">Prorrogação</option>
                <?php
                  break;
                case 'pericia': ?>
                  <option value="aguardando">Aguardando Documento</option>
                  <option value="analise">Análise</option>
                  <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                  <option value="concluso">Concluso </option>
                  <option value="concluido">Concluído </option>
                  <option value="exigencia">Exigência</option>
                  <option value="justComum">Justiça Comum</option>
                  <option value="justFederal">Justiça Federal </option>
                  <option value="pericia" selected>Perícia ou Agendamento</option>
                  <option value="prorrogacao">Prorrogação</option>
                <?php
                  break;
                case 'prorrogacao': ?>
                  <option value="aguardando">Aguardando Documento</option>
                  <option value="analise">Análise</option>
                  <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                  <option value="concluso">Concluso </option>
                  <option value="concluido">Concluído </option>
                  <option value="exigencia">Exigência</option>
                  <option value="justComum">Justiça Comum</option>
                  <option value="justFederal">Justiça Federal </option>
                  <option value="pericia">Perícia ou Agendamento</option>
                  <option value="prorrogacao" selected>Prorrogação</option>
              <?php
                  break;
                default:
                  # code...
                  break;
              }
              ?>
            </select>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
        </div>
        <br />

      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="idcliente" value="<?= $id; ?>" />
        <input type="hidden" name="idadvogado" value="0" />
        <input type="hidden" name="nomeCliente" value="<?= $dcliente['nmPessoa']; ?>" />
        <input type="hidden" name="userActionLog" value="<?= $_SESSION['USUARIO']; ?>" />
        <input type="hidden" name="acao" value="edtEtapa" />
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
          Fechar </button>
        <button class="btn btn-success btn-lg" type="submit">
          <i class="far fa-save fa-fw fa-lg"></i>
          Gravar Dados</button>
        </form>
        <!--/form novo Usuario -->
        <!-- <button type="button" class="btn btn-success">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- MODAL NOVA HISTORICO -->
<div class="modal fade" id="modal-novoHistorico">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 400; letter-spacing: 1px; ">Historico do Processo
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->
        <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data" />

        <input type="hidden" name="id_pessoa_responsavel" id="id_pessoa_responsavel" value="<?= $_SESSION['ID']; ?>" />
        <input type="hidden" name="id_processo" id="id_processo" value="" />
        <input type="hidden" name="id_pessoa_cliente" id="" value="<?= $_GET['idcli']; ?>" />

        <div class="form-row">
          <div class="col-md-12">
            <label for="titulo_historico" requided>Titulo
              <span class="text-orange">*</span>
            </label>

            <input type="text" name="titulo_historico" class="form-control text-uppercase" id="titulo_historico" placeholder="de um titulo para esse historico" value="" required />
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

          <!-- <div class="col-md-6">
                  <label for="contraparte">Processo
                    <span class="text-orange">*</span>
                  </label>
                  <input type="text" name="contraparte" class="form-control text-uppercase  " id="contraparte" placeholder=" Parte Contraria" value="" >
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div> -->

        </div>
        <div class="form-row">
          <div class="col-md-12">
            <label for="decricaoTarefa">Descreva o histórico
              <span class="text-orange">*</span>
            </label>

            <textarea class="form-control" name="descricao_historico" id="descricao_historico" placeholder="Decrição da historico" name="validation" rows="4" required></textarea>

            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class=" col-12 col-md-8">
            <label for="dtTarefa">Tipo de Historico
              <span class="text-orange">*</span>
            </label>
            <select class="form-control text-uppercase" required name="tipo_historico" id="tipo_historico">
              <option value="" selected disabled> Escolha o tipo de Historico</option>
              <option value="at_status">Alteração de Status</option>
              <option value="contato">Comunicação</option>
              <option value="tarefa">Tarefa</option>
            </select>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

        </div>
        <br />

      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="idcliente" value="<?= $id; ?>" />
        <input type="hidden" name="idadvogado" value="0" />
        <input type="hidden" name="nomeCliente" value="<?= $dcliente['nmPessoa']; ?>" />
        <input type="hidden" name="userActionLog" value="<?= $_SESSION['USUARIO']; ?>" />
        <input type="hidden" name="gravarHistorico" value="gravarHistorico" />
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
          Fechar </button>
        <button class="btn btn-success btn-lg" type="submit">
          <i class="far fa-save fa-fw fa-lg"></i>
          Gravar Dados</button>
        </form>
        <!--/form novo Usuario -->
        <!-- <button type="button" class="btn btn-success">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- MODAL EDITAR HISTORICO -->
<div class="modal fade" id="modal-edtHistorico">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 400; letter-spacing: 1px; ">Editar Historico do Processo
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <script>
          document.write(variavelphp);
          console.log(variavelphp);
        </script>

        <?php
        $variavelphp = "<script>document.write(variavelphp)</script>";
        var_dump($variavelphp);

        $idprocess = $_GET['idprocess'];
        // $id_historico = "<input type=\"text\" class=\"text-danger\" id=\"id_historico\">";
        $sql = "SELECT * FROM historico_processo WHERE id_processo = '$idprocess' ORDER BY data_cadastro DESC";
        $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $row) {
        }

        ?>


        <!-- form novo Usuário -->
        <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data" />

        <input type="hidden" name="id_pessoa_responsavel" id="id_pessoa_responsavel" value="<?= $_SESSION['ID']; ?>" />
        <input type="hidden" name="id_processo" id="id_processo" value="" />
        <input type="hidden" name="id_pessoa_cliente" id="" value="<?= $_GET['idcli']; ?>" />

        <div class="form-row">
          <div class="col-md-12">
            <label for="titulo_historico" requided>Titulo
              <span class="text-orange">*</span>
            </label>

            <input type="text" name="titulo_historico" class="form-control text-uppercase" id="titulo_historico" placeholder="de um titulo para esse historico" value="" required />
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

          <!-- <div class="col-md-6">
                  <label for="contraparte">Processo
                    <span class="text-orange">*</span>
                  </label>
                  <input type="text" name="contraparte" class="form-control text-uppercase  " id="contraparte" placeholder=" Parte Contraria" value="" >
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div> -->

        </div>
        <div class="form-row">
          <div class="col-md-12">
            <label for="decricaoTarefa">Descreva o histórico
              <span class="text-orange">*</span>
            </label>

            <textarea class="form-control" name="descricao_historico" id="descricao_historico" placeholder="Decrição da historico" name="validation" rows="4" required></textarea>

            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class=" col-12 col-md-8">
            <label for="dtTarefa">Tipo de Historico
              <span class="text-orange">*</span>
            </label>
            <select class="form-control text-uppercase" required name="tipo_historico" id="tipo_historico">
              <option value="" selected disabled> Escolha o tipo de Historico</option>
              <option value="at_status">Alteração de Status</option>
              <option value="contato">Comunicação</option>
              <option value="tarefa">Tarefa</option>
            </select>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

        </div>
        <br />

      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="idcliente" value="<?= $id; ?>" />
        <input type="hidden" name="idadvogado" value="0" />
        <input type="hidden" name="nomeCliente" value="<?= $dcliente['nmPessoa']; ?>" />
        <input type="hidden" name="userActionLog" value="<?= $_SESSION['USUARIO']; ?>" />
        <input type="hidden" name="gravarHistorico" value="gravarHistorico" />
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
          Fechar </button>
        <button class="btn btn-success btn-lg" type="submit">
          <i class="far fa-save fa-fw fa-lg"></i>
          Gravar Dados</button>
        </form>
        <!--/form novo Usuario -->
        <!-- <button type="button" class="btn btn-success">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- MODAL NOVA TAREFA -->
<div class="modal fade" id="modal-novaTarefa">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px;">Nova Tarefa&nbsp;
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->
        <form class="needs-validation" novalidate action="./pages/pages/acoes/gravaNovaTarefa.php" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="idCreador" id="idCreador" value="<?= $_SESSION['ID']; ?>" />
          <input type="hidden" name="idProcesso" id="" value="<?= $_GET['idprocess']; ?>" />
          <input type="hidden" name="idpessoa" id="" value="<?= $_GET['idcli']; ?>" />

          <div class="form-row">
            <div class="col-md-12">
              <label for="idResponsavel">Responsavel
                <span class="text-orange">*</span>
              </label>

              <select class="form-control text-uppercase custom-select" name="idResponsavel" id="idResponsavel">
                <option value="" selected disabled>Selecione Responsavel </option>
                <?php
                foreach (ler('vw_pessoa_user', '', 'WHERE nivelUser > 0 and flStatusUser = 1')->fetchAll(PDO::FETCH_ASSOC) as $users) {
                ?>
                  <option value="<?= $users['idPessoaPessoa'] ?>"><?= $users['nmPessoa'] . ' - ' ?>
                    <?php
                    switch ($users['nivelUser']) {
                      case '1':
                        echo 'Administrador';
                        break;
                      case '2':
                        echo 'Secretário(a) / Atendente';
                        break;
                      case '3':
                        echo 'Advogado(a) / Parceiro(a)';
                        break;

                      default:
                        # code...
                        break;
                    }

                    ?>
                  </option>
                <?php } ?>

              </select>
              <div class="invalid-feedback">
                A seleção é Obrigatório !
              </div>
              <!-- <input type="text" name="objprocesso" class="form-control text-uppercase" disabled id="objprocesso" placeholder="Objeto do Processo" value="" required/>
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div> -->
            </div>

            <!-- <div class="col-md-6">
                  <label for="contraparte">Processo
                    <span class="text-orange">*</span>
                  </label>
                  <input type="text" name="contraparte" class="form-control text-uppercase  " id="contraparte" placeholder=" Parte Contraria" value="" >
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div> -->

          </div>
          <div class="form-row">
            <div class="col-md-12">
              <label for="decricaoTarefa">O que deverá ser feito ?
                <span class="text-orange">*</span>
              </label>
              <textarea class="form-control" name="decricaoTarefa" id="decricaoTarefa" placeholder="Decrição da tarefa" name="validation" rows="4" required></textarea>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-3">
              <label for="dtTarefa">Data da tarefa
                <span class="text-orange">*</span>
              </label>
              <input type="date" maxlength="19" name="dtTarefa" class="form-control text-uppercase" id="dtTarefa" placeholder="" value="" required />
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2">
              <label for="hora">Hora da tarefa</label>
              <input type="time" maxlength="19" name="hora" class="form-control text-uppercase" id="hora" placeholder="" value="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-5">
              <label for="statusprocesso">Local do Compromisso</label>

              </label>
              <input type="text" maxlength="19" name="local" class="form-control text-uppercase" id="local" placeholder="Local onde sera realizada a terefa" value="" />
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2">
              <label for="prioridade">Prioridade</label>
              <select class="form-control text-uppercase custom-select" name="prioridade" id="prioridade">
                <option value="baixa" class="text-success">Baixa</option>
                <option value="media" class="text-warning">Média</option>
                <option value="alta" class="text-danger">Alta</option>
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </select>
            </div>
          </div>
          <br />


      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="idcliente" value="<?= $_GET["idcli"]; ?>" />
        <input type="hidden" name="idadvogado" value="0" />
        <input type="hidden" name="nomeCliente" value="<?= $dcliente['nmPessoa']; ?>" />
        <input type="hidden" name="userActionLog" value="<?= $_SESSION['USUARIO']; ?>" />
        <input type="hidden" name="gravar" value="gravar" />
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
          Fechar </button>
        <button class="btn btn-success btn-lg" type="submit">
          <i class="far fa-save fa-fw fa-lg"></i>
          Gravar Dados</button>
        </form>
        <!--/form novo Usuario -->
        <!-- <button type="button" class="btn btn-success">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- MODAL EDITAR PROCESSO -->
<div class="modal fade" id="modal-edtProdesso">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; color:orange">Editar Proceso nº:&nbsp;
        </h5>
        <h5 class="modal-title text-primary" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; text-transform: uppercase;">
          <?= $dadoProcesso['niprocesso']; ?>
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->

        <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="acao" value="edtProcesso" />
          <input type="hidden" name="niprocesso" value="<?= $dadoProcesso['niprocesso']; ?>" />
          <div class="form-row">
            <div class="col-md-6">
              <label for="titulo_historico">Objeto do Processo
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="objprocesso" class="form-control text-uppercase  " id="objprocesso" placeholder="Objeto do Processo" value="<?= $dadoProcesso['objprocesso']; ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-6">
              <label for="contraparte">Parte Contraria
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="contraparte" class="form-control text-uppercase  " id="contraparte" placeholder=" Parte Contraria" value="<?= $dadoProcesso['contraparte']; ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

          </div>
          <div class="form-row">
            <div class="col-md-12">
              <label for="descricaoprocesso">Descrição do Processo
                <span class="text-orange">*</span>
              </label>

              <textarea class="form-control" name="descricaoprocesso" id="descricaoprocesso" name="validation" rows="4" required><?= trim($dadoProcesso['descricaoprocesso']); ?></textarea>

              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-4">
              <label for="numprocesso">Nº Processo (CNJ)</label>
              <input type="text" maxlength="19" name="numprocesso" class="form-control text-uppercase js_numCNJ" id="numprocesso" placeholder="Número do Processo" value=" <?= $dadoProcesso['numprocesso'] > 0 ? $dadoProcesso['numprocesso'] : ''; ?>">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-4">
              <label for="areaprocesso">Área da Ação
                <span class="text-orange">*</span>
              </label>
              <select class="form-control text-uppercase" required name="areaprocesso" id="areaprocesso">
                <?php
                switch ($dadoProcesso['areaprocesso']) {
                  case 'adminsitrativo':
                    echo '<option value="adminsitrativo" selected>Administrativo</option>
                          <option value="civil">Civil</option>
                          <option value="familia">Família</option>
                          <option value="previdenciario">Previdenciário</option>
                          <option value="trabalhista">Trabalhista</option>';
                    break;
                  case 'civil':
                    echo '<option value="adminsitrativo">Administrativo</option>
                          <option value="civil" selected>Civil</option>
                          <option value="familia">Família</option>
                          <option value="previdenciario">Previdenciário</option>
                          <option value="trabalhista">Trabalhista</option>';
                    break;
                  case 'familia':
                    echo '<option value="adminsitrativo">Administrativo</option>
                          <option value="civil">Civil</option>
                          <option value="familia" selected>Família</option>
                          <option value="previdenciario">Previdenciário</option>
                          <option value="trabalhista">Trabalhista</option>';
                    break;
                  case 'previdenciario':
                    echo '<option value="adminsitrativo">Administrativo</option>
                          <option value="civil">Civil</option>
                          <option value="familia">Família</option>
                          <option value="previdenciario" selected>Previdenciário</option>
                          <option value="trabalhista">Trabalhista</option>';
                    break;
                  case 'trabalhista':
                    echo '<option value="adminsitrativo">Administrativo</option>
                          <option value="civil">Civil</option>
                          <option value="familia">Família</option>
                          <option value="previdenciario">Previdenciário</option>
                          <option value="trabalhista" selected>Trabalhista</option>';
                    break;
                  default:
                    echo '<option value="" selected disabled>Área do ação</option>
                          <option value="adminsitrativo">Administrativo</option>
                          <option value="civil">Civil</option>
                          <option value="familia">Família</option>
                          <option value="previdenciario">Previdenciário</option>
                          <option value="trabalhista">Trabalhista</option>';
                    break;
                }
                ?>

              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-4">
              <label for="statusprocesso">Etapa
                <span class="text-orange">*</span>
              </label>
              <select class="form-control text-uppercase" required name="statusprocesso" id="statusprocesso">

                <?php
                switch ($dadoProcesso['statusprocesso']) {
                  case 'aguardando':
                    echo ' <option value="aguardando" selected>Aguardando Documento</option>
                    <option value="analise">Análise</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="concluso">Concluso </option>
                    <option value="concluido">Concluído </option>
                    <option value="exigencia">Exigência</option>
                    <option value="justComum">Justiça Comum</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>';
                    break;
                  case 'analise':
                    echo '<option value="aguardando">Aguardando Documento</option>
                    <option value="analise" selected>Análise</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="concluso">Concluso </option>
                    <option value="concluido">Concluído </option>
                    <option value="exigencia">Exigência</option>
                    <option value="justComum">Justiça Comum</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>';
                    break;
                  case 'aguardandoINSS':
                    echo '<option value="aguardando">Aguardando Documento</option>
                    <option value="analise">Análise</option>
                    <option value="aguardandoINSS" selected>Aguardando Resposta do INSS</option>
                    <option value="concluso">Concluso </option>
                    <option value="concluido">Concluído </option>
                    <option value="exigencia">Exigência</option>
                    <option value="justComum">Justiça Comum</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>';
                    break;
                  case 'concluso':
                    echo '<option value="aguardando">Aguardando Documento</option>
                    <option value="analise">Análise</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="concluso" selected>Concluso </option>
                    <option value="concluido">Concluído </option>
                    <option value="exigencia">Exigência</option>
                    <option value="justComum">Justiça Comum</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>';
                    break;
                  case 'concluido':
                    echo '<option value="aguardando">Aguardando Documento</option>
                    <option value="analise">Análise</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="concluso">Concluso </option>
                    <option value="concluido" selected>Concluído </option>
                    <option value="exigencia">Exigência</option>
                    <option value="justComum">Justiça Comum</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>';
                    break;
                  case 'exigencia':
                    echo '<option value="aguardando">Aguardando Documento</option>
                    <option value="analise">Análise</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="concluso">Concluso </option>
                    <option value="concluido">Concluído </option>
                    <option value="exigencia" selected>Exigência</option>
                    <option value="justComum">Justiça Comum</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>';
                    break;
                  case 'justComum':
                    echo '<option value="aguardando">Aguardando Documento</option>
                    <option value="analise">Análise</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="concluso">Concluso </option>
                    <option value="concluido">Concluído </option>
                    <option value="exigencia">Exigência</option>
                    <option value="justComum" selected>Justiça Comum</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>';
                    break;
                  case 'justFederal':
                    echo '<option value="aguardando">Aguardando Documento</option>
                    <option value="analise">Análise</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="concluso">Concluso </option>
                    <option value="concluido">Concluído </option>
                    <option value="exigencia">Exigência</option>
                    <option value="justComum">Justiça Comum</option>
                    <option value="justFederal" selected>Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>';
                    break;
                  case 'pericia':
                    echo '<option value="aguardando">Aguardando Documento</option>
                    <option value="analise">Análise</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="concluso">Concluso </option>
                    <option value="concluido">Concluído </option>
                    <option value="exigencia">Exigência</option>
                    <option value="justComum">Justiça Comum</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="pericia" selected>Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>';
                    break;
                  case 'prorrogacao':
                    echo '<option value="aguardando">Aguardando Documento</option>
                    <option value="analise">Análise</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="concluso">Concluso </option>
                    <option value="concluido">Concluído </option>
                    <option value="exigencia">Exigência</option>
                    <option value="justComum">Justiça Comum</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao" selected>Prorrogação</option>';
                    break;
                  default:
                    echo '<option value="aguardando">Aguardando Documento</option>
                    <option value="analise">Análise</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="concluso">Concluso </option>
                    <option value="concluido">Concluído </option>
                    <option value="exigencia">Exigência</option>
                    <option value="justComum">Justiça Comum</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>';
                    break;
                }
                ?>
              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="idcliente" value="<?= $_GET["idcli"] ?>">
        <input type="hidden" name="idprocesso" value="<?= $_GET["idprocess"] ?>">
        <input type="hidden" name="idadvogado" value="0">
        <input type="hidden" name="nomeCliente" value="<?= $dcliente['nmPessoa']; ?>">
        <input type="hidden" name="userActionLog" value="<?= $_SESSION['USUARIO']; ?>">
        <input type="hidden" name="saveEdi" value="gravar">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
          Fechar </button>
        <button class="btn btn-success btn-lg" type="submit">
          <i class="far fa-save fa-fw fa-lg"></i>
          Gravar Dados</button>
        </form>
        <!--/form novo Usuario -->
        <!-- <button type="button" class="btn btn-success">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
  function setIdHistoric(valor) {

    var currentLocation = window.location;
    alert(currentLocation);
    // $.ajax({
    //   type: "GET",
    //   url: "caminho/para/ficheiro.php",
    //   data: dadosFormulario,
    //   success: function(resposta) {
    //     // variável "resposta" contém o que o servidor envia
    //     // aqui código a executar quando correu tudo bem
    //   },
    //   error: function() {
    //     // correu mal, agir em conformidade
    //   }
    // });


    var variavelphp = valor;
    console.log(variavelphp);

    //document.getElementById('id_historico').value = valor;
  };
</script>

<script>
  function setaDadosModalProcesso(valor) {
    document.getElementById('idPessoaCliente').value = valor;
  };

  function modalIdProcesso(valor) {
    document.getElementById('idProcesso').value = valor;
    document.getElementById('id_processo').value = valor;
    document.getElementById('id_processoHistorico').value = valor;
    // var currentUrl = window.location.href
    // document.location.href = currentUrl + "&idp=" + valor;
  };

  function setaDadosModal(valor) {
    document.getElementById('idPessoa').value = valor;
  };
</script>
