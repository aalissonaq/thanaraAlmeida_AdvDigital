<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 style="font-family:'Advent Pro', sans-serif; font-weight: 500; color: #C77129">Registros do Sistema</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif; ">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Registros do Sistema</li>
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
      <h3 class="card-title"> Registros do Sistema </h3>
      <!--   <div class="card-tools">
        <a href="" class="btn btn-tool text-orange" data-toggle="modal" data-target="#modal-novoUsuario">

          <i class="fa fa-plus-square fa-fw fa-lg"></i>
         <i class="fa fa-user-plus fa-fw fa-lg"></i>
          Novo Clientes</a>
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                     title="Collapse">
                     <i class="fas fa-minus"></i>ttt</button>
                 <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                     title="Remove">
                     <i class="fas fa-times"></i></button>
      </div>-->
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="tabela" class="table table-sm table-striped table-hover ">
          <thead class="">
            <tr>
              <th class="col-md-auto text-center align-middle">
                <i class="fas fa-hashtag fa-fw"></i>
              </th>
              <th class="col-md-auto align-middle text-center text-uppercase">Ação</th>
              <th class="col-md-auto align-middle text-uppercase">Descrição</th>
              <th class="col-md-auto text-center align-middle text-uppercase">Usuário</th>

              <th class="col-md-auto text-center align-middle text-uppercase">DATA | HORA</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $cont = 0;
            $ler = ler("logs", '', "ORDER BY dtActionLog DESC");
            $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
            foreach ($listar as $dados) {
              $cont = $cont + 1;
            ?>
              <tr>
                <td class="text-center align-middle">
                  <?= str_pad($cont, 3, "0", STR_PAD_LEFT); ?>
                </td>

                <td class="text-center align-middle">
                  <?= $dados['tipyActionLog'] ?>
                </td>


                <td class="text-uppercase align-middle">
                  <?= $dados['actionLog'] ?>
                </td>

                <td class="text-center text-uppercase align-middle">
                  <?= $dados['userActionLog'] ?>
                </td>


                <td class="text-center align-middle">
                  <?= date("d/m/Y H:i:s", strtotime($dados['dtActionLog'])); ?>
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

<!-- MODAL NOVO -->
<div class="modal fade" id="modal-novoUsuario">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Novo Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->

        <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovoCliente.php" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="col-md-9 mb-3 ">
              <label for="nmPessoa">Nome do Cliente</label>
              <input type="text" name="nmPessoa" class="form-control text-uppercase  " id="nmPessoa" placeholder="Nome do Cliente" value="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="docPessoa">CPF</label>
              <input type="text" name="docPessoa" class="form-control text-uppercase js_cpf" id="docPessoa" placeholder="Somente Números" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-2 mb-3">
              <label for="dtNascPessoa">Data de Nascimento</label>
              <input type="text" name="dtNascPessoa" class="form-control text-uppercase js_data dtNascPessoa" onblur="Idade();" id="dtNascPessoa" placeholder="dd/mm/yyyy" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-1 mb-3">
              <label for="sexoCliente">Sexo</label>
              <select class="form-control text-uppercase" required name="sexoCliente" id="sexoCliente">
                <option value="Masculino">M</option>
                <option value="Feminino">F</option>
              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <label for="strEstadoCivilCliente">Estado Civil</label>
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

            <div class="col-md-4 mb-3">
              <label for="strNaturalidadeCliente">Naturalidade</label>
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
              <label for="nmMae">Nome da Mãe</label>
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
              <p class="lead">
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
              <label for="stLogradouroPessoa">Endereço </label>
              <input type="text" name="stLogradouroPessoa" class="form-control text-uppercase" id="stLogradouroPessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="nnCasaPessoa">Nº</label>
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
              <label for="stBairroPessoa">Bairro</label>
              <input type="text" name="stBairroPessoa" class="form-control text-uppercase" id="stBairroPessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="stCidadePessoa">Cidade</label>
              <input type="text" name="stCidadePessoa" class="form-control text-uppercase" id="stCidadePessoa" placeholder="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-1 mb-3">
              <label for="stEstadoPessoa">UF</label>
              <input type="text" name="stEstadoPessoa" maxlength="2" class="form-control text-uppercase" id="stEstadoPessoa" placeholder="" required>
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

      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="idRespCadastroCliente" value="<?= $_SESSION['ID']; ?>">
        <input type="hidden" name="nameUserActionLogs" value="<?= $_SESSION['USUARIO']; ?>">
        <input type="hidden" name="gravar" value="gravar">
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

<!-- MODAL EDIT -->
<div class="modal fade" id="modal-editPaciente">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Paciente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form edit Usuário -->

        <form class="needs-validation" novalidate action="pages/pages/acoes/editarPaciente.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="idEdit" value="<?= $dados['idPassoaPessoa'] ?>">
          <div class="form-row">
            <div class="col-md-9 mb-3 ">
              <label for="nmPessoa">Nome do Paciente</label>
              <input type="text" name="nmPessoa" class="form-control text-uppercase  " id="nmPessoa" placeholder="Nome do Paciente" value="<?= $dados['nmPessoa']; ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="docPessoa">CPF</label>
              <input type="text" name="docPessoa" class="form-control text-uppercase js_cpf" id="docPessoa" placeholder="Somente Números" value="<?= $dados['docPessoa'] ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-2 mb-3">
              <label for="dtNascPessoa">Data de Nascimento</label>
              <input type="text" name="dtNascPessoa" class="form-control text-uppercase js_data dtNascPessoa" onblur="Idade();" id="dtNascPessoa" placeholder="dd/mm/yyyy" value="<?= $dados['dtNascPessoa'] ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-1 mb-3">
              <label for="sexoPaciente">Sexo</label>
              <select class="form-control text-uppercase" required name="sexoPaciente" id="sexoPaciente">
                <?php
                switch ($dados['sexoPaciente']) {
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
              <select class="form-control text-uppercase" required name="strEstadoCivilPaciente" id="strEstadoCivilPaciente">
                <?php
                switch ($dados['strEstadoCivilPaciente']) {
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
              <input type="text" name="strNaturalidadePaciente" class="form-control text-uppercase" id="strNaturalidadePaciente" placeholder="" value="<?= $dados['strNaturalidadePaciente'] ?>">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-2 mb-3">
              <label for="nnRg">C. Identidade</label>
              <input type="number" name="nnRg" class="form-control text-uppercase" id="nnRg" placeholder="" value="<?= $dados['nnRg'] ?>">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-12 mb-3">
              <label for="nmMae">Nome da Mãe</label>
              <input type="text" required name="nmMae" class="form-control text-uppercase" id="nmMae" placeholder="" value="<?= $dados['nmMae'] ?>">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="nmPai">Nome da Pai</label>
              <input type="text" name="nmPai" class="form-control text-uppercase" id="nmPai" placeholder="" value="<?= $dados['nmPai'] ?>">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="nmResponsavel">Responsável <small class="text-danger text-uppercase">(Obrigatório para menores
                  de 18
                  anos)</small></label>
              <input type="text" name="nmResponsavel" class="form-control text-uppercase" id="nmResponsavel" placeholder="quando menor de idade" value="<?= $dados['nmResponsavel'] ?>">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

          </div>
          <!-- CONTATOS -->

          <fieldset>
            <legend>
              <p class="lead">
                DADOS DE ENDEREÇO
              </p>
            </legend>
          </fieldset>

          <div class="form-row">
            <div class="col-md-2 mb-3">
              <label for="stCepPessoa">CEP</label>
              <input type="text" name="stCepPessoa" class="form-control text-uppercase js_cep" id="stCepPessoa" size="10" maxlength="9" onblur="pesquisacep(this.value)" placeholder="" value="<?= $dados['stCepPessoa']; ?>">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-8 mb-3">
              <label for="stLogradouroPessoa">Endereço </label>
              <input type="text" name="stLogradouroPessoa" class="form-control text-uppercase" id="stLogradouroPessoa" placeholder="" value="<?= $dados['stLogradouroPessoa'] ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="nnCasaPessoa">Nº</label>
              <input type="number" name="nnCasaPessoa" class="form-control text-uppercase" id="nnCasaPessoa" placeholder="" value="<?= $dados['nnCasaPessoa'] ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

          </div>
          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label for="stCompleEndPessoa">Complemento</label>
              <input type="text" name="stCompleEndPessoa" class="form-control text-uppercase" id="stCompleEndPessoa" placeholder="" value="<?= $dados['stCompleEndPessoa']; ?>">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <label for="stBairroPessoa">Bairro</label>
              <input type="text" name="stBairroPessoa" class="form-control text-uppercase" id="stBairroPessoa" placeholder="" value="<?= $dados['stBairroPessoa'] ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="stCidadePessoa">Cidade</label>
              <input type="text" name="stCidadePessoa" class="form-control text-uppercase" id="stCidadePessoa" placeholder="" value="<?= $dados['stCidadePessoa']; ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-1 mb-3">
              <label for="stEstadoPessoa">UF</label>
              <input type="text" name="stEstadoPessoa" maxlength="2" class="form-control text-uppercase" id="stEstadoPessoa" placeholder="" value="<?= $dados['stEstadoPessoa'] ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>

          <fieldset>
            <legend>
              <p class="lead">
                DADOS DE CONTATOS
              </p>
            </legend>
          </fieldset>

          <div class="form-row">
            <div class="col-md-3 mb-3">
              <label for="nnTelefonePessoa">Telefone</label>
              <input type="text" name="nnTelefonePessoa" class="form-control text-uppercase js_fone" id="nnTelefonePessoa" placeholder="" value="<?= $dados['nnTelefonePessoa']; ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="nnWhatsappPessoa">Whataspp</label>
              <input type="text" name="nnWhatsappPessoa" class="form-control text-uppercase js_fone" id="nnWhatsappPessoa" placeholder="" value="<?= $dados['nnWhatsappPessoa'] ?>">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="stEmailPessoa">E-Mail</label>
              <input type="email" name="stEmailPessoa" class="form-control" id="stEmailPessoa" placeholder="" value="<?= $dados['stEmailPessoa'] ?>">
              <div class="invalid-feedback">
                Obrigatório e deve seguir o padrão de E-maio(text@provedor.com...) !
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="gravar" value="gravar">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
          Fechar </button>
        <button class="btn btn-success" type="submit">
          <i class="far fa-save fa-fw fa-lg"></i>
          Atualizar Dados</button>
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
  //document.getElementById('gestaoMenu').classList.add("menu-open");
  //document.getElementById('gestaoMenuActive').classList.add("active");
  document.getElementById('menuLogs').classList.add("active");

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
