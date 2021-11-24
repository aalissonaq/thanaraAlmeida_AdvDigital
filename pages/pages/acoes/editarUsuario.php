<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';
$idP = 0;
$lendo = ler("users", '', "WHERE id = '{$_POST['idEdit']}' ");
$dadosUser = $lendo->fetchAll(PDO::FETCH_ASSOC);
#dados para tebela usuário
foreach ($dadosUser as $dado) {
    $idP = $dado['idPessoa'];
};

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {


    // $iduser = strip_tags(strip_tags(trim(strtoupper($_POST['nmPessoa']))));
    $dados['nmPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['nmPessoa']))));
    $dados['docPessoa'] = strip_tags(strip_tags(trim(strtoupper(tiraMascara($_POST['docPessoa'])))));

    $dados['dtNascPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['dtNascPessoa']))));
    $dados['stCepPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stCepPessoa']))));
    $dados['stLogradouroPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stLogradouroPessoa']))));
    $dados['nnCasaPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['nnCasaPessoa']))));
    $dados['stCompleEndPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stCompleEndPessoa']))));
    $dados['stBairroPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stBairroPessoa']))));
    $dados['stEstadoPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stEstadoPessoa']))));
    $dados['nnTelefonePessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['nnTelefonePessoa']))));
    $dados['nnWhatsappPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['nnWhatsappPessoa']))));
    $dados['stEmailPessoa'] = strip_tags(strip_tags(trim($_POST['stEmailPessoa'])));
    $dados['txtObsContatosPessoas'] = strip_tags(strip_tags(trim(strtoupper($_POST['txtObsContatosPessoas']))));



    $updateP = atualizar('pessoa', $dados, "idPessoa = '{$idP}'");


    // $inserido = inseir('pessoa', $dados);
    // if ($updateP == true) {
    $lendo = ler("pessoa", '', "WHERE nmPessoa = '{$dados['nmPessoa']}' OR docPessoa = '{$dados['docPessoa']}' ");
    $dadosPessoa = $lendo->fetchAll(PDO::FETCH_ASSOC);
    #dados para tebela usuário
    foreach ($dadosPessoa as $dado) {

        // $usuario['idPessoa'] = $dado['idPessoa'];
        // $p1 = explode(".", $_POST['nnCpfPessoa']);
        // $p2 = explode("-", $_POST['nnCpfPessoa']);
        // $usuario['passUser'] = strip_tags(strip_tags(trim(md5($_POST['passUser']))));
        $usuario['nivelUser'] = strip_tags(strip_tags(trim(strtoupper($_POST['nivelUser']))));
        $usuario['flStatusUser'] = strip_tags(strip_tags(trim(strtoupper($_POST['flStatusUser']))));
        //$usuario['nivelUser'] = 3;
        //$usuario['flStatusUser'] = 1;

        $updateU = atualizar('users', $usuario, "idPessoa = '{$dado['idPessoa']}'");
        // inseir('', $usuario);
        // }
    }

    echo "<script type='text/javascript'>
          alert('O Usuário {$dados['nmPessoa']} teve seus dados Editados com sucesso !');
          window.location = '../../../inicio.php?page=listarusuarios';
        </script>";
    //echo "<div class=\"alert alert-success text-uppercase\" role=\"alert\">O paciente {$dados['nmPessoa']} foi Cadastrado com sucesso !</div>";
    // }
}
//}
