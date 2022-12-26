<!-- Content Header (Page header) -->
<?php
$idExpense = $_GET["id"];

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$vl = substr(tiraMascara(strip_tags(trim($dados['amountExpense']))), 0, strlen(tiraMascara(strip_tags(trim($dados['amountExpense'])))) - 2) . '.' . substr(tiraMascara(strip_tags(trim($dados['amountExpense']))), -2);
$amount = $vl;

// $dadoArquivo = $_FILES['arquivo']['name'];

if (!empty($dados['acao']) && $dados['acao'] == 'criarDespesa') {
  //$uploaddir = './../upload/portarias';
  // $uploaddir = file_exists('upload/portarias/') ? 'upload/portarias/' : mkdir('upload/portarias/', 0777, true);
  // $uploadfile = $uploaddir . basename($_FILES['arquivo']['name']);

  try {
    // move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile);

    $querySaveDespesa = "UPDATE expenses SET descriptionExpense = :descriptionExpense, typeExpense = :typeExpense, amountExpense = :amountExpense, competenceExpense = :competenceExpense, dueDateExpense = :dueDateExpense, payDayExpense= :payDayExpense, isPaidExpense = :isPaidExpense where idExpenses = $idExpense";

    $cadDespesa = $conexao->prepare($querySaveDespesa);
    $cadDespesa->bindParam(':descriptionExpense', nl2br($dados['descriptionExpense']));
    $cadDespesa->bindParam(':typeExpense', $dados['typeExpense']);
    $cadDespesa->bindParam(':amountExpense', $amount);
    $cadDespesa->bindParam(':competenceExpense', date('m/Y', strtotime($dados['dueDateExpense'])));
    $cadDespesa->bindParam(':dueDateExpense', $dados['dueDateExpense']);

    !empty($dados['payDayExpense']) ? $payDay = $dados['payDayExpense'] : $payDay = null;
    !empty($dados['payDayExpense']) ? $isPay = 1 : $isPay = 0;

    $cadDespesa->bindParam(':payDayExpense', $payDay);
    $cadDespesa->bindParam(':isPaidExpense', $isPay);

    $cadDespesa->execute();

    if ($cadDespesa->rowCount()) {
      echo '<script> alert(" Despesa Editada com sucesso!");history.go(-2);</script>';
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

var_dump($dados);
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
          Editar Despesas <?= $expenses['descriptionExpense'] ?>
        </h1>
        <!-- <div class="d-none d-lg-block">
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
        </div> -->
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
    <?php

    $queryGetExpense = "SELECT * FROM expenses WHERE idExpenses = $idExpense";
    $resultGetExpense = $conexao->query($queryGetExpense)->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
      <div class="form-row">
        <div class="col-md-12 mb-3 ">
          <label for="descriptionExpense">Descrição da Despesa</label>
          <textarea type="text" rows="5" name="descriptionExpense" class="form-control text-uppercase" id="descriptionExpense" placeholder="Descrição da Despesa" value="" required><?= nl2br($resultGetExpense[0]['descriptionExpense']) ?></textarea>
          <div class="invalid-feedback">
            Obrigatório !
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-3 mb-3">
          <label for="amountExpense">Valor da Despesa (R$)</label>
          <input type="text" maxlength="12" name="amountExpense" class="form-control text-uppercase js_dinheiro" id="amountExpense" value="<?= formatMoedaBr($resultGetExpense[0]['amountExpense']); ?>" placeholder="Somente Números" required>
          <div class="invalid-feedback">
            Obrigatório !
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <label for="typeExpense">Tipo de Despesa</label>
          <select class="form-control text-uppercase custom-select" required name="typeExpense" id="typeExpense">
            <!-- <option value="" disabled selected>Selecione</option> -->

            <option value="Eventual" <?= $resultGetExpense[0]['typeExpense'] == 'Eventual' ? 'selected' : ''  ?>>Eventual</option>
            <option value="Recorrente" <?= $resultGetExpense[0]['typeExpense'] == 'Recorrente' ? 'selected' : '' ?>>Recorrente</option>
          </select>
          <div class="invalid-feedback">
            Obrigatório !
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <label for="dueDateExpense">Data de Venvimento</label>
          <input type="date" name="dueDateExpense" class="form-control text-uppercase " id="dueDateExpense" value="<?= $resultGetExpense[0]['dueDateExpense'] ?>" required>
          <div class="invalid-feedback">
            Obrigatório !
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <label for="payDayExpense">Data do Pagamento <small>Caso já tenha sido pago</small></label>
          <input type="date" name="payDayExpense" class="form-control text-uppercase " id="payDayExpense" value="<?= $resultGetExpense[0]['payDayExpense'] ?>">
          <div class="invalid-feedback">
            Obrigatório !
          </div>
        </div>
      </div>

  </div>
  <div class="modal-footer justify-content-between">
    <input type="hidden" name="idRespCadastroDispesa" value="<?= $_SESSION['ID']; ?>">
    <input type="hidden" name="acao" value="criarDespesa">
    <button type="button" class="btn btn-danger" onclick="">
      <i class="fas fa-times fa-fw fa-xl"></i>
      Cancelar </button>
    <button class="btn btn-primary" type="submit">
      <i class="far fa-save fa-fw fa-lg"></i>
      Gravar Dados</button>
    </form>
  </div>
  <!--/. container-fluid -->
</section>
<!-- /.content -->


<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js" >

</script> -->

<script>
  document.getElementById('FinaceiroMenu').classList.add("menu-open");
  document.getElementById('FinaceiroMenuActive').classList.add("active");
  document.getElementById('expenses').classList.add("active");

  function setarDadosPagamento(valor) {
    document.getElementById('idDespesa').value = valor;
  };

  function setarDados(valor) {
    alert(valor);
    // document.getElementById('idDespesa').value = valor;
  };
</script>
