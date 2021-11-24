<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

    $dados['descricaoTipoSolicitante'] = strip_tags(strip_tags(trim(strtoupper($_POST['descricaoTipoSolicitante']))));

    // echo '<pre>';
    // print_r($dados);
    // echo '</pre>';

    $lendo = ler("tiposolicitante", '', "WHERE descricaoTipoSolicitante = '{$dados['descricaoTipoSolicitante']}'");
    $verifica = $lendo->rowCount();
    if ($verifica >= 1) {

        echo "<script type='text/javascript'>
      alert('O Tipo de Solicitante {$dados['descricaoTipoSolicitante']} já está Cadastrada !');
      window.location = '?page=listarTipoSolicitante';
    </script>";

        //echo "<div class=\"alert alert-danger text-uppercase\" role=\"alert\">O Usuário {$dados['nmPessoa']} já possui cadastro !</div>";
    } else {
        $inserido = inseir('tiposolicitante', $dados);
        echo "<script type='text/javascript'>
      alert('O Tipo de Solicitante {$dados['descricaoTipoSolicitante']} foi Cadastrada com sucesso !');
      window.location = '../../../inicio.php?page=listarTipoSolicitante';
    </script>";
        //echo "<div class=\"alert alert-success text-uppercase\" role=\"alert\">O paciente {$dados['nmPessoa']} foi Cadastrado com sucesso !</div>";
    }
}
//}