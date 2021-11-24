<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-2 mb-2 pb-2 d-flex">
    <div class="image img-fluid d-flex justify-content-end align-items-center" style="left:.5rem">
      <img src="
                    <?php
                    if ($_SESSION['FOTO']) {
                      echo " ./upload/fotoPessoas/{$_SESSION['FOTO']}";
                    } else {
                      echo "./upload/fotoPessoas/default.png";
                    } ?>" alt="
                  <?= $_SESSION['FOTO'] ?>" class=" profile-user-img img-fluid img-circle shadow user-image" style="min-width:3rem; min-height:3rem; object-fit: cover;
                  position: relative;  border: 0px solid transparent; background: linear-gradient(#c77129,60%, #6368B1); background-clip: padding-box; padding: .21rem;

                  " />
    </div>

    <div class="info">
      <a href="#" class="text-capitalize">
        <p class="">
          olá,
        </p>
        <span class="text-orange lead align-middle" style="font-family: 'Advent Pro', sans-serif; font-weight: 300; letter-spacing: 0.5%; margin-top: -1.3rem; position: absolute; text-transform: uppercase;">

          <?php

          $nome =  explode(' ', $_SESSION['USUARIO']);

          if (!isset($nome[1])) {
            echo $nome[0];
          } elseif (strlen($nome[1]) > 2) {
            echo $nome[0] . ' ' . $nome[1];
          } elseif (isset($nome[2])) {
            echo $nome[0] . ' ' . $nome[1] . ' ' . $nome[2];
          }
          ?>
        </span>
      </a>
    </div>
    <div class="info">
      <!--<a href="?acao=sair" class="d-block text-danger" title="Sair do Sistema">
        <i class="fas fa-sign-out-alt fa-lg fa-fw"></i>
        <i class="fa fa-power-off" aria-hidden="true"></i>
      </a>-->
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



      <!-- ATENDIMENTO
      <li class="nav-header text-uppercase">
        <i class="mdi mdi-format-list-checks mdi-24px text-yellow"> </i>
        <i class="mdi mdi-list-status mdi-24px text-yellow"> </i>
        ATENDIMENTOS
      </li>-->

      <li class="nav-item " id="">
        <a href="?page=listarClientes" class="nav-link" id="menuClientes">
          <i class="nav-icon mdi mdi-account mdi-24px"></i>
          <p>
            Clientes
            <!-- <span class="badge badge-info right">2</span> -->
          </p>
        </a>
      </li>
      <li class="nav-item " id="">
        <a href="?page=listarAdvs" class="nav-link" id="menuPacientes">
          <i class="nav-icon mdi mdi-account-tie mdi-24px"></i>
          <p>
            Advogados
            <!-- <span class="badge badge-info right">2</span> -->
          </p>
        </a>
      </li>

    </ul>

    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <!-- <li class="nav-header text-uppercase">
        <i class="mdi mdi-cogs mdi-24px text-orange"> </i>
        <i class="fas fa-cogs nav-icon fa-fw fa-lg text-orange"> </i>
        GESTÃO
      </li>-->

      <!--  <li class="nav-item">
        <a href="?page=listarusuarios" class="nav-link" id="userSystem">
          <i class="nav-icon mdi mdi-account-group mdi-24px"></i>
         <i class="nav-icon fas fa-user"></i>
          <p>Usuários do Sistema

          </p>
        </a>
      </li> -->


    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
