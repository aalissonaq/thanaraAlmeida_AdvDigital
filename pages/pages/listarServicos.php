<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Serviços</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Gestão</a></li>
          <li class="breadcrumb-item active">Serviços</li>
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
      <h3 class="card-title">Lista de Serviços

      </h3>


      <div class="card-tools">
        <a href="" class="btn btn-tool text-primary" data-toggle="modal" data-target="#modal-noveServicos">

          <i class="fa fa-plus-square fa-fw fa-lg"></i>
          <!-- <i class="fa fa-user-plus fa-fw fa-lg"></i> -->
          Novo Serviços</a>
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
        <table id="tabela" class="table table-sm table-striped table-hover ">
          <thead class="">
            <tr>
              <th class="col-md-auto text-center align-middle">
                <i class="fas fa-hashtag fa-fw"></i>
              </th>
              <th class="col-md-auto align-middle">
                <i class="mdi mdi-hammer-wrench"></i>
                SERVIÇOS
              </th>
              <th class="col-md-auto text-center2 align-middle">
                <i class="mdi mdi-cash-multiple"></i>
                VALOR
              </th>
              <th class="col-md-auto text-center align-middle">
                <i class="mdi mdi-hexagon-multiple-outline"></i>
                STATUS
              </th>

              <th class="col-md-auto text-center align-middle">
                <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cont = 0;
            $ler = ler("servicos", '', "ORDER BY nomeServico ASC");
            $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
            foreach ($listar as $dados) {
              $cont = $cont + 1;
            ?>
            <tr>
              <td class="text-center align-middle">
                <?= str_pad($cont, 3, "0", STR_PAD_LEFT); ?>
              </td>

              <td class="text-uppercase align-middle">
                <?= $dados['nomeServico'] ?>
              </td>

              <td class="text-center2 text-uppercase align-middle">
                R$ <?= formatMoedaBr($dados['vlServico']) ?>
              </td>

              <td class="text-center text-uppercase align-middle">
                <?= ($dados['statusServico'] == 1) ? "Ativo" : "Inativo"; ?>
              </td>

              <td class="align-middle">

                <ul class="nav justify-content-center">

                  <?php
                    switch ($_SESSION['NIVEL']) {
                      case '0':
                        echo
                        " <li class=\"nav-item\">
                             <a href=\"?page=editarServico&idEdit={$dados['idServicos']}\" class=\"btn btn-tool\" target=\"\" title=\"Editar Serviço \" rel=\"noopener noreferrer\" >
                                 <i class=\"mdi mdi-circle-edit-outline  mdi-24px \"></i>
                               </a>
                             </li>



                             ";
                        if ($dados['statusServico'] == 1) {
                          $status = "<a href=\"?page=listarServicos&acao=blocService&id={$dados['idServicos']}\" class=\"btn btn-tool\"
                      target=\"\" title=\"Inativar Serviço\" rel=\"noopener noreferrer\">
                      <!-- <i class=\"fas fa-check-circle fa-lg\"></i> -->
                      <i class=\"mdi mdi-cog-outline  fa fa-2x\"></i>
                      </a>";
                        } else {
                          $status = "<a href=\"?page=listarServicos&acao=unblocService&id={$dados['idServicos']}\" class=\"btn btn-tool\"
                      target=\"\" title=\"Ativar Serviço\" rel=\"noopener noreferrer\">
                      <!-- <i class=\"fas fa-times-circle fa-lg\"></i> -->
                      <i class=\"mdi mdi-cog-off-outline  fa fa-2x\"></i>
                      </a>";
                        }
                        echo  "
                      <li class=\"nav-item\">
                        {$status}
                      </li>";



                        break;

                      default:
                        // STATUS

                        echo
                        "<li class=\"nav-item\">
                                              <a href=\"?page=verPaciente&id={$dados['idPassoaPessoa']}\" class=\"btn btn-tool\" target=\"\"
                                              title=\"Ver Dados do Usuário\" rel=\"noopener noreferrer\">
                                                <i class=\"mdi mdi-eye-outline fa fa-2x\"></i>
                                              </a>
                                            </li>
                                            <li class=\"nav-item\">
                                              <a href=\"?page=edtUsuario&idEdit={$dados['idPassoaPessoa']}\" class=\"btn btn-tool\" target=\"\" data-toggle=\"modal\" data-target=\"#modal-editServico\" title=\"Editar Usuário\" rel=\"noopener noreferrer\">
                                                <!-- <i class=\"fas fa-pen fa-lg\"></i> -->
                                                <i class=\"mdi mdi-account-edit-outline  fa fa-2x\"></i>
                                              </a>
                                            </li>

                                            <li class=\"nav-item\">
                                                 {$status}
                                            </li>


                                            <li class=\"nav-item\">
                                                  <a href=\"?page=edtPasswdUsuario&idEdit={$dados['idPassoaPessoa']}\" class=\"btn btn-tool\" target=\"\"
                                                  title=\"Trocar Senha Usuário\" rel=\"noopener noreferrer\">
                                                    <!-- <i class=\"fas fa-key fa-lg\"></i> -->
                                                    <i class=\"mdi mdi-shield-key-outline  fa fa-2x\"></i>
                                                  </a>
                                                </li>

                                            ";
                        break;
                    }
                    ?>


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

<!-- MODAL NOVO -->
<div class="modal fade" id="modal-noveServicos">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Novo Serviço</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->

        <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovoServico.php" method="POST"
          enctype="multipart/form-data">
          <div class="form-row">
            <div class="col-md-8 mb-3 ">
              <label for="nomeServico">Serviço</label>
              <input type="text" name="nomeServico" class="form-control text-uppercase" id="nomeServico"
                placeholder="Nome do Serviço" value="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="vlServico">Valor</label>

              <input type="text" name="vlServico" maxlength="7" step="0.01" min="0.01"
                class="form-control text-uppercase js_dinheiro" id="vlServico" placeholder="Somente Números" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="statusServico">Status </label>
              <select class="form-control text-uppercase" required name="statusServico" id="statusServico">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
              </select>
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

<!-- MODAL EDIT -->
<div class="modal fade" id="modal-editServico">
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

        <form class="needs-validation" novalidate action="pages/pages/acoes/editarServico.php" method="POST"
          enctype="multipart/form-data">
          <input type="hidden" name="idEdit" value="<?= $dados['idServicos'] ?>">
          <div class="form-row">
            <div class="col-md-8 mb-3 ">
              <label for="nomeServico">Serviço</label>
              <input type="text" name="nomeServico" class="form-control text-uppercase" id="nomeServico"
                placeholder="Nome do Serviço" value="<?= $dados['nomeServico'] ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="vlServico">Valor</label>
              <input type="text" name="vlServico" maxlength="7" step="0.01" min="0.01"
                class="form-control text-uppercase js_dinheiro" id="vlServico" placeholder="Somente Números"
                value="<?= $dados['vlServico'] ?>" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="statusServico">Status </label>
              <select class="form-control text-uppercase" required name="statusServico" id="statusServico">
                <?php
                switch ($dados['statusServico']) {
                  case 0:
                    echo '<option value="0" selected>Inativo</option>
                          <option value="1">Ativo</option>';
                    break;

                  default:
                    echo '<option value="0" >Inativo</option>
                          <option value="1" selected>Ativo</option>';
                    break;
                }
                ?>
              </select>
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


<script type="text/javascript"
  src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
</script>

<script src="./dist/js/app.js"></script>

<script>
//document.getElementById('gestaoMenu').classList.add("menu-open");
//document.getElementById('gestaoMenuActive').classList.add("active");
document.getElementById('menuServicos').classList.add("active");

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