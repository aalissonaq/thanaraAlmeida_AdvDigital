<!-- Content Header (Page header) -->
<?php

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$amount = explode(',', $dados['amountExpense']);
$nAmount =  $amount[0] . '.' . $amount[1];
// $dadoArquivo = $_FILES['arquivo']['name'];

if (!empty($dados['acao']) && $dados['acao'] == 'criarDespesa') {
  //$uploaddir = './../upload/portarias';
  // $uploaddir = file_exists('upload/portarias/') ? 'upload/portarias/' : mkdir('upload/portarias/', 0777, true);
  // $uploadfile = $uploaddir . basename($_FILES['arquivo']['name']);

  try {
    // move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile);

    $querySaveDespesa = "INSERT INTO expenses (descriptionExpense, typeExpense, amountExpense, competenceExpense, dueDateExpense) VALUES(:descriptionExpense, :typeExpense, :amountExpense, :competenceExpense, :dueDateExpense)";
    $cadDespesa = $conexao->prepare($querySaveDespesa);
    $cadDespesa->bindParam(':descriptionExpense', $dados['descriptionExpense']);
    $cadDespesa->bindParam(':typeExpense', $dados['typeExpense']);
    $cadDespesa->bindParam(':amountExpense', $nAmount);
    $cadDespesa->bindParam(':competenceExpense', date('m/Y', strtotime($dados['dueDateExpense'])));
    $cadDespesa->bindParam(':dueDateExpense', $dados['dueDateExpense']);

    $cadDespesa->execute();

    if ($cadDespesa->rowCount()) {
      echo '<script>alert(" Despesa Cadastrada com sucesso!"); </script>';
    } else {
      echo '<script>alert(" Erro"); </script>';
    }
  } catch (PDOException $erro) {
    echo $erro;
    sweetalert('erro', "Erro ao Gravar", "error", 2000);
    # code...
  }
} elseif (!empty($dados['active'])  && $dados['active'] == 'payment') {
  $dados['isPaidExpense'] == 0 ? $dados['payDayExpense'] = '' : '';
  $sql = "UPDATE expenses SET payDayExpense = '{$dados['payDayExpense']}', isPaidExpense = '{$dados['isPaidExpense']}' WHERE idExpenses = '{$dados['idDespesa']}'";

  try {
    $query = $conexao->prepare($sql);
    $query->execute();

    if ($query->rowCount()) {
      echo '<script>alert(" Atualização  realizada com Sucesso"); </script>';
    } else {
      echo '<script>alert(" Erro"); </script>';
      sweetalert('erro', "Erro ao Gravar", "error", 2000);
      # code...
    }
  } catch (PDOException $erro) {
    echo $erro;
    sweetalert('erro', "Erro ao Gravar", "error", 2000);
    # code...
  }
}
// var_dump($dados);
// var_dump($dadoArquivo);







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
$sql = "SELECT * FROM expenses WHERE payDayExpense BETWEEN '{$dateAtualStart}' AND '{$dateAtualEnd}' or competenceExpense = '{$mesAtual}' ";
$result = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as  $release) {
  switch ($release['isPaidExpense']) {
    case 0:
      $totalAReceber += $release['amountExpense'];
      break;
    case 1:
      $totalRecebido += $release['amountExpense'];
      break;
    case 3:
      $totalRenegociado += $release['amountExpense'];
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
          Despesas do mês de <?= $nomeMeses[$m - 1] . ' de ' . date("Y", time()); ?>
        </h1>
        <div class="d-none d-lg-block">
          <div class="col-12 my-2 d-flex justify-content-between btn-group btn-group-sm" role="group">
            <a href="?page=expenses&mes=<?= date('m', time()) ?>" class="btn btn-outline-primary">Mês Atual </a>
            <a href="?page=expenses&mes=1" class="btn btn-outline-primary">Jan</a>
            <a href="?page=expenses&mes=2" class="btn btn-outline-primary">Fev</a>
            <a href="?page=expenses&mes=3" class="btn btn-outline-primary">Mar</a>
            <a href="?page=expenses&mes=4" class="btn btn-outline-primary">Abr</a>
            <a href="?page=expenses&mes=5" class="btn btn-outline-primary">Mai</a>
            <a href="?page=expenses&mes=6" class="btn btn-outline-primary">Jun</a>
            <a href="?page=expenses&mes=6" class="btn btn-outline-primary">Jul</a>
            <a href="?page=expenses&mes=8" class="btn btn-outline-primary">Ago</a>
            <a href="?page=expenses&mes=9" class="btn btn-outline-primary">Set</a>
            <a href="?page=expenses&mes=10" class="btn btn-outline-primary">Out</a>
            <a href="?page=expenses&mes=11" class="btn btn-outline-primary">Nov</a>
            <a href="?page=expenses&mes=12" class="btn btn-outline-primary">Dez</a>
          </div>
        </div>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif;  letter-spacing:.06rem">
          <li class="breadcrumb-item"><a href="inicio.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Financeiro</a></li>
          <li class="breadcrumb-item active">Despesas</li>
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
              // $sql = "SELECT * FROM financial_release_installments WHERE competence = '{$mesAtual}' and isPaidExpense = 1";
              // // $sql = "SELECT * FROM financial_release_installments WHERE dueDateExpense >= '{$initMonth}' AND dueDateExpense <='{$endMonth}'";
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
              <p>Total Despesas pagas no mês</p>
            </div>
            <div class="icon">
              <!-- <i class="fas fa-donate"></i> -->
              <i class="mdi mdi-cash text-success"></i>
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
              <p>Total de Despesas em aberto no mês</p>
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
              <p>Total de Despesas previstas para o mês</p>
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
        <div class="">
          <!-- <h4>Tarefas</h4> -->
          <ul class="nav nav-pills mt-3 mb-1">
            <li class="nav-item ">
              <a class="nav-link" href="#allFinancelReleaseMonth" data-toggle="tab">
                <i class="align-middle mdi mdi-cash mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                <span class="align-middle">
                  Todas as Despesas
                </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="#delayed" data-toggle="tab">
                <i class="align-middle mdi mdi-cash-minus mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                <span class="align-middle">
                  Despesas Pendentes
                </span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#received" data-toggle="tab">
                <i class="align-middle mdi mdi-cash mdi-24px fa fa-fw"></i>&nbsp;&nbsp;
                <span class="align-middle">
                  Despesas Pagas
                </span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#allTask" data-toggle="tab">
                <i class="align-middle mdi mdi-printer mdi-24px fa fa-fw"></i>&nbsp;&nbsp;
                <span class="align-middle">
                  Imprimir Despesas do Mês de <?= $nomeMeses[$m - 1] . ' de ' . date("Y", time()); ?>
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
            <button type="button" class="btn btn-default float-right m-2 " data-toggle="modal" data-target="#modal-novoUsuario">
              <i class="fas fa-plus"></i>
              &nbsp;&nbsp; Cadastrar nova Despesa
            </button>
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
                            <th class="col-md-auto text-center align-middle">
                              <i class="mdi mdi-calendar-outline"></i>
                              DATA
                            </th>
                            <th class="col-md-auto align-middle">
                              <i class="mdi mdi-cash-minus"></i>
                              DESCRIÇÃO DA DESPESA
                            </th>
                            <th class="col-md-auto text-center1 align-middle">
                              <i class="mdi mdi-cash-multiple"></i>
                              VALOR
                            </th>
                            <th class="col-md-2 text-center align-middle">
                              <i class="mdi mdi-tag"></i>
                              TIPO DESPESA
                            </th>
                            <th class="col-md-1 text-center align-middle">
                              <i class="mdi mdi-hexagon-multiple-outline"></i>
                              STATUS
                            </th>
                            <th class="col-md-auto text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          isset($_GET['mes']) ? $mr = $mes . '/' . date("Y") : $mr = date("m/Y", time());

                          $sql = "SELECT * FROM expenses
                                    WHERE expenses.competenceExpense = '{$mr}' AND isPaidExpense <'3'
                                    ORDER BY expenses.dueDateExpense ASC";
                          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                          $count = 1;
                          foreach ($resultado as $expenses) {

                          ?>
                            <tr>
                              <td class="text-center align-middle">
                                <?= date('d/m/Y', strtotime($expenses['dueDateExpense'])) ?>
                              </td>
                              <td class="align-middle">
                                <?= $expenses['descriptionExpense'] ?>
                              </td>
                              <td class="align-middle">
                                R$ <?= formatMoedaBr($expenses['amountExpense']) ?>
                              </td>
                              <td class="text-uppercase align-middle">
                                <?= $expenses['typeExpense']; ?>
                              </td>
                              <td class="text-uppercase text-center align-middle">

                                <?php
                                if ($expenses['isPaidExpense'] == 0) {
                                ?>
                                  <div class="alert alert-warning" role="alert">Pendnente</div>
                                <?php
                                } else {
                                ?>
                                  <div class="alert alert-success" role="alert">Pago<br /> <?= date('d/m/Y', strtotime($expenses['payDayExpense'])) ?></div>
                                <?php } ?>

                              </td>
                              <td class="text-uppercase text-center align-middle">
                                <ul class="nav justify-content-center d-flex justify-content-evenly">
                                  <li class="nav-item">
                                    <a href="?page=expenses&mes=<?= $_GET['mes'] ?>&id=<?= $expenses['idExpenses'] ?>" onclick="setarDadosPagamento(<?= $expenses['idExpenses'] ?>)" class="btn btn-tool" target="" title="Editar Despesas" rel="noopener noreferrer" data-toggle="modal" data-target="#modal-payment">
                                      <i class="mdi mdi-file-edit-outline mdi-24px "></i>
                                    </a>

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>


                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <form>
                                              <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                <input type="text" class="form-control" id="recipient-name">
                                              </div>
                                              <div class="form-group">
                                                <label for="message-text" class="col-form-label">Message:</label>
                                                <textarea class="form-control" id="message-text"></textarea>
                                              </div>
                                            </form>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Send message</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
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
                            <th class="col-md-auto text-center align-middle">
                              <i class="mdi mdi-calendar-outline"></i>
                              DATA
                            </th>
                            <th class="col-md-auto align-middle">
                              <i class="mdi mdi-cash-minus"></i>
                              DESCRIÇÃO DA DESPESA
                            </th>
                            <th class="col-md-auto text-center1 align-middle">
                              <i class="mdi mdi-cash-multiple"></i>
                              VALOR
                            </th>
                            <th class="col-md-2 text-center align-middle">
                              <i class="mdi mdi-tag"></i>
                              TIPO DESPESA
                            </th>
                            <th class="col-md-1 text-center align-middle">
                              <i class="mdi mdi-hexagon-multiple-outline"></i>
                              STATUS
                            </th>
                            <th class="col-md-auto text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          isset($_GET['mes']) ? $mr = $mes . '/' . date("Y") : $mr = date("m/Y", time());

                          $sql = "SELECT * FROM expenses
                                    WHERE expenses.competenceExpense = '{$mr}' AND isPaidExpense ='0'
                                    ORDER BY expenses.dueDateExpense ASC";
                          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                          $count = 1;
                          foreach ($resultado as $expenses) {

                          ?>
                            <tr>
                              <td class="text-center align-middle">
                                <?= date('d/m/Y', strtotime($expenses['dueDateExpense'])) ?>
                              </td>
                              <td class="align-middle">
                                <?= $expenses['descriptionExpense'] ?>
                              </td>
                              <td class="align-middle">
                                R$ <?= formatMoedaBr($expenses['amountExpense']) ?>
                              </td>
                              <td class="text-uppercase align-middle">
                                <?= $expenses['typeExpense']; ?>
                              </td>
                              <td class="text-uppercase text-center align-middle">

                                <?php
                                if ($expenses['isPaidExpense'] == 0) {
                                ?>
                                  <div class="alert alert-warning" role="alert">Pendnente</div>
                                <?php
                                } else {
                                ?>
                                  <div class="alert alert-success" role="alert">Pago<br /> <?= date('d/m/Y', strtotime($expenses['payDayExpense'])) ?></div>
                                <?php } ?>

                              </td>
                              <td class="text-uppercase text-center align-middle">
                                <ul class="nav justify-content-center d-flex justify-content-evenly">
                                  <li class="nav-item">


                                    <a href="?page=expenses&mes=<?= $_GET['mes'] ?>&id=<?= $expenses['idExpenses'] ?>" onclick="setarDadosPagamento(<?= $expenses['idExpenses'] ?>)" class="btn btn-tool" target="" title="Editar Despesas" rel="noopener noreferrer" data-toggle="modal" data-target="#modal-payment">
                                      <i class="mdi mdi-file-edit mdi-24px "></i>

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
                            <th class="col-md-auto text-center align-middle">
                              <i class="mdi mdi-calendar-outline"></i>
                              DATA
                            </th>
                            <th class="col-md-auto align-middle">
                              <i class="mdi mdi-cash-minus"></i>
                              DESCRIÇÃO DA DESPESA
                            </th>
                            <th class="col-md-auto text-center1 align-middle">
                              <i class="mdi mdi-cash-multiple"></i>
                              VALOR
                            </th>
                            <th class="col-md-2 text-center align-middle">
                              <i class="mdi mdi-tag"></i>
                              TIPO DESPESA
                            </th>
                            <th class="col-md-1 text-center align-middle">
                              <i class="mdi mdi-hexagon-multiple-outline"></i>
                              STATUS
                            </th>
                            <th class="col-md-auto text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          isset($_GET['mes']) ? $mr = $mes . '/' . date("Y") : $mr = date("m/Y", time());

                          $sql = "SELECT * FROM expenses
                                    WHERE expenses.competenceExpense = '{$mr}' AND isPaidExpense ='1'
                                    ORDER BY expenses.dueDateExpense ASC";
                          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                          $count = 1;
                          foreach ($resultado as $expenses) {

                          ?>
                            <tr>
                              <td class="text-center align-middle">
                                <?= date('d/m/Y', strtotime($expenses['dueDateExpense'])) ?>
                                asdasd
                              </td>
                              <td class="align-middle">
                                <?= $expenses['descriptionExpense'] ?>
                              </td>
                              <td class="align-middle">
                                R$ <?= formatMoedaBr($expenses['amountExpense']) ?>
                              </td>
                              <td class="text-uppercase align-middle">
                                <?= $expenses['typeExpense']; ?>
                              </td>
                              <td class="text-uppercase text-center align-middle">
                                <?php
                                if ($expenses['isPaidExpense'] == 0) {
                                ?>
                                  <div class="alert alert-warning" role="alert">Pendnente</div>
                                <?php
                                } else {
                                ?>
                                  <div class="alert alert-success" role="alert">Pago<br /> <?= date('d/m/Y', strtotime($expenses['payDayExpense'])) ?></div>
                                <?php } ?>
                              </td>
                              <td class="text-uppercase text-center align-middle">
                                <ul class="nav justify-content-center d-flex justify-content-evenly">
                                  <li class="nav-item">

                                    <a href="?page=expenses&mes=<?= $_GET['mes'] ?>&id=<?= $expenses['idExpenses'] ?>" onclick="setarDadosPagamento(<?= $expenses['idExpenses'] ?>)" class="btn btn-tool" target="" title="Editar Despesas" rel="noopener noreferrer" data-toggle="modal" data-target="#modal-payment">
                                      <i class="mdi mdi-file-edit-outline mdi-24px "></i>
                                    </a>


                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <form>
                                              <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                <input type="text" class="form-control" id="recipient-name">
                                              </div>
                                              <div class="form-group">
                                                <label for="message-text" class="col-form-label">Message:</label>
                                                <textarea class="form-control" id="message-text"></textarea>
                                              </div>
                                            </form>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Send message</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>


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

<!-- modal nova despesa  -->
<div class="modal fade" id="modal-novoUsuario">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nova Despensa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- form novo Usuário -->
        <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="col-md-12 mb-3 ">
              <label for="descriptionExpense">Descrição da Despesa</label>
              <textarea type="text" rows="5" name="descriptionExpense" class="form-control text-uppercase" id="descriptionExpense" placeholder="Descrição da Despesa" value="" required></textarea>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-3 mb-3">
              <label for="amountExpense">Valor da Despesa (R$)</label>
              <input type="text" maxlength="12" name="amountExpense" class="form-control text-uppercase js_dinheiro" id="amountExpense" placeholder="Somente Números" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="typeExpense">Tipo de Despesa</label>
              <select class="form-control text-uppercase custom-select" required name="typeExpense" id="typeExpense">
                <option value="" disabled selected>Selecione</option>
                <option value="Eventual">Eventual</option>
                <option value="Recorrente">Recorrente</option>
              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <label for="dueDateExpense">Data de Venvimento</label>
              <input type="date" name="dueDateExpense" class="form-control text-uppercase " id="dueDateExpense" placeholder="Somente Números" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="payDayExpense">Data do Pagamento <small>Caso já tenha sido pago</small></label>
              <input type="date" name="payDayExpense" class="form-control text-uppercase " id="payDayExpense" placeholder="Somente Números" onblur="isRequiredPaymentVoucher(this.value)">
              <div class="invalid-feedback">
                Obrigatório !
              </div>

            </div>
            <!--
            <div class="col-md-4 mb-3">
              <label for="strComprovanteDespesa">Comprovante de Pagameto <small>(imagem(jpg, png) ou PDF</small>
              </label>
              <input type="file" name="strComprovanteDespesa" class="form-control text-uppercase" id="strComprovanteDespesa" placeholder="imagem ou PDF">
              <div class="invalid-feedback">
                Comprovanete Obrigatório para despesas pagas !
              </div>
            </div> -->
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="idRespCadastroDispesa" value="<?= $_SESSION['ID']; ?>">
        <input type="hidden" name="acao" value="criarDespesa">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
          Fechar </button>
        <button class="btn btn-primary" type="submit">
          <i class="far fa-save fa-fw fa-lg"></i>
          Gravar Dados</button>
        </form>
        <!--/form novo Usuario -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal PAGAMENTO -->
<div class="modal fade" id="modal-payment" tabindex="-1" aria-labelledby="modal-payment" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal-payment" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px;">
          <span class="text-orange">Pagamento de Despesa:</span>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="col-md-12 mb-3">
            <label for="payDayExpense">Data de Pagamento <?= $_POST['id']; ?>
              <span class="text-orange">*</span>
            </label>
            <input type="date" name="payDayExpense" class="form-control text-uppercase" id="description" placeholder="Data do Pagamento" required />
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="isPaidExpense">Confima o Pagamento
              <span class="text-orange">*</span>
            </label>
            <select class="form-control text-uppercase" name="isPaidExpense" id="isPaidExpense" required>
              <option value="1">Sim</option>
              <option value="0">Não</option>
            </select>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
        </div>
        <input type="hidden" name="idDespesa" id="idDespesa">
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
<!-- Modal -->
<!-- Modal PAGAMENTO -->
<div class="modal fade" id="modal-payment" tabindex="-1" aria-labelledby="modal-payment" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal-payment" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px;">
          <span class="text-orange">Pagamento de Despesa:</span>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="col-md-12 mb-3">
            <label for="payDayExpense">Data de Pagamento <?= $_POST['id']; ?>
              <span class="text-orange">*</span>
            </label>
            <input type="date" name="payDayExpense" class="form-control text-uppercase" id="description" placeholder="Data do Pagamento" required />
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="isPaidExpense">Confima o Pagamento
              <span class="text-orange">*</span>
            </label>
            <select class="form-control text-uppercase" name="isPaidExpense" id="isPaidExpense" required>
              <option value="1">Sim</option>
              <option value="0">Não</option>
            </select>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
        </div>
        <input type="hidden" name="idDespesa" id="idDespesa">
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
<!-- Modal -->


<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js" >

</script> -->



<script>
  document.getElementById('FinaceiroMenu').classList.add("menu-open");
  document.getElementById('FinaceiroMenuActive').classList.add("active");
  document.getElementById('expenses').classList.add("active");




  function setarDadosPagamento(valor) {
    document.getElementById('idDespesa').value = valor;
  };

  $('#exampleModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body input').val(recipient)
  })
</script>
