
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Lista de Pacientes">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  

  <title>Lista de Usuários</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/fullcalendar.css">
  <link href="css/widgets.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/xcharts.min.css" rel=" stylesheet">
  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/icons/iconEdent.png"/>
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/main.css">
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

</head>

<body>

  <?php include_once("conexao.php") ?>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Menu lateral" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <a class="navbar-brand" href="loginEDENT/indexLogin.html">
        <img src="images/icons/E-DENT-3.png" class="nav-item " alt="logo" style="width: 90px">
      </a>
    
      
      
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="indexCoordenador.html">
              <i class="icon_house_alt"></i>
              <span>Home</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_document_alt"></i>
              <span> Pacientes</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="listaPaciente.php"> Lista de Pacientes</a></li>
              <li><a class="" href="index_cadastro_paciente.php"> Cadastrar Paciente</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_document_alt"></i>
              <span> Usuários</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="listaUsuario.php"> Lista de Usuários</a></li>
              <li><a class="" href="cadastroUsuario.html"> Cadastrar Usuários</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_document_alt"></i>
              <span> Prontuarios</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="indexCadastroHistoriaMedica.html"> Historia Clinica</a></li>
              <li><a class="" href="indexHigieneOral.html"> Higiene Oral</a></li>
              <li><a class="" href="ProntuarioOdontologico.html"> Odontológico</a></li>
            </ul>
          </li>
          <li><a class="" href="agendaConsultas.html"><i class="icon_genius"></i><span>Consultas</span></a></li>
          <li><a class="" href="odontograma.html"><i class="icon_genius"></i><span>Odontograma</span></a></li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                LISTA USUÁRIOS
              </header>
                <div class="panel-body">
                  <form method="get" action="">
                  <div class="form">
                    <label for="" class="control-label col-lg-2">Pesquise o Usuário: <span class="required">*</span></label>
                      <div class="col-lg-6">
                        <input type="search" id="" value="" class="form-control" placeholder="Busque pelo RG ou CPF">
                        <br>
                        <input class="btn btn-primary" type="button" value="Pesquisar">
                      </div>
                  </div>
                  </form>
                </div>              
                <div class="panel-body">
                  <div class="col-lg-12">
                    <section class="panel">
                      <table class="table table-striped table-advance table-hover">
                        <tbody>
                          <tr>
                            <th><i class="icon_profile"></i> Nome</th>
                            <th><i class="icon_profile"></i> Tipo Usuario</th>
                            <th><i class="icon_calendar"></i> D. Nascimento</th>
                            <th><i class="icon_pin_alt"></i> CPF</th>                        
                            <th><i class="icon_mobile"></i> Telefone</th>
                            <th><i class="icon_cogs"></i> Editar</th>
                          </tr>
                          <?php

                            $sql_lista_usuario = "SELECT nome, tipoUsuario, data_nasc, cpf, telefone FROM usuario";
                            $lista_usuarios = mysqli_query ($conexao, $sql_lista_usuario);                  
                            $registros_usuarios = mysqli_num_rows($lista_usuarios);

                          if($lista_usuarios > null){
                            while ($data = mysqli_fetch_array($lista_usuarios)){

                          ?>

                          <tr>
                            <td><?php echo $data ["nome"]; ?></td>
                            <td><?php echo $data ["tipoUsuario"]; ?></td>
                            <td><?php echo $data ["data_nasc"]; ?></td>
                            <td><?php echo $data ["cpf"]; ?></td>
                            <td><?php echo $data ["telefone"]; ?></td>
                            <td>
                              <div class="btn-group">
                                <a class="btn btn-info" href=""><i class="icon_plus_alt2"></i></a>
                              </div>
                            </td>
                          </tr>




                          <?php
                            }


                          }


                          ?>
                    
                        </tbody>
                      </table>
                    </section>
                  </div>
                </div>
            </section>
          </div>
        </div>
      </section>
    </section>
  </section>

    <!--main content end-->
  
  <!-- container section start -->

  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <script src="js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/xcharts.min.js"></script>
    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/gdp-data.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/sparklines.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>

</body>

</html>

