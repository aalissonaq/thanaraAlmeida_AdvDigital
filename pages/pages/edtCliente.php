<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">Clientes</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif;">
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
  foreach ($dadosPessoa as $dCliente) {
  ?>

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title" style="font-family:'Advent Pro', sans-serif; font-size: 20px; font-weight: bold; color: #C77129">Editar o Cliente:
          <small class="lead text-primary text-uppercase" style="font-family:'Advent Pro', sans-serif;"><?= $dCliente['nmPessoa']; ?></small>
        </h3>

        <div class="card-tools">
          <a href="?page=listarClientes" class="btn btn-tool text-orange">
            <!-- <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i> -->
            <i class="mdi mdi-arrow-left-bold-circle-outline fa fa-2x align-middle"></i>
            Voltar para Lista de Cliente
          </a>
        </div>
      </div>
      <div class="card-body">

        <form class="needs-validation" novalidate action="pages/pages/acoes/editarCliente.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="idEdit" value="<?= $idEdit ?>" />
          <input type="hidden" name="userActionLog" value="<?= $_SESSION['USUARIO'] ?>" />
          <div class="modal-body">
            <!-- form novo Usuário -->
            <div class="form-row">
              <div class="col-md-6 mb-3 ">
                <label for="nmPessoa">Nome do Cliente <span class="text-orange">*</span></label>
                <input type="text" name="nmPessoa" class="form-control text-uppercase  " id="nmPessoa" placeholder="Nome do Cliente" value="<?= $dCliente['nmPessoa']; ?>" required>
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>
              <div class="col-md-4 mb-3 ">
                <label for="nmPessoaSocial">Nome Social / Apelido / Nome fantasia </label>
                <input type="text" name="nmPessoaSocial" class="form-control text-uppercase  " id="nmPessoaSocial" placeholder="Nome Social / Apelido / Nome Fantasia" value="<?= $dCliente['nmPessoaSocial']; ?>">
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>
              <div class="col-md-2 mb-3">
                <label for="docPessoa">CPF <span class="text-orange"> *</span></label>
                <input type="text" name="docPessoa" class="form-control text-uppercase js_cpf" id="docPessoa" placeholder="Somente Números" required value="<?= $dCliente['docPessoa']; ?>">
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-2 mb-3">
                <label for="dtNascPessoa">Data de Nascimento<span class="text-orange""> *</span></label>
                  <input type=" text" name="dtNascPessoa" class="form-control text-uppercase js_data dtNascPessoa" onblur="Idade();" id="dtNascPessoa" placeholder="dd/mm/yyyy" required value="<?= $dCliente['dtNascPessoa']; ?>">
                    <div class="invalid-feedback">
                      Obrigatório !
                    </div>
              </div>

              <div class="col-md-2 mb-3">
                <label for="sexoCliente">Sexo<span class="text-orange""> *</span></label>
                  <select class=" form-control text-uppercase" required name="sexoCliente" id="sexoCliente">

                    <?php
                    switch ($dCliente['sexoCliente']) {
                      case 'Masculino':

                        echo "
                      <option value=\"Masculino\" selected>Masculino</option>
                      <option value=\"Feminino\">Feminino</option>
                      <option value=\"Não Infomado\">Não Informado</option>
                      ";
                        break;
                      case 'Feminino':

                        echo "
                      <option value=\"Masculino\" >Masculino</option>
                      <option value=\"Feminino\" selected>Feminino</option>
                      <option value=\"Não Infomado\">Não Informado</option>
                      ";
                        break;
                      default:
                        echo "
                      <option value=\"Masculino\" >Masculino</option>
                      <option value=\"Feminino\" >Feminino</option>
                      <option value=\"Não Infomado\" selected>Não Informado</option>
                      ";
                        break;
                    }
                    ?>
                    </select>
                    <div class="invalid-feedback">
                      Obrigatório !
                    </div>
              </div>

              <div class="col-md-3 mb-3">
                <label for="strEstadoCivilCliente">Estado Civil</label>
                <select class="form-control text-uppercase" required name="strEstadoCivilCliente" id="strEstadoCivilCliente">
                  <?php
                  switch ($dCliente['strEstadoCivilCliente']) {
                    case 'Solteiro':
                      echo "
    <option value=\"Solteiro\" selected>Solteiro</option>
    <option value=\"Casado\">Casado</option>
    <option value=\"Divorciado\">Divorciado</option>
    <option value=\"Viúvo\">Viúvo</option>
    <option value=\"Separado\">Separado</option>
    <option value=\"Não Informado\">Não Informado</option>
    ";
                      break;

                    case 'Casado':
                      echo "
    <option value=\"Solteiro\">Solteiro</option>
    <option value=\"Casado\" selected>Casado</option>
    <option value=\"Divorciado\">Divorciado</option>
    <option value=\"Viúvo\">Viúvo</option>
    <option value=\"Separado\">Separado</option>
    <option value=\"Não Informado\">Não Informado</option>
    ";
                      break;

                    case 'Divorciado':
                      echo "
    <option value=\"Solteiro\">Solteiro</option>
    <option value=\"Casado\">Casado</option>
    <option value=\"Divorciado\" selected>Divorciado</option>
    <option value=\"Viúvo\">Viúvo</option>
    <option value=\"Separado\">Separado</option>
    <option value=\"Não Informado\">Não Informado</option>
    ";
                      break;

                    case 'Viúvo':
                      echo "
    <option value=\"Solteiro\">Solteiro</option>
    <option value=\"Casado\">Casado</option>
    <option value=\"Divorciado\">Divorciado</option>
    <option value=\"Viúvo\" selected>Viúvo</option>
    <option value=\"Separado\">Separado</option>
    <option value=\"Não Informado\">Não Informado</option>
    ";
                      break;

                    case 'Separado':
                      echo "
    <option value=\"Solteiro\">Solteiro</option>
    <option value=\"Casado\">Casado</option>
    <option value=\"Divorciado\">Divorciado</option>
    <option value=\"Viúvo\">Viúvo</option>
    <option value=\"Separado\" selected>Separado</option>
    <option value=\"Não Informado\">Não Informado</option>
    ";
                      break;
                    default:
                      echo "
    <option value=\"Solteiro\">Solteiro</option>
    <option value=\"Casado\">Casado</option>
    <option value=\"Divorciado\">Divorciado</option>
    <option value=\"Viúvo\">Viúvo</option>
    <option value=\"Separado\">Separado</option>
    <option value=\"Não Informado\" selected>Não Informado</option>
    ";
                      break;
                  }
                  ?>

                </select>
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>

              <div class="col-md-3 mb-3">
                <label for="strNaturalidadeCliente">Naturalidade<span class="text-orange"> *</span></label>
                <input type="text" name="strNaturalidadeCliente" value="<?= $dCliente['strNaturalidadeCliente']; ?>" class="form-control text-uppercase" id="strNaturalidadeCliente" placeholder="Ex: São Paulo" required>

                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>

              <div class="col-md-2 mb-3">
                <label for="nnRg">C. Identidade</label>
                <input type="number" name="nnRg" class="form-control text-uppercase" id="nnRg" value="<?= $dCliente['nnRg']; ?>" placeholder="Ex: 123456789">
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>


              <div class="col-md-12 mb-3">
                <label for="nmMae">Nome da Mãe<span class="text-orange"> *</span></label>
                <input type="text" required name="nmMae" value="<?= $dCliente['nmMae']; ?>" class="form-control text-uppercase" id="nmMae" placeholder="Ex: Maria da Silva">
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <label for="nmPai">Nome da Pai</label>
                <input type="text" name="nmPai" class="form-control text-uppercase" id="nmPai" value="<?= $dCliente['nmPai']; ?>" placeholder="Ex: João da Silva">
                <div class="invalid-feedback">
                  Obrigatório !
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
                <input type="text" name="stCepPessoa" class="form-control text-uppercase js_cep" id="stCepPessoa" size="10" maxlength="9" onblur="pesquisacep(this.value)" value="<?= $dCliente['stCepPessoa']; ?>" placeholder="Ex: 00000-000">

                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>

              <div class="col-md-8 mb-3">
                <label for="stLogradouroPessoa">Endereço<span class="text-orange"> *</span> </label>
                <input type="text" name="stLogradouroPessoa" class="form-control text-uppercase" id="stLogradouroPessoa" value="<?= $dCliente['stLogradouroPessoa']; ?>" placeholder="Ex: Rua João da Silva" required>
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>
              <div class="col-md-2 mb-3">
                <label for="nnCasaPessoa">Nº<span class="text-orange"> *</span></label>
                <input type="number" name="nnCasaPessoa" class="form-control text-uppercase" id="nnCasaPessoa" value="<?= $dCliente['nnCasaPessoa']; ?>" placeholder="Ex: 123" required>
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>

            </div>
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="stCompleEndPessoa">Complemento</label>
                <input type="text" name="stCompleEndPessoa" class="form-control text-uppercase" id="stCompleEndPessoa" value="<?= $dCliente['stCompleEndPessoa']; ?>" placeholder="Ex: Apto. 101">
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <label for="stBairroPessoa">Bairro<span class="text-orange"> *</span></label>
                <input type="text" name="stBairroPessoa" class="form-control text-uppercase" id="stBairroPessoa" value="<?= $dCliente['stBairroPessoa']; ?>" placeholder="Ex: Centro" required>
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="stCidadePessoa">Cidade<span class="text-orange"> *</span></label>
                <input type="text" name="stCidadePessoa" class="form-control text-uppercase" id="stCidadePessoa" value="<?= $dCliente['stCidadePessoa']; ?>" placeholder="Ex: São Paulo" required>
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>
              <div class="col-md-1 mb-3">
                <label for="stEstadoPessoa">UF<span class="text-orange"> *</span></label>
                <input type="text" name="stEstadoPessoa" maxlength="2" class="form-control text-uppercase" id="stEstadoPessoa" value="<?= $dCliente['stEstadoPessoa']; ?>" placeholder="Ex: SP" required>
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>
            </div>

            <fieldset>
              <legend>
                <h1 class="lead text-orange" style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">
                  DADOS DE CONTATOS
                </h1>
              </legend>
            </fieldset>

            <div class="form-row">
              <div class="col-md-3 mb-3">
                <label for="nnTelefonePessoa">Telefone<span class="text-orange"> *</span></label>
                <input type="text" name="nnTelefonePessoa" class="form-control text-uppercase js_fone" id="nnTelefonePessoa" value="<?= $dCliente['nnTelefonePessoa']; ?>" placeholder="Ex: (11) 99999-9999" required>
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="nnWhatsappPessoa">Whataspp</label>
                <input type="text" name="nnWhatsappPessoa" class="form-control text-uppercase js_fone" id="nnWhatsappPessoa" value="<?= $dCliente['nnWhatsappPessoa']; ?>" placeholder="Ex: (11) 99999-9999">
                <div class="invalid-feedback">
                  Obrigatório !
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="stEmailPessoa">E-Mail</label>
                <input type="email" name="stEmailPessoa" class="form-control" id="stEmailPessoa" value="<?= $dCliente['stEmailPessoa']; ?>" placeholder="Ex:email@provedor.com">
                <div class="invalid-feedback">
                  Obrigatório e deve seguir o padrão de E-maio(text@provedor.com...) !
                </div>
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="gravar" value="gravar">

        <a href="?page=listarClientes" class="btn btn-lg btn-outline-danger">
          <i class="mdi mdi-trash-can-outline fa fa-fw fa-lg"></i>
          Cancelar</a>
        <button class="btn btn-lg btn-primary" type="submit">
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

<script src="./dist/js/app.js"></script>
<script>
  //document.getElementById('gestaoMenu').classList.add("menu-open");
  //document.getElementById('gestaoMenuActive').classList.add("active");
  document.getElementById('menuClientes').classList.add("active");

  // DATATABLE
  // $(".table").DataTable({
  //   responsive: true,
  //   bLengthChange: false,
  //   pageLength: 20,
  //   bInfo: true,
  //   bFilter: true,
  //   bSort: false,
  //   language: {
  //     url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
  //   }
  // });

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
