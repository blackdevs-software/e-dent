<?php

include_once("conexao.php");
  if(!empty($_POST))
  {
    $alert='';

    if(empty($_POST['nome']) || empty($_POST['data_nasc']) || empty($_POST['telefone']) || empty($_POST['sexo']) || empty($_POST['estado_civil']) || empty($_POST['rg']) || empty($_POST['cpf']) || empty($_POST['endereco']) || empty($_POST['bairro']) || empty($_POST['cep']) || empty($_POST['cidade']) || empty($_POST['email']))
    {
    ?>
        <script>
          alert("Paciente já cadastrado no sistema, reeveja os dados!");               
        </script>

    <?php
               
        header("Refresh: 0; index.html");    

    }else{

          
          $nome = $_POST['nome'];
          $data_nasc = $_POST['data_nasc'];
          $telefone = $_POST['telefone'];
          $sexo = $_POST['sexo'];
          $estado_civil = $_POST['estado_civil'];
          $rg = $_POST['rg'];
          $cpf_paciente = $_POST['cpf'];
          $endereco = $_POST['endereco'];
          $bairro = $_POST['bairro'];
          $cep = $_POST['cep'];
          $cidade = $_POST['cidade'];
          $email = $_POST['email'];

          $query = mysqli_query ($conexao, "SELECT * FROM paciente WHERE cpf = '$cpf_paciente' ");

          $result = mysqli_fetch_array ($query);

          if($result > 0){

          ?>
              <script>
                alert("Paciente já cadastrado no sistema, reeveja os dados!");               
              </script>

          <?php
               
          header("Refresh: 2; index.html");          

          

          }else{

              $sql_insert_paciente = mysqli_query($conexao, "INSERT INTO paciente (nome, data_nasc, telefone, sexo, estado_civil, rg, cpf, endereco, bairro, cep, cidade, email) VALUES ('$nome', '$data_nasc', '$telefone', '$sexo', '$estado_civil', '$rg', '$cpf_paciente', '$endereco', '$bairro', '$cep','$cidade','$email')");

              if($sql_insert_paciente){

              ?>
                  <script>
                    alert("Paciente cadastrado com sucesso no sistema!");               
                  </script>

              <?php
               
              header("Refresh: 2; index.html");    

              }else{

              ?>
                  <script>
                    alert("Erro ao cadastrar paciente!");               
                  </script>

              <?php
               
              header("Refresh: 2; index.html");    

              }

          }
    }

  }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Cadastrar Pacientes">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  

  <title>Cadastro de Paciente</title>

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
  <!-- container section start -->
  <section id="container" class="">
      <header class="header dark-bg">
        <div class="toggle-nav">
          <div class="icon-reorder tooltips" data-original-title="Menu lateral" data-placement="bottom"><i class="icon_menu"></i></div>
        </div>
        <a class="navbar-brand" href="">
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
              <span>Pacientes</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="listaPaciente.php"> Lista de Pacientes</a></li>
              <li><a class="" href="indexCadastroPaciente.html"> Cadastrar Paciente</a></li>
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
                CADASTRO DE PACIENTE
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal " id="register_form" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group ">
                      <label for="nome" class="control-label col-lg-2">Nome Completo<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="nome" name="nome" type="text" placeholder="Digite o Nome" required="required"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="data_nasc" class="control-label col-lg-2">Data de Nascimento<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="data_nasc" name="data_nasc" type="date" required="required" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="rg" class="control-label col-lg-2">RG<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="rg" name="rg" type="text" placeholder="123456789" required="required"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cpf" class="control-label col-lg-2">CPF<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cpf" name="cpf" placeholder="12345678910" type="text" required="required"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="telefone" class="control-label col-lg-2">Telefone<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="telefone" name="telefone" type="text" placeholder="(DD)99999-9999" required="required"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">Email <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="email" name="email" type="text" placeholder="seunome@email.com" required="required"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="sexo" class="control-label col-lg-2">Sexo<span class="required">*</span></label>
                        <div class="col-lg-10">
                              <select name = "sexo" class="form-control" required="required">
                                <option value = "" selected>Selecionar</option>
                                <option value="f">Feminino</option>
                                <option value ="m">Masculino</option>
                              </select>
                        </div>
                    </div>
                    <div class="form-group ">
                      <label for="estado_civil" class="control-label col-lg-2">Estado Civil<span class="required">*</span></label>
                        <div class="col-lg-10">
                              <select required="required" name ="estado_civil" class="form-control">
                                <option value = "" selected>Selecionar</option>
                                <option value = "s">Solteiro</option>
                                <option value = "c">Casado</option>
                                <option value = "d">Divorciado</option>
                              </select>
                        </div>
                    </div>
                    <div class="form-group ">
                      <label for="cep" class="control-label col-lg-2">CEP<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cep" name="cep" placeholder="Digite o CEP" type="text" required="required"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="endereco" class="control-label col-lg-2">Endereço Residencial<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" id="endereco" name="endereco" class="form-control" id="endereco" placeholder="Digite o Endereço" type="text" required="required" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="bairro" class="control-label col-lg-2">Bairro<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" id="bairro" name="bairro" class="form-control" id="" placeholder="Digite o Bairro" type="text" required="required" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cidade" class="control-label col-lg-2">Cidade<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cidade" name="cidade" class="form-control" id="" placeholder="Digite a Cidade" type="text" required="required" />
                      </div>
                    </div>
                    <center>
                      <div>
                        <small id="" class="form-text text">
                           OBS: Antes de encerrar o cadastro verificar e com o auxilio do paciente verificar se todos os dados estão corretos.              
                        </small>
                      </div>
                      <br>                  

                      <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                          <button class="btn btn-primary" type="submit" value = "Cadastrar Paciente">Salvar</button>
                          <button class="btn btn-default" type="button">Cancelar</button>
                        </div>
                      </div>
                	  </center>
                  </form>
                </div>
              </div>
            </section>
          </div>
        </div>
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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });

    </script>

</body>

</html>
