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
      <h3 class="card-title">Novo Exame</h3>

      <div class="card-tools">
        <a href="?page=listarExamesGest" class="btn btn-tool text-primary">
          <i class="far fa-arrow-alt-circle-left fa-fw fa-lg"></i>
          Voltar para Lista de Exames</a>
      </div>
    </div>
    <div class="card-body">

      <form class="needs-validation" novalidate action="pages/pages/acoes/gravaNovoExame.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-md-2 mb-3">
            <label for="codigoexame">Códego</label>
            <input type="text" name="codigoexame" class="form-control text-uppercase" id="codigoexame" placeholder="" value="" required>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-5 mb-3">
            <label for="exame">Exame</label>
            <input type="text" name="exame" class="form-control text-uppercase" id="exame" placeholder="" required>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="sinonimos">Sinônimos</label>
            <input type="text" name="sinonimos" class="form-control text-uppercase" id="sinonimos" placeholder="" required>
            <div class="invalid-feedback">
              Obrigatório !
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="material">Material</label>
            <input type="text" name="material" class="form-control text-uppercase" id="material" placeholder="" required>
            <div class="invalid-feedback">
              Este Campo é Obrigatório !
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12 mb-3">
            <label for="interpretacaoexame">Interpretação</label>
            <textarea class="form-control text-uppercase js_textareaEdt textarea" placeholder="" rows="5" name="interpretacaoexame">
                        </textarea>
            <div class="invalid-feedback">
              Este Campo é Obrigatório !
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="metodoexame">Método</label>
            <textarea class="form-control text-uppercase js_edtNoToolBar" placeholder="" rows="5" name="metodoexame">
                        </textarea>
            <div class="invalid-feedback">
              Este Campo é Obrigatório !
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="parametroexame">Parâmetro</label>
            <textarea class="form-control text-uppercase js_edtNoToolBar" placeholder="" parametroexame rows="5" name="parametroexame">
                        </textarea>
            <div class="invalid-feedback">
              Este Campo é Obrigatório !
            </div>
          </div>

          <div class="col-md-5 mb-3">
            <label for="valorReferenciaExame">Valor de Referência</label>
            <textarea class="form-control text-uppercase js_edtNoToolBar" placeholder="" rows="5" name="valorReferenciaExame">
                        </textarea>
            <div class="invalid-feedback">
              Este Campo é Obrigatório !
            </div>
          </div>
        </div>

        <div class="form-row ">
          <div class="col-md-12 mb-3">
            <label for="instrucoesPreparoExame">Instruções de Preparo do Exame</label>
            <input type="text" name="instrucoesPreparoExame" class="form-control" id="instrucoesPreparoExame" placeholder="">
            <div class="invalid-feedback ">
              .) !
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
