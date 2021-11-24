<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">Cliente</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif;">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Cliente</li>
          <li class="breadcrumb-item active">Ver de Dados do Cliente</li>
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
  ?>
    <div class="d-none d-print-block col-md-12 mb-1 backgroundColor=""#004455">
      <center>
        <img src="./image/LOGO_LIGHT.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} col-md-4 mb-3" alt="" />
      </center>
      <br />
      <!-- <span class="lead">Sistema de Gerenciamento de Parceiros</span> -->
      <hr color="#004455" class="container-fluid" />
    </div>

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h2 class="card-titletext-uppercase" style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">Dados do Cliente&nbsp
          <small class="lead text-orange text-uppercase">
            <?php //$dcliente['nmPessoa'];
            ?></small>
        </h2>

        <div class="card-tools">
          <a href="?page=listarClientes" class="btn btn-tool text-orange d-print-none">
            <!-- <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i> -->
            <i class="mdi mdi-arrow-left-bold-circle-outline fa fa-2x align-middle "></i>
            Voltar para Lista de Cliente
          </a>
        </div>
      </div>
      <div class="card-body">

        <input type="hidden" name="idEdit" value="<?= $_GET['idEdit']; ?>">

        <div class="form-row">
          <div class="col-md-10 mb-3 ">
            <div class="form-row">
              <div class="col-md-7 mb-3 ">
                <label for="nmPessoa">Nome do Cliente</label>
                <br />
                <span class="lead" style="text-transform: uppercase;"><?= $dcliente['nmPessoa']; ?></span>
              </div>

              <div class="col-md-3 mb-3">
                <label for="docPessoa">CPF</label>
                <br />
                <span class="lead"><?= MascaraCPF($dcliente['docPessoa']); ?></span>
              </div>
              <div class="col-md-1 mb-3 ">
                <label for="nmPessoa">Idade</label>
                <br />
                <span class="lead"><?= str_pad(calcIdade($dcliente['dtNascPessoa']), 2, "0", STR_PAD_LEFT); ?></span>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-2 mb-3">
                <label for="dtNascPessoa">Data de Nascimento</label>
                <br />
                <span class="lead text-uppercase "><?= $dcliente['dtNascPessoa']; ?></span>
              </div>

              <div class="col-md-2 mb-3">
                <label for="sexoPaciente">Sexo</label>
                <br />
                <span class="lead text-uppercase"><?= $dcliente['sexoCliente'] ?></span>
              </div>

              <div class="col-md-2 mb-3">
                <label for="strEstadoCivilCliente">Estado Civil</label>
                <br />
                <span class="lead text-uppercase"><?= $dcliente['strEstadoCivilCliente'] ?></span>
              </div>

              <div class=" col-md-4 mb-3">
                <label for="strNaturalidadeCliente">Naturalidade</label>
                <br />
                <span class="lead text-uppercase"><?= $dcliente['strNaturalidadeCliente']; ?></span>
              </div>

              <div class="col-md-2 mb-3">
                <label for="nnRg">C. Identidade</label>
                <br />
                <spen class="lead"><?= $dcliente['nnRg']; ?></spen>
              </div>

              <div class="col-md-12 mb-3">
                <label for="nmMae ">Nome da Mãe</label>
                <br />
                <span class="lead text-uppercase"><?= $dcliente['nmMae']; ?></span>
              </div>
              <div class="col-md-12 mb-3">
                <label for="nmPai">Nome da Pai</label>
                <br />
                <span class="lead text-uppercase"><?= $dcliente['nmPai']; ?></span>
              </div>

            </div>
          </div>
          <div class="col-md-2 mb-3 ">
            <div class="d-flex flex-row-reverse">
              <div class=" text-center">
                <img src="
                    <?php
                    if ($dcliente['imgCliente']) {
                      echo "./upload/imgClientes/{$dcliente['imgCliente']}";
                    } else {
                      echo "./upload/imgClientes/default.png";
                    }
                    ?>" alt="<?php echo $dcliente['nmPessoa'] ?>" class=" img-fluid img-thumbnail">
              </div>
            </div>
          </div>
        </div>

        <!-- CONTATOS -->

        <fieldset>
          <legend>
            <p class="lead" style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">
              DADOS DE ENDEREÇO
            </p>
          </legend>
        </fieldset>

        <div class="form-row">
          <div class="col-md-2 mb-3">
            <label for="stCepPessoa">CEP</label>
            <br />
            <span class="lead"><?= $dcliente['stCepPessoa']; ?></span>
          </div>

          <div class="col-md-8 mb-3">
            <label for="stLogradouroPessoa">Endereço</label>
            <br />
            <span class="lead text-uppercase"><?= $dcliente['stLogradouroPessoa']; ?></span>
          </div>
          <div class="col-md-2 mb-3">
            <label for="nnCasaPessoa">Nº</label>
            <br />
            <span class="lead text-uppercase"><?= $dcliente['nnCasaPessoa']; ?></span>
          </div>

        </div>
        <div class="form-row">
          <div class="col-md-5 mb-3">
            <label for="stCompleEndPessoa">Complemento</label>
            <br />
            <span class="lead text-uppercase"><?= $dcliente['stCompleEndPessoa']; ?></span>
          </div>

          <div class="col-md-6 mb-3">
            <label for="stBairroPessoa">Bairro</label>
            <br />
            <span class="lead text-uppercase"><?= $dcliente['stBairroPessoa']; ?></span>
          </div>
          <div class="col-md-1 mb-3">
            <label for="stEstadoPessoa">UF</label>
            <br />
            <span class="lead text-uppercase"><?= $dcliente['stEstadoPessoa']; ?></span>
          </div>
        </div>

        <fieldset>
          <legend>
            <p class="lead" style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">
              DADOS DE CONTATOS
            </p>
          </legend>
        </fieldset>

        <div class="form-row">
          <div class="col-md-3 mb-3">
            <label for="nnTelefonePessoa">Telefone</label>
            <br />
            <span class="lead text-uppercase"><?= $dcliente['nnTelefonePessoa']; ?></span>
          </div>
          <div class="col-md-3 mb-3">
            <label for="nnWhatsappPessoa">Whataspp</label>
            <br />
            <span class="lead text-uppercase"><?= $dcliente['nnWhatsappPessoa']; ?></span>
          </div>
          <div class="col-md-6 mb-3">
            <label for="stEmailPessoa">E-Mail</label>
            <br />
            <span class="lead text-lowercase"><?= $dcliente['stEmailPessoa']; ?></span>
          </div>
        </div>

      </div>

      <!-- /.card-body -->
      <div class="card-footer">
        <!-- Footer -->
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
  <?php }
  ?>
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
