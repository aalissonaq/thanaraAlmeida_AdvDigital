<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

    $dados['nmBancada'] = strip_tags(strip_tags(trim(strtoupper($_POST['nmBancada']))));

    // echo '<pre>';
    // print_r($dados);
    // echo '</pre>';

    $lendo = ler("bancadaexame", '', "WHERE nmBancada = '{$dados['nmBancada']}'");
    $verifica = $lendo->rowCount();
    if ($verifica >= 1) {

        echo "<script type='text/javascript'>
          alert('A Bancada {$dados['nmBancada']} já está Cadastrada !');
          window.location = '?page=listBancadaExames';
        </script>";

        //echo "<div class=\"alert alert-danger text-uppercase\" role=\"alert\">O Usuário {$dados['nmPessoa']} já possui cadastro !</div>";
    } else {
        $inserido = inseir('bancadaexame', $dados);
        echo "<script type='text/javascript'>
          alert('O Bancada {$dados['nmBancada']} foi Cadastrada com sucesso !');
          window.location = '../../../inicio.php?page=listBancadaExames';
        </script>";
        //echo "<div class=\"alert alert-success text-uppercase\" role=\"alert\">O paciente {$dados['nmPessoa']} foi Cadastrado com sucesso !</div>";
    }
}
//}
