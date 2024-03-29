<?php

//switch ($_SESSION['NIVEL']) {
//    Sertor Administrativo
//case 1:
if (!isset($_GET['page']) || $_GET['page'] == null) {
  include "./pages/pages/dashboard.php";
} else {
  switch (@$_GET['page']) {
    case 'inicio':
      include "./pages/pages/dashboard.php";
      break;

      #Usuarios do Sistemas
    case 'edtUsuario':
      include "./pages/pages/edtUsuario.php";
      break;
    case 'edtPasswdUsuario':
      include "./pages/pages/edtPasswdUsuario.php";
      break;
    case 'listarusuarios':
      include "./pages/pages/listausuario.php";
      break;
    case 'verUsuario':
      include "./pages/pages/verUsuario.php";
      break;

      #GESTÃO DE CLIENTES
    case 'listarClientes':
      include "./pages/pages/contactsClient.php";
      break;
    case 'cc':
      include "./pages/pages/contactsClient.php";
      break;
    case 'listarClientesCard':
      include "./pages/pages/listarClientesCard.php";
      break;
    case 'verCliente':
      include "./pages/pages/verCliente.php";
      break;
    case 'profileCliente':
      include "./pages/pages/profileCliente.php";
      break;
    case 'edtCliente':
      include "./pages/pages/edtCliente.php";
      break;
    case 'listarLogos':
      include "./pages/pages/listarLogos.php";
      break;

      #PRODESSOS
    case 'processos':
      include "./pages/pages/processoCliente.php";
      break;
    case 'process_detail':
      include "./pages/pages/process_detail.php";
      break;

      #TAREFAS
    case 'task_detail':
      include "./pages/pages/task_detail.php";
      break;

      #SERVIÇOS
    case 'listarServicos':
      include "./pages/pages/listarServicos.php";
      break;
    case 'editarServico':
      include "./pages/pages/editarServico.php";
      break;
    case 'edtExame':
      include "./pages/pages/edtExamesac.php";
      break;
    case 'listBancadaExames':
      include "./pages/pages/listarBancadaExames.php";
      break;
    case 'edtBancada':
      include "./pages/pages/edtBancada.php";
      break;

      #GESTÃO DE MATERIAIS
    case 'listarMateriais':
      include "./pages/pages/listarMareiais.php";
      break;
    case 'edtMaterial':
      include "./pages/pages/edtMaterial.php";
      break;

      #GESTÃO DE SOLICITANTES
    case 'listarTipoSolicitante':
      include "./pages/pages/listarTipoSolicitante.php";
      break;

      #GESTÃO FINANCEIRO
    case 'financial':
      include "./pages/pages/financial.php";
      break;
    case 'financialCategories':
      include "./pages/pages/financialCategories.php";
      break;
    case 'financialReleases':
      include "./pages/pages/financialReleaseMonth.php";
      break;
    case 'financialedt':
      include "./pages/pages/financial_edt.php";
      break;
    case 'expenses':
      include "./pages/pages/expensesMonth.php";
      break;
    case 'despesas':
      include "./pages/pages/listarDespesas.php";
      break;
    case 'financialStatement':
      include "./pages/pages/financialStatement.php";
      break;
    case 'edtExpenses':
      include "./pages/pages/edtExpenses.php";
      break;

      #GESTÃO DE CONVÊNIO
    case 'listarConvenios':
      include "./pages/pages/listarConvenios.php";
      break;





      #CARTÃO
    case 'listarCartoes':
      include "./pages/pages/listaCartoes.php";
      break;
    case 'novoCartao':
      include "./pages/pages/novoCartao.php";
      break;

      #profile
    case 'profile':
      include "./pages/pages/profile.php";
      break;

      #Quando não encontrar pagina
    default:
      include "./pages/404.php";
      break;
  }
}
