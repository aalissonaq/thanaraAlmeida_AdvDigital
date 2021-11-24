<?php

session_start();
require_once './data/dbasys.php';
require_once './data/outfunc.php';
//restrito

$login['usuario'] = strip_tags(trim(tiraMascara($_POST['usuario'])));
$login['senha'] = strip_tags(trim(md5($_POST['senha'])));

$lerPessoa = ler("vw_pessoa_user", "", "WHERE docPessoa = '{$login['usuario']}' and passUser = '{$login['senha']}'");
if ($lerPessoa->rowCount() != 0) {
  foreach ($lerPessoa->fetchAll(PDO::FETCH_ASSOC) as $pessoa) {
    $_SESSION['ID'] = $pessoa['idPessoaUser'];
    $_SESSION['USUARIO'] = $pessoa['nmPessoa'];
    $_SESSION['CPFCNPJ'] = $pessoa['docPessoa'];
    $_SESSION['FOTO'] = $pessoa['foto'];
    $_SESSION['STATUS'] = $pessoa['flStatusUser'];
    $_SESSION['NIVEL'] = $pessoa['nivelUser'];
  }
  $log['tipyActionLog'] = 'Entrar';
  $log['userActionLog'] = $_SESSION['USUARIO'];
  $log['actionLog'] = "o Usuario {$_SESSION['USUARIO']}, acessou o Sistema";

  inseir('logs', $log);
  echo '<script>alert("Bem vindo!");</script>';
  echo '<script>window.location="inicio.php";</script>';
} else {
  echo '<script>alert("Usuário ou senha inválidos!");</script>';
  echo '<script>window.location="index.php";</script>';
}
