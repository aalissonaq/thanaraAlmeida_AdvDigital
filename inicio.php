<?php
session_start();
date_default_timezone_set('America/Fortaleza');
require_once './data/dbasys.php';
require_once './data/conexao.php';
$conexao = novaConexao();

require_once './util/util.php';
require_once './data/outfunc.php';

date_default_timezone_set('America/Sao_Paulo');
if (!isset($_SESSION['USUARIO'])) {
  header("Location: index.php");
} else if (isset($_GET['acao']) && $_GET['acao'] === 'sair') {

  $log['tipyActionLog'] = 'Sair';
  $log['userActionLog'] = $_SESSION['USUARIO'];
  $log['actionLog'] = "O Usuario {$_SESSION['USUARIO']}, Saiu do Sistema";

  inseir('logs', $log);
  session_destroy();
  header("Location: index.php");
} else if (isset($_GET['acao']) && $_GET['acao'] === 'bloc') {
  // $blocId = $_GET['blocID'];
  $dados['flStatusUser'] = '0';
  $bloc = atualizar('users', $dados, "id = {$_GET['blocID']}");
  if ($bloc) {
    header("Location: ?page=listarusuarios");
  }
} else if (isset($_GET['acao']) && $_GET['acao'] === 'unbloc') {
  // $blocId = $_GET['blocID'];
  $dados['flStatusUser'] = '1';
  $bloc = atualizar('users', $dados, "id = {$_GET['blocID']}");
  if ($bloc) {
    header("Location: ?page=listarusuarios");
  }
} else if (isset($_GET['acao']) && $_GET['acao'] === 'blocService') {
  // $blocId = $_GET['blocID'];
  $dados['statusServico'] = '0';
  $blocService = atualizar('servicos', $dados, "idServicos = {$_GET['id']}");
  if ($blocService) {
    header("Location: ?page=listarServicos");
  }
} else if (isset($_GET['acao']) && $_GET['acao'] === 'unblocService') {
  // $blocId = $_GET['blocID'];
  $dados['statusServico'] = '1';
  $blocService = atualizar('servicos', $dados, "idServicos = {$_GET['id']}");
  if ($blocService) {
    header("Location: ?page=listarServicos");
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />

  <title>Dra Thanara Almeida | SISTEMA</title>
  <link rel="shortcut icon" href="./image/icon.png" type="image/x-icon" />
  <link rel="stylesheet" href="./plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css" />

  <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" /> -->
  <script src="https://kit.fontawesome.com/3e97e20813.js" crossorigin="anonymous"></script>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
  <!-- dataTables -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css"/> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css" />
  <!-- <link rel="stylesheet" href="./dist/css/bootstrapCustun.css" /> -->

  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
  <!-- <link rel="stylesheet" href="node_modules/@mdi/font/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.5.95/css/materialdesignicons.min.css"> -->

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@100;200;300;400;500;600;700&family=Cinzel+Decorative:wght@400;700;900&family=Cinzel:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />

  <!-- <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css"/> -->

  <script src="plugins/sweetalert2/sweetalert2.js"></script>
  <script src="./pages/js/calendario.js"></script>


  <style type="text/css">
    input {
      caret-color: #C77129;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse! layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
  <div class="wrapper">
    <!-- Navbar -->
    <?php
    $_SESSION['LOGIN'] == 0 ?
      sweetalert("Olá, {$_SESSION['USUARIO']}", 'Bem vindo ao sistema de gestão de clientes.', 'success', 2800, 'center') : '';
    $_SESSION['LOGIN'] = 1;

    require_once './_includes/_navbarRoot.php';
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-gray elevation-4">
      <!-- Brand Logo -->
      <a href="inicio.php" class="brand-link navbar-orange-dark">
        <img src="./image/icon.png" alt="Dra. Thanara Almeida" title="Dra. Thanara Almeida" class="brand-image" style=" width: 30px; height: 50px; " />
        <span class="brand-text font-weight-light" style="font-family:Cinzel; font-weight: 500; font-size: 18px;">
          <img src="./image/mebTxt.png" alt="Dra. Thanara Almeida" title="Dra. Thanara Almeida" class="img-fluid" style=" width: 160px;" />
        </span>
      </a>
      <?php
      switch ($_SESSION['NIVEL']) {
        case '2':
          include_once './_includes/_sidebarSec.php';
          break;

        default:
          include_once './_includes/_sidebarRoot.php';
          break;
      }
      ?>
      <!-- Sidebar -->
      <?php  ?>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class=" content-wrapper">
      <?php
      require_once './conteudo.php';
      ?>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; <?= date('Y', time()); ?> |
        <a href="https://caririinovacao.com.br" target="_new">
          <small>
            Desenvolvido por Cariri Inovação
          </small>
        </a> | </strong> <i>Todos os direitos reservados.</i>
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 0.9
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="dist/js/demo.js"></script>
  <script src="dist/js/app.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script> -->
  <!-- PAGE SCRIPTS -->
  <script src="dist/js/pages/dashboard2.js"></script>

  <!-- jquery.mask -->
  <script src="./dist/js/jquery.mask.min.js" type="text/javascript"></script>
  <!-- JS DO APP-->
  <script src="./dist/js/app.js" type="text/javascript"></script>
  <!-- Summernote -->
  <script src="./plugins/summernote/summernote-bs4.min.js"></script>
  <!-- include summernote-pt-BR -->
  <script src="./plugins/summernote/lang/summernote-pt-BR.min.js"></script>
  <!-- Select2 -->
  <script src="./plugins/select2/js/select2.full.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="./plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="./plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

  <script src="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5.10.1,npm/fullcalendar@5.10.1/locales/pt-br.min.js"></script>

  <script src="plugins/sweetalert2/sweetalert2.js"></script>


</body>

</html>
