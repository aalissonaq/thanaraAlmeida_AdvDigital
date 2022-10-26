    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="font-family:'Advent Pro', sans-serif; font-weight: 400; ">Clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif; letter-spacing: .06rem;" >
              <li class="breadcrumb-item"><a href="?page=inicio">Home</a></li>
              <li class="breadcrumb-item active">Clientes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <?php
      if (isset($_GET['searchAll'])) {
        $sql = "SELECT * FROM pessoa
        INNER JOIN clientes ON pessoa.idPessoa = clientes.idPessoa ORDER BY pessoa.nmPessoa ASC";
        $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      }

      if (isset($_GET['search']) && $_GET['search'] ==  "latter") {
        $sql = "SELECT * FROM pessoa
                INNER JOIN clientes ON pessoa.idPessoa = clientes.idPessoa
                WHERE nmPessoa LIKE '" . $_GET['param'] . "%'";

        $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultado) == 0) {
          echo '<div class="alert alert-danger" role="alert">
                Nenhum resultado encontrado!
                </div>';
        }
      } elseif (isset($_GET['search']) && $_GET['search'] ==  "name") {
        $sql = "SELECT * FROM pessoa
        INNER JOIN clientes ON pessoa.idPessoa = clientes.idPessoa
        WHERE nmPessoa LIKE '%" . $_GET['param'] . "%'";

        $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultado) == 0) {
          echo '<div class="alert alert-danger" role="alert">
        Nenhum resultado encontrado!
        </div>';
        }
      } else {
        $sql = "SELECT * FROM pessoa
                INNER JOIN clientes ON pessoa.idPessoa = clientes.idPessoa ORDER BY pessoa.nmPessoa ASC";
        $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      }

      ?>
      <div class="container-fluid">

        <div class="row d-flex justify-content-between">
          <!-- <span class="mt-2">
            <i class="fa fa-search fa-lg fa-fw"> </i>
            <a href="?page=cc&searchAll" class="h4">TODOS </a>

          </span> -->

          <form class="form-inline col-12" method="get">
            <input type="hidden" name="page" value="listarClientes">
            <input type="hidden" name="search" value="name">
            <input class="form-control mr-sm-2 mr-2 col-9 col-md-10" type="text" placeholder="Pesquisar pelo nome do cliente" name="param" autofocus />
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
          </form>
          <div class="d-none d-lg-block">
            <div class="col-8 my-2 d-flex justify-content-between btn-group btn-group-sm" role="group">
              <a href="?page=listarClientes&searchAll" class="btn btn-outline-primary">TODOS </a>
              <a href="?page=listarClientes&search=latter&param=a" class="btn btn-outline-primary  ">A</a>
              <a href="?page=listarClientes&search=latter&param=b" class="btn btn-outline-primary">B</a>
              <a href="?page=listarClientes&search=latter&param=c" class="btn btn-outline-primary">C</a>
              <a href="?page=listarClientes&search=latter&param=d" class="btn btn-outline-primary">D</a>
              <a href="?page=listarClientes&search=latter&param=e" class="btn btn-outline-primary">E</a>
              <a href="?page=listarClientes&search=latter&param=f" class="btn btn-outline-primary">F</a>
              <a href="?page=listarClientes&search=latter&param=g" class="btn btn-outline-primary">G</a>
              <a href="?page=listarClientes&search=latter&param=h" class="btn btn-outline-primary">H</a>
              <a href="?page=listarClientes&search=latter&param=i" class="btn btn-outline-primary">I</a>
              <a href="?page=listarClientes&search=latter&param=j" class="btn btn-outline-primary">J</a>
              <a href="?page=listarClientes&search=latter&param=k" class="btn btn-outline-primary">K</a>
              <a href="?page=listarClientes&search=latter&param=l" class="btn btn-outline-primary">L</a>
              <a href="?page=listarClientes&search=latter&param=m" class="btn btn-outline-primary">M</a>
              <a href="?page=listarClientes&search=latter&param=n" class="btn btn-outline-primary">N</a>
              <a href="?page=listarClientes&search=latter&param=o" class="btn btn-outline-primary">O</a>
              <a href="?page=listarClientes&search=latter&param=p" class="btn btn-outline-primary">P</a>
              <a href="?page=listarClientes&search=latter&param=q" class="btn btn-outline-primary">Q</a>
              <a href="?page=listarClientes&search=latter&param=r" class="btn btn-outline-primary">R</a>
              <a href="?page=listarClientes&search=latter&param=s" class="btn btn-outline-primary">S</a>
              <a href="?page=listarClientes&search=latter&param=t" class="btn btn-outline-primary">T</a>
              <a href="?page=listarClientes&search=latter&param=u" class="btn btn-outline-primary">U</a>
              <a href="?page=listarClientes&search=latter&param=v" class="btn btn-outline-primary">V</a>
              <a href="?page=listarClientes&search=latter&param=w" class="btn btn-outline-primary">W</a>
              <a href="?page=listarClientes&search=latter&param=x" class="btn btn-outline-primary">X</a>
              <a href="?page=listarClientes&search=latter&param=y" class="btn btn-outline-primary">Y</a>
              <a href="?page=listarClientes&search=latter&param=z" class="btn btn-outline-primary">Z</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-header">
        <!--
      <h3 class="card-title" style="font-family:'Advent Pro', sans-serif; letter-spacing: 1px;">Lista de Clientes
      </h3>
      -->
        <div class="card-tools">
          <a href="" class="btn btn-tool text-primary align-middle" data-toggle="modal" data-target="#modal-novoUsuario" style="font-family:'Advent Pro', sans-serif; font-weight: bold; font-size: 1rem; letter-spacing: 1px;">

            <i class="fa fa-plus-square fa-fw fa-2x align-middle"></i>
            Novo Clientes
          </a>

        </div>
      </div>

      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            <!-- Card Cliente -->
            <?php
            foreach ($resultado as $cliente) {

            ?>

              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light">
                  <!-- <div class="card-header text-muted border-bottom-0">
                  Digital Strategist
                </div> -->
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h1 class="lead py-3 h1 text-primary" style="font-family:'Advent Pro', sans-serif; font-weight: bold; ; font-size: 1.5rem;text-transform: uppercase;"><b>
                            <?php
                            if ($cliente['nmPessoaSocial'] == '') {
                              $nome =  explode(' ', $cliente['nmPessoa']);
                              if (strlen($nome[1]) > 2) {
                                echo $nome[0] . " " . $nome[1];
                              } else {
                                echo $nome[0] . " " . $nome[1] . " " . $nome[2];
                              }
                            } else {
                              echo $cliente['nmPessoaSocial'];
                            }
                            ?>
                          </b>
                        </h1>
                        <p class=" lead text-md border-bottom" style="margin-top:-1rem; text-transform: uppercase; font-size: 1.2rem">
                          <?= $cliente['nmPessoa'] ?>

                        </p>

                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <li class="small mb-1" style="text-transform: uppercase;">
                            <span class="fa-li">
                              <i class="fas fa-lg fa-building"></i>
                            </span>
                            <?= $cliente['stLogradouroPessoa'] . ", " . $cliente['nnCasaPessoa'] . " - " . $cliente['stBairroPessoa'] . " <br/> " . $cliente['stCidadePessoa'] . "-" . $cliente['stEstadoPessoa'] . "<br/> CEP:" . $cliente['stCepPessoa'] ?>
                          </li>
                          <li class="small mb-1">
                            <span class="fa-li">
                              <i class="fas fa-lg fa-phone"></i>
                            </span>
                            <?= $cliente['nnTelefonePessoa'] ?>
                          </li>
                          <?php
                          if (!$cliente['nnWhatsappPessoa']) {
                          } else {
                          ?>
                            <li class="small mb-1">
                              <span class="fa-li">
                                <i class="fab fa-lg fa-whatsapp text-success"></i></span>

                              <a href="https://api.whatsapp.com/send?phone=55<?= tiraMascara($cliente['nnWhatsappPessoa']) ?>&text=Ol%C3%A1%20<?= urlencode($cliente['nmPessoa']); ?>%2C%20temos%20novidades%20sobre%20seu%20processo.%20%20" class="text-success" target="_blank" title="Enviar WhatsApp">

                                <?= $cliente['nnWhatsappPessoa'] ?>
                              </a>

                            </li>
                          <?php } ?>
                          <li class="small mb-1">
                            <span class="fa-li">
                              <i class="fas fa-lg fa-envelope"></i>
                            </span>
                            <?= $cliente['stEmailPessoa'] ?>
                          </li>
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="<?php
                                  if ($cliente['foto']) {
                                    echo "./upload/fotoPessoas/{$cliente['foto']}";
                                  } else {
                                    echo "./upload/fotoPessoas/default.png";
                                  } ?>" alt="
                  <?php echo $cliente['nmPessoa'] ?>" class="img-circle img-fluid my-4" style="object-fit: cover;">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                      <button data-toggle="modal" data-target="#modal-edtFoto" onclick="setaDadosModal(<?= $cliente['idPessoa'] ?>)" ; class="btn btn-sm bg-outline-secondary">
                        <i class="mdi mdi-camera-flip-outline mdi-24px "></i>
                      </button>
                      <a href="?page=profileCliente&id=<?= $cliente['idPessoa'] ?>" class="btn btn-sm btn-primary">
                        <i class="mdi mdi-account mdi-18px"></i> Perfil do Cliente
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <!-- final card cliente -->

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


          </div>
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer">
          <nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item"><a class="page-link" href="#">6</a></li>
              <li class="page-item"><a class="page-link" href="#">7</a></li>
              <li class="page-item"><a class="page-link" href="#">8</a></li>
            </ul>
          </nav>
        </div> -->
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

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
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <script>
      document.getElementById('menuClientes').classList.add("active");

      function setaDadosModal(valor) {
        document.getElementById('idPessoa').value = valor;
      }


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
