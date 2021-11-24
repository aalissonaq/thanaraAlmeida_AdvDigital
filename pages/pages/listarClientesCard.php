<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 style="font-family:'Advent Pro', sans-serif; font-weight: 400; color: #532317">Clientes</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif;">
          <li class="breadcrumb-item"><a href="inicio.php"><i class="mdi mdi-home-outline fa fa-fw"></i>Inicio</a></li>
          <li class="breadcrumb-item active"><i class="mdi mdi-account-outline fa fa-fw"></i>Clientes</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <!--
      <h3 class="card-title" style="font-family:'Advent Pro', sans-serif; letter-spacing: 1px;">Lista de Clientes
      </h3>
      -->
      <div class="card-tools">
        <a href="" class="btn btn-tool text-primary" data-toggle="modal" data-target="#modal-novoUsuario" style="font-family:'Advent Pro', sans-serif; font-weight: bold; font-size: 1rem; letter-spacing: 1px;">

          <i class="fa fa-plus-square fa-fw fa-2x"></i>
          Novo Clientes
        </a>

      </div>
    </div>
    <div class="card-body">

      <!-- Usuários Card -->
      <div class="row d-flex align-items-stretch">
        <?php
        $log['tipyActionLog'] = 'Listar';
        $log['userActionLog'] = $_SESSION['USUARIO'];
        $log['actionLog'] = "Listou todos os clientes";
        inseir('logs', $log);

        $cont = 0;
        $ler = ler("vw_pessoa_cliente", '', "ORDER BY nmPessoa ASC");
        $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
        foreach ($listar as $dados) {
          $cont = $cont + 1;

        ?>
          <div class=" col-12  col-sm-6 col-md-4 d-flex align-items-stretch ">
            <div class="card bg-light ">
              <div class="card-header text-muted border-bottom-0 min-vw-100">
                <!-- Digital Strategist -->
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h1 class="lead h1 text-primary" style="font-family:'Advent Pro', sans-serif; font-weight: bold; ; font-size: 1.5rem;text-transform: uppercase;"><b>
                        <?php
                        if ($dados['nmPessoaSocial'] == '') {
                          $nome =  explode(' ', $dados['nmPessoa']);
                          if (strlen($nome[1]) > 2) {
                            echo $nome[0] . " " . $nome[1];
                          } else {
                            echo $nome[0] . " " . $nome[1] . " " . $nome[2];
                          }
                        } else {
                          echo $dados['nmPessoaSocial'];
                        }

                        ?>
                      </b></h1>
                    <p class="lead text-navy" style="font-size:
                    .96rem; text-transform: uppercase;">
                      <?= $dados['nmPessoa'] ?>
                    </p>
                    <hr style="margin-top:-.9rem" />
                    <!-- <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                    -->
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small">
                        <span class="fa-li">
                          <i class="fas fa-lg fa-building"></i>
                        </span>
                        <?= $dados['stLogradouroPessoa'] . ", " . $dados['nnCasaPessoa'] . " - " . $dados['stBairroPessoa'] . " <br/> " . $dados['stCidadePessoa'] . "-" . $dados['stEstadoPessoa'] . "<br/> CEP:" . $dados['stCepPessoa'] ?>
                      </li>
                      <li class="small">
                        <span class="fa-li">
                          <i class="fas fa-lg fa-phone"></i></span>
                        <?= $dados['nnTelefonePessoa'] ?>
                      </li>

                      <?php
                      if (!$dados['nnWhatsappPessoa']) {
                      } else {
                      ?>
                        <li class="small">
                          <span class="fa-li">
                            <i class="fab fa-lg fa-whatsapp text-success"></i></span>

                          <a href="https://api.whatsapp.com/send?phone=55<?= tiraMascara($dados['nnWhatsappPessoa']) ?>&text=Ol%C3%A1%20<?= urlencode($dados['nmPessoa']); ?>%2C%20temos%20novidades%20sobre%20seu%20processo.%20%20" class="text-success" target="_blank" title="Enviar WhatsApp">

                            <?= $dados['nnWhatsappPessoa'] ?>
                          </a>

                        </li>
                      <?php } ?>
                      <li class="small">
                        <span class="fa-li">
                          <i class="far fa-lg fa-envelope"></i></span>
                        <?= $dados['stEmailPessoa']; ?>
                      </li>
                    </ul>
                  </div>
                  <div class="col-5 text-center aligh">
                    <img src="
                    <?php
                    if ($dados['foto']) {
                      echo "./upload/fotoPessoas/{$dados['foto']}";
                    } else {
                      echo "./upload/fotoPessoas/default.png";
                    } ?>" alt="
                  <?php echo $dados['nmPessoa'] ?>" class="img-circle img-fluid shadow " style="width:10rem; height:10rem; object-fit: cover;" />
                    <a class="btn btn-tool text-warning" href="" data-toggle="modal" data-target="#modal-edtFoto" data-id="<?= $dados['idPessoaCliente'] ?>" onclick="setaDadosModal(<?= $dados['idPessoaCliente'] ?> )" style="z-index: 9; top:-20px;" title="Mudar foto">
                      <i class="mdi mdi-camera-flip-outline "></i>

                    </a>
                    <!-- MODAL EDITAR FOTO -->
                    <div class="modal fade" id="modal-edtFoto">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; color:#C77129">
                              Trocar Foto</h4>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- form novo Usuário -->

                            <form class="needs-validation" novalidate action="./pages/pages/acoes/editarFoto.php" method="POST" enctype="multipart/form-data">

                              <input type="hidden" name="idPessoa" id="idPessoa" value="">
                              <input type="hidden" name="nomePessoa" id="nomePessoa" value="<?= $dados['nmPessoa']; ?>">

                              <div class="form-row">
                                <div class="col-md-12 mb-3">
                                  <label for="foto">Foto/Logo do Cliente <span class="text-orange">*</span>

                                  </label>
                                  <input type="file" name="foto" class="form-control-lg text-uppercase" id="foto" placeholder="">
                                  <div class="invalid-feedback">
                                    Obrigatório !
                                  </div>
                                </div>

                              </div>

                          </div>
                          <div class="modal-footer justify-content-between">

                            <input type="hidden" name="userActionLog" value="<?php echo $_SESSION['USUARIO']; ?>" />
                            <input type="hidden" name="gravar" value="gravar" />
                            <button type="button" class="btn btn-outline-danger btn-lg" data-dismiss="modal">
                              <i class="fas fa-times fa-fw fa-lg"></i>
                              Fechar </button>
                            <button class="btn btn-success btn-lg" type="submit">
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
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="offset-md-6 col-md-6 col-sm-12">
                  <div class="text-right d-flex justify-content-around align-items-center">

                    <?php
                    switch ($_SESSION['NIVEL']) {
                      case '0':
                        include '_includes/_toolsClientes.root.php';
                        break;


                      default:
                        include '_includes/_toolsClientes.default.php';
                        break;
                    }
                    ?>
                    <!--
                  <a href="#" class="btn btn-sm btn-primary">
                    <i class="fas fa-user"></i> 'Ver' Perfil
                  </a>
                -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
      <!-- Final Usuarios Card -->

    </div>
    <!-- /.card-body -->

    <!-- /.card-footer-->
  </div>

  <!-- /.card -->
  <br />
</section>
<!-- /.content -->

<!-- MODAL NOVO -->
<div class="modal fade" id="modal-novoUsuario">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-primary" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; ">Novo
          Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->
        <form class="needs-validation" novalidate action="./pages/pages/acoes/gravaNovoCliente.php" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="col-md-6 mb-3 ">
              <label for="nmPessoa">Nome do Cliente <span class="text-orange">*</span></label>
              <input type="text" name="nmPessoa" class="form-control text-uppercase  " id="nmPessoa" placeholder="Nome do Cliente" value="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-4 mb-3 ">
              <label for="nmPessoaSocial">Nome Social / Apelido / Nome fantasia </label>
              <input type="text" name="nmPessoaSocial" class="form-control text-uppercase " id="nmPessoaSocial" placeholder="Nome Social / Apelido / Nome Fantasia" value="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="docPessoa">CPF <span class="text-orange"> *</span></label>
              <input type="text" name="docPessoa" class="form-control text-uppercase js_cpf" id="docPessoa" placeholder="Somente Números" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-2 mb-3">
              <label for="dtNascPessoa">Data de Nascimento<span class="text-orange"> *</span></label>
              <input type="text" name="dtNascPessoa" class="form-control text-uppercase js_data dtNascPessoa" onblur="Idade();" id="dtNascPessoa" placeholder="dd/mm/yyyy" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-2 mb-3">
              <label for="sexoCliente">Sexo<span class="text-orange"> *</span></label>
              <select class="form-control text-uppercase" required name="sexoCliente" id="sexoCliente">
                <option value="" selected disabled> Sexo</option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Não Infomado">Não Informado</option>
              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <label for="strEstadoCivilCliente">Estado Civil <span class="text-orange"> *</span></label>
              <select class="form-control text-uppercase" required name="strEstadoCivilCliente" id="strEstadoCivilCliente">
                <option value="Solteiro">Solteiro</option>
                <option value="Casado">Casado</option>
                <option value="Viúvo">Viúvo</option>
                <option value="Separado judicialme">Separado judicialme</option>
                <option value="Divorciado">Divorciado</option>
                <option value="Não Informado">Não Informado</option>
              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="strNaturalidadeCliente">Naturalidade<span class="text-orange"> *</span></label>
              <input type="text" name="strNaturalidadeCliente" class="form-control text-uppercase" id="strNaturalidadeCliente" placeholder="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-2 mb-3">
              <label for="nnRg">C. Identidade</label>
              <input type="number" name="nnRg" class="form-control text-uppercase" id="nnRg" placeholder="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="nmMae">Nome da Mãe<span class="text-orange"> *</span></label>
              <input type="text" required name="nmMae" class="form-control text-uppercase" id="nmMae" placeholder="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="nmPai">Nome da Pai</label>
              <input type="text" name="nmPai" class="form-control text-uppercase" id="nmPai" placeholder="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

          </div>
          <!-- CONTATOS -->

          <fieldset>
            <legend>
              <p class="lead text-primary" style="font-family:'Advent Pro', sans-serif; font-weight: bold; ">
                DADOS DE ENDEREÇO
              </p>
            </legend>
          </fieldset>

          <div class="form-row">
            <div class="col-md-2 mb-3">
              <label for="stCepPessoa">CEP</label>
              <input type="text" name="stCepPessoa" class="form-control text-uppercase js_cep" id="stCepPessoa" size="10" maxlength="9" onblur="pesquisacep(this.value)" placeholder="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-8 mb-3">
              <label for="stLogradouroPessoa">Endereço<span class="text-orange"> *</span> </label>
              <input type="text" name="stLogradouroPessoa" class="form-control text-uppercase" id="stLogradouroPessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="nnCasaPessoa">Nº<span class="text-orange"> *</span></label>
              <input type="number" name="nnCasaPessoa" class="form-control text-uppercase" id="nnCasaPessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

          </div>
          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label for="stCompleEndPessoa">Complemento</label>
              <input type="text" name="stCompleEndPessoa" class="form-control text-uppercase" id="stCompleEndPessoa" placeholder="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <label for="stBairroPessoa">Bairro<span class="text-orange"> *</span></label>
              <input type="text" name="stBairroPessoa" class="form-control text-uppercase" id="stBairroPessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="stCidadePessoa">Cidade<span class="text-orange"> *</span></label>
              <input type="text" name="stCidadePessoa" class="form-control text-uppercase" id="stCidadePessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-1 mb-3">
              <label for="stEstadoPessoa">UF<span class="text-orange"> *</span></label>
              <input type="text" name="stEstadoPessoa" maxlength="2" class="form-control text-uppercase" id="stEstadoPessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>

          <fieldset>
            <legend>
              <h1 class="lead text-primary" style="font-family:'Advent Pro', sans-serif; font-weight: bold;">
                DADOS DE CONTATOS
              </h1>
            </legend>
          </fieldset>

          <div class="form-row">
            <div class="col-md-3 mb-3">
              <label for="nnTelefonePessoa">Telefone<span class="text-orange"> *</span></label>
              <input type="text" name="nnTelefonePessoa" class="form-control text-uppercase js_fone" id="nnTelefonePessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="nnWhatsappPessoa">Whataspp</label>
              <input type="text" name="nnWhatsappPessoa" class="form-control text-uppercase js_fone" id="nnWhatsappPessoa" placeholder="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="stEmailPessoa">E-Mail</label>
              <input type="email" name="stEmailPessoa" class="form-control" id="stEmailPessoa" placeholder="">
              <div class="invalid-feedback">
                Obrigatório e deve seguir o padrão de E-maio(text@provedor.com...) !
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="nnTelefonePessoa">Foto/Logo do Cliente <span class="text-orange"> *</span></label>
              <input type="file" name="imgCliente" class="form-control text-uppercase" id="imgCliente" placeholder="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="idRespCadastroCliente" value="<?= $_SESSION['ID']; ?>" />
        <input type="hidden" name="userActionLog" value="<?php echo $_SESSION['USUARIO']; ?>" />
        <input type="hidden" name="gravar" value="gravar" />
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
          Fechar </button>
        <button class="btn btn-success btn-lg" type="submit">
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




<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
</script>

<script src="./dist/js/app.js"></script>

<script>
  function setaDadosModal(valor) {
    document.getElementById('idPessoa').value = valor;

  }
</script>

<script>
  //document.getElementById('gestaoMenu').classList.add("menu-open");
  //document.getElementById('gestaoMenuActive').classList.add("active");
  document.getElementById('menuClientes').classList.add("active");




  // DATATABLE
  // $(".table").DataTable({
  // responsive: true,
  // bLengthChange: false,
  // pageLength: 20,
  // bInfo: true,
  // bFilter: true,
  // bSort: false,
  // language: {
  // url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
  // }
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
