<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

  $dados['idCreador'] = strip_tags((trim($_POST['idCreador'])));
  $dados['idResponsavel'] = strip_tags((trim($_POST['idResponsavel'])));
  $dados['idProcesso'] = strip_tags((trim($_POST['idProcesso'])));
  $dados['decricaoTarefa'] = strip_tags((trim($_POST['decricaoTarefa'])));
  $dados['dtTarefa'] = strip_tags(strip_tags(trim($_POST['dtTarefa'])));
  $dados['hora'] = strip_tags(strip_tags(trim($_POST['hora'])));
  $dados['local'] = strip_tags(strip_tags(trim($_POST['local'])));
  $dados['prioridade'] = strip_tags(strip_tags(trim($_POST['prioridade'])));

  //$dados['restingir'] = isset($_POST['restingir']) == 'on' ? 1 : 0;
  $dados['idpessoa'] = strip_tags(strip_tags(trim($_POST['idpessoa'])));

  $inserir = inseir('tarefas', $dados);

  if ($inserir) {
    $log['tipyActionLog'] = 'Cadastrar';
    $log['userActionLog'] = $_POST['userActionLog'];
    $log['actionLog'] = "Cadastrou uma nova Tarefa";
    inseir('logs', $log);

    echo "<script type='text/javascript'> alert('Tarefa inserida com sucesso !');
    history.go(-1);
  </script>";
  } else {
    echo "<script>alert('Erro ao inserir Tarefa!'); history.go(-1);</script>";
  }
}
