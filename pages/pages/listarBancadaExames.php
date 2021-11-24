<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gestão de Exames</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=inicio">Home</a></li>
                    <li class="breadcrumb-item active">Lista de Bancadas</li>
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
            <h3 class="card-title">Lista de Bancadas
            </h3>


            <div class="card-tools">
                <a href="?page=" class="btn btn-tool text-primary" data-toggle="modal" data-target="#modal-novaBancada">
                    <i class="fa fa-plus-square fa-fw fa-lg"></i>
                    Nova Bancada</a>
                <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                             title="Collapse">
                             <i class="fas fa-minus"></i>ttt</button>
                         <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                             title="Remove">
                             <i class="fas fa-times"></i></button> -->
            </div>
        </div>
        <div class="card-body">

            <table id="tabela" class="table table-sm table-striped table-hover">
                <thead>
                    <tr>
                        <th class="col-md-auto text-center text-uppercase align-middle">#</th>
                        <th class="col-md-auto text-center text-uppercase align-middle">Bancada</th>

            <!-- <th class="col-md-auto  text-center align-middle">Status</th> -->
                        <th class="col-md-auto text-center align-middle">
                            <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 0;
                    $ler = ler("bancadaexame", '', "ORDER BY nmBancada ASC");
                    $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listar as $dados) {
                        $cont = $cont + 1;
                        ?>

                        <tr>
                            <td class="text-center align-middle"><?php echo str_pad($cont, 2, "0", STR_PAD_LEFT); ?></td>

                            <td class="text-uppercase align-middle"><?php echo $dados['nmBancada']; ?>
                            </td>

                    <!-- <td class="text-center text-uppercase">
                            <?php //echo ($dados['flStatusUser'] == 1) ? "Ativo" : "Inativo"; ?>
                    </td> -->
                            <td class="">
                                <ul class="nav justify-content-center align-middle">
                                    <?php
                                    echo "<li class=\"nav-item\">
                                      <a href=\"?page=edtBancada&idEdit={$dados['idBancada']}\" class=\"btn btn-tool\" target=\"\" title=\"Editar Exame\" rel=\"noopener noreferrer\">
                                        <i class=\"far fa-edit fa-lg\"></i>
                                       </a>
                                     </li>";
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
<div class="modal fade" id="modal-novaBancada">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nova Bancada</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form nova Bancada -->

                <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovaBancada.php" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                            <label for="nmBancada">NOME DA BANCADA</label>
                            <input type="text" name="nmBancada" class="form-control text-uppercase" id="nmBancada" placeholder=""
                                   required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                    </div>


                    <!--/form nova bancada -->
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" name="gravar" value="gravar">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
                    Fechar </button>
                <button class="btn btn-primary" type="submit">
                    <i class="far fa-save fa-fw fa-lg"></i>
                    Gravar Dados</button>
                </form>
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
            document.getElementById('gestExameMenu').classList.add("menu-open");
            document.getElementById('bancadaExemesActive').classList.add("active");

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
</script>
