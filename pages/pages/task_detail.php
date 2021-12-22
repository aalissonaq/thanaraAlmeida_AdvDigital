<?php
$task_id = $_GET['task'];
$sql = "SELECT * FROM `tarefas` WHERE `idtarefas` = '$task_id'";
$resultQueryTask = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$task = $resultQueryTask[0];

$idClient = $task['idpessoa'];
$idProcess = $task['idProcesso'];

if (isset($_POST['edtTarefa']) && $_POST['edtTarefa'] == 'edtTarefa') {

  $dados['idCreador'] = strip_tags((trim($_POST['idCreador'])));
  $dados['idResponsavel'] = strip_tags((trim($_POST['idResponsavel'])));
  $dados['idProcesso'] = strip_tags((trim($_POST['idProcesso'])));
  $dados['idpessoa'] = strip_tags(strip_tags(trim($_POST['idpessoa'])));
  $dados['decricaoTarefa'] = strip_tags((trim($_POST['decricaoTarefa'])));
  $dados['dtTarefa'] = strip_tags(strip_tags(trim($_POST['dtTarefa'])));
  $dados['hora'] = strip_tags(strip_tags(trim($_POST['hora'])));
  $dados['local'] = strip_tags(strip_tags(trim($_POST['local'])));
  $dados['finalizada'] = $_POST['finalizada'];
  $dados['prioridade'] = strip_tags(strip_tags(trim($_POST['prioridade'])));

  $updadeTask = atualizar('tarefas', $dados, "idtarefas = '$task_id'");
  if ($updadeTask) {
    echo "<script>alert('Tarefa atualizada com sucesso!');</script>";
    echo "<script>window.location.href = 'inicio.php?page=task_detail&task=$task_id';</script>";
  } else {
    echo "<script>alert('Erro ao atualizar tarefa!');</script>";
    echo "<script>window.location.href = 'inicio.php?page=task_detail&task=$task_id';</script>";
  }
}

