<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Usuários do Sistema</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Usuários do Sistema</li>
          <li class="breadcrumb-item active">Dados do Usuários do Sistema</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="d-none d-print-block col-md-12 mb-1  bg-dark">
    <img src="./image/logo.png"
      class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} col-md-4 mb-3"
      alt=""><br />
    <!-- <span class="lead">Sistema de Gerenciamento de Parceiros</span> -->
    <hr color="#004455" class="container-fluid" />
  </div <?php
            $id = $_GET['id'];
            $dadosPessoa = ler("vw_pessoa_user", '', "WHERE id = '{$id}'")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dadosPessoa as $dp) {
            ?> <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title text-uppercase">Dados do Usuário do Sistema
        <small class="lead text-orange text-uppercase"></small>
      </h3>

      <div class="card-tools">
        <a href="?page=listarusuarios" class="btn btn-tool text-orange d-print-none">
          <!-- <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i> -->
          <i class="mdi mdi-arrow-left-bold-circle-outline fa fa-2x align-middle"></i>
          Voltar para Lista de Usuários
        </a>
      </div>
    </div>
    <div class="card-body">





      <form class="needs-validation" novalidate action="pages/pages/acoes/editarUsuario.php" method="POST"
        enctype="multipart/form-data">
        <input type="hidden" value="<?= $idEdit; ?>" name="idEdit" />
        <div class="form-row">
          <div class="col-md-9 mb-3">
            <label for="nmPessoa">Nome do Usuário</label>
            <br />
            <span class="lead"><?= $dp['nmPessoa']; ?></span>
          </div>
          <div class="col-md-3 mb-3">
            <label for="docPessoa">CPF ou CNPJ</label>
            <br />
            <span class="lead">
              <?= $retVal = (strlen($dp['docPessoa']) == 11) ? MascaraCPF($dp['docPessoa']) : MascaraCNPJ($dp['docPessoa']); ?>
            </span>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-3 mb-3">
            <label for="dtNascPessoa">Data de Nascimento/Criação</label>
            <br />
            <span class="lead"><?= $dp['dtNascPessoa']; ?></span>
          </div>
          <div class="col-md-2 mb-3">
            <label for="stCepPessoa">CEP</label>
            <br />
            <span class="lead"><?= $dp['stCepPessoa']; ?></span>
          </div>
          <div class="col-md-6 mb-3">
            <label for="stLogradouroPessoa">Endereço</label>
            <br />
            <span class="lead"><?= $dp['stLogradouroPessoa']; ?></span>
          </div>
          <div class="col-md-1 mb-3">
            <label for="nnCasaPessoa">Nº</label>
            <br />
            <span class="lead"><?= $dp['nnCasaPessoa']; ?></span>
          </div>

        </div>
        <div class="form-row">
          <div class="col-md-5 mb-3">
            <label for="stCompleEndPessoa">Complemento</label>
            <br />
            <span class="lead"><?= $dp['stCompleEndPessoa']; ?></span>
          </div>

          <div class="col-md-6 mb-3">
            <label for="stBairroPessoa">Bairro</label>
            <br />
            <span class="lead"><?= $dp['stBairroPessoa']; ?></span>
          </div>
          <div class="col-md-1 mb-3">
            <label for="stEstadoPessoa">UF</label>
            <br />
            <span class="lead"><?= $dp['stEstadoPessoa']; ?></span>
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-2 mb-3">
            <label for="nnTelefonePessoa">Telefone</label>
            <br />
            <span class="lead"><?= $dp['nnTelefonePessoa']; ?></span>
          </div>
          <div class="col-md-2 mb-3">
            <label for="nnWhatsappPessoa">Whataspp</label>
            <br />
            <span class="lead"><?= $dp['nnWhatsappPessoa']; ?></span>
          </div>
          <div class="col-md-8 mb-3">
            <label for="stEmailPessoa">E-Mail</label>
            <br />
            <span class="lead"><?= $dp['stEmailPessoa']; ?></span>
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-12 mb-3">
            <label for="txtObsContatosPessoas">Observações de Contados</label>
            <br />
            <p class="lead"><?= $dp['txtObsContatosPessoas']; ?></p>
          </div>
        </div>
        <hr />
        <fieldset>
          <legend>
            <p class="lead">
              DADOS DE ACESSO
            </p>
          </legend>
        </fieldset>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="nivelUser">Nível de Acesso</label>
            <br />
            <span class="lead">
              <?php
                            switch ($dp['nivelUser']) {
                                case '1':
                                    echo 'Administrador do Sistema';
                                    break;
                                case '2':
                                    echo 'Parceiro';
                                    break;
                                default:
                                    echo 'Antendente';
                                    break;
                            }
                            ?>
            </span>

          </div>
          <div class="col-md-6 mb-3">
            <label for="flStatusUser">Status do Usuário</label>
            <br />
            <span class="lead">
              <?php
                            switch ($dp['flStatusUser']) {
                                case '1':
                                    echo 'Ativo';
                                    break;

                                default:
                                    echo 'Inativo';
                                    break;
                            }
                            ?>
            </span>
          </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <div class="modal-footer justify-content-between">
        <a class="btn btn-danger d-print-none text-light" onclick="history.go(-1)" type="">
          <i class="mdi mdi-arrow-left-circle-outline fa fa-fw fa-lg"></i>
          Voltar
        </a>
        <a class="btn btn-primary d-print-none text-light" onclick="self.print()" type="">
          <i class="mdi mdi-printer fa fa-fw fa-lg"></i>
          Imprimir
        </a>
      </div>
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
  <br />
  <?php } ?>
</section>
<!-- /.content -->
<script>
document.getElementById('gestaoMenu').classList.add("menu-open");
document.getElementById('gestaoMenuActive').classList.add("active");
document.getElementById('userSystem').classList.add("active");

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
  document.getElementById("logradouro").value = "";
  document.getElementById("bairro").value = "";
  document.getElementById("cidade").value = "";
  document.getElementById("estado").value = "";
  // document.getElementById("ibge").value = "";
}

function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById("logradouro").value =
      conteudo.logradouro;
    document.getElementById("bairro").value =
      conteudo.bairro;
    document.getElementById("cidade").value =
      conteudo.localidade;
    document.getElementById("estado").value =
      conteudo.uf;
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
      document.getElementById("logradouro").value =
        "...";
      document.getElementById("bairro").value = "...";
      document.getElementById("cidade").value = "...";
      document.getElementById("estado").value = "...";
      //document.getElementById("ibge").value = "...";

      //Cria um elemento javascript.
      var script = document.createElement("script");

      //Sincroniza com o callback.
      script.src =
        "https://viacep.com.br/ws/" +
        cep +
        "/json/?callback=meu_callback";

      //Insere script no documento e carrega o conteúdo.
      document.body.appendChild(script);
    } //end if.
    else {
      //cep é inválido.
      limpa_formulário_cep();
      alert("Formato de CEP inválido.");
    }
  } //end if.
  else {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep();
  }
}
</script>