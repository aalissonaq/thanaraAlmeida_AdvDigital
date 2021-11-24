<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

    $dados['codMaterial'] = strip_tags(strip_tags(trim(strtoupper(str_replace(' ', '', $_POST['codMaterial'])))));
    $dados['strMaterial'] = strip_tags(strip_tags(trim(strtoupper($_POST['strMaterial']))));
    $dados['unMaterial'] = strip_tags(strip_tags(trim($_POST['unMaterial'])));
    $dados['qtdEstoqueMaterial'] = strip_tags(strip_tags(trim(strtoupper($_POST['qtdEstoqueMaterial']))));

    //  echo '<pre>';
    //  print_r($dados);
    //  echo '</pre>';

    $lendo = ler("materiais", '', "WHERE codMaterial = '{$dados['codMaterial']}'");
    $verifica = $lendo->rowCount();
    if ($verifica >= 1) {

        echo "<script type='text/javascript'>
          alert('O Material {$dados['strMaterial']} já está Cadastrado !');
          window.location = '../../../inicio.php?page=listarMateriais';
        </script>";

        //echo "<div class=\"alert alert-danger text-uppercase\" role=\"alert\">O Usuário {$dados['nmPessoa']} já possui cadastro !</div>";
    } else {
        $inserido = inseir('materiais', $dados);
        echo "<script type='text/javascript'>
          alert('O Material {$dados['strMaterial']} foi Cadastrado com sucesso !');
          window.location = '../../../inicio.php?page=listarMateriais';
        </script>";
        //echo "<div class=\"alert alert-success text-uppercase\" role=\"alert\">O paciente {$dados['nmPessoa']} foi Cadastrado com sucesso !</div>";
    }
}
//}
