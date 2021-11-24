<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';


if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

  $dados['nomeServico'] = strip_tags(strip_tags(trim(strtoupper($_POST['nomeServico']))));
  //$vlServ = tiraMascara($_POST['vlServico']);
  // $tmVl = strlen(tiraMascara($_POST['vlServico'])) - 2;
  $vl = substr(tiraMascara($_POST['vlServico']), 0, strlen(tiraMascara($_POST['vlServico'])) - 2) . '.' . substr(tiraMascara($_POST['vlServico']), -2);

  $dados['vlServico'] = strip_tags(strip_tags(trim(strtoupper($vl))));
  //$dados['vlServico'] = strip_tags(strip_tags(trim(strtoupper(str_replace(",", ".", $_POST['vlServico'])))));
  $dados['statusServico'] = strip_tags(strip_tags(trim(strtoupper(tiraMascara($_POST['statusServico'])))));

  inseir('servicos', $dados);

  echo "<script type='text/javascript'> alert('O Serviço  {$dados['nomeServico']} foi Cadastrado com sucesso !');
  window.location = '../../../inicio.php?page=listarServicos';
   </script>";
}
//}