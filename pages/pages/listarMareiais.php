<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gestão de Materiais</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=inicio">Home</a></li>
                    <li class="breadcrumb-item active">Lista de Materiais </li>
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
            <h3 class="card-title">Lista de Materiais
            </h3>

            <div class="card-tools">
                <a href="" class="btn btn-tool text-primary" data-toggle="modal" data-target="#modal-novoMaterial">
                    <i class="fa fa-plus-square fa-fw fa-lg"></i>
                    Novo Material</a>

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
                            <th class="col-md-auto text-center text-uppercase align-middle">Cód</th>
                            <th class="col-md-auto text-center text-uppercase align-middle">Material</th>
                            <th class="col-md-auto text-center text-uppercase align-middle">Unidade</th>
                            <th class="col-md-auto text-center text-uppercase align-middle">Qtd Estoque</th>
                            <!-- <th class="col-md-auto  text-center">Status</th> -->
                            <th class="col-md-auto  text-center">
                                <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cont = 0;
                        $ler = ler("materiais", '', "ORDER BY codMaterial ASC ");
                        $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($listar as $dados) {
                            $cont = $cont + 1;
                            ?>

                            <tr>
                                <td class="text-center text-uppercase align-middle">
                                    <?= str_pad($dados['codMaterial'], 5, "0", STR_PAD_LEFT); ?></td>

                                <td class="text-cente text-uppercase align-middle">
                                    <?= $dados['strMaterial']; ?>
                                </td>
                                <td class="text-center text-uppercase align-middle">
                                    <?= $dados['unMaterial']; ?>
                                </td>
                                <td class="text-uppercase text-center align-middle">
                                    <?= str_pad($dados['qtdEstoqueMaterial'], 4, "0", STR_PAD_LEFT); ?>
                                </td>
                                <!-- <td class="text-uppercase text-center align-middle"> -->
                                <!-- <?= str_pad($dados['qtdEstoqueMaterial'], 3, "0", STR_PAD_LEFT); ?> -->
                                <!-- </td> -->

                  <!-- <td class="text-center text-uppercase align-middle">
                                <?php //echo ($dados['flStatusUser'] == 1) ? "Ativo" : "Inativo";
                                ?>
                </td> -->
                                <td class="">
                                    <ul class="nav justify-content-center align-middle">
                                        <?php
                                        switch ($_SESSION['NIVEL']) {
                                            case '0':
                                                echo "<li class=\"nav-item\">
                                      <a href=\"?page=edtMaterial&idEdit={$dados['idMaterial']}\" class=\"btn btn-tool\" 
                                      target=\"\" title=\"Editar Material\" rel=\"noopener noreferrer\">
                                        <i class=\"far fa-edit fa-lg\"></i>
                                      </a>
                                  </li>";
                                                break;

                                            case '1':
                                                echo "<li class=\"nav-item\">
                                      <a href=\"?page=edtMaterial&idEdit={$dados['idMaterial']}\" class=\"btn btn-tool\" 
                                      target=\"\" title=\"Editar Material\" rel=\"noopener noreferrer\">
                                        <i class=\"far fa-edit fa-lg\"></i>
                                      </a>
                                  </li>";
                                                break;

                                            default:
                                                # code...
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


<!-- modal -->
<div class="modal fade" id="modal-novoMaterial">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Novo Cadatro de Material</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form novo Exame -->

                <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovoMaterial.php" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label for="codMaterial">Código</label>
                            <input type="number" name="codMaterial" class="form-control text-uppercase" id="codMaterial"
                                   placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-10 mb-3">
                            <label for="strMaterial">Material </label>
                            <input type="text" name="strMaterial" class="form-control text-uppercase" id="strMaterial" placeholder=""
                                   value="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3 form-group">
                            <label for="unMaterial">Unidade </label>

                            <select class="form-control select2 mb-4" required name="unMaterial" >

                                <option value="" selected disabled>Selecione a Unidade</option>
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
                                   placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
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
                <!--/form novo Exame -->
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
      document.getElementById('gestMaterialMenu').classList.add("menu-open");
      document.getElementById('getMaterialActive').classList.add("active");

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

</script>
