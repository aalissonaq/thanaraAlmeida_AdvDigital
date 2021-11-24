<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gestão de Exames</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Lista de Exames</li>
                    <li class="breadcrumb-item active">Novo Exame</li>
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
            <h3 class="card-title">Editar Exame</h3>

            <div class="card-tools">
                <a href="?page=listarExamesGest" class="btn btn-tool text-primary">
                    <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i>
                    Voltar para Lista de Exames</a>
            </div>
        </div>
        <div class="card-body">

            <form class="needs-validation" novalidate action="pages/pages/acoes/" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-4 mb-3">


                        <label for="flStatusUser">Bancada</label>
                        <select class="form-control text-uppercase" required name="flStatusUser" id="flStatusUser">
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
                            Este Campo é Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="codigoexame">Identificação </label>
                        <input type="text" name="codigoexame" class="form-control text-uppercase" id="codigoexame" placeholder=""
                               value="" required>
                        <div class="invalid-feedback">
                            Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exame">Descrição</label>
                        <input type="text" name="exame" class="form-control text-uppercase" id="exame" placeholder="" required>
                        <div class="invalid-feedback">
                            Obrigatório !
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="codigoexame">Tubo </label>
                        <input type="text" name="codigoexame" class="form-control text-uppercase" id="codigoexame" placeholder=""
                               value="" required>
                        <div class="invalid-feedback">
                            Obrigatório !
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exame">Material</label>
                        <input type="text" name="exame" class="form-control text-uppercase" id="exame" placeholder="" required>
                        <div class="invalid-feedback">
                            Obrigatório !
                        </div>
                    </div>

                </div>

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
    document.getElementById('gestExameMenu').classList.add("menu-open");
    document.getElementById('getExemesActive').classList.add("active");

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
