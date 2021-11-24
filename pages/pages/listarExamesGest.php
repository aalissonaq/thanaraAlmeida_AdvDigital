<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gestão de Exames</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=inicio">Home</a></li>
                    <li class="breadcrumb-item active">Lista de Exames</li>
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
            <h3 class="card-title">Lista de Exames
            </h3>


            <div class="card-tools">
                <a href="" class="btn btn-tool text-primary" data-toggle="modal" data-target="#modal-novoExame">
                    <i class="fa fa-plus-square fa-fw fa-lg"></i>
                    Novo Exame</a>

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
                            <!-- <th class="col-md-auto text-center text-uppercase align-middle">Bancada</th> -->
                            <th class="col-md-auto text-center text-uppercase align-middle">Identificação</th>
                            <th class="col-md-auto text-center text-uppercase align-middle">Descrição </th>
                            <th class="col-md-auto text-center text-uppercase align-middle">Tubo </th>
                            <th class="col-md-auto text-center text-uppercase align-middle">Material </th>
                            <!-- <th class="col-md-auto  text-center align-middle">Status</th> -->
                            <th class="col-md-auto  text-center align-middle">
                                <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cont = 0;
                        $ler = ler("exemesac", '', "ORDER BY identifexameac ASC");
                        $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($listar as $dados) {
                            $cont = $cont + 1;
                        ?>

                            <tr>
                                <!-- <td class="text-center text-uppercase"> -->
                                <?php
                                // $lerBancada = ler('bancadaexame', '', "WHERE idBancada = '{$dados['idBancada']}'")
                                //   ->fetchAll(PDO::FETCH_ASSOC);
                                // foreach ($lerBancada as $bancada) {
                                //   echo $bancada['nmBancada'];
                                // }
                                ?>
                                <!-- </td> -->

                                <td class="text-centerN text-uppercase align-middle" style="font-size: .9rem;">
                                    <?php echo $dados['identifexameac']; ?>
                                </td>
                                <td class=" text-uppercase align-middle" style="font-size: .9rem;">
                                    <?php echo $dados['descricaoexameac']; ?>
                                </td>
                                <td class="text-uppercase text-center align-middle" style="font-size: .9rem;">
                                    <?php echo $dados['tuboexameac']; ?>
                                </td>
                                <td class="text-uppercase text-center align-middle" style="font-size: .9rem;">
                                    <?php echo $dados['materialexameac']; ?>
                                </td>

                                <!-- <td class="text-center text-uppercase align-middle">
                                <?php //echo ($dados['flStatusUser'] == 1) ? "Ativo" : "Inativo"; 
                                ?>
                </td> -->
                                <td class="">
                                    <ul class="nav justify-content-center align-middle">

                                        <?php
                                    //     echo "<li class=\"nav-item\">
                                    //   <a href=\"?page=edtExame&idEdit={$dados['idExamesac']}\" class=\"btn btn-tool\" target=\"\" title=\"Editar Exame\" rel=\"noopener noreferrer\">
                                    //     <i class=\"far fa-edit fa-lg\"></i>
                                    //    </a>
                                    //  </li>";
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


<!-- modal -->
<div class="modal fade" id="modal-novoExame">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Novo Exame</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form novo Exame -->

                <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovoExame.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">


                            <label for="flStatusUser">Bancada</label>
                            <select class="form-control text-uppercase" required name="idBancada" id="idBancada">
                                <option value="" selected disabled>Selecione uma Bancada</option>
                                <?php
                                $lerBancada = ler('bancadaexame')->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($lerBancada as $bancada) {
                                    echo "<option value=\"{$bancada['idBancada']}\">{$bancada['nmBancada']}</option>";
                                    // echo "<option value=\"$bancada['idBancada']\">$bancada['nmBancada']</option>";
                                };
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="identifexameac">Identificação </label>
                            <input type="text" name="identifexameac" class="form-control text-uppercase" id="identifexameac" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="descricaoexameac">Descrição</label>
                            <input type="text" name="descricaoexameac" class="form-control text-uppercase" id="descricaoexameac" placeholder="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="tuboexameac">Tubo </label>
                            <input type="text" name="tuboexameac" class="form-control text-uppercase" id="tuboexameac" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Obrigatório !
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="materialexameac">Material</label>
                            <input type="text" name="materialexameac" class="form-control text-uppercase" id="materialexameac" placeholder="" required>
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


<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
</script>

<script src="./dist/js/app.js"></script>

<script>
    document.getElementById('gestaoMenu').classList.add("menu-open");
    document.getElementById('gestaoMenuActive').classList.add("active");
    document.getElementById('gestExameMenu').classList.add("menu-open");
    document.getElementById('getExemesActive').classList.add("active");

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
</script>