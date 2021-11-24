<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <!-- <h1 style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">Profile</h1> -->
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="font-family:'Advent Pro', sans-serif;">
          <li class="breadcrumb-item"><a href="inicio.php"><i class="mdi mdi-home-outline fa fa-fw"></i>Inicio</a></li>
          <li class="breadcrumb-item"><a href="?page=listarClientes"><i class="mdi mdi-account-outline fa fa-fw"></i>Cliente</a></li>
          <li class="breadcrumb-item active"><i class="mdi mdi-file-account-outline fa fa-fw"></i>Perfil do Cliente</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <?php


  $idEdit = $_GET['id'];
  $dadosPessoa = ler("vw_pessoa_cliente", '', "WHERE idPassoaPessoa = '{$idEdit}'")->fetchAll(PDO::FETCH_ASSOC);
  foreach ($dadosPessoa as $dcliente) {

    // foreach (lerJoin('pessoa', 'clientes', 'idPessoa', 'LEFT', 'WHERE pessoa.idPessoa =1')->fetchAll(PDO::FETCH_ASSOC) as $dcliente) {

  ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img src="
                <?php
                if ($dcliente['foto']) {
                  echo "./upload/fotoPessoas/{$dcliente['foto']}";
                } else {
                  echo "./upload/fotoPessoas/default.png";
                }
                ?>
                " class="profile-user-img img-fluid img-circle" alt="foto do Cliente <?= $dcliente['nmPessoa'] ?>" style="object-fit: cover;" />
              </div>

              <h3 class="profile-username text-center text-primary" style="font-family:'Advent Pro', sans-serif; font-weight: 600; ">
                <?php
                if ($dcliente['nmPessoaSocial'] == '') {
                  $nome =  explode(' ', $dcliente['nmPessoa']);
                  if (strlen($nome[1]) > 2) {
                    echo $nome[0] . " " . $nome[1];
                  } else {
                    echo $nome[0] . " " . $nome[1] . " " . $nome[2];
                  }
                } else {
                  echo $dcliente['nmPessoaSocial'];
                }

                ?>
              </h3>

              <p class="text-muted text-center" style="text-transform: uppercase;">
                <?= $dcliente['nmPessoa'] ?>
              </p>
              <p>
              <div class="d-flex justify-content-around align-items-center">
                <?php
                switch ($_SESSION['NIVEL']) {
                  case '0':
                ?>

                    <a href="?page=listarClientes" class="btn btn-tool " target="" title="Voltar" rel="noopener noreferrer">
                      <i class="mdi mdi-arrow-left-circle-outline mdi-24px fa fa-fw"></i>
                    </a>
                    <a href="#settings" class="btn btn-tool" target="" data-toggle="tab" title="Editar Dados" rel="noopener noreferrer">
                      <i class="mdi mdi-account-edit-outline mdi-24px fa fa-fw"></i>
                    </a>

                    <button data-toggle="modal" data-target="#modal-edtFoto" data-id="<?= $idEdit ?>" onclick="setaDadosModal(<?= $idEdit ?> )" class="btn btn-tool \" target="" title="Trocar Foto" rel="noopener noreferrer\">
                      <i class="mdi mdi-camera-flip-outline mdi-24px fa fa-fw"></i>
                    </button>
                <?php
                    break;


                  default:
                    include '_includes/_toolsClientes.default.php';
                    break;
                }
                ?>
              </div>
              </p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b><i class="fas fa-lg fa-phone text-primary"></i> </b>
                  <a href="tel:<?= tiraMascara($dcliente['nnTelefonePessoa']) ?>" class="" style="font-size:1rem">
                    <?= $dcliente['nnTelefonePessoa'] ?>
                  </a>


                  <span class="float-right">
                    <b>
                      <i class="fab fa-lg fa-whatsapp text-success"></i>
                    </b>

                    <a href="https://api.whatsapp.com/send?phone=55<?= tiraMascara($dcliente['nnWhatsappPessoa']) ?>&text=Ol%C3%A1%20<?= urlencode($dcliente['nmPessoa']); ?>%2C%20temos%20novidades%20sobre%20ser%20processo.%20%20" class="text-success " target="_blank" title="Enviar WhatsApp" style="font-size:1.1rem">

                      <?= $dcliente['nnWhatsappPessoa'] ?>
                    </a>
                  </span>
                </li>
                <li class="list-group-item">
                  <b>
                    <i class="fas fa-fw fa-lg fa-envelope text-primary"></i>
                  </b>
                  <!-- <span class="float-right"> -->
                  <a href="mailto:<?= $dcliente['stEmailPessoa'] ?>" class="" style="font-size:.95rem">
                    <?= $dcliente['stEmailPessoa'] ?>
                  </a>
                  </a>
                  <!-- </span> -->
                </li>
              </ul>

              <a href="?page=verCliente&id=<?= $idEdit ?>" class="btn btn-outline-primary btn-block">
                <i class="fas fa-lg fa-fw fa-print"> </i>
                <span class="text-uppercase">
                  Ficha do Cliente
                </span>
              </a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary ">
            <div class="card-header">
              <h3 class="card-title text-white">DADOS</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço</strong>

              <p class="text-muted" style="text-transform: uppercase;">
                <?= $dcliente['stLogradouroPessoa'] . ", " . $dcliente['nnCasaPessoa'] . " <br/>" . $dcliente['stBairroPessoa'] . " <br/> " . $dcliente['stCidadePessoa'] . "-" . $dcliente['stEstadoPessoa'] . " CEP:" . $dcliente['stCepPessoa'] ?>
              </p>
              <hr>
              <!-- <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
              <p class="text-muted">
                <span class="tag tag-danger">UI Design</span>
                <span class="tag tag-success">Coding</span>
                <span class="tag tag-info">Javascript</span>
                <span class="tag tag-warning">PHP</span>
                <span class="tag tag-primary">Node.js</span>
              </p>
              <hr> -->
              <!-- <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-outline">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#toayTask" data-toggle="tab">
                    <i class="align-middle mdi mdi-calendar-multiple mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                    <span class="align-middle">
                      Tarefas de hoje
                    </span>
                  </a>
                </li>


                <li class="nav-item">
                  <a class="nav-link " href="#allTasks" data-toggle="tab">
                    <i class="align-middle mdi mdi-calendar-clock mdi-24px fa fa-fw"></i>&nbsp;&nbsp;
                    <span class="align-middle">
                      Tarefas Agendadas
                    </span>
                  </a>
                </li>

                <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                </li> -->

              </ul>


            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="toayTask">
                  <!-- Tarefas -->

                  <div class="table-responsive ">
                    <table id="tabela" class="table table-sm table-striped table-hover">
                      <thead class="" style="font-family: 'Advent Pro', sans-serif;">
                        <tr>
                          <th class="col-md-1 text-center align-middle">
                            <i class="fas fa-hashtag fa-fw"></i>
                          </th>
                          <th class="col-mb-2 text-center align-middle ">Tarefa</th>
                          <th class="col-mb-2 text-center align-middle ">Responsável</th>
                          <th class="col-mb-2 text-center align-middle ">Data e Hora</th>

                          <th class="col-md-auto text-center align-middle">
                            <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        $id = $_GET['id'];
                        $count = 0;
                        foreach (ler('tarefas', '', "WHERE idpessoa = {$id}")->fetchAll(PDO::FETCH_ASSOC) as $dadosTarefa) {
                          $count++;
                        ?>
                          <tr class="">
                            <td class=" text-uppercase align-middle text-center" style="font-size: .9rem;">
                              <!-- //str_pad($count, 2, "0", STR_PAD_LEFT); -->

                            </td>

                            <td class="text-uppercase align-middle text-center">
                              <?= $dadosTarefa['decricaoTarefa']; ?>
                            </td>

                            <td class="text-uppercase align-middle text-center" style="font-size: .9rem; ">
                              <?php
                              foreach (ler('pessoa', '', "WHERE idPessoa ={$dadosTarefa['idResponsavel']} ")->fetchAll(PDO::FETCH_ASSOC) as $dadosPessoa) {
                                echo $dadosPessoa['nmPessoa'];
                              }
                              ?>
                            </td>

                            <td class="text-uppercase align-middle text-center">
                              <?= date("d/m/Y ", strtotime($dadosTarefa['hora'])); ?>
                              as
                              <?= date(" H:i", strtotime($dadosTarefa['hora'])); ?>
                            </td>

                            <td class="text-uppercase align-middle  ">
                              <ul class="nav justify-content-center d-flex justify-content-evenly">
                                <?php
                                switch ($_SESSION['NIVEL']) {
                                  case '0':
                                ?>
                                    <li class="nav-item">
                                      <a href="" class="btn btn-tool" target="" title="Visializar Processo" rel="noopener noreferrer">
                                        <i class="mdi mdi-file-eye-outline mdi-24px "></i>
                                      </a>
                                    </li>


                                <?php
                                    break;

                                  default:
                                    //TESTE DE STATUS
                                    break;
                                }
                                ?>
                              </ul>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>

                  <!-- /.tarefas -->

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                  <!-- The timeline -->
                  <div class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-danger">
                        10 Feb. 2014
                      </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-envelope bg-primary"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                        <div class="timeline-body">
                          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                          weebly ning heekya handango imeem plugg dopplr jibjab, movity
                          jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                          quora plaxo ideeli hulu weebly balihoo...
                        </div>
                        <div class="timeline-footer">
                          <a href="#" class="btn btn-primary btn-sm">Read more</a>
                          <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-user bg-info"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                        </h3>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-comments bg-warning"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                        <div class="timeline-body">
                          Take me to your leader!
                          Switzerland is small and neutral!
                          We are more like Germany, ambitious and misunderstood!
                        </div>
                        <div class="timeline-footer">
                          <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-success">
                        3 Jan. 2014
                      </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-camera bg-purple"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                        <div class="timeline-body">
                          <img src="http://placehold.it/150x100" alt="...">
                          <img src="http://placehold.it/150x100" alt="...">
                          <img src="http://placehold.it/150x100" alt="...">
                          <img src="http://placehold.it/150x100" alt="...">
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="far fa-clock bg-gray"></i>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="allTasks">
                  Todas as Tarefas Agendadas
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>

          <!--Novo Painel Processo-->
          <div class="card  card-primary-dark card-outline">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#process" data-toggle="tab">
                    <i class="align-middle mdi mdi-scale-balance mdi-24px fa fa-fw"> </i>&nbsp;&nbsp;
                    <span class="align-middle">
                      Processos | Casos
                    </span>
                  </a>
                </li>


                <li class="nav-item">
                  <a class="nav-link " href="#settings" data-toggle="tab">
                    <i class="align-middle mdi mdi-file-edit-outline mdi-24px fa fa-fw"></i>&nbsp;&nbsp;
                    <span class="align-middle">
                      Editar Dados do Cliente
                    </span>
                  </a>
                </li>

                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                </li>

              </ul>


            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="process">
                  <!-- Processos -->

                  <a href="" class="btn btn-tool text-orange float-right" data-toggle="modal" data-target="#modal-novoProdesso" style="font-family:'Advent Pro', sans-serif; font-weight: bold; font: size 20px; letter-spacing: 1px; margin-bottom:1rem">
                    <i class="fa fa-plus-square fa-fw fa-2x align-middle"></i>
                    Novo Processos</a>


                  <div class="table-responsive ">
                    <table id="tabela" class="tableP table-sm table-striped table-hover">
                      <thead class="" style="font-family: 'Advent Pro', sans-serif;">
                        <tr>
                          <th class="col-md-1 text-center align-middle">
                            <i class="fas fa-hashtag fa-fw"></i>
                          </th>
                          <th class="col-mb-2 text-center align-middle ">C. PARTE</th>
                          <th class="col-mb-2 text-center align-middle ">ÁREA</th>
                          <th class="col-mb-2 text-center align-middle">N° DO PROCESSO (CNJ)</th>
                          <th class="col-md-2 text-center align-middle">STATU</th>
                          <th class="col-md-auto text-center align-middle">
                            <i class="fab fa-lg fa-fw fa-whmcs" title="Ações"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        $id = $_GET['id'];
                        $count = 0;
                        foreach (ler('processos', '', "WHERE idcliente = {$id}")->fetchAll(PDO::FETCH_ASSOC) as $dadosProcesso) {
                          $count++;
                        ?>
                          <tr class="">
                            <td class=" text-uppercase align-middle text-center" style="font-size: .9rem;">
                              <!-- //str_pad($count, 2, "0", STR_PAD_LEFT); -->
                              <?= $dadosProcesso['niprocesso']; ?>
                            </td>
                            <td class=" text-uppercase align-middle text-center">
                              <?= $dadosProcesso['contraparte'] ?>
                            </td>
                            <td class="text-uppercase align-middle text-center">
                              <?php
                              switch ($dadosProcesso['areaprocesso']) {
                                case 'adminsitrativo':
                                  echo "Administrativo";
                                  break;
                                case 'previdenciario':
                                  echo "Previdenciário";
                                  break;
                                case 'trabalhista':
                                  echo "Trabalhista";
                                  break;
                                case 'familia':
                                  echo "Família";
                                  break;
                                case 'civil':
                                  echo "Civil";
                                  break;

                                default:
                                  # code...
                                  break;
                              }; ?>
                            </td>
                            <td class="text-uppercase align-middle text-center">
                              <?= isset($dadosProcesso['numprocesso']) && $dadosProcesso['numprocesso'] > 0 ? MascaraCNJ(str_pad($dadosProcesso['numprocesso'], 20, "0", STR_PAD_LEFT)) : 'Processo sem Número'; ?>
                            </td>
                            <td class="text-uppercase align-middle d-flex justify-content-between align-items-center" style="font-size: .8rem; ">
                              <?php
                              switch ($dadosProcesso['statusprocesso']) {
                                case 'aguardando':
                                  echo 'Aguardando Documento';
                                  break;
                                case 'pericia':
                                  echo 'Perícia ou Agendamento';
                                  break;
                                case 'prorrogacao':
                                  echo 'Prorrogação';
                                  break;
                                case 'exigencia':
                                  echo 'Exigência';
                                  break;
                                case 'aguardandoINSS':
                                  echo 'Aguardando Resposta do INSS';
                                  break;
                                case 'justFederal':
                                  echo 'Justiça Federal';
                                  break;
                                case 'concluido':
                                  echo 'Concluído';
                                  break;
                                default:
                                  echo 'Aguardando Documento';
                                  break;
                              };

                              echo "
                  <a href=\"\" class=\"btn btn-tool\" target=\"\"
                  title=\"Atualizar Status\" rel=\"noopener noreferrer\">
                  <i class=\"mdi mdi-rotate-3d-variant mdi-24px fa fa-fw\"></i>
                  </a>
                  ";
                              ?>
                            </td>
                            <td class="text-uppercase align-middle  ">
                              <ul class="nav justify-content-center d-flex justify-content-evenly">
                                <?php
                                switch ($_SESSION['NIVEL']) {
                                  case '0':
                                ?>
                                    <li class="nav-item">
                                      <a href="" class="btn btn-tool" target="" title="Visializar Processo" rel="noopener noreferrer">
                                        <i class="mdi mdi-file-eye-outline mdi-24px "></i>
                                      </a>
                                    </li>
                                    <li class="nav-item">
                                      <a href="" class="btn btn-tool" target="" title="Histórico" rel="noopener noreferrer">
                                        <i class="mdi mdi-calendar-clock-outline mdi-24px "></i>
                                      </a>
                                    </li>
                                    <li class="nav-item">
                                      <a href="" class="btn btn-tool" target="" title="Adicionar Tarefas" rel="noopener noreferrer" data-toggle="modal" data-target="#modal-novaTarefa" onclick="modalIdProcesso(<?= $dadosProcesso['idprocesso'] ?>)">
                                        <i class="mdi mdi-book-cog-outline mdi-24px"></i>
                                      </a>
                                    </li>

                                <?php
                                    break;

                                  default:
                                    //TESTE DE STATUS
                                    break;
                                }
                                ?>
                              </ul>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.processo -->

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                  <!-- The timeline -->
                  <div class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-danger">
                        10 Feb. 2014
                      </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-envelope bg-primary"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                        <div class="timeline-body">
                          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                          weebly ning heekya handango imeem plugg dopplr jibjab, movity
                          jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                          quora plaxo ideeli hulu weebly balihoo...
                        </div>
                        <div class="timeline-footer">
                          <a href="#" class="btn btn-primary btn-sm">Read more</a>
                          <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-user bg-info"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                        </h3>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-comments bg-warning"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                        <div class="timeline-body">
                          Take me to your leader!
                          Switzerland is small and neutral!
                          We are more like Germany, ambitious and misunderstood!
                        </div>
                        <div class="timeline-footer">
                          <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-success">
                        3 Jan. 2014
                      </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-camera bg-purple"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                        <div class="timeline-body">
                          <img src="http://placehold.it/150x100" alt="...">
                          <img src="http://placehold.it/150x100" alt="...">
                          <img src="http://placehold.it/150x100" alt="...">
                          <img src="http://placehold.it/150x100" alt="...">
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="far fa-clock bg-gray"></i>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">

                  <!--Form edit Cliente-->

                  <form class="needs-validation" novalidate action="pages/pages/acoes/editarCliente.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idEdit" value="<?= $idEdit ?>" />
                    <div class="form-row">
                      <div class="col-md-6 mb-3 ">
                        <label for="nmPessoa">Nome do Cliente <span class="text-orange">*</span></label>
                        <input type="text" name="nmPessoa" class="form-control text-uppercase  " id="nmPessoa" placeholder="Nome do Cliente" value="<?= $dcliente['nmPessoa']; ?>" required />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                      <div class="col-md-4 mb-3 ">
                        <label for="nmPessoaSocial">Nome Social / Apelido / Nome fantasia </label>
                        <input type="text" name="nmPessoaSocial" class="form-control text-uppercase  " id="nmPessoaSocial" placeholder="Nome Social / Apelido / Nome Fantasia" value="<?= $dcliente['nmPessoaSocial']; ?>" />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="docPessoa">CPF <span class="text-orange"> *</span></label>
                        <input type="text" name="docPessoa" class="form-control text-uppercase js_cpf" id="docPessoa" placeholder="Somente Números" required value="<?= $dcliente['docPessoa']; ?>" />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-2 mb-3">
                        <label for="dtNascPessoa">
                          Data de Nascimento
                          <span class="text-orange">*</span>
                        </label>
                        <input type=" text" name="dtNascPessoa" class="form-control text-uppercase js_data dtNascPessoa" onblur="Idade();" id="dtNascPessoa" placeholder="dd/mm/yyyy" required value="<?= $dcliente['dtNascPessoa']; ?>" />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <label for="sexoCliente">Sexo<span class="text-orange"> *</span></label>
                        <select class=" form-control text-uppercase" required name="sexoCliente" id="sexoCliente">

                          <?php
                          switch ($dcliente['sexoCliente']) {
                            case 'Masculino':

                              echo "
                      <option value=\"Masculino\" selected>Masculino</option>
                      <option value=\"Feminino\">Feminino</option>
                      <option value=\"Não Infomado\">Não Informado</option>
                      ";
                              break;
                            case 'Feminino':

                              echo "
                      <option value=\"Masculino\" >Masculino</option>
                      <option value=\"Feminino\" selected>Feminino</option>
                      <option value=\"Não Infomado\">Não Informado</option>
                      ";
                              break;
                            default:
                              echo "
                      <option value=\"Masculino\" >Masculino</option>
                      <option value=\"Feminino\" >Feminino</option>
                      <option value=\"Não Infomado\" selected>Não Informado</option>
                      ";
                              break;
                          }
                          ?>
                        </select>
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>

                      <div class="col-md-3 ">
                        <label for="strEstadoCivilCliente">Estado Civil</label>
                        <select class="form-control text-uppercase" required name="strEstadoCivilCliente" id="strEstadoCivilCliente">
                          <?php
                          switch ($dcliente['strEstadoCivilCliente']) {
                            case 'Solteiro':
                              echo "
    <option value=\"Solteiro\" selected>Solteiro</option>
    <option value=\"Casado\">Casado</option>
    <option value=\"Divorciado\">Divorciado</option>
    <option value=\"Viúvo\">Viúvo</option>
    <option value=\"Separado\">Separado</option>
    <option value=\"Não Informado\">Não Informado</option>
    ";
                              break;

                            case 'Casado':
                              echo "
    <option value=\"Solteiro\">Solteiro</option>
    <option value=\"Casado\" selected>Casado</option>
    <option value=\"Divorciado\">Divorciado</option>
    <option value=\"Viúvo\">Viúvo</option>
    <option value=\"Separado\">Separado</option>
    <option value=\"Não Informado\">Não Informado</option>
    ";
                              break;

                            case 'Divorciado':
                              echo "
    <option value=\"Solteiro\">Solteiro</option>
    <option value=\"Casado\">Casado</option>
    <option value=\"Divorciado\" selected>Divorciado</option>
    <option value=\"Viúvo\">Viúvo</option>
    <option value=\"Separado\">Separado</option>
    <option value=\"Não Informado\">Não Informado</option>
    ";
                              break;

                            case 'Viúvo':
                              echo "
    <option value=\"Solteiro\">Solteiro</option>
    <option value=\"Casado\">Casado</option>
    <option value=\"Divorciado\">Divorciado</option>
    <option value=\"Viúvo\" selected>Viúvo</option>
    <option value=\"Separado\">Separado</option>
    <option value=\"Não Informado\">Não Informado</option>
    ";
                              break;

                            case 'Separado':
                              echo "
    <option value=\"Solteiro\">Solteiro</option>
    <option value=\"Casado\">Casado</option>
    <option value=\"Divorciado\">Divorciado</option>
    <option value=\"Viúvo\">Viúvo</option>
    <option value=\"Separado\" selected>Separado</option>
    <option value=\"Não Informado\">Não Informado</option>
    ";
                              break;
                            default:
                              echo "
    <option value=\"Solteiro\">Solteiro</option>
    <option value=\"Casado\">Casado</option>
    <option value=\"Divorciado\">Divorciado</option>
    <option value=\"Viúvo\">Viúvo</option>
    <option value=\"Separado\">Separado</option>
    <option value=\"Não Informado\" selected>Não Informado</option>
    ";
                              break;
                          }
                          ?>

                        </select>
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>

                      <div class="col-md-3 ">
                        <label for="strNaturalidadeCliente">Naturalidade<span class="text-orange"> *</span></label>
                        <input type="text" name="strNaturalidadeCliente" value="<?= $dcliente['strNaturalidadeCliente']; ?>" class="form-control text-uppercase" id="strNaturalidadeCliente" placeholder="Ex: São Paulo" required />

                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <label for="nnRg">C. Identidade</label>
                        <input type="number" name="nnRg" class="form-control text-uppercase" id="nnRg" value="<?= $dcliente['nnRg']; ?>" placeholder="Ex: 123456789" />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col-md-12 ">
                        <label for="nmMae">Nome da Mãe<span class="text-orange"> *</span></label>
                        <input type="text" required name="nmMae" value="<?= $dcliente['nmMae']; ?>" class="form-control text-uppercase" id="nmMae" placeholder="Ex: Maria da Silva" />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label for="nmPai">Nome da Pai</label>
                        <input type="text" name="nmPai" class="form-control text-uppercase" id="nmPai" value="<?= $dcliente['nmPai']; ?>" placeholder="Ex: João da Silva" />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                    </div>
                    <br />
                    <fieldset>
                      <legend>
                        <p class="lead" style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">
                          DADOS DE ENDEREÇO
                        </p>
                      </legend>
                    </fieldset>

                    <div class="form-row">
                      <div class="col-md-2 ">
                        <label for="stCepPessoa">CEP</label>
                        <input type="text" name="stCepPessoa" class="form-control text-uppercase js_cep" id="stCepPessoa" size="10" maxlength="9" onblur="pesquisacep(this.value)" value="<?= $dcliente['stCepPessoa']; ?>" placeholder="Ex: 00000-000" />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>

                      <div class="col-md-8 ">
                        <label for="stLogradouroPessoa">Endereço<span class="text-orange"> *</span> </label>
                        <input type="text" name="stLogradouroPessoa" class="form-control text-uppercase" id="stLogradouroPessoa" value="<?= $dcliente['stLogradouroPessoa']; ?>" placeholder="Ex: Rua João da Silva" required />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <label for="nnCasaPessoa">Nº<span class="text-orange"> *</span></label>
                        <input type="number" name="nnCasaPessoa" class="form-control text-uppercase" id="nnCasaPessoa" value="<?= $dcliente['nnCasaPessoa']; ?>" placeholder="Ex: 123" required />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-4 ">
                        <label for="stCompleEndPessoa">Complemento</label>
                        <input type="text" name="stCompleEndPessoa" class="form-control text-uppercase" id="stCompleEndPessoa" value="<?= $dcliente['stCompleEndPessoa']; ?>" placeholder="Ex: Apto. 101" />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>

                      <div class="col-md-4 ">
                        <label for="stBairroPessoa">Bairro<span class="text-orange"> *</span></label>
                        <input type="text" name="stBairroPessoa" class="form-control text-uppercase" id="stBairroPessoa" value="<?= $dcliente['stBairroPessoa']; ?>" placeholder="Ex: Centro" required />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                      <div class="col-md-3 ">
                        <label for="stCidadePessoa">Cidade<span class="text-orange"> *</span></label>
                        <input type="text" name="stCidadePessoa" class="form-control text-uppercase" id="stCidadePessoa" value="<?= $dcliente['stCidadePessoa']; ?>" placeholder="Ex: São Paulo" required />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                      <div class="col-md-1 ">
                        <label for="stEstadoPessoa">UF<span class="text-orange"> *</span></label>
                        <input type="text" name="stEstadoPessoa" maxlength="2" class="form-control text-uppercase" id="stEstadoPessoa" value="<?= $dcliente['stEstadoPessoa']; ?>" placeholder="Ex: SP" required />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                    </div>
                    <br />
                    <fieldset>
                      <legend>
                        <h1 class="lead text-orange" style="font-family:'Advent Pro', sans-serif; font-weight: bold; color: #C77129">
                          DADOS DE CONTATOS
                        </h1>
                      </legend>
                    </fieldset>
                    <div class="form-row">
                      <div class="col-md-3 mb-3">
                        <label for="nnTelefonePessoa">Telefone<span class="text-orange"> *</span></label>
                        <input type="text" name="nnTelefonePessoa" class="form-control text-uppercase js_fone" id="nnTelefonePessoa" value="<?= $dcliente['nnTelefonePessoa']; ?>" placeholder="Ex: (11) 99999-9999" required />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="nnWhatsappPessoa">Whataspp</label>
                        <input type="text" name="nnWhatsappPessoa" class="form-control text-uppercase js_fone" id="nnWhatsappPessoa" value="<?= $dcliente['nnWhatsappPessoa']; ?>" placeholder="Ex: (11) 99999-9999" />
                        <div class="invalid-feedback">
                          Obrigatório !
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="stEmailPessoa">E-Mail</label>
                        <input type="email" name="stEmailPessoa" class="form-control" id="stEmailPessoa" value="<?= $dcliente['stEmailPessoa']; ?>" placeholder="Ex:email@provedor.com" />
                        <div class="invalid-feedback">
                          Obrigatório e deve seguir o padrão de E-maio(text@provedor.com...) !
                        </div>
                      </div>
                    </div>
                    <div class="form-row ">
                      <div class="col-md-12 d-flex justify-content-between align-meddings">
                        <input type="hidden" name="gravar" value="gravar" />

                        <a href="?page=listarClientes" class="btn btn-lg btn-outline-danger">
                          <i class="mdi mdi-trash-can-outline fa fa-fw"></i>
                          Cancelar</a>
                        <button class="btn btn-lg btn-success" type="submit">
                          <i class="far fa-save fa-fw fa-lg"></i>
                          Gravar Dados</button>
                      </div>
                    </div>
                  </form>

                  <!-- / Form edit Cliente-->
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>

    <!-- MODAL EDITAR FOTO -->
    <div class="modal fade" id="modal-edtFoto">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; color:#C77129">
              Trocar Foto</h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- form novo Usuário -->

            <form class="needs-validation" novalidate action="./pages/pages/acoes/editarFoto.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idPessoa" id="idPessoa" value="">
              <input type="hidden" name="nomePessoa" id="nomePessoa" value="<?= $dcliente['nmPessoa']; ?>">

              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="nnTelefonePessoa">Foto/Logo do Cliente <span class="text-orange">*</span>

                  </label>
                  <input type="file" name="imgCliente" class="form-control-lg text-uppercase" id="imgCliente" placeholder="">
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>

              </div>

          </div>
          <div class="modal-footer justify-content-between">

            <input type="hidden" name="userActionLog" value="<?php echo $_SESSION['USUARIO']; ?>" />
            <input type="hidden" name="gravar" value="gravar" />
            <button type="button" class="btn btn-outline-danger btn-lg" data-dismiss="modal">
              <i class="fas fa-times fa-fw fa-lg"></i>
              Fechar </button>
            <button class="btn btn-success btn-lg" type="submit">
              <i class="far fa-save fa-fw fa-lg"></i>
              Gravar Dados</button>
            </form>
            <!--/form novo Usuario -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- MODAL NOVA TAREFA -->
    <div class="modal fade" id="modal-novaTarefa">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; color:orange">Nova Tarefa&nbsp;
            </h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- form novo Usuário -->

            <form class="needs-validation" novalidate action="./pages/pages/acoes/gravaNovaTarefa.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idCreador" id="idCreador" value="<?= $_SESSION['ID']; ?>" />
              <input type="hidden" name="idProcesso" id="idProcesso" value="" />
              <input type="hidden" name="idpessoa" id="" value="<?= $_GET['id']; ?>" />

              <div class="form-row">
                <div class="col-md-12">
                  <label for="idResponsavel">Responsavel
                    <span class="text-orange">*</span>
                  </label>

                  <select class="form-control text-uppercase custom-select" name="idResponsavel" id="idResponsavel">
                    <option value="" selected disabled>Selecione Responsavel </option>
                    <?php
                    foreach (ler('vw_pessoa_user', '', 'WHERE nivelUser > 0 and flStatusUser = 1')->fetchAll(PDO::FETCH_ASSOC) as $users) {
                    ?>

                      <option value="<?= $users['idPessoaPessoa'] ?>"><?= $users['nmPessoa'] . ' - ' ?>
                        <?php
                        switch ($users['nivelUser']) {
                          case '1':
                            echo 'Administrador';
                            break;
                          case '2':
                            echo 'Secretário(a) / Atendente';
                            break;
                          case '3':
                            echo 'Advogado(a) / Parceiro(a)';
                            break;

                          default:
                            # code...
                            break;
                        }

                        ?>
                      </option>
                    <?php } ?>


                  </select>
                  <div class="invalid-feedback">
                    A seleção é Obrigatório !
                  </div>

                  <!-- <input type="text" name="objprocesso" class="form-control text-uppercase" disabled id="objprocesso" placeholder="Objeto do Processo" value="" required/>
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div> -->
                </div>

                <!-- <div class="col-md-6">
                  <label for="contraparte">Processo
                    <span class="text-orange">*</span>
                  </label>
                  <input type="text" name="contraparte" class="form-control text-uppercase  " id="contraparte" placeholder=" Parte Contraria" value="" >
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div> -->

              </div>
              <div class="form-row">
                <div class="col-md-12">
                  <label for="decricaoTarefa">O que deverá ser feito ?
                    <span class="text-orange">*</span>
                  </label>

                  <textarea class="form-control" name="decricaoTarefa" id="decricaoTarefa" placeholder="Decrição da tarefa" name="validation" rows="4" required></textarea>

                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-3">
                  <label for="dtTarefa">Data da tarefa
                    <span class="text-orange">*</span>
                  </label>
                  <input type="date" maxlength="19" name="dtTarefa" class="form-control text-uppercase" id="dtTarefa" placeholder="" value="" required />
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>
                <div class="col-md-2">
                  <label for="hora">Hora da tarefa</label>
                  <input type="time" maxlength="19" name="hora" class="form-control text-uppercase" id="hora" placeholder="" value="">
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>

                <div class="col-md-7">
                  <label for="statusprocesso">Local do Compromisso</label>

                  </label>
                  <input type="text" maxlength="19" name="local" class="form-control text-uppercase" id="local" placeholder="Local onde sera realizada a terefa" value="" />
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>
              </div>
              <br />
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-primary d-inline ">
                      <input type="checkbox" id="restingir" name="restingir" />
                      <label for="restingir">
                        Restrigir Tarefa ao Rsponsável
                      </label>
                    </div>

                  </div>
                </div>
              </div>



          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="idcliente" value="<?= $id; ?>" />
            <input type="hidden" name="idadvogado" value="0" />
            <input type="hidden" name="nomeCliente" value="<?= $dcliente['nmPessoa']; ?>" />
            <input type="hidden" name="userActionLog" value="<?= $_SESSION['USUARIO']; ?>" />
            <input type="hidden" name="gravar" value="gravar" />
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
              Fechar </button>
            <button class="btn btn-success btn-lg" type="submit">
              <i class="far fa-save fa-fw fa-lg"></i>
              Gravar Dados</button>
            </form>
            <!--/form novo Usuario -->
            <!-- <button type="button" class="btn btn-success">Save changes</button> -->
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- MODAL NOVO PROCESSO -->
    <div class="modal fade" id="modal-novoProdesso">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; color:orange">Novo Proceso nº:&nbsp;
            </h5>
            <h5 class="modal-title text-primary" style="font-family: 'Advent Pro', sans-serif; font-weight: 500; letter-spacing: 1px; text-transform: uppercase;">
              <?= nProcesso("processos", "{$_GET['id']}"); ?>
            </h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- form novo Usuário -->

            <form class="needs-validation" novalidate action="./pages/pages/acoes/gravaNovoProcesso.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="niprocesso" value="<?= nProcesso("processos", "{$_GET['id']}"); ?>" />
              <div class="form-row">
                <div class="col-md-6">
                  <label for="objprocesso">Objeto do Processo
                    <span class="text-orange">*</span>
                  </label>
                  <input type="text" name="objprocesso" class="form-control text-uppercase  " id="objprocesso" placeholder="Objeto do Processo" value="" required>
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="contraparte">Parte Contraria
                    <span class="text-orange">*</span>
                  </label>
                  <input type="text" name="contraparte" class="form-control text-uppercase  " id="contraparte" placeholder=" Parte Contraria" value="" required>
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>

              </div>
              <div class="form-row">
                <div class="col-md-12">
                  <label for="descricaoprocesso">Descrição do Processo
                    <span class="text-orange">*</span>
                  </label>

                  <textarea class="form-control" name="descricaoprocesso" id="descricaoprocesso" placeholder="Decrição detalhada do processo/caso" name="validation" rows="4" required></textarea>

                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-4">
                  <label for="numprocesso">Nº Processo (CNJ)</label>
                  <input type="text" maxlength="19" name="numprocesso" class="form-control text-uppercase js_numCNJ" id="numprocesso" placeholder="Número do Processo" value="">
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="areaprocesso">Área da Ação
                    <span class="text-orange">*</span>
                  </label>
                  <select class="form-control text-uppercase" required name="areaprocesso" id="areaprocesso">
                    <!--<option value="" selected disabled>Área do ação</option>-->
                    <option value="adminsitrativo">Administrativo</option>
                    <option value="civil">Civil</option>
                    <option value="familia">Família</option>
                    <option value="previdenciario">Previdenciário</option>
                    <option value="trabalhista">Trabalhista</option>

                  </select>
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="statusprocesso">Status
                    <span class="text-orange">*</span>
                  </label>
                  <select class="form-control text-uppercase" required name="statusprocesso" id="statusprocesso">
                    <option value="aguardando">Aguardando Documento</option>
                    <option value="pericia">Perícia ou Agendamento</option>
                    <option value="prorrogacao">Prorrogação</option>
                    <option value="exigencia">Exigência</option>
                    <option value="aguardandoINSS">Aguardando Resposta do INSS</option>
                    <option value="justFederal">Justiça Federal </option>
                    <option value="concluido">Concluído </option>


                  </select>
                  <div class="invalid-feedback">
                    Obrigatório !
                  </div>
                </div>
              </div>


          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="idcliente" value="<?= $id; ?>">
            <input type="hidden" name="idadvogado" value="0">
            <input type="hidden" name="nomeCliente" value="<?= $dcliente['nmPessoa']; ?>">
            <input type="hidden" name="userActionLog" value="<?= $_SESSION['USUARIO']; ?>">
            <input type="hidden" name="gravar" value="gravar">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times fa-fw fa-lg"></i>
              Fechar </button>
            <button class="btn btn-success btn-lg" type="submit">
              <i class="far fa-save fa-fw fa-lg"></i>
              Gravar Dados</button>
            </form>
            <!--/form novo Usuario -->
            <!-- <button type="button" class="btn btn-success">Save changes</button> -->
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


  <?php } ?>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- <footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.0.0-rc.5
  </div>
  <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
  reserved.
</footer> -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>

<!-- ./wrapper -->
<script>
  function setaDadosModalProcesso(valor) {
    document.getElementById('idPessoaCliente').value = valor;

  };

  function modalIdProcesso(valor) {
    document.getElementById('idProcesso').value = valor;
  };

  function setaDadosModal(valor) {
    document.getElementById('idPessoa').value = valor;
  };
</script>
<script>
  //document.getElementById('gestaoMenu').classList.add("menu-open");
  //document.getElementById('gestaoMenuActive').classList.add("active");
  document.getElementById('menuClientes').classList.add("active");


  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();

  // Adicionando Javascript
  function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById("stLogradouroPessoa").value = "";
    document.getElementById("stBairroPessoa").value = "";
    document.getElementById("stCidadePessoa").value = "";
    document.getElementById("stEstadoPessoa").value = "";
    // document.getElementById("ibge").value = "";
  }

  function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
      //Atualiza os campos com os valores.
      document.getElementById("stLogradouroPessoa").value = (conteudo.logradouro);
      document.getElementById("stBairroPessoa").value = (conteudo.bairro);
      document.getElementById("stCidadePessoa").value = (conteudo.localidade);
      document.getElementById("stEstadoPessoa").value = (conteudo.uf);
      //document.getElementById("ibge").value =
      //conteudo.ibge;
    } //end if.
    else {
      //CEP não Encontrado.
      limpa_formulário_cep();
      alert("CEP não encontrado.");
    }
  }

  function pesquisacep(valor) {
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, "");

    //Verifica se campo cep possui valor informado.
    if (cep != "") {
      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      //Valida o formato do CEP.
      if (validacep.test(cep)) {
        //Preenche os campos com "..." enquanto consulta webservice.
        document.getElementById("stLogradouroPessoa").value = "...";
        document.getElementById("stBairroPessoa").value = "...";
        document.getElementById("stCidadePessoa").value = "...";
        document.getElementById("stEstadoPessoa").value = "...";
        //document.getElementById("ibge").value = "...";

        //Cria um elemento javascript.
        var script = document.createElement("script");

        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);
        document.getElementById("nnCasaPessoa").focus();
      } //end if.
      else {
        //cep é inválido.
        limpa_formulário_cep();
        alert("Formato de CEP inválido.");
        document.getElementById("stLogradouroPessoa").focus();
      }
    } //end if.
    else {
      //cep sem valor, limpa formulário.
      limpa_formulário_cep();
    }
  }
</script>
