<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

  $idEdit = $_POST['idPessoaCliente'];
  $nomePessoa = $_POST['nomePessoa'];
  $pasta = "./../../../upload/imgClientes";
  $extensoes = array('jpg', 'jpeg', 'gif', 'png', 'jfif');

  $ler = ler('clientes', '', "WHERE idPessoa = '{$idEdit}'");
  $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
  foreach ($listar as $dados) {
    $odlImg = $dados['imgCliente'];

    if (is_file($pasta . '/' . $odlImg)) {
      unlink($pasta . '/' . $odlImg);
    }
  }


  if ($_FILES['imgCliente']['name'] == '') {
    $cliente['imgCliente'] = '';
  } else {
    $cliente['imgCliente'] = upLoadFile($_FILES['imgCliente'], 1,  $extensoes, $pasta);
  }

  $updateFoto = atualizar('clientes', $cliente, "idPessoa = '{$idEdit}'");

  if ($updateFoto) {


    $log['tipyActionLog'] = 'Atualizar';
    $log['userActionLog'] = $_POST['userActionLog'];
    $log['actionLog'] = "Atualizou a Foto do Cliente:  {$nomePessoa}";
    inseir('logs', $log);

    echo "<script type='text/javascript'>
            alert('a Foto do Cliente {$nomePessoa} foi  atualizada com sucesso !');
history.back();
          </script>";
  } else {
    echo "<script type='text/javascript'>
    alert('a Foto do Cliente NÃO foi atualizada !');
history.back();
  </script>";
  }
}
