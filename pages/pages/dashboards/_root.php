<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 " style="font-family:'Advent Pro', sans-serif; font-weight: 300; ">
          Painel</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif;  letter-spacing:.06rem">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->


    <div class="row">
      <div class="col-12 col-sm-4 col-md-4">
        <a class="nav-link" href="#todayTask" data-toggle="tab" onclick="window.getElementById('todayTask').classList.add(' active');">
          <div class="small-box bg-default">
            <div class="inner mx-3">
              <?php
              //$today = date("Y-m-d", time());
              if ($_SESSION['NIVEL'] >= 1) {
                $sql = "SELECT * FROM tarefas WHERE idResponsavel = {$_SESSION['ID']} AND dtTarefa =  CURDATE() AND finalizada = 0";
              } else {
                $sql = "SELECT * FROM tarefas WHERE dtTarefa =  CURDATE()";
              }
              $resultado = $conexao->query($sql);
              ?>

              <h3><?= str_pad($resultado->rowCount(), 3, "0", STR_PAD_LEFT); ?></h3>
              <p>Tarefas para hoje</p>
            </div>
            <div class="icon">
              <!-- <i class="far fa-clock"></i> -->
              <i class="mdi mdi-calendar-clock-outline "></i>
            </div>

          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-4 col-md-4">
        <a class="nav-link" href="#allTask" data-toggle="tab" onclick="window.getElementById('todayTask').classList.add(' active');">
          <div class="small-box bg-gradient-default">
            <div class="inner mx-3">
              <?php
              if ($_SESSION['NIVEL'] > 1) {
                $sql = "SELECT * FROM tarefas WHERE idResponsavel = {$_SESSION['ID']} AND finalizada = 0";
              } else {
                $sql = "SELECT * FROM tarefas WHERE finalizada = 0";
              }

              $resultado = $conexao->query($sql);
              ?>
              <h3><?= str_pad($resultado->rowCount(), 3, "0", STR_PAD_LEFT); ?></h3>
              <p>Tarefas pendentes</p>
            </div>
            <div class="icon ">
              <i class="mdi mdi-calendar-alert "></i>
            </div>

          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-4 col-md-4">
        <a class="nav-link" href="#allTask" data-toggle="tab" onclick="window.getElementById('todayTask').classList.add(' active');">
          <div class="small-box bg-gradient-default">
            <div class="inner mx-3">
              <?php
              if ($_SESSION['NIVEL'] > 1) {
                $sql = "SELECT * FROM tarefas WHERE idResponsavel = {$_SESSION['ID']} AND finalizada = 1";
              } else {
                $sql = "SELECT * FROM tarefas WHERE finalizada = 1";
              }
              $resultado = $conexao->query($sql);
              ?>
              <h3><?= str_pad($resultado->rowCount(), 3, "0", STR_PAD_LEFT); ?></h3>
              <p>Tarefas Concluidas</p>
            </div>
            <div class="icon ">
              <i class="mdi mdi-calendar-alert "></i>
            </div>
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>
      <!-- /.col -->
      <!-- /.col -->
      </a>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-12 col-sm-5 col-md-3">
        <div class="" id='calendar'></div>
      </div>
      <!-- /.col -->
      <div class="col-9">
        <div class="">
          <!-- <h4>Tarefas</h4> -->
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
                  Tarefas Agendadas
                </span>
              </a>
            </li>

            <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                </li> -->

          </ul>
        </div>
        <div class="card ">
          <div class="card-tools">
            <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button> -->
            <!-- <button type="button" class="btn btn-default float-right m-2 "><i class="fas fa-plus"></i> Nova Tarefa
            </button> -->

          </div>
          <!-- <div class="card-header">
            <h3 class="card-title"></h3>
          </div> -->
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">

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
                            <th class="col-md-2 text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($_SESSION['NIVEL'] > 1) {
                            $sql = "SELECT * FROM tarefas
                                    INNER JOIN processos
                                    ON tarefas.idProcesso = processos.idprocesso
                                    INNER JOIN pessoa
                                    ON tarefas.idpessoa = pessoa.idPessoa
                                    WHERE idResponsavel = {$_SESSION['ID']} AND (dtTarefa = CURDATE() OR dtTarefa < CURDATE()) AND finalizada = 0
                                    ORDER BY dtTarefa ASC";
                          } else {
                            $sql = "SELECT * FROM tarefas
                                    INNER JOIN processos
                                    ON tarefas.idProcesso = processos.idprocesso
                                    INNER JOIN pessoa
                                    ON tarefas.idpessoa = pessoa.idPessoa
                                    WHERE (dtTarefa = CURDATE() OR dtTarefa < CURDATE()) AND finalizada = 0
                                    ORDER BY dtTarefa ASC";
                          }
                          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                          $count = 1;
                          foreach ($resultado as $task) {
                          ?>
                            <tr scope="row" class="" <?= $task['finalizada'] == '1' ? $colorBG = '#c6e5b1' : '' ?> style="background-color: <?= $colorBG ?>;">

                              <td class="text-uppercase align-middle" style="font-size: .75rem; ">
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
                                    <div class="d-flex justify-content-around">
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Parte:&nbsp;</strong><?= lmWord($task['nmPessoa'], 70); ?>
                                      </div>|&nbsp;
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Contra-Parte:&nbsp;</strong><?= lmWord($task['contraparte'], 70); ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td class="text-uppercase align-middle text-center" style="font-weight: 300;">
                                <?php
                                $today = date("Y-m-d", time());
                                if ($task['dtTarefa'] == $today) {
                                  echo "<span class='badge badge-pill badge-warning px-4 py-1'>Hoje</span>";
                                } else {
                                  echo "<span class='badge badge-pill badge-danger px-2 py-1'>Atrasada</span>";
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
                                    <a href="?page=profileCliente&id=<?= $task['idPessoa'] ?>" class="btn btn-tool" target="" title="Perfil de Usúario" rel="noopener noreferrer">
                                      <i class="mdi mdi-account-arrow-right mdi-24px "></i>
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
                  <div class="tab-pane fade" id="allTask" role="tabpanel" aria-labelledby="allTask-tab">
                    <!-- Todas as Tarefas  -->
                    <div class="table-responsive col-12">
                      <table id="tabela" class="table table-sm table-striped table-hover">
                        <thead class="" style="font-weight: 300; font-family: 'Advent Pro', sans-serif;">
                          <tr>
                            <th class="col-auto text-center align-middle">Tarefa</th>
                            <th class="col-2 text-center align-middle">status</th>
                            <th class="col-2 text-center align-middle">Responsável</th>
                            <th class="col-1 text-center align-middle">Data e Hora</th>
                            <th class="col-1 text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($_SESSION['NIVEL'] > 1) {
                            $sql = "SELECT * FROM tarefas
                                  INNER JOIN processos
                                  ON tarefas.idProcesso = processos.idprocesso
                                  INNER JOIN pessoa
                                  ON tarefas.idpessoa = pessoa.idPessoa
                                  WHERE idResponsavel = {$_SESSION['ID']}
                                  AND finalizada != 1
                                  AND  dtTarefa > CURDATE()
                                  ORDER BY dtTarefa ASC";
                          } else {
                            $sql = "SELECT * FROM tarefas
                                  INNER JOIN processos
                                  ON tarefas.idProcesso = processos.idprocesso
                                  INNER JOIN pessoa
                                  ON tarefas.idpessoa = pessoa.idPessoa
                                  WHERE finalizada != 1
                                  AND  dtTarefa > CURDATE()
                                  ORDER BY dtTarefa ASC";
                          }
                          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                          $count = 1;
                          foreach ($resultado as $task) {

                          ?>
                            <tr scope="row" class="" <?= $task['finalizada'] == '1' ? $colorBG = '#c6e5b1' : $colorBG = '' ?> style="background-color: <?= $colorBG ?>;">

                              <td class="text-uppercase align-middle" style="font-size: .75rem; ">
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
                                    <div class="d-flex justify-content-around">
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Parte:&nbsp;</strong><?= lmWord($task['nmPessoa'], 70); ?>
                                      </div>|&nbsp;
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Contra-Parte:&nbsp;</strong><?= lmWord($task['contraparte'], 70); ?>
                                      </div>
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
                                    Finalizada em:<br/>
                                    </small>" . date('d/m/Y', strtotime($task['dtFinalizacao'])) . " AS " . date('H:i', strtotime($task['dtFinalizacao'])) . "";
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

                </div>
                <!-- ./chart-responsive -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>


      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!--/. container-fluid -->
</section>
<!-- /.content -->



<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js" >

</script> -->



<script>
  document.getElementById('inicio').classList.add("active");
</script>
