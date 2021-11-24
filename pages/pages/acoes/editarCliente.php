<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

  $idEdit = $_POST['idEdit'];
  $dados['nmPessoa'] = strip_tags(strip_tags(trim(strtoupper($_POST['nmPessoa']))));
  $dados['nmPessoaSocial'] = strip_tags(strip_tags(trim(strtoupper($_POST['nmPessoaSocial']))));
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

  $updatePessoa = atualizar('pessoa', $dados, "idPessoa = '{$idEdit}'");

  $cliente['sexoCliente'] = strip_tags(strip_tags(trim($_POST['sexoCliente'])));
  $cliente['strEstadoCivilCliente'] = strip_tags(strip_tags(trim($_POST['strEstadoCivilCliente'])));
  $cliente['strNaturalidadeCliente'] = strip_tags(strip_tags(trim($_POST['strNaturalidadeCliente'])));
  $cliente['nnRg'] = strip_tags(strip_tags(trim(strtoupper($_POST['nnRg']))));
  $cliente['nmMae'] = strip_tags(strip_tags(trim(strtoupper($_POST['nmMae']))));
  $cliente['nmPai'] = strip_tags(strip_tags(trim(strtoupper($_POST['nmPai']))));
  $cliente['nmResponsavel'] = strip_tags(strip_tags(trim(strtoupper($_POST['nmResponsavel']))));

  $updateU = atualizar('clientes', $cliente, "idPessoa = '{$idEdit}'");

  if ($updatePessoa && $updateU) {
    $log['tipyActionLog'] = 'Atualizar';
    $log['userActionLog'] = $_POST['userActionLog'];
    $log['actionLog'] = "Atualizou os dados do Cliente:  {$dados['nmPessoa']} -CPF: {$dados['docPessoa']}";
    inseir('logs', $log);

    echo "<script type='text/javascript'>
            alert('Os dados do Cliente {$dados['nmPessoa']} foram  atualizados com sucesso !');
            history.go(-1);
          </script>";
  } else {
    echo "<script type='text/javascript'>
    alert('Os dados do Cliente {$dados['nmPessoa']} NÃO foram  atualizados !');
    history.go(-1);
  </script>";
  }
}
