<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 style="font-family:'Advent Pro', sans-serif; font-weight: 400; color: #C77129">Usuários do Sistema</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif;">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Usuários do Sistema</li>
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
      <!-- <h3 class="card-title">Lista de Usuários</h3> -->

      <div class="card-tools">
        <a href="" class="btn btn-tool text-orange" data-toggle="modal" data-target="#modal-novoUsuario" style="font-family:'Advent Pro', sans-serif; font-weight: bold; font-size: 1rem; letter-spacing: 1px;">
          <i class="fa fa-plus-square fa-fw fa-lg align-middle"></i>
          <!-- <i class="fa fa-user-plus fa-fw fa-lg"></i> -->
          Novo Usuário</a>
        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
            title="Collapse">
            <i class="fas fa-minus"></i>ttt</button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
            title="Remove">
            <i class="fas fa-times"></i></button> -->
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="tabela" class="table table-sm table-striped table-hover">
          <thead>
            <tr>
              <th class="col-md-auto text-center align-middle">&nbsp;</th>
              <th class="col-md-auto align-middle ">Nome</th>
              <th class="col-md-auto align-middle text-center">Nível</th>
              <th class="col-md-auto align-middle text-center">Status</th>
              <th class="col-md-auto align-middle text-center">
                <!-- <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i> -->
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cont = 0;
            $ler = ler("vw_pessoa_user", '', "WHERE nivelUser > 0 ORDER BY id ASC");
            $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
            foreach ($listar as $dados) {
              $idPessoa = $dados['idPessoaPessoa'];
              $nomePessoa = $dados['nmPessoa'];
              $cont = $cont + 1;
            ?>
              <tr>
                <td class="text-center align-middle">
                  <img src="
                    <?php
                    if ($dados['foto']) {
                      echo " ./upload/fotoPessoas/{$dados['foto']}";
                    } else {
                      echo "./upload/fotoPessoas/default.png";
                    } ?>" alt="
                  <?= $dados['nmPessoa'] ?>" class="profile-user-img img-fluid img-circle shadow " style="width:4rem; height:4rem; object-fit: cover;" />
                  <!-- str_pad($cont, 2, "0", STR_PAD_LEFT);  -->
                </td>
                <td class="text-uppercase align-middle"><?= $dados['nmPessoa']; ?></td>
                <td class="text-center text-uppercase align-middle">
                  <?php
                  switch ($dados['nivelUser']) {
                    case '0':
                      echo 'ROOT';
                      break;
                    case '1':
                      echo 'Administrador(a) do Sistema';
                      break;
                    case '2':
                      echo 'Secretário(a) / Atendente';
                      break;
                    case '3':
                      echo 'Advogado(a) / Parceiro(a)';
                      break;

                    default:
                      echo 'Não Definido';
                      break;
                  }
                  ?>
                </td>
                <td class="text-center text-uppercase align-middle">
                  <?php echo ($dados['flStatusUser'] == 1) ? "Ativo" : "Bloqueado"; ?>
                </td>
                <td class="align-middle">
                  <ul class="nav justify-content-center">
                    <?php
                    switch ($dados['nivelUser']) {
                      case '0':
                        // echo
                        "<li class=\"nav-item\">
                            <a href=\"?page=verUsuario&idEdit={$dados['idPessoaPessoa']}\" class=\"btn btn-tool\" target=\"\"
                            title=\"Ver Dados do Usuário\" rel=\"noopener noreferrer\">
                                <i class=\"far fa-eye fa-lg\"></i>
                            </a>
                          </li>

                          <li class=\"nav-item\">
                                <a href=\"?page=edtUsuario&idEdit={$dados['id']}\" class=\"btn btn-tool\" target=\"\"
                                title=\"Trocar Senha Usuário\" rel=\"noopener noreferrer\">
                                  <i class=\"mdi mdi-shield-key-outline fa fa-2x\"></i>
                                </a>
                              </li>
                          ";
                        break;

                      default:
                        //TESTE DE STATUS
                        if ($dados['flStatusUser'] == 1) {
                          $status = "<a href=\"?page=listarusuarios&acao=bloc&blocID={$dados['id']}\" class=\"btn btn-tool\"
  target=\"\" title=\"Bloquear Usuário\" rel=\"noopener noreferrer\">
  <!-- <i class=\"fas fa-check-circle fa-lg\"></i> -->
  <i class=\"mdi mdi-account-check-outline  fa fa-2x\"></i>
  </a>";
                        } else {
                          $status = "<a href=\"?page=listarusuarios&acao=unbloc&blocID={$dados['id']}\" class=\"btn btn-tool\"
  target=\"\" title=\"Desbloquar Usuário\" rel=\"noopener noreferrer\">
  <!-- <i class=\"fas fa-times-circle fa-lg\"></i> -->
  <i class=\"mdi mdi-account-lock-outline  fa fa-2x\"></i>
  </a>";
                        }

                        echo
                        "<li class=\"nav-item\">
                                <a href=\"?page=verUsuario&id={$dados['id']}\" class=\"btn btn-tool\" target=\"\"
                                title=\"Ver Dados\" rel=\"noopener noreferrer\">
                                  <i class=\"mdi mdi-file-eye-outline fa fa-2x\"></i>
                                </a>
                              </li>
                              <li class=\"nav-item\">
                                <a href=\"?page=edtUsuario&idEdit={$dados['id']}\" class=\"btn btn-tool\" target=\"\"
                                title=\"Editar\" rel=\"noopener noreferrer\">
                                  <!-- <i class=\"fas fa-pen fa-lg\"></i> -->
                                  <i class=\"mdi mdi-account-edit-outline  fa fa-2x\"></i>
                                </a>
                              </li>
                              <li class=\"nav-item\">
                                   {$status}
                              </li>

                              <li class=\"nav-item\">
                                    <a href=\"?page=edtPasswdUsuario&idEdit={$dados['id']}\" class=\"btn btn-tool\" target=\"\"
                                    title=\"Trocar Senha\" rel=\"noopener noreferrer\">
                                      <!-- <i class=\"fas fa-key fa-lg\"></i> -->
                                      <i class=\"mdi mdi-shield-key-outline fa fa-2x\"></i>
                                    </a>
                                  </li>
                              ";
                    ?>

                        <button data-toggle="modal" data-target="#modal-edtFoto" onclick="setaDadosModal(<?= $dados['idPessoaPessoa']; ?> )" class="btn btn-tool \" target="" title="Trocar Foto" rel="noopener noreferrer\">
                          <i class="mdi mdi-camera-flip-outline  fa fa-2x fa-fw align-middle"></i>
                        </button>

                    <?php
                        break;
                    }
                    ?>

                  </ul>

                  </ul>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <!-- Footer -->
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
  <br />
</section>
<!-- /.content -->

<!-- modal NOVO USUARIO -->
<div class="modal fade" id="modal-novoUsuario">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-orange" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px;">Novo Usuários do Sistema</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->

        <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovoUsuario.php" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="col-md-9 mb-3">
              <label for="nmPessoa">Nome do Usuário
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="nmPessoa" class="form-control text-uppercase" id="nmPessoa" placeholder="Nome do Usuário" value="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="docPessoa">CPF ou CNPJ
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="docPessoa" class="form-control text-uppercase cpfOuCnpj" id="docPessoa" placeholder="Somente Números" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-3 mb-3">
              <label for="dtNascPessoa">Data de Nasc./Criação
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="dtNascPessoa" class="form-control text-uppercase js_data" id="dtNascPessoa" placeholder="dd/mm/yyyy" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="stCepPessoa">CEP</label>
              <input type="text" name="stCepPessoa" class="form-control text-uppercase js_cep" id="stCepPessoa" placeholder="" onblur="pesquisacep(this.value)">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-5 mb-3">
              <label for="stLogradouroPessoa">Endereço
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="stLogradouroPessoa" class="form-control text-uppercase" id="stLogradouroPessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="nnCasaPessoa">Nº
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="nnCasaPessoa" class="form-control text-uppercase" id="nnCasaPessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

          </div>
          <div class="form-row">
            <div class="col-md-5 mb-3">
              <label for="stCompleEndPessoa">Complemento</label>
              <input type="text" name="stCompleEndPessoa" class="form-control text-uppercase" id="stCompleEndPessoa" placeholder="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <label for="stBairroPessoa">Bairro
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="stBairroPessoa" class="form-control text-uppercase" id="stBairroPessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="stCidadePessoa">Cidade
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="stCidadePessoa" class="form-control text-uppercase" id="stCidadePessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-1 mb-3">
              <label for="stEstadoPessoa">UF
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="stEstadoPessoa" maxlength="2" class="form-control text-uppercase" id="stEstadoPessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-3 mb-3">
              <label for="nnTelefonePessoa">Telefone</label>
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
              <label for="stEmailPessoa">E-Mail
                <span class="text-orange">*</span>
              </label>
              <input type="email" name="stEmailPessoa" class="form-control" id="stEmailPessoa" placeholder="">
              <div class="invalid-feedback">
                Obrigatório e deve seguir o padrão de E-maio(text@provedor.com...) !
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="txtObsContatosPessoas">Observações de Contados</label>
              <textarea class="form-control text-uppercase js_textareaEdt3" rows="3" name="txtObsContatosPessoas">Recados, falar com</textarea>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="foto">Foto</label>
              <input type="file" name="foto" class="form-control text-uppercase" id="foto" placeholder="FOTO" style="border: none;">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>

          <fieldset>
            <legend>
              <p class="lead text-orange" style="font-family:'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; ">
                DADOS DE ACESSO
              </p>
            </legend>
          </fieldset>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="nivelUser">Nível de Acesso
                <span class="text-orange">*</span>
              </label>
              <select class="form-control text-uppercase custom-select" required name="nivelUser" id="nivelUser">
                <option value="" selected disabled>Selecione o Nivel de Acesso</option>
                <option value="1">Administrador(a) do Sistema</option>
                <option value="2">Secretário(a) / Atendente</option>
                <option value="3">Advogado(a) / Parceiro(a)</option>

              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="flStatusUser">Status do Usuário
                <span class="text-orange">*</span>
              </label>
              <select class="form-control text-uppercase" required name="flStatusUser" id="flStatusUser">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="passUser">Senha de Acesso
                <span class="text-orange">*</span>
              </label>
              <input type="password" disabled name="passUser" class="form-control" id="passUser" placeholder="password" value="*****" />
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>


      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="gravar" value="gravar">
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

<!-- MODAL EDITAR FOTO -->
<div class="modal fade" id="modal-edtFoto">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; color:#C77129">
          Tocar Foto Usuário</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->

        <form class="needs-validation" novalidate action="./pages/pages/acoes/editarFoto.php" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="idPessoa" id="idPessoa" value="">
          <input type="hidden" name="nomePessoa" id="nomePessoa" value="<?= $nomePessoa; ?>">

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

<script>
  function setaDadosModal(valor) {
    document.getElementById('idPessoa').value = valor;
  };
</script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
</script>

<script src="./dist/js/app.js"></script>

<script>
  //  document.getElementById('gestaoMenu').classList.add("menu-open");
  //  document.getElementById('gestaoMenuActive').classList.add("active");
  document.getElementById('userSystem').classList.add("active");

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
