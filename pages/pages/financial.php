<?php
if (isset($_POST['gravarHistorico']) && $_POST['gravarHistorico'] == 'gravarHistorico') {
  $id_pessoa_cliente = $_POST['id_pessoa_cliente'];
  $id_pessoa_responsavel = $_POST['id_pessoa_responsavel'];
  $id_processo = $_POST['id_processo'];
  $titulo_historico = $_POST['titulo_historico'];
  $descricao_historico = $_POST['descricao_historico'];
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
        <div class="col-md-3">

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
                  <span class="float-right">
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
        <div class="col-md-9">
          <div class="card card-outline">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active." href="#toayTask" data-toggle="tab">
                    <i class="align-middle mdi mdi-currency-brl mdi-18px fa fa-fw"> </i>&nbsp;&nbsp;
                    <span class="align-middle">
                      Financeiro do Cliente
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
                  <!-- Todas as Tarefas  -->
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
                          <th class="col-2 text-center align-middle">status</th>
                          <th class="col-3 text-center align-middle">Responsável</th>
                          <th class="col-2 text-center align-middle">Data e Hora</th>
                          <th class="col-auto text-center align-middle">
                            <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                          </th>
                      </tbody>
                    </table>
                  </div>
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
<!-- <footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.0.0-rc.5
  </div>
  <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
  reserved.
</footer> -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>

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
