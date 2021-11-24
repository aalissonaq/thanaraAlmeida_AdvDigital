<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

    $dados['codMaterial'] = strip_tags(strip_tags(trim(strtoupper(str_replace(' ', '', $_POST['codMaterial'])))));
    $dados['strMaterial'] = strip_tags(strip_tags(trim(strtoupper($_POST['strMaterial']))));
    $dados['unMaterial'] = strip_tags(strip_tags(trim($_POST['unMaterial'])));
    $dados['qtdEstoqueMaterial'] = strip_tags(strip_tags(trim(strtoupper($_POST['qtdEstoqueMaterial']))));

    // $inserido = inseir('materiais', $dados);
    $updateMateril = atualizar('materiais', $dados, "idMaterial = '{$_POST['idEdit']}'");

    if ($updateMateril) {
        echo "<script type='text/javascript'>
          alert('O Item {$dados['strMaterial']} foi alterado com sucesso !');
          window.location = '../../../inicio.php?page=listarMateriais';
        </script>";
    }
}
//}
