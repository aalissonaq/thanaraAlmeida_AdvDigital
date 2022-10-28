<!-- Content Header (Page header) -->
<?php
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
$sql = "SELECT * FROM financial_release_installments WHERE  payday_installments BETWEEN '{$dateAtualStart}' AND '{$dateAtualEnd}' or competence = '{$mesAtual}' ";
$result = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as  $release) {
  switch ($release['is_paid']) {
    case 0:
      $totalAReceber += $release['installments_amount'];
      break;
    case 1:
      $totalRecebido += $release['installments_amount'];
      break;
    case 3:
      $totalRenegociado += $release['installments_amount'];
      break;
    default:
      // echo $release['installments_amount'] . "<br/>";
      // $c++;
      break;
  }
}
$totalMes = $totalRecebido + $totalAReceber;

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 " style="font-family:'Advent Pro', sans-serif; font-weight: 500; ">
          Lançamentos do mês de <?= $nomeMeses[$m - 1] . ' de ' . date("Y", time()); ?>
        </h1>
        <div class="d-none d-lg-block">
          <div class="col-12 my-2 d-flex justify-content-between btn-group btn-group-sm" role="group">
            <a href="?page=financialReleases&mes=<?= date('m', time()) ?>" class="btn btn-outline-primary">Mês Atual </a>
            <a href="?page=financialReleases&mes=1" class="btn btn-outline-primary">Jan</a>
            <a href="?page=financialReleases&mes=2" class="btn btn-outline-primary">Fev</a>
            <a href="?page=financialReleases&mes=3" class="btn btn-outline-primary">Mar</a>
            <a href="?page=financialReleases&mes=4" class="btn btn-outline-primary">Abr</a>
            <a href="?page=financialReleases&mes=5" class="btn btn-outline-primary">Mai</a>
            <a href="?page=financialReleases&mes=6" class="btn btn-outline-primary">Jun</a>
            <a href="?page=financialReleases&mes=6" class="btn btn-outline-primary">Jul</a>
            <a href="?page=financialReleases&mes=8" class="btn btn-outline-primary">Ago</a>
            <a href="?page=financialReleases&mes=9" class="btn btn-outline-primary">Set</a>
            <a href="?page=financialReleases&mes=10" class="btn btn-outline-primary">Out</a>
            <a href="?page=financialReleases&mes=11" class="btn btn-outline-primary">Nov</a>
            <a href="?page=financialReleases&mes=12" class="btn btn-outline-primary">Dez</a>
          </div>
        </div>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif;  letter-spacing:.06rem">
          <li class="breadcrumb-item"><a href="inicio.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Financeiro</a></li>
          <li class="breadcrumb-item active">Lançamentos</li>
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
              // $sql = "SELECT * FROM financial_release_installments WHERE competence = '{$mesAtual}' and is_paid = 1";
              // // $sql = "SELECT * FROM financial_release_installments WHERE due_date >= '{$initMonth}' AND due_date <='{$endMonth}'";
              // //$sql = "SELECT SUM(installments_amount) FROM financial_release_installments WHERE competence = '03/2022'";
              // $resultado = $conexao->query($sql);
              // $total = 0;
              // while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
              //   $total += $row->installments_amount;
              // }
              ?>

              <h3 class="text-success">
                <i class="mdi mdi-currency-brl"></i>
                <?= formatMoedaBr($totalRecebido) ?>
              </h3>
              <p>Total dos Valores Recebidos</p>
            </div>
            <div class="icon">
              <!-- <i class="fas fa-donate"></i> -->
              <i class="mdi mdi-cash-plus text-success"></i>
            </div>
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-4 col-md-4">
        <a class="nav-link" href="#todayTask" data-toggle="tab" onclick="window.getElementById('todayTask').classList.add(' active');">
          <div class="small-box bg-default">
            <div class="inner mx-3">
              <h3 class="text-danger">
                <i class="mdi mdi-currency-brl"></i>
                <?= formatMoedaBr($totalAReceber) ?>
              </h3>
              <p>Total de Valores Pendentes ou em Atraso</p>
            </div>
            <div class="icon">
              <!-- <i class="fas fa-donate"></i> -->
              <i class="mdi mdi-cash-minus text-danger"></i>
            </div>
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-4 col-md-4">
        <a class="nav-link" href="#allFinancelReleaseMonth" data-toggle="tab" onclick="window.getElementById('allFinancelReleaseMonth').classList.add(' active');">
          <div class="small-box bg-default">
            <div class="inner mx-3">
              <h3 class="text-info">
                <i class="mdi mdi-currency-brl"></i>
                <?= formatMoedaBr($totalMes) ?>
              </h3>
              <p>Total de previsto o mês</p>
            </div>
            <div class="icon">
              <!-- <i class="fas fa-donate"></i> -->
              <i class="mdi mdi-cash"></i>
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

      <div class="col-12">
        <div class="">
          <!-- <h4>Tarefas</h4> -->
          <ul class="nav nav-pills mt-3 mb-1">
            <li class="nav-item ">
              <a class="nav-link" href="#allFinancelReleaseMonth" data-toggle="tab">
                <i class="align-middle mdi mdi-calendar-multiple mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                <span class="align-middle">
                  Todos os Lançamentos
                </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="#todayTask" data-toggle="tab">
                <i class="align-middle mdi mdi-calendar-multiple mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                <span class="align-middle">
                  Lançamentos Atrasados
                </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="#todayTask" data-toggle="tab">
                <i class="align-middle mdi mdi-calendar-multiple mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                <span class="align-middle">
                  Lançamentos Futuros
                </span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#allTask" data-toggle="tab">
                <i class="align-middle mdi mdi-calendar-clock mdi-24px fa fa-fw"></i>&nbsp;&nbsp;
                <span class="align-middle">
                  Lançamentos Recebidos
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
                  <div class="tab-pane fade show active" id="allFinancelReleaseMonth" role="tabpanel" aria-labelledby="allFinancelReleaseMonth-tab">
                    <!-- Tarefas de hoje -->
                    <div class="table-responsive ">
                      <table id="tabela" class="table table-sm table-striped table-hover">
                        <thead class="" style="font-family: 'Advent Pro', sans-serif; font-weight: 100;">
                          <tr>
                            <th class="col-md-auto text-center align-middle ">Lançamentos</th>
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
                                    WHERE idResponsavel = {$_SESSION['ID']} ORDER BY dtTarefa ASC";
                          } else {
                            $sql = "SELECT * FROM tarefas
                                    INNER JOIN processos
                                    ON tarefas.idProcesso = processos.idprocesso
                                    INNER JOIN pessoa
                                    ON tarefas.idpessoa = pessoa.idPessoa
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
  document.getElementById('FinaceiroMenu').classList.add("menu-open");
  document.getElementById('FinaceiroMenuActive').classList.add("active");
  document.getElementById('LancamentosFinac').classList.add("active");
</script>
