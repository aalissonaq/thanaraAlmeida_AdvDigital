<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edição de Usuários do Sistema</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Usuários do Sistema</li>
                    <li class="breadcrumb-item active">Edição de Usuários do Sistema</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <?php
    $idEdit = $_GET['idEdit'];
    $dadosPessoa = ler("vw_pessoa_user", '', "WHERE id = '{$idEdit}'")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dadosPessoa as $dp) {
        ?>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Editar o Usuário do Sistema:
                    <small class="lead text-primary text-uppercase"><?= $dp['nmPessoa']; ?></small>
                </h3>

                <div class="card-tools">
                    <a href="?page=listarusuarios" class="btn btn-tool text-primary">
                        <!-- <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i> -->
                        <i class="mdi mdi-arrow-left-bold-circle-outline fa fa-2x align-middle"></i>
                        Voltar para Lista de Usuários</a>
                </div>
            </div>
            <div class="card-body">

                <form class="needs-validation" novalidate action="pages/pages/acoes/editarUsuario.php" method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" value="<?= $idEdit; ?>" name="idEdit" />
                    <div class="form-row">
                        <div class="col-md-9 mb-3">
                            <label for="nmPessoa">Nome do Usuário</label>
                            <input type="text" name="nmPessoa" class="form-control text-uppercase" id="nmPessoa"
                                   placeholder="Nome do Usuário" value="<?= $dp['nmPessoa']; ?>" required>
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="docPessoa">CPF ou CNPJ</label>
                            <input type="text" name="docPessoa" class="form-control text-uppercase cpfOuCnpj" id="docPessoa"
                                   placeholder="Somente Números" maxlength="18" value="<?= $dp['docPessoa']; ?>" required>
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="dtNascPessoa">Data de Nascimento/Criação</label>
                            <input type="text" name="dtNascPessoa" class="form-control text-uppercase js_data"
                                   id="dtNascPessoa" placeholder="dd/mm/yyyy" value="<?= $dp['dtNascPessoa']; ?>" required>
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="stCepPessoa">CEP</label>
                            <input type="text" name="stCepPessoa" class="form-control text-uppercase js_cep"
                                   id="stCepPessoa" placeholder="" value="<?= $dp['stCepPessoa']; ?>">
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stLogradouroPessoa">Endereço</label>
                            <input type="text" name="stLogradouroPessoa" class="form-control text-uppercase"
                                   id="stLogradouroPessoa" placeholder="" value="<?= $dp['stLogradouroPessoa']; ?>" required>
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label for="nnCasaPessoa">Nº</label>
                            <input type="text" name="nnCasaPessoa" class="form-control text-uppercase" id="nnCasaPessoa"
                                   placeholder="" value="<?= $dp['nnCasaPessoa']; ?>" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-5 mb-3">
                            <label for="stCompleEndPessoa">Complemento</label>
                            <input type="text" name="stCompleEndPessoa" class="form-control text-uppercase"
                                   id="stCompleEndPessoa" placeholder="" value="<?= $dp['stCompleEndPessoa']; ?>">
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stBairroPessoa">Bairro</label>
                            <input type="text" name="stBairroPessoa" class="form-control text-uppercase" id="stBairroPessoa"
                                   placeholder="" value="<?= $dp['stBairroPessoa']; ?>" required>
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label for="stEstadoPessoa">UF</label>
                            <input type="text" name="stEstadoPessoa" maxlength="2" class="form-control text-uppercase"
                                   id="stEstadoPessoa" placeholder="" value="<?= $dp['stEstadoPessoa']; ?>" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label for="nnTelefonePessoa">Telefone</label>
                            <input type="text" name="nnTelefonePessoa" class="form-control text-uppercase js_fone"
                                   id="nnTelefonePessoa" placeholder="" value="<?= $dp['nnTelefonePessoa']; ?>" required>
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="nnWhatsappPessoa">Whataspp</label>
                            <input type="text" name="nnWhatsappPessoa" class="form-control text-uppercase js_fone"
                                   id="nnWhatsappPessoa" placeholder="" value="<?= $dp['nnWhatsappPessoa']; ?>">
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="stEmailPessoa">E-Mail</label>
                            <input type="email" name="stEmailPessoa" class="form-control" id="stEmailPessoa" placeholder=""
                                   value="<?= $dp['stEmailPessoa']; ?>" required>
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório e deve seguir o padrão de E-maio(text@provedor.com...) !
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="txtObsContatosPessoas">Observações de Contados</label>
                            <textarea class="form-control text-uppercase js_textareaEdt" placeholder="" rows="5"
                                      name="txtObsContatosPessoas">
                                          <?= $dp['txtObsContatosPessoas']; ?>
                            </textarea>
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>
                    </div>
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
                            <select class="form-control text-uppercase" required name="nivelUser" id="nivelUser">
                                <?php
                                switch ($dp['nivelUser']) {
                                    case '1':
                                        echo
                                        "<option value=\"1\" selected>Administrador do Sistema</option>
                      <option value=\"2\">Parceiro</option>
                      <option value=\"3\">Antendente</option>";
                                        break;

                                    case '2':
                                        echo
                                        "<option value=\"1\" >Administrador do Sistema</option>
                    <option value=\"2\" selected>Parceiro</option>
                    <option value=\"3\">Antendente</option>";
                                        break;

                                    default:
                                        echo
                                        "<option value=\"1\" >Administrador do Sistema</option>
                    <option value=\"2\" >Parceiro</option>
                    <option value=\"3\" selected>Antendente</option>";
                                        break;
                                };
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                A seleção é Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="flStatusUser">Status do Usuário</label>
                            <select class="form-control text-uppercase" required name="flStatusUser" id="flStatusUser">

                                <?php
                                switch ($dp['flStatusUser']) {
                                    case '1':
                                        echo
                                        '<option value="1" selected>Ativo</option>
                         <option value="0">Inativo</option>';
                                        break;

                                    default:
                                        echo
                                        '<option value="1" >Ativo</option>
                         <option value="0" selected>Inativo</option>';
                                        break;
                                }
                                ?>


                            </select>
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div>
                        <!-- <div class="col-md-4 mb-3">
                            <label for="passUser">Senha de Acesso</label>
                            <input type="password" name="passUser" class="form-control" id="passUser" required>
                            <div class="invalid-feedback">
                                Este Campo é Obrigatório !
                            </div>
                        </div> -->
                    </div>


                    <!-- <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                  Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                  You must agree before submitting.
                </div>
              </div>
            </div> -->
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="gravar" value="gravar">
                        <a href="?page=listarusuarios" class="btn btn-danger">
                            <i class="mdi mdi-trash-can-outline fa fa-fw fa-lg"></i>
                            Cancelar</a>
                        <button class="btn btn-primary" type="submit">
                            <i class="far fa-save fa-fw fa-lg"></i>
                            Gravar Dados</button>
                    </div>
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
<?php } ?>
</section>
<!-- /.content -->
<script>
    document.getElementById('gestaoMenu').classList.add("menu-open");
    document.getElementById('gestaoMenuActive').classList.add("active");
    document.getElementById('userSystem').classList.add("active");

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
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