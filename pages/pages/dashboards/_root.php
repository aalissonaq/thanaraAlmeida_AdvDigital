<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 " style="font-family:'Advent Pro', sans-serif; font-weight: 300; ">
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
      <div class="col-12 col-sm-6 col-md-4">
        <a href="#">

          <div class="small-box bg-default">
            <div class="inner mx-3">
              <?php
              $today = date("Y-m-d", time());
              $sql = "SELECT * FROM tarefas WHERE dtTarefa = '$today'";
              $resultado = $conexao->query($sql);
              ?>

              <h3><?= str_pad($resultado->rowCount(), 3, "0", STR_PAD_LEFT); ?></h3>
              <p>Tarefas para hoje</p>
            </div>
            <div class="icon">
              <!-- <i class="far fa-clock"></i> -->
              <i class="mdi mdi-calendar-clock-outline "></i>
            </div>

          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-4">


        <a href="">
          <div class="small-box bg-gradient-default">
            <div class="inner mx-3">
              <?php
              $sql = "SELECT * FROM tarefas WHERE finalizada = 0";
              $resultado = $conexao->query($sql);
              ?>
              <h3><?= str_pad($resultado->rowCount(), 3, "0", STR_PAD_LEFT); ?></h3>
              <p>Tarefas pendentes</p>
            </div>
            <div class="icon ">
              <i class="mdi mdi-calendar-alert "></i>
            </div>

          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-4">
        <a href="">
          <div class="small-box bg-gradient-default">
            <div class="inner mx-3">
              <?php
              $sql = "SELECT * FROM tarefas WHERE finalizada = 1";
              $resultado = $conexao->query($sql);
              ?>
              <h3><?= str_pad($resultado->rowCount(), 3, "0", STR_PAD_LEFT); ?></h3>
              <p>Tarefas Concluidas</p>
            </div>
            <div class="icon ">
              <i class="mdi mdi-calendar-multiple-check "></i>
            </div>

          </div>
        </a>
        <!-- /.info-box -->
      </div>

      <!-- /.col -->

      <!-- /.col -->
      </a>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-4">
        <div id='calendar'></div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!--/. container-fluid -->
</section>
<!-- /.content -->



<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js" >

</script> -->



<script>
  document.getElementById('inicio').classList.add("active");
</script>
