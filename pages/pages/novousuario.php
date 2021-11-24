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
                    <li class="breadcrumb-item active">Novo Usuários do Sistema</li>
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
            <h3 class="card-title">Novo Usuário do Sistema</h3>

            <div class="card-tools">
                <a href="?page=listarusuarios" class="btn btn-tool text-primary">
                    <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i>
                    Voltar para Lista de Usuários</a>
            </div>
        </div>
        <div class="card-body">

            <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovoUsuario.php" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-9 mb-3">
                        <label for="nmPessoa">Nome do Usuário</label>
                        <input type="text" name="nmPessoa" class="form-control text-uppercase" id="nmPessoa" placeholder="Nome do Usuário" value="" required>
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="docPessoa">CPF ou CNPJ</label>
                        <input type="text" name="docPessoa" class="form-control text-uppercase cpfOuCnpj" id="docPessoa" placeholder="Somente Números" required>
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório !
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="dtNascPessoa">Data de Nascimento/Criação</label>
                        <input type="text" name="dtNascPessoa" class="form-control text-uppercase js_data" id="dtNascPessoa" placeholder="dd/mm/yyyy" required>
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="stCepPessoa">CEP</label>
                        <input type="text" name="stCepPessoa" class="form-control text-uppercase js_cep" id="stCepPessoa" placeholder="">
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stLogradouroPessoa">Endereço</label>
                        <input type="text" name="stLogradouroPessoa" class="form-control text-uppercase" id="stLogradouroPessoa" placeholder="" required>
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="nnCasaPessoa">Nº</label>
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
                            Este Campo é Obrigatório !
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="stBairroPessoa">Bairro</label>
                        <input type="text" name="stBairroPessoa" class="form-control text-uppercase" id="stBairroPessoa" placeholder="" required>
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório !
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

                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label for="nnTelefonePessoa">Telefone</label>
                        <input type="text" name="nnTelefonePessoa" class="form-control text-uppercase js_fone" id="nnTelefonePessoa" placeholder="" required>
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="nnWhatsappPessoa">Whataspp</label>
                        <input type="text" name="nnWhatsappPessoa" class="form-control text-uppercase js_fone" id="nnWhatsappPessoa" placeholder="">
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="stEmailPessoa">E-Mail</label>
                        <input type="email" name="stEmailPessoa" class="form-control" id="stEmailPessoa" placeholder="">
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório e deve seguir o padrão de E-maio(text@provedor.com...) !
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="txtObsContatosPessoas">Observações de Contados</label>
                        <textarea class="form-control text-uppercase js_textareaEdt" placeholder="Recados, falar com ..." rows="5" name="txtObsContatosPessoas">
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
                    <div class="col-md-4 mb-3">
                        <label for="nivelUser">Observações de Contados</label>
                        <select class="form-control text-uppercase" required name="nivelUser" id="nivelUser">
                            <option value="" selected disabled>Selecione o Nivel de Acesso</option>
                            <option value="1">Administrador do Sistema</option>
                            <option value="2">Advogado/Parceiro</option>
                            <option value="3">Antendente/Secretária</option>
                        </select>
                        <div class="invalid-feedback">
                            A seleção é Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="flStatusUser">Status do Usuário</label>
                        <select class="form-control text-uppercase" required name="flStatusUser" id="flStatusUser">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="passUser">Senha de Acesso</label>
                        <input type="password" name="passUser" class="form-control" id="passUser" required>
                        <div class="invalid-feedback">
                            Este Campo é Obrigatório !
                        </div>
                    </div>
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
                <input type="hidden" name="gravar" value="gravar">
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
