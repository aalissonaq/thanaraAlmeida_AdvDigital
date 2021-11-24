<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

    $dados['nmPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['nmPessoa']))));
    $dados['docPessoa'] = strip_tags(strip_tags(trim(strtoupper(tiraMascara($_POST['docPessoa'])))));

    $dados['dtNascPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['dtNascPessoa']))));
    $dados['stCepPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stCepPessoa']))));
    $dados['stLogradouroPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stLogradouroPessoa']))));
    $dados['nnCasaPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['nnCasaPessoa']))));
    $dados['stCompleEndPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stCompleEndPessoa']))));
    $dados['stBairroPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stBairroPessoa']))));
    $dados['stCidadePessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stCidadePessoa']))));
    $dados['stEstadoPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['stEstadoPessoa']))));
    $dados['nnTelefonePessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['nnTelefonePessoa']))));
    $dados['nnWhatsappPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['nnWhatsappPessoa']))));
    $dados['stEmailPessoa'] = strip_tags(strip_tags(trim($_POST['stEmailPessoa'])));
    $dados['txtObsContatosPessoas'] = strip_tags(strip_tags(trim(strtoupper($_POST['txtObsContatosPessoas']))));

    $pasta = "./../../../upload/fotoPessoas";
    $extensoes = array('jpg', 'jpeg', 'gif', 'png');

    if ($_FILES['foto']['name'] == '') {
        $dados['foto'] = '';
    } else {
        $dados['foto'] = upLoadFile($_FILES['foto'], 1,  $extensoes, $pasta);
    }


    if (ler("pessoa", '', "WHERE docPessoa = '{$dados['docPessoa']}' ")->rowCount() > 0) {
        echo '<script>alert("Já existe um usuário com este CPF cadastrado!"); history.go(-1) ; </script>';
    } else {
        $inserido = inseir('pessoa', $dados);
        foreach (ler("pessoa", '', "WHERE docPessoa = '{$dados['docPessoa']}' ") as $pessoa) {
            $usuario['idPessoa'] = $pessoa['idPessoa'];
            $usuario['passUser'] = md5(substr($dados['docPessoa'], 0, 3) . substr($dados['docPessoa'], -2));
            $usuario['nivelUser'] = strip_tags(trim($_POST['nivelUser']));
            $usuario['flStatusUser'] = strip_tags(trim($_POST['flStatusUser']));

            inseir('users', $usuario);

            $log['tipyActionLog'] = 'Cadastrar';
            $log['userActionLog'] = $_POST['userActionLog'];
            $log['actionLog'] = "Cadastro de novo Usuário do sistema:  {$dados['nmPessoa']} -CPF: {$cpfCliente}";

            inseir('logs', $log);

            echo '<script>alert("Usuário cadastrado com sucesso!"); history.go(-1); </script>';
        }
    }
}
