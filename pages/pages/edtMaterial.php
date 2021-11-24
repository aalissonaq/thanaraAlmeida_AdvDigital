<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edição da Material</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Gestão de Materiais</li>
                    <li class="breadcrumb-item active">Edição Materiais </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <?php
    $idEdit = $_GET['idEdit'];
    $dadosMateriais = ler("materiais", '', "WHERE idMaterial = '{$idEdit}'")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dadosMateriais as $dMaterial) {
        ?>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Editar o Material:
                    <small style="font-size: 1.1rem;"
                           class="lead text-primary text-uppercase"><?= $dMaterial['codMaterial'] . ' - ' . $dMaterial['strMaterial']; ?></small>
                </h3>

                <div class="card-tools">
                    <a href="?page=listarMateriais" class="btn btn-tool text-primary">
                      <!-- <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i> -->
                        <i class="mdi mdi-arrow-left-bold-circle-outline fa fa-2x align-middle"></i>
                        Voltar para Lista de Materiais</a>
                </div>
            </div>
            <div class="card-body">

                <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovoMaterial.php" method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" name="idEdit" value="<?= $GET['idEdit']; ?>">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label for="codMaterial">Código</label>
                            <input type="number" name="codMaterial" class="form-control text-uppercase" id="codMaterial" placeholder=""
                                   value="<?= $dMaterial['codMaterial'] ?>" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-10 mb-3">
                            <label for="strMaterial">Material </label>
                            <input type="text" name="strMaterial" class="form-control text-uppercase" id="strMaterial" placeholder=""
                                   value="<?= $dMaterial['strMaterial'] ?>" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="unMaterial">Unidade </label>
                            <select class="form-control text-uppercase" required name="unMaterial" id="unMaterial">

                                <option value="Unidade">Unidade</option>
                                <option value="Frasco">Frasco</option>
                                <option value="Pacote">Pacote</option>
                                <option value="Caixa">Caixa</option>
                                <option value="Galão">Galão</option>
                                <option value="Rolo">Rolo</option>
                                <option value="Kit">Kit</option>
                                <option value="Rack">Rack</option>
                                <option value="Saco">Saco</option>

                            </select>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="qtdEstoqueMaterial">Qtd. em Estoque</label>
                            <input type="number" name="qtdEstoqueMaterial" class="form-control text-uppercase" id="qtdEstoqueMaterial"
                                   placeholder="" value="<?= $dMaterial['qtdEstoqueMaterial'] ?>" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="gravar" value="gravar">
                        <a href="?page=listarMateriais" class="btn btn-danger">
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
    <?php } ?>
</section>
<!-- /.content -->
<script>
    document.getElementById('gestaoMenu').classList.add("menu-open");
    document.getElementById('gestaoMenuActive').classList.add("active");
    document.getElementById('gestMaterialMenu').classList.add("menu-open");
    document.getElementById('getMaterialActive').classList.add("active");

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
