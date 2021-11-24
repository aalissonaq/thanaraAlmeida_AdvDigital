<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pacientes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pacientes</li>
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
            <h3 class="card-title">Lista de Pacientes

            </h3>


            <div class="card-tools">
                <a href="" class="btn btn-tool text-primary" data-toggle="modal" data-target="#modal-novoUsuario">
                    <i class="fa fa-plus-square fa-fw fa-lg"></i>
                    <!-- <i class="fa fa-user-plus fa-fw fa-lg"></i> -->
                    Novo Pacientes</a>
                <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                             title="Collapse">
                             <i class="fas fa-minus"></i>ttt</button>
                         <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                             title="Remove">
                             <i class="fas fa-times"></i></button> -->
            </div>
        </div>
        <div class="card-body">

            <table id="tabela" class="table table-sm table-striped table-hover ">
                <thead class="">
                    <tr>
                        <th class="col-md-auto text-center align-middle">
                            <i class="fas fa-hashtag fa-fw"></i>
                        </th>
                        <th class="col-md-auto align-middle">Nome</th>
                        <th class="col-md-auto text-center align-middle">CPF</th>
                        <th class="col-md-auto text-center align-middle">SEXO</th>
                        <th class="col-md-auto text-center align-middle">IDADE</th>
                        <th class="col-md-auto text-center align-middle">TELEFONES</th>
                        <th class="col-md-auto text-center align-middle">
                            <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 0;
                    $ler = ler("vw_pessoa_paciente", '', "ORDER BY nmPessoa ASC");
                    $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listar as $dados) {
                        $cont = $cont + 1;
                        ?>
                        <tr>
                            <td class="text-center align-middle">
                                <?= str_pad($cont, 3, "0", STR_PAD_LEFT); ?>
                            </td>

                            <td class="text-uppercase align-middle">
                                <?= $dados['nmPessoa'] ?>
                            </td>

                            <td class="text-center text-uppercase align-middle">
                                <?= MascaraCPF($dados['docPessoa']) ?>
                            </td>
                            <td class="text-center text-uppercase align-middle">
                                <?= $dados['sexoPaciente'] ?>
                            </td>
                            <td class="text-center align-middle">
                                <?= str_pad(calcIdade($dados['dtNascPessoa']), 2, "0", STR_PAD_LEFT); ?>
                            </td>
                            <td class="text-center align-middle">
                                <?= $dados['nnTelefonePessoa'] . "<br/>" . $dados['nnWhatsappPessoa']; ?>
                            </td>
                            <td class="align-middle">

                                <ul class="nav justify-content-center">

                                    <?php
                                    switch ($_SESSION['NIVEL']) {
                                        case '0':

                                            echo "<li class=\"nav-item\">
    <a href=\"?page=viewUsuario&idEdit={$dados['idPessoaPaciente']}\" class=\"btn btn-tool\" target=\"\" title=\"Ver Dados\" rel=\"noopener noreferrer\">
      <i class=\"far fa-eye fa-lg\"></i>
    </a>
  </li>
  
  <li class=\"nav-item\">
    <a href=\"?page=edtUsuario&idEdit={$dados['idPessoaPaciente']}\" class=\"btn btn-tool\" target=\"\" title=\"Editar\" rel=\"noopener noreferrer\">
      <i class=\"far fa-edit fa-lg\"></i>
    </a>
  </li>
  
  <li class=\"nav-item\">
    <a href=\"?page=edtUsuario&idEdit={$dados['idPessoaPaciente']}\" class=\"btn btn-tool\" target=\"\" title=\"Solicitar Exames\" rel=\"noopener noreferrer\">
      <i class=\"fas fa-vials fa-lg\"></i>
    </a>
  </li>
 ";
                                            break;
// case '2':
                                        //     echo '<li class="nav-item">
                                        //           <a href="" class="btn btn-tool" target="" title="Ver Dados do Usuário" rel="noopener noreferrer">
                                        //             <i class="far fa-eye fa-lg"></i>
                                        //           </a>
                                        //         </li>
                                        //         <li class="nav-item">
                                        //           <a href="" class="btn btn-tool" target="" title="Editar Usuário" rel="noopener noreferrer">
                                        //             <i class="far fa-edit fa-lg"></i>
                                        //           </a>
                                        //         </li>
                                        //         ';
                                        //     break;

                                        default:
                                            echo 'sem Permisão';
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

<!-- modal -->
<div class="modal fade" id="modal-novoUsuario">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Novo Paciente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form novo Usuário -->

                <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovoPaciente.php" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-9 mb-3 ">
                            <label for="nmPessoa">Nome do Paciente</label>
                            <input type="text" name="nmPessoa" class="form-control text-uppercase  " id="nmPessoa"
                                   placeholder="Nome do Paciente" value="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="docPessoa">CPF</label>
                            <input type="text" name="docPessoa" class="form-control text-uppercase js_cpf" id="docPessoa"
                                   placeholder="Somente Números" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label for="dtNascPessoa">Data de Nascimento</label>
                            <input type="text" name="dtNascPessoa" class="form-control text-uppercase js_data" id="dtNascPessoa"
                                   placeholder="dd/mm/yyyy" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="sexoPaciente">Sexo</label>
                            <select class="form-control text-uppercase" required name="sexoPaciente" id="sexoPaciente">
                                <option value="Masculino">M</option>
                                <option value="Feminino">F</option>
                            </select>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="strEstadoCivilPaciente">Estado Civil</label>
                            <select class="form-control text-uppercase" required name="strEstadoCivilPaciente"
                                    id="strEstadoCivilPaciente">
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
                            <label for="strNaturalidadePaciente">Naturalidade</label>
                            <input type="text" name="strNaturalidadePaciente" class="form-control text-uppercase"
                                   id="strNaturalidadePaciente" placeholder="">
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
                        <div class="col-md-12 mb-3">
                            <label for="nmResponsavel">Responsavel</label>
                            <input type="text" name="nmResponsavel" class="form-control text-uppercase" id="nmResponsavel"
                                   placeholder="quando responvel">
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
                            <input type="text" name="stCepPessoa" class="form-control text-uppercase js_cep" id="stCepPessoa"
                                   placeholder="">
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="stLogradouroPessoa">Endereço</label>
                            <input type="text" name="stLogradouroPessoa" class="form-control text-uppercase" id="stLogradouroPessoa"
                                   placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="nnCasaPessoa">Nº</label>
                            <input type="number" name="nnCasaPessoa" class="form-control text-uppercase" id="nnCasaPessoa"
                                   placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-5 mb-3">
                            <label for="stCompleEndPessoa">Complemento</label>
                            <input type="text" name="stCompleEndPessoa" class="form-control text-uppercase" id="stCompleEndPessoa"
                                   placeholder="">
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stBairroPessoa">Bairro</label>
                            <input type="text" name="stBairroPessoa" class="form-control text-uppercase" id="stBairroPessoa"
                                   placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label for="stEstadoPessoa">UF</label>
                            <input type="text" name="stEstadoPessoa" maxlength="2" class="form-control text-uppercase"
                                   id="stEstadoPessoa" placeholder="" required>
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
                            <input type="text" name="nnTelefonePessoa" class="form-control text-uppercase js_fone"
                                   id="nnTelefonePessoa" placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nnWhatsappPessoa">Whataspp</label>
                            <input type="text" name="nnWhatsappPessoa" class="form-control text-uppercase js_fone"
                                   id="nnWhatsappPessoa" placeholder="">
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


<script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
</script>

<script src="./dist/js/app.js"></script>

<script>
      document.getElementById('gestaoMenu').classList.add("menu-open");
      document.getElementById('gestaoMenuActive').classList.add("active");
      document.getElementById('profSolicitanteActiva').classList.add("active");

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