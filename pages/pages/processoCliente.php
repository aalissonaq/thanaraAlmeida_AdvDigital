<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">Processos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif;">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=listarClientes">Cliente</a></li>
          <li class="breadcrumb-item active">Processos</li>
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
      <h3 class="card-title " style="font-family:'Advent Pro', sans-serif; letter-spacing: 1px;">
        <div class="">
          <?php
          $id = $_GET['id'];
          $nomeCliente = '';
          foreach (ler("vw_pessoa_cliente", '', "WHERE idPessoaCliente = {$id}")->fetchAll(PDO::FETCH_ASSOC) as $dadosPessoa) {
            $idCliente = $dadosPessoa['idCliente'];
            $nomeCliente = $dadosPessoa['nmPessoa'];
          ?>

            <img src="
                    <?php
                    if (isset($dadosPessoa['imgCliente']) && !empty($dadosPessoa['imgCliente'])) {
                      echo " ./upload/imgClientes/{$dadosPessoa['imgCliente']}";
                    } else {
                      echo "./upload/imgClientes/default.png";
                    } ?>" alt="
          <?php echo $dadosPessoa['nmPessoa'] ?>" class="shadow border rounded-circle border-4 border-warning img-circle img-fluid " style="width:75px; height: 75px; object-fit: cover;" alt="
          <?= $dadosPessoa['nmPessoa'] ?>" title="
          <?= $dadosPessoa['nmPessoa'] ?>" />

            <span class="">
              <?= $dadosPessoa['nmPessoa']; ?>
            </span>
          <?php } ?>
        </div>
      </h3>


      <div class="card-tools">
        <a href="" class="btn btn-tool text-orange" data-toggle="modal" data-target="#modal-novoProdesso" style="font-family:'Advent Pro', sans-serif; font-weight: bold; font: size 20px; letter-spacing: 1px;">
          <i class="fa fa-plus-square fa-fw fa-2x"></i>
          Novo Processos</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="tabela" class="table table-sm table-striped table-hover">
          <thead class="" style="font-family: 'Advent Pro', sans-serif;">
            <tr>
              <th class="col-md-1 text-center align-middle">
                <i class="fas fa-hashtag fa-fw"></i>
              </th>
              <th class="col-mb-3 text-center align-middle ">ÁREA</th>
              <th class="col-mb-2 text-center align-middle">N° DO PROCESSO (CNJ)</th>
              <th class="col-md-2 text-center align-middle">STATU</th>
              <th class="col-md-3 text-center align-middle">
                <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
              </th>
            </tr>
          </thead>
          <tbody>

            <?php
            $id = $_GET['id'];
            $idCliente;
            //$lerDadosProcesso = ler('processos', '', "WHERE idcliente = {$idCliente}")->fetchAll(PDO::FETCH_ASSOC);
            $count = 0;
            foreach (ler('processos', '', "WHERE idcliente = {$id}")->fetchAll(PDO::FETCH_ASSOC) as $dadosProcesso) {
              $count++;
            ?>
              <tr class="">
                <td class="col-md-1 text-uppercase align-middle text-center">
                  <?= str_pad($count, 2, "0", STR_PAD_LEFT);
                  // $count++;
                  ?>
                </td>
                <td class="text-uppercase align-middle text-center">
                  <?php

                  switch ($dadosProcesso['areaprocesso']) {
                    case 'adminsitrativo':
                      echo "Administrativo";
                      break;
                    case 'previdenciario':
                      echo "Previdenciário";
                      break;
                    case 'trabalhista':
                      echo "Trabalhista";
                      break;

                    default:
                      # code...
                      break;
                  }; ?>
                </td>
                <td class="text-uppercase align-middle text-center">
                  <?= isset($dadosProcesso['numprocesso']) && $dadosProcesso['numprocesso'] > 0 ? MascaraCNJ(str_pad($dadosProcesso['numprocesso'], 19, "0", STR_PAD_LEFT)) : 'Processo sem Número'; ?>
                </td>
                <td class="text-uppercase align-middle d-flex justify-content-between align-items-center" style="font-size: .94rem; ">
                  <?php
                  switch ($dadosProcesso['statusprocesso']) {
                    case 'aguardando':
                      echo 'Aguardando Documento';
                      break;
                    case 'pericia':
                      echo 'Perícia ou Agendamento';
                      break;
                    case 'prorrogacao':
                      echo 'Prorrogação';
                      break;
                    case 'exigencia':
                      echo 'Exigência';
                      break;
                    case 'aguardandoINSS':
                      echo 'Aguardando Resposta do INSS';
                      break;
                    case 'justFederal':
                      echo 'ustiça Federal';
                      break;


                    default:
                      echo 'Aguardando Documento';
                      break;
                  };

                  echo "
                  <a href=\"\" class=\"btn btn-tool\" target=\"\"
                  title=\"Atualizar Status\" rel=\"noopener noreferrer\">
                  <i class=\"mdi mdi-rotate-3d-variant mdi-24px fa fa-fw\"></i>
                  </a>
                  ";

                  ?>
                </td>
                <td class="text-uppercase align-middle  ">

                  <ul class="nav justify-content-center d-flex justify-content-evenly">
                    <?php
                    switch ($_SESSION['NIVEL']) {
                      case '0':
                        echo "
                        <li class=\"nav-item\">
                            <a href=\"\" class=\"btn btn-tool\" target=\"\"
                            title=\"Visializar Processo\" rel=\"noopener noreferrer\">
                            <i class=\"mdi mdi-file-eye-outline mdi-24px \"></i>
                            </a>
                          </li>
                        <li class=\"nav-item\">
                            <a href=\"\" class=\"btn btn-tool\" target=\"\"
                            title=\"Histórico\" rel=\"noopener noreferrer\">
                            <i class=\"mdi mdi-calendar-clock-outline mdi-24px \"></i>
                            </a>
                          </li>
                        <li class=\"nav-item\">
                            <a href=\"\" class=\"btn btn-tool\" target=\"\"
                            title=\"Ações\" rel=\"noopener noreferrer\">
                            <i class=\"mdi mdi-book-cog-outline mdi-24px\"></i>
                            </a>
                          </li>

                        ";
                        break;

                      default:
                        //TESTE DE STATUS
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
      <a href="?page=listarClientes" class="btn btn-outline-danger">
        <i class="mdi mdi-arrow-left-thick mdi-18px"></i>
        Voltar
      </a>
      <!-- Footer -->
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
  <br />
</section>
<!-- /.content -->

<!-- MODAL NOVO PROCESSO -->
<div class="modal fade" id="modal-novoProdesso">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; color:orange">Novo Proceso:&nbsp;
        </h5>
        <h5 class="modal-title text-primary" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px;">
          <?= ' ' . $nomeCliente; ?>
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form novo Usuário -->

        <form class="needs-validation" novalidate action="./pages/pages/acoes/gravaNovoProcesso.php" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="col-md-12">
              <label for="objprocesso">Objeto do Processo
                <span class="text-orange">*</span>
              </label>
              <input type="text" name="objprocesso" class="form-control text-uppercase  " id="objprocesso" placeholder="Objeto do Processo" value="" required>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <label for="descricaoprocesso">Descrição do Processo
                <span class="text-orange">*</span>
              </label>

              <textarea class="form-control" name="descricaoprocesso" id="descricaoprocesso" placeholder="Decrição detalhada do processo/caso" name="validation" rows="4" required></textarea>

              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-4">
              <label for="numprocesso">Nº Processo (CNJ)</label>
              <input type="text" maxlength="19" name="numprocesso" class="form-control text-uppercase js_numCNJ" id="numprocesso" placeholder="Número do Processo" value="">
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-4">
              <label for="areaprocesso">Área da Ação
                <span class="text-orange">*</span>
              </label>
              <select class="form-control text-uppercase" required name="areaprocesso" id="areaprocesso">
                <!--<option value="" selected disabled>Área do ação</option>-->
                <option value="adminsitrativo">Administrativo</option>
                <option value="previdenciario">Previdenciário</option>
                <option value="trabalhista">Trabalhista</option>

              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
            <div class="col-md-4">
              <label for="statusprocesso">Status
                <span class="text-orange">*</span>
              </label>
              <select class="form-control text-uppercase" required name="statusprocesso" id="statusprocesso">
                <option value="aguardando">Aguardando Documento</option>
                <option value="pericia">Perícia ou Agendamento</option>
                <option value="prorrogacao">Prorrogação</option>
                <option value="exigencia">Exigência</option>
                <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                <option value="justFederal">Justiça Federal </option>

              </select>
              <div class="invalid-feedback">
                Obrigatório !
              </div>
            </div>
          </div>


      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="idcliente" value="<?= $id; ?>">
        <input type="hidden" name="idadvogado" value="0">
        <input type="hidden" name="nomeCliente" value="<?= $nomeCliente; ?>">
        <input type="hidden" name="userActionLog" value="<?= $_SESSION['USUARIO']; ?>">
        <input type="hidden" name="gravar" value="gravar">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
          Fechar </button>
        <button class="btn btn-success btn-lg" type="submit">
          <i class="far fa-save fa-fw fa-lg"></i>
          Gravar Dados</button>
        </form>
        <!--/form novo Usuario -->
        <!-- <button type="button" class="btn btn-success">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- MODAL EDIT -->

<!-- /.modal -->


<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
</script>

<script src="./dist/js/app.js"></script>

<script>
  //document.getElementById('gestaoMenu').classList.add("menu-open");
  //document.getElementById('gestaoMenuActive').classList.add("active");
  document.getElementById('menuClientes').classList.add("active");

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
