<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cliente</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Cliente</li>
          <li class="breadcrumb-item active">Edição de Dados do Cliente</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <?php
  $idEdit = $_GET['idEdit'];
  $dadosPessoa = ler("vw_pessoa_cliente", '', "WHERE idPassoaPessoa = '{$idEdit}'")->fetchAll(PDO::FETCH_ASSOC);
  foreach ($dadosPessoa as $dpaciente) {
  ?>

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Editar o Cliente:
        <small class="lead text-primary text-uppercase"><?= $dpaciente['nmPessoa']; ?></small>
      </h3>

      <div class="card-tools">
        <a href="?page=listarClientes" class="btn btn-tool text-primary">
          <!-- <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i> -->
          <i class="mdi mdi-arrow-left-bold-circle-outline fa fa-2x align-middle"></i>
          Voltar para Lista de Cliente
        </a>
      </div>
    </div>
    <div class="card-body">

      <form class="needs-validation" novalidate action="pages/pages/acoes/editarCliente.php" method="POST"
        enctype="multipart/form-data">

        <input type="hidden" name="idEdit" value="<?= $_GET['idEdit']; ?>">
        <div class="form-row">
          <div class="col-md-9 mb-3 ">
            <label for="nmPessoa">Nome do Paciente</label>
            <input type="text" name="nmPessoa" class="form-control text-uppercase  " id="nmPessoa"
              placeholder="Nome do Paciente" value="<?= $dpaciente['nmPessoa']; ?>" required>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="docPessoa">CPF</label>
            <input type="text" name="docPessoa" class="form-control text-uppercase js_cpf" id="docPessoa"
              placeholder="Somente Números" value="<?= $dpaciente['docPessoa']; ?>">
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-2 mb-3">
            <label for="dtNascPessoa">Data de Nascimento</label>
            <input type="text" name="dtNascPessoa" class="form-control text-uppercase js_data dtNascPessoa"
              onblur="Idade();" id="dtNascPessoa" placeholder="dd/mm/yyyy" value="<?= $dpaciente['dtNascPessoa']; ?>"
              required>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

          <div class="col-md-1 mb-3">
            <label for="sexoPaciente">Sexo</label>
            <select class="form-control text-uppercase" required name="sexoPaciente" id="sexoPaciente">
              <?php
                switch ($dpaciente['sexoPaciente']) {
                  case 'Masculino':
                    echo '<option value="Masculino" selected>M</option>
                                              <option value="Feminino">F</option>';
                    break;

                  default:
                    echo '<option value="Masculino" >M</option>
                                <option value="Feminino" selected>F</option>';
                    break;
                }
                ?>


            </select>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <label for="strEstadoCivilPaciente">Estado Civil</label>
            <select class="form-control text-uppercase" required name="strEstadoCivilPaciente"
              id="strEstadoCivilPaciente">
              <?php
                switch ($dpaciente['strEstadoCivilPaciente']) {
                  case 'Solteiro':
                    echo '
                                    <option value="Solteiro" selected>Solteiro</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Viúvo">Viúvo</option>
                                    <option value="Separado judicialme">Separado judicialme</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Não Informado">Não Informado</option>
                                   ';
                    break;
                  case 'Casado':
                    echo '
                                    <option value="Solteiro" >Solteiro</option>
                                    <option value="Casado" selected>Casado</option>
                                    <option value="Viúvo">Viúvo</option>
                                     <option value="Separado judicialme">Separado judicialme</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Não Informado">Não Informado</option>
                                   ';
                    break;
                  case 'Viúvo':
                    echo '
                                    <option value="Solteiro" >Solteiro</option>
                                    <option value="Casado" >Casado</option>
                                    <option value="Viúvo" selected>Viúvo</option>
                                     <option value="Separado judicialme">Separado judicialme</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Não Informado">Não Informado</option>
                                   ';
                    break;
                  case 'Separado judicialme':
                    echo '
                                    <option value="Solteiro" >Solteiro</option>
                                    <option value="Casado" >Casado</option>
                                    <option value="Viúvo" >Viúvo</option>
                                     <option value="Separado judicialme" selected>Separado judicialme</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Não Informado">Não Informado</option>
                                   ';
                    break;
                  case 'Divorciado':
                    echo '
                                    <option value="Solteiro" >Solteiro</option>
                                    <option value="Casado" >Casado</option>
                                    <option value="Viúvo" >Viúvo</option>
                                     <option value="Separado judicialme" >Separado judicialme</option>
                                    <option value="Divorciado" selected>Divorciado</option>
                                    <option value="Não Informado">Não Informado</option>
                                   ';
                    break;

                  default:
                    echo '
                                <option value="Solteiro" >Solteiro</option>
                                <option value="Casado" >Casado</option>
                                <option value="Viúvo" >Viúvo</option>
                                 <option value="Separado judicialme" >Separado judicialme</option>
                                <option value="Divorciado" >Divorciado</option>
                                <option value="Não Informado"selected>Não Informado</option>
                               ';
                    break;
                }
                ?>


            </select>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <label for="strNaturalidadePaciente">Naturalidade</label>
            <input type="text" name="strNaturalidadePaciente" class="form-control text-uppercase"
              id="strNaturalidadePaciente" value="<?= $dpaciente['strNaturalidadePaciente']; ?>" placeholder="">
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

          <div class="col-md-2 mb-3">
            <label for="nnRg">C. Identidade</label>
            <input type="number" name="nnRg" class="form-control text-uppercase" id="nnRg" placeholder=""
              value="<?= $dpaciente['nnRg']; ?>">
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>


          <div class="col-md-12 mb-3">
            <label for="nmMae">Nome da Mãe</label>
            <input type="text" required name="nmMae" class="form-control text-uppercase" id="nmMae" placeholder=""
              value="<?= $dpaciente['nmMae']; ?>">
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="nmPai">Nome da Pai</label>
            <input type="text" name="nmPai" class="form-control text-uppercase" id="nmPai" placeholder=""
              value="<?= $dpaciente['nmPai']; ?>">
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

        </div>
        <!-- CONTATOS -->

        <fieldset>
          <legend>
            <h1 class="lead text-orange">
              DADOS DE ENDEREÇO
            </h1>
          </legend>
        </fieldset>

        <div class="form-row">
          <div class="col-md-2 mb-3">
            <label for="stCepPessoa">CEP</label>
            <input type="text" name="stCepPessoa" class="form-control text-uppercase js_cep" id="stCepPessoa"
              placeholder="" value="<?= $dpaciente['stCepPessoa']; ?>">
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

          <div class="col-md-8 mb-3">
            <label for="stLogradouroPessoa">Endereço</label>
            <input type="text" name="stLogradouroPessoa" class="form-control text-uppercase" id="stLogradouroPessoa"
              placeholder="" value="<?= $dpaciente['stLogradouroPessoa']; ?>" required>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-2 mb-3">
            <label for="nnCasaPessoa">Nº</label>
            <input type="number" name="nnCasaPessoa" class="form-control text-uppercase" id="nnCasaPessoa"
              placeholder="" value="<?= $dpaciente['nnCasaPessoa']; ?>" required>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

        </div>
        <div class="form-row">
          <div class="col-md-5 mb-3">
            <label for="stCompleEndPessoa">Complemento</label>
            <input type="text" name="stCompleEndPessoa" class="form-control text-uppercase" id="stCompleEndPessoa"
              placeholder="" value="<?= $dpaciente['stCompleEndPessoa']; ?>">
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label for="stBairroPessoa">Bairro</label>
            <input type="text" name="stBairroPessoa" class="form-control text-uppercase" id="stBairroPessoa"
              placeholder="" value="<?= $dpaciente['stBairroPessoa']; ?>" required>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-1 mb-3">
            <label for="stEstadoPessoa">UF</label>
            <input type="text" name="stEstadoPessoa" maxlength="2" class="form-control text-uppercase"
              id="stEstadoPessoa" placeholder="" value="<?= $dpaciente['stEstadoPessoa']; ?>" required>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
        </div>

        <fieldset>
          <legend>
            <h1 class="lead text-orange">
              DADOS DE CONTATOS
            </h1>
          </legend>
        </fieldset>

        <div class="form-row">
          <div class="col-md-3 mb-3">
            <label for="nnTelefonePessoa">Telefone</label>
            <input type="text" name="nnTelefonePessoa" class="form-control text-uppercase js_fone" id="nnTelefonePessoa"
              placeholder="" value="<?= $dpaciente['nnTelefonePessoa']; ?>" required>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="nnWhatsappPessoa">Whataspp</label>
            <input type="text" name="nnWhatsappPessoa" class="form-control text-uppercase js_fone" id="nnWhatsappPessoa"
              placeholder="" value="<?= $dpaciente['nnWhatsappPessoa']; ?>">
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="stEmailPessoa">E-Mail</label>
            <input type="email" name="stEmailPessoa" class="form-control" id="stEmailPessoa" placeholder=""
              value="<?= $dpaciente['stEmailPessoa']; ?>">
            <div class="invalid-feedback">
              Obrigatório e deve seguir o padrão de E-maio(text@provedor.com...) !
            </div>
          </div>
        </div>

    </div>
    <div class="modal-footer justify-content-between">
      <input type="hidden" name="gravar" value="gravar">

      <a href="?page=listarClientes" class="btn btn-danger">
        <i class="mdi mdi-trash-can-outline fa fa-fw fa-lg"></i>
        Cancelar</a>
      <button class="btn btn-primary" type="submit">
        <i class="far fa-save fa-fw fa-lg"></i>
        Gravar Dados</button>
      </form>


    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <!-- Footer -->
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
//document.getElementById('gestaoMenu').classList.add("menu-open");
//document.getElementById('gestaoMenuActive').classList.add("active");
document.getElementById('menuCliente').classList.add("active");

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
