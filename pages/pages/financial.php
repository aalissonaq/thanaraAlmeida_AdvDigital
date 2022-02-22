<?php
if (isset($_POST['active']) && $_POST['active'] == 'createFinancialRelease') {

  $typeFull = explode('-', $_POST['type']);
  $type = $typeFull[1] . '-' . $typeFull[2];
  $id_process = $_GET['process'];
  $id_financial_category = $typeFull[0];
  $description = strip_tags(trim($_POST['description']));
  $vl = substr(tiraMascara(strip_tags(trim($_POST['amount']))), 0, strlen(tiraMascara(strip_tags(trim($_POST['amount'])))) - 2) . '.' . substr(tiraMascara(strip_tags(trim($_POST['amount']))), -2);
  $amount = $vl;
  $competence = $_POST['competence'];
  $due_date = strip_tags(trim($_POST['due_date']));
  $installments = $_POST['number_installments'] > 1 ? 1 : 0;
  $number_installments = $_POST['number_installments'];

  $sql = "INSERT INTO financial_release (type, id_process, id_financial_category, description, amount, competence, due_date, installments, number_installments) VALUES ('$type', '$id_process','$id_financial_category', '$description', '$amount', '$competence', '$due_date', '$installments', '$number_installments')";

  if ($conexao->exec($sql)) {
    sweetalert('Sucesso', 'Lançamento gravado com suscesso', 'success', 2000);
  } else {
    sweetalert('Ops !', ' Erro ao grava o Lançamento, por favor tente novamente', 'error', 2000);
  }
}

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <!-- <h1 style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">Profile</h1> -->
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif; letter-spacing: .06rem;">
          <li class="breadcrumb-item"><a href="inicio.php"><i class="mdi mdi-home-outline fa fa-fw"></i>Inicio</a></li>
          <li class="breadcrumb-item"><a href="?page=listarClientes"><i class="mdi mdi-account-outline fa fa-fw"></i>Cliente</a></li>
          <li class="breadcrumb-item active"><i class="mdi mdi-file-account-outline fa fa-fw"></i>Financeiro do Cliente</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <?php


  $idEdit = $_GET['id'];
  $dadosPessoa = ler("vw_pessoa_cliente", '', "WHERE idPassoaPessoa = '{$idEdit}'")->fetchAll(PDO::FETCH_ASSOC);
  foreach ($dadosPessoa as $dcliente) {

    // foreach (lerJoin('pessoa', 'clientes', 'idPessoa', 'LEFT', 'WHERE pessoa.idPessoa =1')->fetchAll(PDO::FETCH_ASSOC) as $dcliente) {

  ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img src="
                <?php
                if ($dcliente['foto']) {
                  echo "./upload/fotoPessoas/{$dcliente['foto']}";
                } else {
                  echo "./upload/fotoPessoas/default.png";
                }
                ?>
                " class="profile-user-img img-fluid img-circle" alt="foto do Cliente <?= $dcliente['nmPessoa'] ?>" style="object-fit: cover;" />
              </div>

              <h3 class="profile-username text-center text-primary" style="font-family:'Advent Pro', sans-serif; font-weight: 600; font-size:1.4rem ">
                <?php
                if ($dcliente['nmPessoaSocial'] == '') {
                  $nome =  explode(' ', $dcliente['nmPessoa']);
                  if (strlen($nome[1]) > 2) {
                    echo $nome[0] . " " . $nome[1];
                  } else {
                    echo $nome[0] . " " . $nome[1] . " " . $nome[2];
                  }
                } else {
                  echo $dcliente['nmPessoaSocial'];
                }

                ?>
              </h3>

              <p class="text-muted text-center" style="text-transform: uppercase;">
                <?= $dcliente['nmPessoa'] ?>
              </p>
              <p>
              <div class="d-flex justify-content-around align-items-center">
                <?php
                if ($_SESSION['NIVEL'] <= "1") {
                ?>

                  <button onclick="history.go(-1)" class="btn btn-tool " target="" title="Voltar" rel="noopener noreferrer">
                    <i class="mdi mdi-arrow-left-circle-outline mdi-24px fa fa-fw"></i>
                  </button>
                  <!-- <a href="#settings" class="btn btn-tool" target="" data-toggle="tab" title="Editar Dados" rel="noopener noreferrer">
                    <i class="mdi mdi-account-edit-outline mdi-24px fa fa-fw"></i>
                  </a>

                  <button data-toggle="modal" data-target="#modal-edtFoto" data-id="<?= $idEdit ?>" onclick="setaDadosModal(<?= $idEdit ?> )" class="btn btn-tool \" target="" title="Trocar Foto" rel="noopener noreferrer\">
                    <i class="mdi mdi-camera-flip-outline mdi-24px fa fa-fw"></i>
                  </button> -->
                  <?=
                  $_GET["page"] == 'financial' ? '<button class="btn btn-tool text-primary" target="" title="Financeiro" rel="noopener noreferrer\"><i class="mdi mdi-currency-brl mdi-18px fa fa-fw"></i></button>' : '<button class="btn btn-tool" target="" title="Financeiro" rel="noopener noreferrer\"><i class="mdi mdi-currency-brl mdi-18px fa fa-fw"></i></button>';
                  ?>
                  <!-- <button class="btn btn-tool text-orange" target="" title="Financeiro" rel="noopener noreferrer\">
                    <i class="mdi mdi-currency-brl mdi-18px fa fa-fw"></i>
                  </button> -->
                <?php
                } else {
                ?>
                  <a href="?page=listarClientes" class="btn btn-tool " target="" title="Voltar" rel="noopener noreferrer">
                    <i class="mdi mdi-arrow-left-circle-outline mdi-24px fa fa-fw"></i>
                  </a>
                  <a href="#settings" class="btn btn-tool" target="" data-toggle="tab" title="Editar Dados" rel="noopener noreferrer">
                    <i class="mdi mdi-account-edit-outline mdi-24px fa fa-fw"></i>
                  </a>

                  <button data-toggle="modal" data-target="#modal-edtFoto" data-id="<?= $idEdit ?>" onclick="setaDadosModal(<?= $idEdit ?> )" class="btn btn-tool \" target="" title="Trocar Foto" rel="noopener noreferrer\">
                    <i class="mdi mdi-camera-flip-outline mdi-24px fa fa-fw"></i>
                  </button>
                <?php
                }
                ?>
              </div>
              </p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b><i class="fas fa-lg fa-phone text-primary"></i> </b>
                  <a href="tel:<?= tiraMascara($dcliente['nnTelefonePessoa']) ?>" class="" style="font-size:1rem">
                    <?= $dcliente['nnTelefonePessoa'] ?>
                  </a>
                  <span class="float-left">
                    <b>
                      <i class="fab fa-lg fa-whatsapp text-success"></i>
                    </b>

                    <a href="https://api.whatsapp.com/send?phone=55<?= tiraMascara($dcliente['nnWhatsappPessoa']) ?>&text=Ol%C3%A1%20<?= urlencode($dcliente['nmPessoa']); ?>%2C%20temos%20novidades%20sobre%20ser%20processo.%20%20" class="text-success " target="_blank" title="Enviar WhatsApp" style="font-size:1.1rem">

                      <?= $dcliente['nnWhatsappPessoa'] ?>
                    </a>
                  </span>
                </li>
                <li class="list-group-item">
                  <b>
                    <i class="fas fa-fw fa-lg fa-envelope text-primary"></i>
                  </b>
                  <!-- <span class="float-right"> -->
                  <a href="mailto:<?= $dcliente['stEmailPessoa'] ?>" class="" style="font-size:.95rem">
                    <?= $dcliente['stEmailPessoa'] ?>
                  </a>
                  </a>
                  <!-- </span> -->
                </li>
              </ul>

              <a href="?page=verCliente&id=<?= $idEdit ?>" class="btn btn-outline-primary btn-block">
                <i class="fas fa-lg fa-fw fa-print"> </i>
                <span class="text-uppercase">
                  Ficha do Cliente
                </span>
              </a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary ">
            <div class="card-header">
              <h3 class="card-title text-white">DADOS</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço</strong>
              <p class="text-muted" style="text-transform: uppercase;">
                <?= $dcliente['stLogradouroPessoa'] . ", " . $dcliente['nnCasaPessoa'] . " <br/>" . $dcliente['stBairroPessoa'] . " <br/> " . $dcliente['stCidadePessoa'] . "-" . $dcliente['stEstadoPessoa'] . " CEP:" . $dcliente['stCepPessoa'] ?>
              </p>
              <hr>
              <!-- <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
              <p class="text-muted">
                <span class="tag tag-danger">UI Design</span>
                <span class="tag tag-success">Coding</span>
                <span class="tag tag-info">Javascript</span>
                <span class="tag tag-warning">PHP</span>
                <span class="tag tag-primary">Node.js</span>
              </p>
              <hr> -->
              <!-- <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-10">
          <div class="card card-outline">
            <div class="card-header p-2">

              <div class="card-tools">
                <a href="" class="btn btn-tool align-middle mr-3" data-toggle="modal" data-target="#modal-newFinancialReleases" style="font-family:'Advent Pro', sans-serif; font-weight: bold; font-size: 1rem; letter-spacing: 1px;">
                  <i class="fa fa-plus-square fa-fw fa-lg align-middle"></i>
                  <!-- <i class="fa fa-user-plus fa-fw fa-lg"></i> -->
                  Novo Lançamento
                </a>
              </div>

              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active." href="#toayTask" data-toggle="tab">
                    <i class="align-middle mdi mdi-currency-brl mdi-18px fa fa-fw"> </i>&nbsp;&nbsp;

                    <span class="align-middle">
                      <?= !isset($_GET['process']) ? "Financeiro do Cliente" : "Financeiro do Proceso" ?>
                    </span>
                  </a>
                </li>

                <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                </li> -->
              </ul>



            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="toayTask">
                </div>
                <div class="tab-pane active" id="allTasks">
                  <!-- Financeiro -->
                  <?php
                  if (!isset($_GET['process'])) {
                  ?>
                    <div class="table-responsive">
                      <table id="tabela" class="table table-sm table-striped table-hover">
                        <thead class="" style="font-weight: 300; font-family: 'Advent Pro', sans-serif;">
                          <tr>
                            <th class="col-4 text-center align-middle">#</th>
                            <th class="col-2 text-center align-middle">Nº Proceso</th>
                            <th class="col-3 text-center align-middle">Valor da Ação</th>
                            <th class="col-2 text-center align-middle">Data e Hora</th>
                            <th class="col-auto text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <th class="col-4 text-center align-middle">#</th>
                          <th class="col-2 text-center align-middle">1235464654654564564654</th>
                          <th class="col-3 text-center align-middle">Responsável</th>
                          <th class="col-2 text-center align-middle">Data e Hora</th>
                          <th class="col-auto text-center align-middle">
                            <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                          </th>
                        </tbody>
                      </table>
                    </div>
                  <?php
                  } else {
                  ?>
                    <div class="table-responsive">
                      <table id="tabela" class="table table-sm table-striped table-hover">
                        <thead class="" style="font-weight: 300; font-family: 'Advent Pro', sans-serif;">
                          <tr>
                            <th class="col-1 text-center align-middle">#</th>
                            <th class="col-3 text-center align-middle">Tipo</th>
                            <th class="col-2 text-center align-middle">Nº Proceso</th>
                            <th class="col-3 text-center align-middle">Descrição</th>
                            <th class="col-1 text-center align-middle">Valor</th>
                            <th class="col-2 text-center align-middle">Competência</th>
                            <th class="col-2 text-center align-middle">Vencimento</th>

                            <th class="col-auto text-center align-middle">
                              <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = "SELECT * FROM financial_release
                                  WHERE financial_release.id_process = '{$_GET['process']}'";
                          $result = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                          $count = 1;
                          foreach ($result as  $release) {
                          ?>

                            <tr class="">
                              <td class="col-1 text-center align-middle">
                                <?= str_pad($count, 3, "0", STR_PAD_LEFT); $count++ ?>
                              </td>
                              <td class="col-2 text-center align-middle">
                                <?= $release['type']; ?>
                              </td>
                              <td class="col-2 text-center align-middle">
                                <?= $release['id_process']; ?>
                              </td>
                              <td class="col-3 text-center align-middle">
                                <?= $release['description']; ?>
                              </td>
                              <td class="col-2 text-center align-middle">
                                R$ <?= formatMoedaBr($release['amount']); ?>
                              </td>
                              <td class="col-2 text-center align-middle">
                                <?= $release['competence']; ?>
                              </td>
                              <td class="col-2 text-center align-middle">
                              <?= date('d/m/Y', strtotime($release['due_date'])); ?>
                              </td>

                              <td class="col-auto text-center align-middle">
                                <div class="dropdown">
                                  <button class="btn  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                    ...
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button">
                                      <i class="mdi mdi-cash-register" title="Pagamento"></i>
                                      Pagamento
                                    </button>
                                    <button class="dropdown-item" type="button">
                                      <i class="mdi mdi-calendar-multiple" title="Parcelamento"></i>
                                      Parcelas
                                    </button>
                                    <button class="dropdown-item" type="button">
                                      <i class="mdi mdi-square-edit-outline" title="Documentos"></i>
                                      Editar
                                    </button>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  <?php } ?>
                  <!-- /.tarefas -->
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>

          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!--row -->
    </div>
  <?php } ?>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>

<!-- modal NOVO USUARIO -->
<div class="modal fade" id="modal-newFinancialReleases">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px;">
          <span class="text-orange">Novo Lançamento no Proceso:</span>
          <?php
          $sql = "SELECT * FROM processos WHERE idprocesso = {$_GET['process']}";
          $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
          foreach ($resultado as $value) {
            echo '#' . $value['niprocesso'] . '<br/>' . strtoupper($value['objprocesso']);
          }
          ?>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->

        <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="col-md-3 mb-3">
              <label for="nmPessoa">Tipo de Lançamento
                <span class="text-orange">*</span>
              </label>
              <select class="form-control" id="type" name="type" required>
                <option value="" selected disabled>Selecione...</option>
                <?php
                $sql = "SELECT * FROM financial_categories ORDER BY financial_categories.type DESC";
                $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultado as $value) {
                ?>
                  <option value="<?= $value['id'] ?>-<?= $value['type'] ?>-<?= $value['category'] ?>"><?= $value['type'] ?> - <?= $value['category'] ?></option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-9 mb-3">
              <label for="docPessoa">Descrição do Lançamento
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="description" class="form-control text-uppercase" id="description" placeholder="Descrição do Lançamento" required />
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-3 mb-3">
              <label for="dtNascPessoa">Valor do Lançamento
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="amount" class="form-control text-uppercase js_dinheiro" id="amount" maxlength="12" placeholder="R$ 0.000,00" required />
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="competence">Competência</label>
              <select name="competence" id="competence" class="form-control" required>
                <option value="" selected disabled>Selecione...</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                ?>
                  <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>/<?= date('Y', time()) ?>">
                    <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>/<?= date('Y', time()) ?>
                  </option>

                <?php } ?>
              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="due_date">Data de Vencimento
                <span class="text-orange">*</span>
              </label>
              <input type="date" name="due_date" class="form-control text-uppercase" id="due_date" placeholder="" required />
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="number_installments">Pascelas
                <span class="text-orange">*</span>
              </label>
              <select name="number_installments" id="number_installments" class="form-control" required>
                <option value="" selected disabled>Selecione...</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                ?>
                  <option value="<?= $i; ?>">
                    <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>
                  </option>

                <?php } ?>
              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="active" value="createFinancialRelease">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
          Fechar </button>
        <button class="btn btn-lg btn-success" type="submit">
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


