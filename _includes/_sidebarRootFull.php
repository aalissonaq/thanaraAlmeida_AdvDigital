<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <!-- <div class="info">
            <a href="#" class="d-block">Olá, </a>
        </div> -->
    <div class="info">
      <a href="#" class="d-block col-11 text-uppercase">
        <?= $_SESSION['USUARIO']; ?>
      </a>
    </div>
    <div class="info">
      <a href="?acao=sair" class="d-block text-danger" title="Sair do Sistema">
        <i class="fas fa-sign-out-alt fa-lg fa-fw"></i>
        <!-- <i class="fa fa-power-off" aria-hidden="true"></i> -->
      </a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



      <!-- ATENDIMENTO -->
      <li class="nav-header text-uppercase">
        <i class="mdi mdi-format-list-checks mdi-24px text-yellow"> </i>
        <i class="mdi mdi-list-status mdi-24px text-yellow"> </i>
        ATENDIMENTOS
      </li>

      <li class="nav-item " id="">
        <a href="?page=listarPaciantes" class="nav-link" id="menuPacientes">
          <i class="nav-icon fas fa-user-injured"></i>
          <p>
            Paciente
            <!-- <span class="badge badge-info right">2</span> -->
          </p>
        </a>
      </li>
      <li class="nav-item " id="">
        <a href="?page=listarPaciantes" class="nav-link" id="menuPacientes">
          <i class="nav-icon mdi mdi-calendar-clock"></i>
          <p>
            Agenda
            <!-- <span class="badge badge-info right">2</span> -->
          </p>
        </a>
      </li>
    </ul>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <!-- FINANCEIRO -->
      <li class="nav-header text-uppercase">
        <i class="mdi mdi-cash-multiple mdi-24px text-success"> </i>
        FINANCEIRO
      </li>
      <!--Caixa-->
      <li class="nav-item has-treeview " id="caixaMenu">
        <a href="" class="nav-link" id="">
          <i class="nav-icon fas fa-cash-register"></i>
          <p>
            Caixa
            <i class="right fas fa-angle-left"></i>
            <!-- <span class="badge badge-info right">2</span> -->
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="?page=listardespesas" class="nav-link" id="dispesaActiva">
              <i class="nav-icon mdi mdi-cash-minus"></i>
              <p>Despensas | Saída</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=" class="nav-link" id="profSolicitanteActiva">
              <i class="nav-icon mdi mdi-cash-plus"></i>
              <p>Receiras | Entrada</p>
            </a>
          </li>
        </ul>
      </li>

      <!--Configurações-->
      <li class="nav-item has-treeview " id="caixaMenu">
        <a href="?page=listarSolicitante" class="nav-link" id="">
          <i class="nav-icon fas fa-cogs"></i>
          <p>
            Configurações
            <i class="right fas fa-angle-left"></i>
            <!-- <span class="badge badge-info right">2</span> -->
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="?page=listardispesas" class="nav-link" id="dispesaActiva">
              <i class="nav-icon mdi mdi-cash-minus"></i>
              <p>Tipo deDispesas </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=" class="nav-link" id="profSolicitanteActiva">
              <i class="nav-icon mdi mdi-cash-plus"></i>
              <p>Receiras | Entrada</p>
            </a>
          </li>
        </ul>
      </li>
    </ul>

    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-header text-uppercase">
        <i class="mdi mdi-cogs mdi-24px text-orange"> </i>
        <!--<i class="fas fa-cogs nav-icon fa-fw fa-lg text-orange"> </i>-->
        GESTÃO
      </li>

      <li class="nav-item " id="">
        <a href="?page=listarServicos" class="nav-link" id="menuServicos">
          <i class="nav-icon mdi mdi-hammer-wrench mdi-20px"></i>
          <p>
            Serviços
            <!-- <span class="badge badge-info right">2</span> -->
          </p>
        </a>
      </li>
      <li class="nav-item " id="">
        <a href="?page=listarPaciantes" class="nav-link" id="menuPacientes">
          <i class="nav-icon mdi mdi-medical-bag  mdi-20px"></i>
          <p>
            Convênios
            <!-- <span class="badge badge-info right">2</span> -->
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="?page=listarusuarios" class="nav-link" id="userSystem">
          <i class="nav-icon mdi mdi-account-group mdi-20px"></i>
          <!-- <i class="nav-icon fas fa-user"></i> -->
          <p>Usuários do Sistema

          </p>
        </a>
      </li>



      <!--GESTÃO -->
      <!--  <li class="nav-item has-treeview" id="gestaoMenu">
        <a href="#" class="nav-link" id="gestaoMenuActive">
          <i class="fas fa-cogs nav-icon fa-fw fa-lg text-orange"> </i>
          <p>
            GESTÃO
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview"> -->

      <!-- <li class="nav-item">
            <a href="?page=listarParceiros" class="nav-link" id="parceiros">
              <i class="nav-icon fas fa-hospital-alt"></i>
              <p>Parceiros</p>
            </a>
          </li>
          <li class="nav-item " id="">
            <a href="?page=listarPaciantes" class="nav-link" id="menuPacientes">
              <i class="nav-icon fas fa-user-injured"></i>
              <p>
                Paciente-->
      <!-- <span class="badge badge-info right">2</span> -->
      <!--</p>
            </a>
          </li>-->

      <!-- <li class="nav-item has-treeview-" id="">
            <a href="?page=listarConvenios" class="nav-link" id="menuConvenio">
              <i class="nav-icon fas fa-first-aid"></i>
              <p>
                Convênios | Planos
                <!-- <i class="right fas fa-angle-left"></i> -->
      <!-- <span class="badge badge-info right">2</span> -->
      <!-- </p>
      </a>
      </li>
      <li class="nav-item has-treeview " id="gestExameMenu">
        <a href="" class="nav-link" id="">
          <i class="fas fa-vials fa-fw nav-icon"></i>
          <p>Gestão de Exames
            <i class="right fas fa-angle-left"></i>
          </p>

        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <a href="?page=listBancadaExames" class="nav-link" id="bancadaExemesActive">
              <i class="nav-icon fas fa-vial"></i>
              <p>Bancadada</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=listarExamesGest" class="nav-link" id="getExemesActive">
              <i class="nav-icon fas fa-vial"></i>
              <p>Exames</p>
            </a>
          </li>
        </ul>
      </li>-->
      <!-- Materiais -->
      <!-- <li class="nav-item has-treeview" id="gestMaterialMenu">
        <a href="?page=listarMateriais" class="nav-link">
          <i class="fas fa-dolly-flatbed fa-fw nav-icon"></i>
          <p>Gestão de Materiais
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <a href="?page=" class="nav-link" id="bancadaExemesActive">
              <i class="nav-icon fas fa-people-carry"></i>
              <p>Solicitações</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=listarMateriais" class="nav-link" id="getMaterialActive">
              <i class="nav-icon fas fa-boxes"></i>
              <p>Materiais</p>
            </a>
          </li>
        </ul>

      </li>-->
    </ul>
    </li>

    <!-- SOLICITAÇÕES -->
    <!-- <li class="nav-header text-uppercase">
      <i class="fas fa-dolly nav-icon fa-fw fa-lg text-yellow"> </i>
      SOLICITAÇÕES
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cubes"></i>
        <p>Solicitação de Material</p>
      </a>
    </li>
   <li class="nav-item">
                <a href="https://adminlte.io/docs/3.0" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>Documentation</p>
                </a>
            </li> -->
    <!-- <li class="nav-header">MULTI LEVEL EXAMPLE</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Level 1</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                        Level 1
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level 2</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Level 2
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level 2</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Level 1</p>
                </a>
            </li> -->
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>