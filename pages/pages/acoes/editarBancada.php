<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {
  //  $idEdt = $_POST['idEdt'];
  $dados['nmBancada'] = strip_tags(trim(strtoupper($_POST['nmBancada'])));

  atualizar('bancadaexame', $dados, "idBancada = '{$_POST['idEdt']}'");

  // $updateB = atualizar('bancadaexame', $dados, "idBancada = '{$_POST['idEdit']}'");

  echo "<script type='text/javascript'>
          alert('A Bancada {$dados['nmBancada']} foi atualizada com Sucesso !');
          window.location = '../../../inicio.php?page=listBancadaExames';
        </script>";
}
