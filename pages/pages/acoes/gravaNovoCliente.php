<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';

if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {

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
  // $dados['txtObsContatosPessoas'] = strip_tags(strip_tags(trim(strtoupper($_POST['txtObsContatosPessoas']))));

  //Verifica de já Existe

  $isRegisteredPerson = ler('pessoa', '', "WHERE docPessoa = '{$dados['docPessoa']}'")->rowCount();

  if ($isRegisteredPerson != 0) {
    echo "<script type='text/javascript'> alert('O Paciente {$dados['nmPessoa']} já possui cadastro!'); </script>";
  } else {
    $inserido = inseir('pessoa', $dados);
    $idRegisteredPerson = null;
    if ($inserido) {
      $dadosPessoas = ler('pessoa', '', "WHERE docPessoa = '{$dados['docPessoa']}'")->fetchAll(PDO::FETCH_ASSOC);
      foreach ($dadosPessoas as $dataPessoa) {
        $idRegisteredPerson = $dataPessoa['idPessoa'];
      }
      $cliente['idPessoa'] = $idRegisteredPerson;
      $cliente['sexoCliente'] = strip_tags(strip_tags(trim($_POST['sexoCliente'])));
      $cliente['strEstadoCivilCliente'] = strip_tags(strip_tags(trim($_POST['strEstadoCivilCliente'])));
      $cliente['strNaturalidadeCliente'] = strip_tags(strip_tags(trim($_POST['strNaturalidadeCliente'])));
      $cliente['nnRg'] = strip_tags(strip_tags(trim(strtoupper($_POST['nnRg']))));
      $cliente['nmMae'] = strip_tags(strip_tags(trim(strtoupper($_POST['nmMae']))));
      $cliente['nmPai'] = strip_tags(strip_tags(trim(strtoupper($_POST['nmPai']))));
      $cliente['idRespCadastroCliente'] = strip_tags(strip_tags(trim(strtoupper($_POST['idRespCadastroCliente']))));


      $pasta = "./../../../upload/imgClientes";
      $extensoes = array('jpg', 'jpeg', 'gif', 'png');

      if ($_FILES['imgCliente']['name'] == '') {
        $cliente['imgCliente'] = '';
      } else {
        // $dados['strComprovanteDespesa'] = $_FILES['strComprovanteDespesa'];
        $cliente['imgCliente'] = upLoadFile($_FILES['imgCliente'], 1,  $extensoes, $pasta);
      }
      $isRegistered = ler('clientes', '', "WHERE idPessoa = '{$idRegisteredPerson}'")->rowCount();

      if ($isRegistered != 0) {
      } else {
        inseir('clientes', $cliente);
        $cpfCliente = $_POST['docPessoa'];

        $log['tipyActionLog'] = 'Cadastrar';
        $log['userActionLog'] = $_POST['userActionLog'];
        $log['actionLog'] = "Cadastro de novo Cliente:  {$dados['nmPessoa']} -CPF: {$cpfCliente}";

        //echo "<pre>";
        //print_r($log);
        //echo "</pre>";

        inseir('logs', $log);
      }
    }
  }

  echo "<script type='text/javascript'> alert('O Cliente {$dados['nmPessoa']} foi Cadastrado com sucesso !');window.location = '../../../inicio.php?page=listarClientes';
  </script>";





  // echo "<script type='text/javascript'>
  // alert('O Paciente {$dados['nmPessoa']} foi Cadastrado com sucesso !');
  //      window.location = '../../../inicio.php?page=listarPaciantes';
  //     </script>";
  //echo "<div class=\"alert alert-success text-uppercase\" role=\"alert\">O paciente {$dados['nmPessoa']} foi Cadastrado com sucesso !</div>";
  // }
}
//}
