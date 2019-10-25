<?php
  include_once("conexao.php");

  if(!empty($_POST))
  {
    if (
      empty($_POST['idUsuario'])|| empty($_POST['senha']) || empty($_POST['tipoUsuario']) || empty($_POST['nome']) || empty($_POST['data_nasc']) || 
      empty($_POST['telefone']) || empty($_POST['sexo']) || empty($_POST['estado_civil']) || empty($_POST['rg']) || empty($_POST['cpf']) ||
      empty($_POST['bairro']) || empty($_POST['cep']) || empty($_POST['cidade']) || empty($_POST['enderecoResidencial']) || empty($_POST['email']) || 
      empty($_POST['confirmar_senha'])
    ) {
      echo 'Todos os campos são obrigatorios';
    } else {
      $id = $_POST['idUsuario'];
      $data = [
        'senha' => $_POST['senha'],
        'tipoUsuario' => $_POST['tipoUsuario'],
        'nome' => $_POST['nome'],        
        'data_nasc' => $_POST['data_nasc'],
        'telefone' => $_POST['telefone'],
        'sexo' => $_POST['sexo'],
        'estado_civil' => $_POST['estado_civil'],
        'rg' => $_POST['rg'],
        'cpf' => $_POST['cpf'],
        'bairro' => $_POST['bairro'],
        'cep' => $_POST['cep'],
        'cidade' => $_POST['cidade'],
        'enderecoResidencial' => $_POST['enderecoResidencial'],       
        'email' => $_POST['email'],         
        'confirmar_senha' => $_POST['confirmar_senha'],
      ];

      $update_fields = [];

      $update_fields = array_map(function($key, $value) {
        if (preg_match("/[^0-9]+/", $value)) {
          $value = "'{$value}'";
        }
        return "{$key} = {$value}";
      }, array_keys($data), $data);

      $update_fields = implode(', ', $update_fields);

      $slq_update_usuario = "UPDATE
                                usuario
                              SET
                                {$update_fields}
                              WHERE
                                idUsuario = {$id}";

      $salvar_usuario = mysqli_query($conexao, $slq_update_usuario);

      if($salvar_usuario){
      ?>
        <script>
          alert("Cadasto do usuario alterado com sucesso no sistema!");               
        </script>
      <?php
        header("Refresh: 0; listaUsuario.php");
      }else{
      ?>
        <script>
          alert("Erro ao alterar o cadastro do usuario!");               
        </script>
      <?php               
        header("Refresh: 0; listaUsuario.php");    

      }
    }
  }

  //Retornar dados do usuário:
    if(empty($_GET['id']))
    {
      header('Location: listaUsuario.php');
    }
    $idU = $_GET['id'];

    $sql = mysqli_query($conexao, "SELECT idUsuario, senha, tipoUsuario, nome, data_nasc, telefone, sexo, estado_civil, rg, cpf, bairro, cep, cidade, enderecoResidencial, email, confirmar_senha FROM usuario WHERE idUsuario = $idU ");

    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0){
      header('Location: listaUsuario.php');
    }else{
      while ($data = mysqli_fetch_array($sql)) {

        $idUsuario = $data['idUsuario'];
        $senha = $data['senha'];
        $tipoUsuario = $data['tipoUsuario'];
        $nome = $data['nome'];
        $data_nasc = $data['data_nasc'];
        $telefone = $data['telefone'];
        $sexo = $data['sexo'];
        $estado_civil = $data['estado_civil'];
        $rg = $data['rg'];
        $cpf = $data['cpf'];
        $bairro = $data['bairro'];
        $cep = $data['cep'];
        $cidade = $data['cidade'];
        $enderecoResidencial = $data['enderecoResidencial'];
        $email = $data['email'];
        $confirmar_senha = $data['confirmar_senha'];

      }
    }

    $sexo_options = [
      [ 'name' => 'Feminino', 'value' => 'f' ],
      [ 'name' => 'Masculino', 'value' => 'm' ],
    ];

    $estado_civil_options = [
      [ 'name' => 'Casado', 'value' => 'c' ],
      [ 'name' => 'Solteiro', 'value' => 's' ],
      [ 'name' => 'Divorciado', 'value' => 'd' ],
    ];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  

  <title>Editar Usuário</title>

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
              <li><a class="" href="listaUsuario.php"> Lista Usuarios</a></li>
              <li><a class="" href="index_cadastro_usuario.php"> Cadastrar Usuario</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_document_alt"></i>
              <span> Prontuarios</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="indexCadastroHistoriaClinica.html"> Historia Clinica</a></li>
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
                CADASTRO USUARIO
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal " id="register_form" method="post" action="">
                    <input type = "hidden" name="idUsuario" value="<?= $idU; ?>">
                    <div class="form-group ">
                      <label for="nome" class="control-label col-lg-2">Nome Completo<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class=" form-control" type="text" name="nome" required="required" placeholder="Digite o Nome" value="<?php echo $nome; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="tipoUsuario" class="control-label col-lg-2">Tipo Usuário<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="tipoUsuario" class="form-control" required="required">                          
                            <option value="<?php echo $tipoUsuario; ?>" selected><?php echo $tipoUsuario; ?></option>
                            <option value="profissional">Profissional</option>
                            <option value="coordenador">Coordenador</option>                          
                          </select>
                        </div>
                    </div>
                    <div class="form-group ">
                      <label for="data_nasc" class="control-label col-lg-2">Data de Nascimento<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="date" name="data_nasc" required="required" value="<?php echo $data_nasc; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cpf" class="control-label col-lg-2">CPF<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="cpf" required="required" placeholder="12345678910" value="<?php echo $cpf; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="rg" class="control-label col-lg-2">RG<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="rg" required="required" placeholder="123456789" value="<?php echo $rg; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="telefone" class="control-label col-lg-2">Telefone<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="telefone" required="required" placeholder="(DD)99999-9999" value="<?php echo $telefone; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">Email<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" name="email" type="email" placeholder="seunome@email.com" value="<?php echo $email; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="sexo" class="control-label col-lg-2">Sexo<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="sexo" class="form-control" required="required">
                            <?php
                              foreach ($sexo_options as $option) {
                                if ($sexo === $option['value']) {
                                  ?>
                                    <option selected value="<?= $option['value']; ?>">
                                      <?= $option['name']; ?>
                                    </option>
                                  <?php
                                } else {
                                  ?>
                                    <option value="<?= $option['value']; ?>">
                                      <?= $option['name']; ?>
                                    </option>
                                  <?php
                                }
                              }
                            ?>
                          </select>
                        </div>
                    </div>
                    <div class="form-group ">
                      <label for="estado_civil" class="control-label col-lg-2">Estado Civil<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="estado_civil" class="form-control" required="required">
                            <?php
                              foreach ($estado_civil_options as $option) {
                                if ($estado_civil === $option['value']) {
                                  ?>
                                    <option selected value="<?= $option['value']; ?>">
                                      <?= $option['name']; ?>
                                    </option>
                                  <?php
                                } else {
                                  ?>
                                    <option value="<?= $option['value']; ?>">
                                      <?= $option['name']; ?>
                                    </option>
                                  <?php
                                }
                              }
                            ?>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="cep" class="control-label col-lg-2">CEP<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="cep" required="required" placeholder="Digite o CEP" value="<?php echo $cep; ?>"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="enderecoResidencial" class="control-label col-lg-2">Endereço Residencial<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control"  type="text" name="enderecoResidencial" required="required" placeholder="Digite o Endereço" value="<?php echo $enderecoResidencial; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="bairro" class="control-label col-lg-2">Bairro<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="bairro" required="required" placeholder="Digite o Bairro" value="<?php echo $bairro; ?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cidade" class="control-label col-lg-2">Cidade<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="cidade" required="required" placeholder="Digite a Cidade" value="<?php echo $cidade; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="senha" class="control-label col-lg-2">Senha<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="password" name="senha" required="required" placeholder="Digite a Senha" value="<?php echo $senha; ?>"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="confirmar_senha" class="control-label col-lg-2">Confirme a Senha<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="password"name="confirmar_senha" required="required" placeholder="Confirme a senha" value="<?php echo $confirmar_senha; ?>"/>
                      </div>
                    </div>
                    <center>
                      <div>
                        <small id="" class="form-text text">
                           OBS: Antes de encerrar o cadastro verificar com o auxilio do profissional se todos os dados estão corretos.             
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
  <script src="js/charts.js"></script>
  <script src="js/jquery.slimscroll.min.js"></script>

</body>

</html>
