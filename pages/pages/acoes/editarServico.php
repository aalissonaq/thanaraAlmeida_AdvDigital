<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

// $idP = 0;
// $lendo = ler("paciente", '', "WHERE idPessoa = '{$_POST['idEdit']}' ");
// $dadosUser = $lendo->fetchAll(PDO::FETCH_ASSOC);
// #dados para tebela usuário
// foreach ($dadosUser as $dado) {
//     $idP = $dado['idPessoa'];
// };

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

  $dados['nomeServico'] = strip_tags(strip_tags(trim(strtoupper($_POST['nomeServico']))));
  $vl = substr(tiraMascara($_POST['vlServico']), 0, strlen(tiraMascara($_POST['vlServico'])) - 2) . '.' . substr(tiraMascara($_POST['vlServico']), -2);
  $dados['vlServico'] = strip_tags(strip_tags(trim(strtoupper($vl))));
  $dados['statusServico'] = strip_tags(strip_tags(trim(strtoupper(tiraMascara($_POST['statusServico'])))));

  $updatePessoa = atualizar('servicos', $dados, "idServicos = '{$_POST['idEdit']}'");

  echo "<script type='text/javascript'>
          alert('Os dados do Paciente {$dados['nomeServico']} foram  atualizados com sucesso !');
          window.location = '../../../inicio.php?page=listarServicos';
        </script>";
}