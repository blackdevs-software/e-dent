<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Lista de Pacientes">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">

  <title>Lista de Paciente</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
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
            <a class="" href="index.html">
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
                LISTA PACIENTES
              </header>
              <div class="panel-body">
                  <form method="get" action="">
                  <div class="">
                    <label for="" class="control-label col-lg-2">Pesquise o Paciente: <span class="required">*</span></label>
                      <div class="col-lg-6">
                        <input type="text" name="busca_paciente" class="form-control" placeholder="Pesquise o paciente pelo nome" required autofocus>
                        <br>
                        <input class="btn btn-primary" type="submit" value="Pesquisar">
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
                          <th><i class="icon_calendar"></i> D. Nascimento</th>
                          <th><i class="icon_mail_alt"></i> Email</th>
                          <th><i class="icon_pin_alt"></i> CPF</th>
                          <th><i class="icon_mobile"></i> Telefone</th>
                          <th><i class="icon_cogs"></i></th>
                        </tr>
                        <?php

                          include_once("conexao.php");


                          $busca_paciente = isset ($_GET['busca_paciente'])?$_GET['busca_paciente']:"";

                          $sql_pesquisa_paciente = "SELECT nome, data_nasc, email, cpf, telefone FROM paciente WHERE  nome LIKE '%$busca_paciente%'";                          

                          $sql_lista_paciente = "SELECT idPaciente, nome, data_nasc, email, cpf, telefone FROM paciente";

                          $lista_paciente = mysqli_query ($conexao, $sql_pesquisa_paciente);
                          $registros_paciente = mysqli_num_rows($lista_paciente);

                          if($lista_paciente > null){
                            while ($data = mysqli_fetch_array($lista_paciente)){
                              ?>
                                <tr>
                                  <td><?= $data ["nome"]; ?></td>
                                  <td><?= $data ["data_nasc"]; ?></td>
                                  <td><?= $data ["email"]; ?></td>
                                  <td><?= $data ["cpf"]; ?></td>
                                  <td><?= $data ["telefone"]; ?></td>
                                  <td>
                                    <a class="link_edit" href="editarPaciente.php?id=<?= $data['idPaciente']; ?>">Editar</a>
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
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/chart-master/Chart.js"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
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
