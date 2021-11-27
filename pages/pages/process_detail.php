<?php
$idProcess = $_GET['idprocess'];

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
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhamento do Processo</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=inicio">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=profileCliente&id=<?= $_GET["idcli"] ?>">Perfil do Usuarios</a></li>
          <li class="breadcrumb-item active">Project Detail</li>
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
        <a href="?page=profileCliente&id=<?= $_GET["idcli"] ?>" class="btn btn-tool text- d-print-none">
          <!-- <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i> -->
          <i class="mdi mdi-arrow-left-bold-circle-outline fa fa-2x align-middle "></i>
          Voltar ao Peril do Cliente
        </a>
        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button> -->
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
          <!-- info box -->
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
                    <h3>0000</h3>
                    <h6>...</h6>
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
                            <i class="fas fa-envelope bg-blue"></i>
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
                              <div class="timeline-body ">
                                <?= $row['descricao_historico'] ?>
                              </div>
                              <!-- Placement of additional controls. Optional -->
                              <div class="timeline-footer ">
                                <?php
                                if ($row['id_pessoa_responsavel'] == $_SESSION['ID'] || $_SESSION['NIVEL'] <= 1) {
                                ?>
                                  <a class="btn btn-primary btn-sm float-right" style="border-radius: 7px;">
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
          $sql = "SELECT * FROM processos INNER JOIN pessoa ON processos.idcliente = pessoa.idPessoa WHERE idprocesso = '$idProcess'";
          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
          foreach ($resultado as $dadoProcesso) {
          ?>
            <div class="row d-flex justify-content-between  ">
              <h4 class="col-11 text-primary text-justify">
                <i class="fas fa-balance-scale mx-1"> - </i>

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
                      default:
                        echo 'Aguardando Documento';
                        break;
                    };
                    ?>
                  </span>
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


<!-- MODAL NOVA HISTORICO -->
<div class="modal fade" id="modal-novoHistorico">
  <div class="modal-dialog modal-xl">
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