if (isset($_POST['gravarHistorico']) && $_POST['gravarHistorico'] == 'gravarHistorico') {
  $id_pessoa_cliente = $_POST['id_pessoa_cliente'];
  $id_pessoa_responsavel = $_POST['id_pessoa_responsavel'];
  $id_processo = trim(strip_tags($_GET['idprocess']));
  $titulo_historico = trim(strip_tags($_POST['titulo_historico']));
  $descricao_historico = trim(strip_tags($_POST['descricao_historico']));
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

  $id_pessoa_cliente = trim(strip_tags($idClient));
  $id_pessoa_responsavel = $_SESSION['ID'];
  $id_processo = trim(strip_tags($idProcess));
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
}

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 style="font-family:'Advent Pro', sans-serif; letter-spacing: .07rem; font-weight: 300;">Detalhamento da tarefa</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif; letter-spacing: .06rem;">
          <li class="breadcrumb-item"><a href="?page=inicio">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=profileCliente&id=<?= $idClient ?>">Perfil do Usuários</a></li>
          <li class="breadcrumb-item active">Detalhamento de Tarefa</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <?php
  switch ($task['prioridade']) {
    case 'baixa':
      $color = 'success';
      break;
    case 'media':
      $color = 'warning';
      break;
    case 'alta':
      $color = 'danger';
      break;
    default:
      $color = 'secondary';
      break;
  }
  ?>


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
        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
          <div class="row mr-2">
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
            <div class="card col-12 col-md-12 card-<?= $color ?>">
              <div class="card-header">
                <h2 class="card-title text-uppercase h3">Tarefa</h2>
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
                      <!-- <button type="button" class="btn btn-lg btn-outline-primary mr-4 " data-toggle="modal" data-target="#modal-novoHistorico">
                        <i class="fas fa-plus"></i>
                        Adicionar Histórico
                      </button> -->
                    </div>
                    <!-- <div class="post">-->
                    <div class="row mb-2">
                      <div class="col-12 text-primary ">
                        <span class="text-lead">
                          <i class="fas fa-cogs mr-1"></i>
                          Descrição da Tarefa:
                        </span>
                        <div class="h5  text-justify">
                          <span class="text-lead text-uppercase">
                            <?= $task['decricaoTarefa'] ?>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-6 text-primary">
                        <span class="text-lead">
                          <i class="fas fa-user-tie mr-1"></i>
                          Criado por:
                        </span>
                        <div class="h5">
                          <span class="text-lead text-uppercase">
                            <?php
                            $criador = $task['idCreador'];
                            $sql = "SELECT * FROM pessoa WHERE idPessoa = '$criador'";
                            $result = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                            $pessoa = $result[0];
                            echo $pessoa['nmPessoa'];
                            ?>
                        </div>
                      </div>
                      <div class="col-6 text-primary">
                        <span class="text-lead">
                          <i class="fas fa-user-tie mr-1"></i>
                          Responsável:
                        </span>
                        <div class="h5">
                          <span class="text-lead text-uppercase ">
                            <?php
                            $resposavel = $task['idResponsavel'];
                            $sql = "SELECT * FROM pessoa WHERE idPessoa = '$resposavel'";
                            $result = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                            $pessoa = $result[0];
                            echo $pessoa['nmPessoa'];
                            ?>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-3 text-primary">
                        <span class="text-lead">
                          <i class="fas fa-calendar-day mr-1"></i>
                          Data da Tarefa:
                        </span>
                        <div class="h5">
                          <span class="text-lead text-uppercase text-primary">
                            <?= date('d/m/Y', strtotime($task['dtTarefa'])); ?>
                        </div>
                      </div>
                      <div class="col-3 text-primary">
                        <span class="text-lead">
                          <i class="fas fa-clock mr-1"></i>
                          Hora da tarefa:
                        </span>
                        <div class="h5">
                          <span class="text-lead text-uppercase ">
                            <?= date('H:i', strtotime($task['hora'])); ?>
                        </div>
                      </div>
                      <div class="col-6 text-primary">
                        <span class="text-lead">
                          <i class="fas fa-map-marker-alt mr-1"></i>
                          Local da Tarefa:
                        </span>
                        <div class="h5">
                          <span class="text-lead text-uppercase ">
                            <?= $task['local'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-3 text-primary">
                        <span class="text-lead">
                          <i class="fas fa-exclamation-circle mr-1"></i>
                          Prioridade:
                        </span>
                        <div class="h5">
                          <span class="text-lead text-uppercase text-<?= $color ?>">
                            <?= $task['prioridade'] ?>
                        </div>
                      </div>
                      <div class="col-3 text-primary">
                        <span class="text-lead">
                          <i class="fas fa-check mr-1"></i>
                          Finalizar Tarefa:
                        </span>
                        <div class="h5">
                          <span class="text-lead text-uppercase">
                            <?= $task['finalizada'] == 1
                              ? '<span class="text-success">SIM</span><i class="mdi mdi-checkbox-marked-circle-outline text-success"></i>'
                              : '<span class="text-danger">NÃo</span><i class="mdi mdi-close-circle-outline text-danger"></i>' ?>
                        </div>

                      </div>
                    </div>
                    </form>
                    <a href="" class="btn btn-outline-primary " target="" title="Adicionar Tarefas" rel="noopener noreferrer" data-toggle="modal" data-target="#modal-editTarefa">
                      <i class="mdi mdi-book-cog-outline mdi-24px align-middle"></i>
                      Editar Tarefa
                    </a>
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
          $sql = "SELECT * FROM processos INNER JOIN pessoa ON processos.idcliente = pessoa.idPessoa WHERE idprocesso = '$idProcess'";
          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
          foreach ($resultado as $dadoProcesso) {
          ?>
            <div class="row d-flex justify-content-between  ">
              <h4 class="col-11 text-primary text-justify">
                <i class="fas fa-balance-scale mx-1"> </i>-
                <?= $dadoProcesso['niprocesso'] . ' - ' . $dadoProcesso['objprocesso'] ?>
              </h4>
              <a href="" title="Editar Processo">
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
                    ATIVO
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

<!-- MODAL EDITAR TAREFA -->
<div class="modal fade" id="modal-editTarefa">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px;">Editar Tarefa&nbsp;
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- form novo Usuário -->
        <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="edtTarefa" value="edtTarefa">
          <input type="hidden" name="restingir" id="idTarefa" value="<?= $task['restingir']; ?>">
          <input type="hidden" name="idCreador" id="idCreador" value="<?= $task['idCreador']; ?>" />
          <input type="hidden" name="idProcesso" id="idProcesso" value="<?= $task['idProcesso'] ?>" />
          <input type="hidden" name="idpessoa" id="" value="<?= $task['idpessoa'] ?>" />

          <div class="form-row">
            <div class="col-md-12">
              <label for="idResponsavel">Responsavel
                <span class="text-orange">*</span>
              </label>

              <select class="form-control text-uppercase custom-select" name="idResponsavel" id="idResponsavel">
                <option value="" selected disabled>Selecione Responsavel </option>
                <?php

                $sql = "SELECT * FROM pessoa  WHERE idPessoa = '" . $task['idResponsavel'] . "'";
                $result = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $pessoa) {

                  switch ($pessoa['nivelUser']) {
                    case '1':
                      $nivel = 'Administrador';
                      break;
                    case '2':
                      $nivel = 'Secretário(a) / Atendente';
                      break;
                    case '3':
                      $nivel = 'Advogado(a) / Parceiro(a)';
                      break;
                  }

                  echo "<option value='" . $pessoa['idPessoa'] . "' selected>" . $pessoa['nmPessoa'] . ' - ' . $nivel . "</option>";
                }

                foreach (ler('vw_pessoa_user', '', "WHERE nivelUser > 0 and flStatusUser = 1 and idPessoaPessoa != '{$task['idResponsavel']}'")->fetchAll(PDO::FETCH_ASSOC) as $users) {
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
              <textarea class="form-control" name="decricaoTarefa" id="decricaoTarefa" placeholder="Decrição da tarefa" name="validation" rows="4" required>
              <?= $task['decricaoTarefa']; ?>
              </textarea>
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
              <input type="date" maxlength="19" name="dtTarefa" class="form-control text-uppercase" id="dtTarefa" placeholder="" value="<?= $task['dtTarefa']; ?>" required />
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2">
              <label for="hora">Hora da tarefa</label>
              <input type="time" maxlength="19" name="hora" class="form-control text-uppercase" id="hora" value="<?= $task['hora']; ?>">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-4">
              <label for="statusprocesso">Local do Compromisso</label>
              <input type="text" maxlength="19" name="local" class="form-control text-uppercase" id="local" placeholder="Local onde sera realizada a terefa" value="<?= $task['local']; ?>" />
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2">
              <label for="prioridade">Prioridade</label>
              <select class="form-control text-uppercase custom-select" name="prioridade" id="prioridade">
                <?php
                switch ($task['prioridade']) {
                  case 'baixa':
                    echo "<option value='baixa' class='text-success' selected>Baixa</option>";
                    echo "<option value='media' class='text-warning'>Média</option>";
                    echo "<option value='alta' class='text-danger'>Alta</option>";
                    break;
                  case 'media':
                    echo "<option value='baixa' class='text-success'>Baixa</option>";
                    echo "<option value='media' class='text-warning' selected>Média</option>";
                    echo "<option value='alta' class='text-danger'>Alta</option>";
                    break;
                  case 'alta':
                    echo "<option value='baixa' class='text-success'>Baixa</option>";
                    echo "<option value='media' class='text-warning'>Média</option>";
                    echo "<option value='alta' class='text-danger' selected>Alta</option>";
                    break;
                }
                ?>

                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </select>
            </div>
            <div class="col-md-1">
              <label for="checkboxDanger1" class="center">
                <?= $task['finalizada'] == 1 ? 'Finalizada' : 'Finalizar ?' ?>
              </label>
              <select class="form-control text-uppercase custom-select" name="finalizada" id="">
                <?php
                switch ($task['finalizada']) {
                  case '1':
                    echo "<option value='1' class='text-success' selected>SIM</option>";
                    echo "<option value='0' class='text-warning'>NÃO</option>";
                    break;
                  case '0':
                    echo "<option value='1' class='text-success'>SIM</option>";
                    echo "<option value='0' class='text-warning' selected>NÃO</option>";
                    break;
                }
                ?>

                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </select>

              <!--<div class="icheck-danger d-flex justify-content-center">
                <input type="checkbox" name="finalizada" <? //$task['finalizada'] == 1 ? 'checked' : ''
                                                          ?> id="checkboxDanger1">
                <label for="checkboxDanger1"></label>
              </div> -->
            </div>

          </div>
          <br />


      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="idcliente" value="<?= $id; ?>" />
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
        <input type="hidden" name="id_pessoa_cliente" id="" value="<?= $idClient; ?>" />

        <div class="form-row">
          <div class=" col-12">
            <label for="statusprocesso">Etapa
              <span class="text-orange">*</span>
            </label>
            <select class="form-control text-uppercase" required name="statusprocesso" id="statusprocesso">
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

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


</body>

</html>
