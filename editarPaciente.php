<?php

include_once("conexao.php");

	//Retornar dados:
    if(empty($_GET['id']))
    {

      header('Location: listaPaciente.php');

    }

    $idP = $_GET['id'];

    $sql = mysqli_query($conexao, "SELECT idPaciente, nome, data_nasc, telefone, sexo, estado_civil, rg, cpf, endereco, bairro, cep, cidade, email FROM paciente WHERE idPaciente = $idP ");

    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0){
      header('Location: listaPaciente.php');

    }else{
      
      while ($data = mysqli_fetch_array($sql)) {
        # code...
        $idPaciente = $data ['idPaciente'];
        $nome = $data ['nome'];
        $data_nasc = $data ['data_nasc'];
        $telefone = $data ['telefone'];
        $sexo = $data ['sexo'];
        $estado_civil = $data ['estado_civil'];
        $rg = $data ['rg'];
        $cpf = $data ['cpf'];
        $endereco = $data ['endereco'];
        $bairro = $data ['bairro'];
        $cep = $data ['cep'];
        $cidade = $data ['cidade'];
        $email = $data ['email'];

      }
    }

    $sql_update_paciente = mysqli_query ($conexao, "UPDATE paciente SET nome = '$nome', data_nasc = '$data_nasc', telefone = '$telefone', sexo ='$sexo', estado_civil='$estado_civil', rg='$rg', cpf='$cpf', endereco='$endereco', bairro='$bairro', cep='$cep', cidade='$cidade', email='$email' WHERE idPaciente= idP ");

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  

  <title>Editar Paciente</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
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
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>
      <a class="navbar-brand" href="#">
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
            <a class="" href="indexProfissional.html">
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
          <li>
            <a class="" href="">
              <i class="icon_genius"></i>
              <span>Odontograma</span>
            </a>
          </li>

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
                EDITAR CADASTRO DE PACIENTE
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal " id="register_form" method="put" action="">
                    <input type = "hidden" name="idPaciente" value="<?php echo $idP; ?>">
                    <div class="form-group ">
                      <label for="nome" class="control-label col-lg-2">Nome Completo<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="nome" placeholder="Digite o Nome" required="required" value = "<?php echo $nome; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="data_nasc" class="control-label col-lg-2">Data de Nascimento<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class=" form-control"  type="date"  name="data_nasc"required="required" value = "<?php echo $data_nasc; ?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cpf" class="control-label col-lg-2">CPF<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="cpf" placeholder="12345678910" value = "<?php echo $cpf; ?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="rg" class="control-label col-lg-2">RG<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" name="rg" type="text" placeholder="123456789" value = "<?php echo $rg; ?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="telefone" class="control-label col-lg-2">Telefone<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" name="telefone" type="text" placeholder="(DD)99999-9999" value = "<?php echo $telefone; ?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">Email<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" name="email" type="email" placeholder="seunome@email.com" value = "<?php echo $email ;?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="sexo" class="control-label col-lg-2">Sexo<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name ="sexo" class="form-control" required="required">
                            <option selected value = "$sexo"><?php echo $sexo ;?></option>
                            <option value="f">Feminino</option>
                            <option value="m">Masculino</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group ">
                      <label for="estado_civil" class="control-label col-lg-2">Estado Civil<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select class="form-control" name="estado_civil" required="required">
                            <option selected value = ""><?php echo $estado_civil ;?></option>
                            <option value="s" >Solteiro</option>
                            <option value="c">Casado</option>
                            <option value="d" >Divorciado</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group ">
                      <label for="cep" class="control-label col-lg-2">CEP<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control"  type="text" name="cep" placeholder="Digite o CEP" value = "<?php echo $cep ;?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="endereco" class="control-label col-lg-2">Endereço Residencial<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="endereco" placeholder="Digite o Endereço" value = "<?php echo $endereco ; ?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="bairro" class="control-label col-lg-2">Bairro<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="bairro" placeholder="Digite o Bairro" value = "<?php echo $bairro ; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cidade" class="control-label col-lg-2">Cidade<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="cidade" placeholder="Digite a Cidade" value = "<?php echo $cidade ;?>"/>
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
                        <button class="btn btn-primary" type="submit" value = "">Salvar</button>
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
  <!-- custom select -->
  <script src="js/jquery.customSelect.min.js"></script>
  <script src="assets/chart-master/Chart.js"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>    
  <!-- custom script for this page-->
  <script src="js/xcharts.min.js"></script>
  <script src="js/jquery.autosize.min.js"></script>
  <script src="js/jquery.placeholder.min.js"></script>
  <script src="js/jquery.slimscroll.min.js"></script>

</body>

</html>
