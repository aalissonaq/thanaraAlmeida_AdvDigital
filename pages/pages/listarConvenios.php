<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Convênios | Planos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Convênios | Planos</li>
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
            <h3 class="card-title">Lista de Convênios | Planos
            </h3>
            <div class="card-tools">
                <a href="" class="btn btn-tool text-primary" data-toggle="modal" data-target="#modal-novoUsuario">
                    <i class="fa fa-plus-square fa-fw fa-lg"></i>
                    <!-- <i class="fa fa-user-plus fa-fw fa-lg"></i> -->
                    Novo Convênios | Planos</a>
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
                        <th class="col-md-auto align-middle">RAZÃO SOCIAL</th>
                        <th class="col-md-auto align-middle">NOME FANTASIA</th>
                        <th class="col-md-auto text-center align-middle">CNPJ</th>
                        <th class="col-md-auto text-center align-middle">TIPO</th>
                        <th class="col-md-auto text-center align-middle">
                            <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 0;
                    $ler = ler("convenios", '', "ORDER BY RazaoSocialConvenio ASC");
                    $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listar as $dados) {
                        $cont = $cont + 1;
                        ?>
                        <tr>
                            <td class="text-center align-middle">
                                <?= str_pad($dados['idConvenio'], 3, "0", STR_PAD_LEFT); ?>
                            </td>

                            <td class="text-uppercase align-middle">
                                <?= $dados['RazaoSocialConvenio'] ?>
                            </td>

                            <td class="text-center text-uppercase align-middle">
                                <?= $dados['nmFantasiaConvenio'] ?>
                            </td>
                            <td class="text-center text-uppercase align-middle">
                                <?= $dados['nnCnpjConvenio'] ?>
                            </td>
                            <td class="text-center align-middle">
                                <?= $dados['srtTipoConvenio']; ?>
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
                <h4 class="modal-title">Novo Convênio | Plano</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form novo Usuário -->

                <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovoPaciente.php" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-6 mb-3 ">
                            <label for="RazaoSocialConvenio">Razão Social</label>
                            <input type="text" name="RazaoSocialConvenio" class="form-control text-uppercase  "
                                   id="RazaoSocialConvenio" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 ">
                            <label for="nmFantasiaConvenio ">Nome Fantasia</label>
                            <input type="text" name="nmFantasiaConvenio" class="form-control text-uppercase" id="nmFantasiaConvenio"
                                   placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label for="nnCepConvenio">CEP</label>
                            <input type="text" name="nnCepConvenio" class="form-control text-uppercase js_cep" id="nnCepConvenio"
                                   placeholder="">
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="strLogradouroConvenio">Endereço</label>
                            <input type="text" name="strLogradouroConvenio" class="form-control text-uppercase"
                                   id="strLogradouroConvenio" placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label for="nnEndConvenio">Nº</label>
                            <input type="number" name="nnEndConvenio" class="form-control text-uppercase" id="nnEndConvenio"
                                   placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="strComplementoConvenio">Complemento</label>
                            <input type="text" name="strComplementoConvenio" class="form-control text-uppercase"
                                   id="strComplementoConvenio" placeholder="">
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="srtBairroConvenio">Bairro</label>
                            <input type="text" name="srtBairroConvenio" class="form-control text-uppercase" id="srtBairroConvenio"
                                   placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="srtEstadoConvenio">Cidade</label>
                            <input type="text" name="srtEstadoConvenio" class="form-control text-uppercase" id="srtEstadoConvenio"
                                   placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="srtEstadoConvenio">Estado</label>
                            <input type="text" name="srtEstadoConvenio" maxlength="2" class="form-control text-uppercase"
                                   id="srtEstadoConvenio" placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="srtTipoConvenio">Tipo de Convênio</label>
                            <input type="text" name="srtTipoConvenio" maxlength="2" class="form-control text-uppercase"
                                   id="srtTipoConvenio" placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="nnCnpjConvenio">CNPJ</label>
                            <input type="text" name="nnCnpjConvenio" class="form-control text-uppercase js_cnpj" id="nnCnpjConvenio"
                                   placeholder="Somente Números" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nnIncricaoConvenio">Insc. Estadual</label>
                            <input type="number" name="nnIncricaoConvenio" class="form-control text-uppercase" id="nnIncricaoConvenio"
                                   placeholder="Somente Números" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="contatoConvenio">Contato</label>
                            <input type="text" name="contatoConvenio" class="form-control text-uppercase" id="contatoConvenio"
                                   placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="nnTelefoneConvenio">Telefone</label>
                            <input type="text" name="nnTelefoneConvenio" class="form-control text-uppercase js_fone"
                                   id="nnTelefoneConvenio" placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-9 mb-3">
                            <label for="srtEmailConvenio">E-Mail</label>
                            <input type="text" name="srtEmailConvenio" class="form-control text-uppercase" id="srtEmailConvenio"
                                   placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="instAtendimentoConvenio">Instruções para Atendimento</label>
                            <textarea class="form-control text-uppercase js_textareaEdt" placeholder="" rows="5"
                                      name="instAtendimentoConvenio">
                            </textarea>
                            <div class="invalid-feedback">
                                Obrigatório !
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
      document.getElementById('menuConvenio').classList.add("active");

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