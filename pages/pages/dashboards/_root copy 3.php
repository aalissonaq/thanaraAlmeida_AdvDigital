<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 " style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">
          Painel</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif; ">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->


    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <a href="#">

          <div class="small-box bg-default">
            <div class="inner mx-3">
              <h3>0000</h3>
              <p>Tarefas para hoje</p>
            </div>
            <div class="icon">
              <!-- <i class="far fa-clock"></i> -->
              <i class="mdi mdi-calendar-clock-outline " style="margin-top:-2.3rem"></i>
            </div>
            <a href="#" class="small-box-footer">
              Veja mais <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <a href="?page=listarClientes">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1">
              <i class="mdi mdi-account fas fa-fw fa-lg"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">Clientes</span>
              <span class="info-box-number">
                <?php
                $userSystem = ler('clientes', '', "");
                echo $userSystem->rowCount();
                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <a href="">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1">
              <i class="mdi mdi-briefcase-variant mdi-36px"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">Processos </span>
              <span class="info-box-number">
                <?= $service = ler('clientes', '', "")->rowCount(); ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
        <!-- /.info-box -->
      </div>

      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <a href="?page=listarusuarios">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1">
              <i class="mdi mdi-account-group mdi-36px"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">
                Usuários
              </span>
              <span class="info-box-number">
                <?= $userSystem = ler('users', '', "WHERE flStatusUser = 1")->rowCount() - 1; ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
      </div>
      <!-- /.col -->
      </a>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!--/. container-fluid -->
</section>
<!-- /.content -->



<script>
  document.getElementById('inicio').classList.add("active");
</script>