<!-- ./wrapper -->
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
<script>
  //document.getElementById('gestaoMenu').classList.add("menu-open");
  //document.getElementById('gestaoMenuActive').classList.add("active");
  document.getElementById('menuClientes').classList.add("active");
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();

  // Adicionando Javascript
  function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById("stLogradouroPessoa").value = "";
    document.getElementById("stBairroPessoa").value = "";
    document.getElementById("stCidadePessoa").value = "";
    document.getElementById("stEstadoPessoa").value = "";
    // document.getElementById("ibge").value = "";
  }

  function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
      //Atualiza os campos com os valores.
      document.getElementById("stLogradouroPessoa").value = (conteudo.logradouro);
      document.getElementById("stBairroPessoa").value = (conteudo.bairro);
      document.getElementById("stCidadePessoa").value = (conteudo.localidade);
      document.getElementById("stEstadoPessoa").value = (conteudo.uf);
      //document.getElementById("ibge").value =
      //conteudo.ibge;
    } //end if.
    else {
      //CEP não Encontrado.
      limpa_formulário_cep();
      alert("CEP não encontrado.");
    }
  }

  function pesquisacep(valor) {
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, "");

    //Verifica se campo cep possui valor informado.
    if (cep != "") {
      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      //Valida o formato do CEP.
      if (validacep.test(cep)) {
        //Preenche os campos com "..." enquanto consulta webservice.
        document.getElementById("stLogradouroPessoa").value = "...";
        document.getElementById("stBairroPessoa").value = "...";
        document.getElementById("stCidadePessoa").value = "...";
        document.getElementById("stEstadoPessoa").value = "...";
        //document.getElementById("ibge").value = "...";

        //Cria um elemento javascript.
        var script = document.createElement("script");

        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);
        document.getElementById("nnCasaPessoa").focus();
      } //end if.
      else {
        //cep é inválido.
        limpa_formulário_cep();
        alert("Formato de CEP inválido.");
        document.getElementById("stLogradouroPessoa").focus();
      }
    } //end if.
    else {
      //cep sem valor, limpa formulário.
      limpa_formulário_cep();
    }
  }
</script>
