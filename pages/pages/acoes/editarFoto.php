<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

  $idEdit = $_POST['idPessoa'];
  $nomePessoa = $_POST['nomePessoa'];
  $pasta = "./../../../upload/fotoPessoas/";
  $extensoes = array('jpg', 'jpeg', 'gif', 'png', 'jfif');

  $ler = ler('pessoa', '', "WHERE idPessoa = '{$idEdit}'");
  $listar = $ler->fetchAll(PDO::FETCH_ASSOC);
  foreach ($listar as $dados) {
    $odlImg = $dados['foto'];

    if (is_file($pasta . '/' . $odlImg)) {
      unlink($pasta . '/' . $odlImg);
    }
  }

  if ($_FILES['foto']['name'] == '') {
    $cliente['foto'] = '';
  } else {
    $cliente['foto'] = upLoadFile($_FILES['foto'], 1,  $extensoes, $pasta);
  }

  $updateFoto = atualizar('pessoa', $cliente, "idPessoa = '{$idEdit}'");

  if ($updateFoto) {

    foreach (ler('pessoa', '', "WHERE idPessoa = '{$idEdit}'")->fetchAll(PDO::FETCH_ASSOC) as $dados) {
      $nomePessoa = $dados['nmPessoa'];
    }

    $log['tipyActionLog'] = 'Atualizar';
    $log['userActionLog'] = $_POST['userActionLog'];
    $log['actionLog'] = "Atualizou a Foto do usuario {$nomePessoa}";
    inseir('logs', $log);

    echo "<script type='text/javascript'>
              alert('Foto atualizada com sucesso !');
  history.back();
            </script>";
  } else {
    echo "<script type='text/javascript'>
      alert('a Foto NÃO foi atualizada !');
  history.back();
    </script>";
  }
}
