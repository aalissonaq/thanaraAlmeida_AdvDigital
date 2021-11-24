<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

    $dados['idBancada'] = strip_tags(strip_tags(trim(strtoupper($_POST['idBancada']))));
    $dados['identifexameac'] = strip_tags(strip_tags(trim(strtoupper($_POST['identifexameac']))));
    $dados['descricaoexameac'] = strip_tags(strip_tags(trim(strtoupper($_POST['descricaoexameac']))));
    $dados['tuboexameac'] = strip_tags(strip_tags(trim(strtoupper($_POST['tuboexameac']))));
    $dados['materialexameac'] = strip_tags(strip_tags(trim(strtoupper($_POST['materialexameac']))));

    // echo '<pre>';
    // print_r($dados);
    // echo '</pre>';

    $lendo = ler("exemesac", '', "WHERE identifexameac = '{$dados['identifexameac']}'");
    $verifica = $lendo->rowCount();
    if ($verifica >= 1) {

        echo "<script type='text/javascript'>
          alert('O Exame {$dados['descricaoexameac']} já está Cadastrado !');
          window.location = '../../../inicio.php?page=listarExamesGest';
        </script>";

        //echo "<div class=\"alert alert-danger text-uppercase\" role=\"alert\">O Usuário {$dados['nmPessoa']} já possui cadastro !</div>";
    } else {
        $inserido = inseir('exemesac', $dados);
        echo "<script type='text/javascript'>
          alert('O Exame {$dados['descricaoexameac']} foi Cadastrado com sucesso !');
          window.location = '../../../inicio.php?page=listarExamesGest';
        </script>";
        //echo "<div class=\"alert alert-success text-uppercase\" role=\"alert\">O paciente {$dados['nmPessoa']} foi Cadastrado com sucesso !</div>";
    }
}
//}
