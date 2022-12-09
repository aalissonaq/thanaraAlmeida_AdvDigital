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

if (isset($_POST['active']) && $_POST['active'] == 'payment') {
  $_POST['is_paid'] == 0 ? $_POST['payday_installments'] = '' : '';
  $sql = "UPDATE financial_release_installments SET payday_installments = '{$_POST['payday_installments']}', is_paid = '{$_POST['is_paid']}' WHERE id = '{$_POST['idInstallment']}'";
  if ($conexao->exec($sql)) {
    echo '<script>alert(" Atualização  realizada com Sucesso"); </script>';
  } else {
    echo '<script>alert("Erro na Atualização"); </script>';
  }
}

$totalMes = $totalRecebido + $totalAReceber;

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 " style="font-family:'Advent Pro', sans-serif; font-weight: 500; ">
          Receitas do mês de <?= $nomeMeses[$m - 1] . ' de ' . date("Y", time()); ?>
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
            <a href="?page=financialReleases&mes=7" class="btn btn-outline-primary">Jul</a>
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
          <li class="breadcrumb-item active">Receitas</li>
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
              <p>Total Recebidos no mês</p>
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
              <p>Total em Aberto no mês</p>
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
              <p>Total de previsto para o mês</p>
            </div>
            <div class="icon">
              <!-- <i class="fas fa-donate"></i> -->
              <i class="mdi mdi-cash-clock"></i>
            </div>

          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <!-- <div class="col-12 col-sm-3 col-md-3">
        <a class="nav-link" href="#allFinancelReleaseMonth" data-toggle="tab" onclick="window.getElementById('allFinancelReleaseMonth').classList.add(' active');">
          <div class="small-box bg-default">
            <div class="inner mx-3">
              <h3 class="text-orange">
                <i class="mdi mdi-currency-brl"></i>
                <? formatMoedaBr($totalMes) ?>
              </h3>
              <p>Total de previsto o mês</p>
            </div>
            <div class="icon">
              <i class="mdi mdi-cash-refund text-orange"></i>
            </div>

          </div>
        </a>
      </div> -->
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
        <!-- links tab -->
        <div class="">
          <!-- <h4>Tarefas</h4> -->
          <ul class="nav nav-pills mt-3 mb-1">
            <li class="nav-item ">
              <a class="nav-link" href="#allFinancelReleaseMonth" data-toggle="tab">
                <i class="align-middle mdi mdi-calendar-multiselect mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                <span class="align-middle">
                  Todos os Lançamentos
                </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="#delayed" data-toggle="tab">
                <i class="align-middle mdi mdi-calendar-filter mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                <span class="align-middle">
                  Lançamentos em Atraso
                </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="#pending" data-toggle="tab">
                <i class="align-middle mdi mdi-calendar-filter mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                <span class="align-middle">
                  Lançamentos Pendentes
                </span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#received" data-toggle="tab">
                <i class="align-middle mdi mdi-calendar-weekend mdi-24px fa fa-fw"></i>&nbsp;&nbsp;
                <span class="align-middle">
                  Lançamentos Recebidos
                </span>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#received" data-toggle="tab">
                <i class="align-middle mdi mdi-cash-minus  fa fa-2x fa-fw"></i>&nbsp;
                <span class="align-middle">
                  Despesas
                </span>
              </a>
            </li> -->
            <li class="nav-item">

              <a class="nav-link" href="pdfs/viewRevenueReport.php?mes=<?= isset($_GET['mes']) ? $_GET['mes'] : $mr = date("m", time()); ?>" target="_new">
                <i class="align-middle mdi mdi-printer mdi-24px fa fa-fw"></i>&nbsp;&nbsp;
                <span class="align-middle">
                  Imprimir Relatório Mês de <?= $nomeMeses[$m - 1] . ' de ' . date("Y", time()); ?>
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
                            <th class="col-md-4 text-center align-middle text-uppercase ">Lançamentos</th>
                            <th class="col-md-1 text-center align-middle text-uppercase ">status</th>
                            <th class="col-md-1 text-center align-middle text-uppercase ">Pagamento agandado para</th>
                            <!-- <th class="col-md-1 text-center align-middle text-uppercase  ">Data e Hora</th> -->
                            <th class="col-md-2 text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          isset($_GET['mes']) ? $mr = $mes . '/' . date("Y") : $mr = date("m/Y", time());
                          if ($_SESSION['NIVEL'] > 1) {
                            $sql = "SELECT * FROM financial_release as fr
                                    INNER JOIN financial_release_installments AS fri ON fri.id_financial_release = fr.id
                                    INNER JOIN processos AS p ON fr.id_process = p.idprocesso
                                    INNER JOIN pessoa as pers on pers.idPessoa = p.idcliente
                                    INNER JOIN clientes AS cli ON cli.idPessoa = pers.idPessoa
                                    WHERE idResponsavel = {$_SESSION['ID']} AND fri.competence = '{$mr}' AND is_paid <'3'
                                    ORDER BY fri.due_date ASC";
                          } else {
                            $sql = "SELECT * FROM financial_release as fr
                                    INNER JOIN financial_release_installments AS fri ON fri.id_financial_release = fr.id
                                    INNER JOIN processos AS p ON fr.id_process = p.idprocesso
                                    INNER JOIN pessoa as pers on pers.idPessoa = p.idcliente
                                    INNER JOIN clientes AS cli ON cli.idPessoa = pers.idPessoa
                                    WHERE (fri.competence = '{$mr}') AND is_paid <'3'
                                    ORDER BY fri.due_date ASC";
                          }
                          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                          $count = 1;
                          foreach ($resultado as $financialRelease) {
                          ?>
                            <? $financialRelease['is_paid'] == '1' ? $colorBG = '#c6e5b1' : '' ?>
                            <tr scope="row" class="">
                              <td class="text-uppercase align-middle" style="font-size: .75rem; ">
                                <div class="d-flex align-items-center">
                                  <div class="d-flex flex-column">
                                    <div class="text-muted">
                                      <strong class="text-primary">Cliente:&nbsp;</strong><?= $financialRelease['nmPessoa']; ?>
                                    </div>
                                    <div class="text-muted">
                                      <strong class="text-primary">Processo:&nbsp;</strong><?= $financialRelease['niprocesso'] . ' - ' .  $financialRelease['objprocesso']; ?>
                                    </div>
                                    <div class="text-muted">
                                      <strong class="text-primary">Valor da da Parcela:&nbsp;</strong> R$<?= formatMoedaBr($financialRelease['installments_amount']); ?>
                                    </div>
                                    <!-- <div class="d-flex justify-content-around">
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Parte:&nbsp;</strong><?= lmWord($financialRelease['nmPessoa'], 70); ?>
                                      </div>|&nbsp;
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Contra-Parte:&nbsp;</strong><?= lmWord($financialRelease['contraparte'], 70); ?>
                                      </div>
                                    </div> -->
                                  </div>
                                </div>
                              </td>
                              <td class="text-uppercase align-middle text-center" style="font-weight: 300;">
                                <?php
                                $today = date("Y-m-d", time());
                                if ($financialRelease['is_paid'] === 1) { ?>
                                  <span class="badge badge-success " style='font-size: 0.9rem; padding:<?= $padding ?>; font-weight: 400; letter-spacing: 0.2em; line-height: 16px; width: 100%;'>
                                  <?php
                                  echo "Pago em <br/>";
                                  echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                } else { ?>

                                    <?php
                                    if ($financialRelease['is_paid'] == '0'  && $financialRelease['due_date'] >= date('Y-m-d', time())) {
                                      $colorStatus = 'warning';
                                      $padding = '1rem';
                                    } elseif ($financialRelease['is_paid'] == '0' && $financialRelease['due_date'] < date('Y-m-d', time())) {
                                      $colorStatus = 'danger';
                                      $padding = '1rem';
                                    } elseif ($financialRelease['is_paid'] == '3') {
                                      $colorStatus = 'info';
                                      $padding = '0.5rem';
                                    } else {
                                      $colorStatus = 'success';
                                      $padding = '0.5rem';
                                    }
                                    ?>
                                    <a href="" class="p-1" data-toggle="modal" data-target="#modal-payment" onclick="setarDadosModalProcesso(<?= $financialRelease['id'] ?>)">
                                      <span class="badge badge-<?= $colorStatus ?> " style='font-size: 0.9rem; padding:<?= $padding ?>; font-weight: 400; letter-spacing: 0.2em; line-height: 16px; width: 100%;'>
                                        <?php
                                        if ($financialRelease['is_paid'] == '0'  && $financialRelease['due_date'] >= date('Y-m-d', time())) {
                                          echo "Pendente";
                                        } elseif ($financialRelease['is_paid'] == '0' && $financialRelease['due_date'] < date('Y-m-d', time())) {
                                          echo "Atrasado";
                                        } elseif ($financialRelease['is_paid'] == '3') {
                                          echo "Renegociado em <br/>";
                                          echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                        } else {
                                          echo "Pago em <br/>";
                                          echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                        }
                                        ?>
                                        <? $financialRelease['is_paid'] == '0' ? 'Pendente' : 'Pago' ?>

                                      </span>
                                      </ <?php } ?> <?php
                                                    // } elseif ($financialRelease['is_paid'] == 3) {
                                                    // echo 'Renegociando em ' . $financialRelease['payday_installments'];
                                                    // }

                                                    // if ($financialRelease['dtTarefa'] == $today) {
                                                    // echo "<span class='badge badge-pill badge-warning px-4 py-1'>Hoje</span>";
                                                    // } else {
                                                    // echo "<span class='badge badge-pill badge-danger px-2 py-1'>Atrasada</span>";
                                                    // }
                                                    ?> </td>

                              <td class=" text-uppercase align-middle text-center" style="font-size: .8rem; ">
                                <?php
                                echo date('d/m/Y', strtotime($financialRelease['due_date']));

                                // if ($financialRelease['is_paid'] != '0') {
                                //   echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                //   // var_dump($financialRelease['fri']['due_date']);
                                // } else {
                                //   echo date('d/m/Y', strtotime($financialRelease['due_date']));
                                // }
                                // $sql = "SELECT * FROM pessoa WHERE idPessoa = '" . $financialRelease['idResponsavel'] . "'";
                                // $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                                // foreach ($resultado as $pessoa) {
                                //   echo $pessoa['nmPessoa'];
                                // }
                                ?>
                              </td>
                              <!-- <td class="text-uppercase align-middle text-center">
                                <?php
                                // echo date('d/m/Y', strtotime($financialRelease['dtTarefa']));
                                // echo " AS ";
                                // echo date('H:i', strtotime($financialRelease['hora']));
                                ?>
                              </td> -->
                              <td class="text-uppercase align-middle ">

                                <ul class="nav justify-content-center d-flex justify-content-evenly">
                                  <li class="nav-item">
                                    <button class="btn btn-tool" target="" title="Receber pagamento" rel="noopener noreferrer" data-toggle="modal" data-target="#modal-payment" onclick="setarDadosModalProcesso(<?= $financialRelease['id'] ?>)">
                                      <!-- <i class="mdi mdi-file-edit-outline mdi-24px "></i> -->
                                      <i class="fa-sharp fa-solid fa-hand-holding-dollar fa-2x"></i>
                                    </button>

                                    <a href="?page=financial&id=<?= $financialRelease['idcliente'] ?>&process=<?= $financialRelease['idprocesso'] ?>" class="btn btn-tool" target="" title="Ir para Lançamento do Usúario" rel="noopener noreferrer">
                                      <i class="mdi mdi-account-arrow-right fa-2x"></i>
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
                  <div class="tab-pane fade show " id="delayed" role="tabpanel" aria-labelledby="allFinancelReleaseMonth-tab">
                    <!-- Tarefas de hoje -->
                    <div class="table-responsive ">
                      <table id="tabela" class="table table-sm table-striped table-hover">
                        <thead class="" style="font-family: 'Advent Pro', sans-serif; font-weight: 100;">
                          <tr>
                            <th class="col-md-4 text-center align-middle text-uppercase ">Lançamentos</th>
                            <th class="col-md-1 text-center align-middle text-uppercase ">status</th>
                            <th class="col-md-1 text-center align-middle text-uppercase ">Pagamento agandado para</th>
                            <!-- <th class="col-md-1 text-center align-middle text-uppercase  ">Data e Hora</th> -->
                            <th class="col-md-2 text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          isset($_GET['mes']) ? $mr = $mes . '/' . date("Y") : $mr = date("m/Y", time());
                          if ($_SESSION['NIVEL'] > 1) {
                            $sql = "SELECT * FROM financial_release as fr
                                    INNER JOIN financial_release_installments AS fri ON fri.id_financial_release = fr.id
                                    INNER JOIN processos AS p ON fr.id_process = p.idprocesso
                                    INNER JOIN pessoa as pers on pers.idPessoa = p.idcliente
                                    INNER JOIN clientes AS cli ON cli.idPessoa = pers.idPessoa
                                    WHERE idResponsavel = {$_SESSION['ID']} AND fri.competence = '{$mr}' AND is_paid ='0' AND fri.due_date < CURDATE()
                                    ORDER BY fri.due_date ASC";
                          } else {
                            $sql = "SELECT * FROM financial_release as fr
                                    INNER JOIN financial_release_installments AS fri ON fri.id_financial_release = fr.id
                                    INNER JOIN processos AS p ON fr.id_process = p.idprocesso
                                    INNER JOIN pessoa as pers on pers.idPessoa = p.idcliente
                                    INNER JOIN clientes AS cli ON cli.idPessoa = pers.idPessoa
                                    WHERE (fri.competence = '{$mr}') AND is_paid ='0' AND fri.due_date < CURDATE()
                                    ORDER BY fri.due_date ASC";
                          }
                          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                          $count = 1;
                          foreach ($resultado as $financialRelease) {
                          ?>
                            <? $financialRelease['is_paid'] == '1' ? $colorBG = '#c6e5b1' : '' ?>
                            <tr scope="row" class="">
                              <td class="text-uppercase align-middle" style="font-size: .75rem; ">
                                <div class="d-flex align-items-center">
                                  <div class="d-flex flex-column">
                                    <div class="text-muted">
                                      <strong class="text-primary">Cliente:&nbsp;</strong><?= $financialRelease['nmPessoa']; ?>
                                    </div>
                                    <div class="text-muted">
                                      <strong class="text-primary">Processo:&nbsp;</strong><?= $financialRelease['niprocesso'] . ' - ' .  $financialRelease['objprocesso']; ?>
                                    </div>
                                    <div class="text-muted">
                                      <strong class="text-primary">Valor da da Parcela:&nbsp;</strong> R$<?= formatMoedaBr($financialRelease['installments_amount']); ?>
                                    </div>
                                    <!-- <div class="d-flex justify-content-around">
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Parte:&nbsp;</strong><?= lmWord($financialRelease['nmPessoa'], 70); ?>
                                      </div>|&nbsp;
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Contra-Parte:&nbsp;</strong><?= lmWord($financialRelease['contraparte'], 70); ?>
                                      </div>
                                    </div> -->
                                  </div>
                                </div>
                              </td>
                              <td class="text-uppercase align-middle text-center" style="font-weight: 300;">
                                <?php
                                $today = date("Y-m-d", time());


                                if ($financialRelease['is_paid'] === 1) { ?>
                                  <span class="badge badge-success " style='font-size: 0.9rem; padding:<?= $padding ?>; font-weight: 400; letter-spacing: 0.2em; line-height: 16px; width: 100%;'>
                                  <?php
                                  echo "Pago em <br/>";
                                  echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                } else { ?>

                                    <?php
                                    if ($financialRelease['is_paid'] == '0'  && $financialRelease['due_date'] >= date('Y-m-d', time())) {
                                      $colorStatus = 'warning';
                                      $padding = '1rem';
                                    } elseif ($financialRelease['is_paid'] == '0' && $financialRelease['due_date'] < date('Y-m-d', time())) {
                                      $colorStatus = 'danger';
                                      $padding = '1rem';
                                    } elseif ($financialRelease['is_paid'] == '3') {
                                      $colorStatus = 'info';
                                      $padding = '0.5rem';
                                    } else {
                                      $colorStatus = 'success';
                                      $padding = '0.5rem';
                                    }
                                    ?>

                                    <span class="badge badge-<?= $colorStatus ?> " style='font-size: 0.9rem; padding:<?= $padding ?>; font-weight: 400; letter-spacing: 0.2em; line-height: 16px; width: 100%;'>
                                      <?php
                                      if ($financialRelease['is_paid'] == '0'  && $financialRelease['due_date'] >= date('Y-m-d', time())) {
                                        echo "Pendente";
                                      } elseif ($financialRelease['is_paid'] == '0' && $financialRelease['due_date'] < date('Y-m-d', time())) {
                                        echo "Atrasado";
                                      } elseif ($financialRelease['is_paid'] == '3') {
                                        echo "Renegociado em <br/>";
                                        echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                      } else {
                                        echo "Pago em <br/>";
                                        echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                      }
                                      ?>
                                      <? $financialRelease['is_paid'] == '0' ? 'Pendente' : 'Pago' ?>

                                    </span>
                                  <?php } ?>

                                  <?php
                                  // } elseif ($financialRelease['is_paid'] == 3) {
                                  // echo 'Renegociando em ' . $financialRelease['payday_installments'];
                                  // }

                                  // if ($financialRelease['dtTarefa'] == $today) {
                                  // echo "<span class='badge badge-pill badge-warning px-4 py-1'>Hoje</span>";
                                  // } else {
                                  // echo "<span class='badge badge-pill badge-danger px-2 py-1'>Atrasada</span>";
                                  // }
                                  ?>
                              </td>

                              <td class=" text-uppercase align-middle text-center" style="font-size: .8rem; ">
                                <?php
                                echo date('d/m/Y', strtotime($financialRelease['due_date']));

                                // if ($financialRelease['is_paid'] != '0') {
                                //   echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                //   // var_dump($financialRelease['fri']['due_date']);
                                // } else {
                                //   echo date('d/m/Y', strtotime($financialRelease['due_date']));
                                // }
                                // $sql = "SELECT * FROM pessoa WHERE idPessoa = '" . $financialRelease['idResponsavel'] . "'";
                                // $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                                // foreach ($resultado as $pessoa) {
                                //   echo $pessoa['nmPessoa'];
                                // }
                                ?>
                              </td>
                              <!-- <td class="text-uppercase align-middle text-center">
                                <?php
                                // echo date('d/m/Y', strtotime($financialRelease['dtTarefa']));
                                // echo " AS ";
                                // echo date('H:i', strtotime($financialRelease['hora']));
                                ?>
                              </td> -->
                              <td class="text-uppercase align-middle ">

                                <ul class="nav justify-content-center d-flex justify-content-evenly">
                                  <li class="nav-item">
                                    <button class="btn btn-tool" target="" title="Receber pagamento" rel="noopener noreferrer" data-toggle="modal" data-target="#modal-payment" onclick="setarDadosModalProcesso(<?= $financialRelease['id'] ?>)">
                                      <!-- <i class="mdi mdi-file-edit-outline mdi-24px "></i> -->
                                      <i class="fa-sharp fa-solid fa-hand-holding-dollar fa-2x"></i>
                                    </button>
                                    <a href="?page=financial&id=<?= $financialRelease['idcliente'] ?>&process=<?= $financialRelease['idprocesso'] ?>" class="btn btn-tool" target="" title="Ir para Lançamento do Usúario" rel="noopener noreferrer">
                                      <i class="mdi mdi-account-arrow-right fa-2x"></i>
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
                  <div class="tab-pane fade show " id="pending" role="tabpanel" aria-labelledby="allFinancelReleaseMonth-tab">
                    <!-- Tarefas de hoje -->
                    <div class="table-responsive ">
                      <table id="tabela" class="table table-sm table-striped table-hover">
                        <thead class="" style="font-family: 'Advent Pro', sans-serif; font-weight: 100;">
                          <tr>
                            <th class="col-md-4 text-center align-middle text-uppercase ">Lançamentos</th>
                            <th class="col-md-1 text-center align-middle text-uppercase ">status</th>
                            <th class="col-md-1 text-center align-middle text-uppercase ">Pagamento agandado para</th>
                            <!-- <th class="col-md-1 text-center align-middle text-uppercase  ">Data e Hora</th> -->
                            <th class="col-md-2 text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          isset($_GET['mes']) ? $mr = $mes . '/' . date("Y") : $mr = date("m/Y", time());
                          if ($_SESSION['NIVEL'] > 1) {
                            $sql = "SELECT * FROM financial_release as fr
                                    INNER JOIN financial_release_installments AS fri ON fri.id_financial_release = fr.id
                                    INNER JOIN processos AS p ON fr.id_process = p.idprocesso
                                    INNER JOIN pessoa as pers on pers.idPessoa = p.idcliente
                                    INNER JOIN clientes AS cli ON cli.idPessoa = pers.idPessoa
                                    WHERE idResponsavel = {$_SESSION['ID']} AND fri.competence = '{$mr}' AND is_paid ='0' AND fri.due_date >= CURDATE()
                                    ORDER BY fri.due_date ASC";
                          } else {
                            $sql = "SELECT * FROM financial_release as fr
                                    INNER JOIN financial_release_installments AS fri ON fri.id_financial_release = fr.id
                                    INNER JOIN processos AS p ON fr.id_process = p.idprocesso
                                    INNER JOIN pessoa as pers on pers.idPessoa = p.idcliente
                                    INNER JOIN clientes AS cli ON cli.idPessoa = pers.idPessoa
                                    WHERE (fri.competence = '{$mr}') AND is_paid ='0' AND fri.due_date >= CURDATE()
                                    ORDER BY fri.due_date ASC";
                          }
                          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                          $count = 1;
                          foreach ($resultado as $financialRelease) {
                          ?>
                            <? $financialRelease['is_paid'] == '1' ? $colorBG = '#c6e5b1' : '' ?>
                            <tr scope="row" class="">
                              <td class="text-uppercase align-middle" style="font-size: .75rem; ">
                                <div class="d-flex align-items-center">
                                  <div class="d-flex flex-column">
                                    <div class="text-muted">
                                      <strong class="text-primary">Cliente:&nbsp;</strong><?= $financialRelease['nmPessoa']; ?>
                                    </div>
                                    <div class="text-muted">
                                      <strong class="text-primary">Processo:&nbsp;</strong><?= $financialRelease['niprocesso'] . ' - ' .  $financialRelease['objprocesso']; ?>
                                    </div>
                                    <div class="text-muted">
                                      <strong class="text-primary">Valor da da Parcela:&nbsp;</strong> R$<?= formatMoedaBr($financialRelease['installments_amount']); ?>
                                    </div>
                                    <!-- <div class="d-flex justify-content-around">
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Parte:&nbsp;</strong><?= lmWord($financialRelease['nmPessoa'], 70); ?>
                                      </div>|&nbsp;
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Contra-Parte:&nbsp;</strong><?= lmWord($financialRelease['contraparte'], 70); ?>
                                      </div>
                                    </div> -->
                                  </div>
                                </div>
                              </td>
                              <td class="text-uppercase align-middle text-center" style="font-weight: 300;">
                                <?php
                                $today = date("Y-m-d", time());
                                if ($financialRelease['is_paid'] === 1) { ?>
                                  <span class="badge badge-success " style='font-size: 0.9rem; padding:<?= $padding ?>; font-weight: 400; letter-spacing: 0.2em; line-height: 16px; width: 100%;'>
                                  <?php
                                  echo "Pago em <br/>";
                                  echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                } else { ?>

                                    <?php
                                    if ($financialRelease['is_paid'] == '0'  && $financialRelease['due_date'] >= date('Y-m-d', time())) {
                                      $colorStatus = 'warning';
                                      $padding = '1rem';
                                    } elseif ($financialRelease['is_paid'] == '0' && $financialRelease['due_date'] < date('Y-m-d', time())) {
                                      $colorStatus = 'danger';
                                      $padding = '1rem';
                                    } elseif ($financialRelease['is_paid'] == '3') {
                                      $colorStatus = 'info';
                                      $padding = '0.5rem';
                                    } else {
                                      $colorStatus = 'success';
                                      $padding = '0.5rem';
                                    }
                                    ?>

                                    <span class="badge badge-<?= $colorStatus ?> " style='font-size: 0.9rem; padding:<?= $padding ?>; font-weight: 400; letter-spacing: 0.2em; line-height: 16px; width: 100%;'>
                                      <?php
                                      if ($financialRelease['is_paid'] == '0'  && $financialRelease['due_date'] >= date('Y-m-d', time())) {
                                        echo "Pendente";
                                      } elseif ($financialRelease['is_paid'] == '0' && $financialRelease['due_date'] < date('Y-m-d', time())) {
                                        echo "Atrasado";
                                      } elseif ($financialRelease['is_paid'] == '3') {
                                        echo "Renegociado em <br/>";
                                        echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                      } else {
                                        echo "Pago em <br/>";
                                        echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                      }
                                      ?>
                                      <? $financialRelease['is_paid'] == '0' ? 'Pendente' : 'Pago' ?>

                                    </span>
                                  <?php } ?>

                                  <?php
                                  // } elseif ($financialRelease['is_paid'] == 3) {
                                  // echo 'Renegociando em ' . $financialRelease['payday_installments'];
                                  // }

                                  // if ($financialRelease['dtTarefa'] == $today) {
                                  // echo "<span class='badge badge-pill badge-warning px-4 py-1'>Hoje</span>";
                                  // } else {
                                  // echo "<span class='badge badge-pill badge-danger px-2 py-1'>Atrasada</span>";
                                  // }
                                  ?>
                              </td>

                              <td class=" text-uppercase align-middle text-center" style="font-size: .8rem; ">
                                <?php
                                echo date('d/m/Y', strtotime($financialRelease['due_date']));

                                // if ($financialRelease['is_paid'] != '0') {
                                //   echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                //   // var_dump($financialRelease['fri']['due_date']);
                                // } else {
                                //   echo date('d/m/Y', strtotime($financialRelease['due_date']));
                                // }
                                // $sql = "SELECT * FROM pessoa WHERE idPessoa = '" . $financialRelease['idResponsavel'] . "'";
                                // $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                                // foreach ($resultado as $pessoa) {
                                //   echo $pessoa['nmPessoa'];
                                // }
                                ?>
                              </td>
                              <!-- <td class="text-uppercase align-middle text-center">
                                <?php
                                // echo date('d/m/Y', strtotime($financialRelease['dtTarefa']));
                                // echo " AS ";
                                // echo date('H:i', strtotime($financialRelease['hora']));
                                ?>
                              </td> -->
                              <td class="text-uppercase align-middle ">

                                <ul class="nav justify-content-center d-flex justify-content-evenly">
                                  <li class="nav-item">
                                    <button class="btn btn-tool" target="" title="Receber pagamento" rel="noopener noreferrer" data-toggle="modal" data-target="#modal-payment" onclick="setarDadosModalProcesso(<?= $financialRelease['id'] ?>)">
                                      <!-- <i class="mdi mdi-file-edit-outline mdi-24px "></i> -->
                                      <i class="fa-sharp fa-solid fa-hand-holding-dollar fa-2x"></i>
                                    </button>
                                    <a href="?page=financial&id=<?= $financialRelease['idcliente'] ?>&process=<?= $financialRelease['idprocesso'] ?>" class="btn btn-tool" target="" title="Ir para Lançamento do Usúario" rel="noopener noreferrer">
                                      <i class="mdi mdi-account-arrow-right fa-2x"></i>
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
                  <div class="tab-pane fade show " id="received" role="tabpanel" aria-labelledby="allFinancelReleaseMonth-tab">
                    <!-- Tarefas de hoje -->
                    <div class="table-responsive ">
                      <table id="tabela" class="table table-sm table-striped table-hover">
                        <thead class="" style="font-family: 'Advent Pro', sans-serif; font-weight: 100;">
                          <tr>
                            <th class="col-md-4 text-center align-middle text-uppercase ">Lançamentos</th>
                            <th class="col-md-1 text-center align-middle text-uppercase ">status</th>
                            <th class="col-md-1 text-center align-middle text-uppercase ">Pagamento agandado para</th>
                            <!-- <th class="col-md-1 text-center align-middle text-uppercase  ">Data e Hora</th> -->
                            <th class="col-md-2 text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          isset($_GET['mes']) ? $mr = $mes . '/' . date("Y") : $mr = date("m/Y", time());
                          if ($_SESSION['NIVEL'] > 1) {
                            $sql = "SELECT * FROM financial_release as fr
                                    INNER JOIN financial_release_installments AS fri ON fri.id_financial_release = fr.id
                                    INNER JOIN processos AS p ON fr.id_process = p.idprocesso
                                    INNER JOIN pessoa as pers on pers.idPessoa = p.idcliente
                                    INNER JOIN clientes AS cli ON cli.idPessoa = pers.idPessoa
                                    WHERE idResponsavel = {$_SESSION['ID']} AND fri.competence = '{$mr}' AND is_paid ='1'
                                    ORDER BY fri.due_date ASC";
                          } else {
                            $sql = "SELECT * FROM financial_release as fr
                                    INNER JOIN financial_release_installments AS fri ON fri.id_financial_release = fr.id
                                    INNER JOIN processos AS p ON fr.id_process = p.idprocesso
                                    INNER JOIN pessoa as pers on pers.idPessoa = p.idcliente
                                    INNER JOIN clientes AS cli ON cli.idPessoa = pers.idPessoa
                                    WHERE (fri.competence = '{$mr}') AND is_paid ='1'
                                    ORDER BY fri.due_date ASC";;
                          }
                          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                          $count = 1;
                          foreach ($resultado as $financialRelease) {
                          ?>
                            <? $financialRelease['is_paid'] == '1' ? $colorBG = '#c6e5b1' : '' ?>
                            <tr scope="row" class="">
                              <td class="text-uppercase align-middle" style="font-size: .75rem; ">
                                <div class="d-flex align-items-center">
                                  <div class="d-flex flex-column">
                                    <div class="text-muted">
                                      <strong class="text-primary">Cliente:&nbsp;</strong><?= $financialRelease['nmPessoa']; ?>
                                    </div>
                                    <div class="text-muted">
                                      <strong class="text-primary">Processo:&nbsp;</strong><?= $financialRelease['niprocesso'] . ' - ' .  $financialRelease['objprocesso']; ?>
                                    </div>
                                    <div class="text-muted">
                                      <strong class="text-primary">Valor da da Parcela:&nbsp;</strong> R$<?= formatMoedaBr($financialRelease['installments_amount']); ?>
                                    </div>
                                    <!-- <div class="d-flex justify-content-around">
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Parte:&nbsp;</strong><?= lmWord($financialRelease['nmPessoa'], 70); ?>
                                      </div>|&nbsp;
                                      <div class="col-6 text-muted">
                                        <strong class="text-primary">Contra-Parte:&nbsp;</strong><?= lmWord($financialRelease['contraparte'], 70); ?>
                                      </div>
                                    </div> -->
                                  </div>
                                </div>
                              </td>
                              <td class="text-uppercase align-middle text-center" style="font-weight: 300;">
                                <?php
                                $today = date("Y-m-d", time());


                                if ($financialRelease['is_paid'] === 1) { ?>
                                  <span class="badge badge-success " style='font-size: 0.9rem; padding:<?= $padding ?>; font-weight: 400; letter-spacing: 0.2em; line-height: 16px; width: 100%;'>
                                  <?php
                                  echo "Pago em <br/>";
                                  echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                } else { ?>

                                    <?php
                                    if ($financialRelease['is_paid'] == '0'  && $financialRelease['due_date'] >= date('Y-m-d', time())) {
                                      $colorStatus = 'warning';
                                      $padding = '1rem';
                                    } elseif ($financialRelease['is_paid'] == '0' && $financialRelease['due_date'] < date('Y-m-d', time())) {
                                      $colorStatus = 'danger';
                                      $padding = '1rem';
                                    } elseif ($financialRelease['is_paid'] == '3') {
                                      $colorStatus = 'info';
                                      $padding = '0.5rem';
                                    } else {
                                      $colorStatus = 'success';
                                      $padding = '0.5rem';
                                    }
                                    ?>

                                    <span class="badge badge-<?= $colorStatus ?> " style='font-size: 0.9rem; padding:<?= $padding ?>; font-weight: 400; letter-spacing: 0.2em; line-height: 16px; width: 100%;'>
                                      <?php
                                      if ($financialRelease['is_paid'] == '0'  && $financialRelease['due_date'] >= date('Y-m-d', time())) {
                                        echo "Pendente";
                                      } elseif ($financialRelease['is_paid'] == '0' && $financialRelease['due_date'] < date('Y-m-d', time())) {
                                        echo "Atrasado";
                                      } elseif ($financialRelease['is_paid'] == '3') {
                                        echo "Renegociado em <br/>";
                                        echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                      } else {
                                        echo "Pago em <br/>";
                                        echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                      }
                                      ?>
                                      <? $financialRelease['is_paid'] == '0' ? 'Pendente' : 'Pago' ?>

                                    </span>
                                  <?php } ?>

                                  <?php
                                  // } elseif ($financialRelease['is_paid'] == 3) {
                                  // echo 'Renegociando em ' . $financialRelease['payday_installments'];
                                  // }

                                  // if ($financialRelease['dtTarefa'] == $today) {
                                  // echo "<span class='badge badge-pill badge-warning px-4 py-1'>Hoje</span>";
                                  // } else {
                                  // echo "<span class='badge badge-pill badge-danger px-2 py-1'>Atrasada</span>";
                                  // }
                                  ?>
                              </td>

                              <td class=" text-uppercase align-middle text-center" style="font-size: .8rem; ">
                                <?php
                                echo date('d/m/Y', strtotime($financialRelease['due_date']));

                                // if ($financialRelease['is_paid'] != '0') {
                                //   echo date('d/m/Y', strtotime($financialRelease['payday_installments']));
                                //   // var_dump($financialRelease['fri']['due_date']);
                                // } else {
                                //   echo date('d/m/Y', strtotime($financialRelease['due_date']));
                                // }
                                // $sql = "SELECT * FROM pessoa WHERE idPessoa = '" . $financialRelease['idResponsavel'] . "'";
                                // $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                                // foreach ($resultado as $pessoa) {
                                //   echo $pessoa['nmPessoa'];
                                // }
                                ?>
                              </td>
                              <!-- <td class="text-uppercase align-middle text-center">
                                <?php
                                // echo date('d/m/Y', strtotime($financialRelease['dtTarefa']));
                                // echo " AS ";
                                // echo date('H:i', strtotime($financialRelease['hora']));
                                ?>
                              </td> -->
                              <td class="text-uppercase align-middle ">

                                <ul class="nav justify-content-center d-flex justify-content-evenly">
                                  <li class="nav-item">
                                    <button class="btn btn-tool" target="" title="Receber pagamento" rel="noopener noreferrer" data-toggle="modal" data-target="#modal-payment" onclick="setarDadosModalProcesso(<?= $financialRelease['id'] ?>)">
                                      <!-- <i class="mdi mdi-file-edit-outline mdi-24px "></i> -->
                                      <i class="fa-sharp fa-solid fa-hand-holding-dollar fa-2x"></i>
                                    </button>
                                    <a href="?page=financial&id=<?= $financialRelease['idcliente'] ?>&process=<?= $financialRelease['idprocesso'] ?>" class="btn btn-tool" target="" title="Ir para Lançamento do Usúario" rel="noopener noreferrer">
                                      <i class="mdi mdi-account-arrow-right fa-2x"></i>
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

<!-- Modal payment -->
<div class="modal fade" id="modal-payment" tabindex="-1" aria-labelledby="modal-payment" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal-payment" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px;">
          <span class="text-orange">Pagamento:</span>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="col-md-12 mb-3">
            <label for="docPessoa">Data de Pagamento
              <span class="text-orange">*</span>
            </label>
            <input type="date" name="payday_installments" class="form-control text-uppercase" id="description" placeholder="Data do Pagamento" required />
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="is_paid">Confima o Pagamento
              <span class="text-orange">*</span>
            </label>
            <select class="form-control text-uppercase" name="is_paid" id="is_paid" required>
              <option value="1">Sim</option>
              <option value="0">Não</option>
            </select>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
        </div>
        <input type="hidden" name="idInstallment" id="idInstallment">
        <input type="hidden" name="active" value="payment">
        <div class="modal-footer d-flex justify-content-between">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
            <i class="mdi mdi-trash-can-outline mdi-18px"></i>
            Cancelar
          </button>
          <button type="submit" class="btn btn-success">
            <i class="mdi mdi-content-save-outline mdi-18px"></i>
            Salvar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Paymants fin -->

<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js" >

</script> -->



<script>
  document.getElementById('FinaceiroMenu').classList.add("menu-open");
  document.getElementById('FinaceiroMenuActive').classList.add("active");
  document.getElementById('LancamentosFinac').classList.add("active");

  function setarDadosModalProcesso(valor) {
    document.getElementById('idInstallment').value = valor;
  };
</script>
