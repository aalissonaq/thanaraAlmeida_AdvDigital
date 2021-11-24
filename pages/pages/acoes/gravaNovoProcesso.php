<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

  $dados['idcliente'] = strip_tags(strip_tags(trim($_POST['idcliente'])));
  $dados['niprocesso'] = strip_tags(strip_tags(trim($_POST['niprocesso'])));
  $dados['idadvogado'] = strip_tags(strip_tags(trim($_POST['idadvogado'])));
  $dados['objprocesso'] = strip_tags(strip_tags(trim($_POST['objprocesso'])));
  $dados['contraparte'] = strip_tags(strip_tags(trim($_POST['contraparte'])));
  $dados['descricaoprocesso'] = strip_tags(strip_tags(trim($_POST['descricaoprocesso'])));
  $dados['numprocesso'] = $_POST['numprocesso'] == '' ? '0' : strip_tags(strip_tags(trim(tiraMascara($_POST['numprocesso']))));
  $dados['areaprocesso'] = strip_tags(strip_tags(trim($_POST['areaprocesso'])));
  $dados['statusprocesso'] = strip_tags(strip_tags(trim($_POST['statusprocesso'])));

  $inserir = inseir('processos', $dados);

  if ($inserir) {
    $log['tipyActionLog'] = 'Cadastrar';
    $log['userActionLog'] = $_POST['userActionLog'];
    $log['actionLog'] = "Cadastrou um ovo processo do Cliente:  {$_POST['nomeCliente']}";
    inseir('logs', $log);
  }
  echo "<script type='text/javascript'> alert('O Processo foi Cadastrado com sucesso !');
          history.go(-1);
        </script>";
}
