<?php
  include_once('connection.php');

  if (!empty($_POST)) {
    if (empty($_POST['nome']) || empty($_POST['tipoUsuario']) || empty($_POST['data_nasc'])
      || empty($_POST['cpf']) || empty($_POST['rg']) || empty($_POST['telefone'])
      || empty($_POST['email']) || empty($_POST['sexo']) || empty($_POST['estado_civil'])
      || empty($_POST['cep']) || empty($_POST['enderecoResidencial']) || empty($_POST['bairro'])
      || empty($_POST['cidade']) || empty($_POST['senha']) || empty($_POST['confirmar_senha'])) {
    ?>
      <script>
        alert("Todos os campos são obrigatorios");
      </script>
    <?php
      header("Refresh: 0; cadastroPaciente.php");
    } else {
      $nome = $_POST['nome'];
      $tipoUsuario = $_POST['tipoUsuario'];
      $data_nasc = $_POST['data_nasc'];
      $cpf_usuario = $_POST['cpf'];
      $rg = $_POST['rg'];
      $telefone = $_POST['telefone'];
      $email = $_POST['email'];
      $sexo = $_POST['sexo'];
      $estado_civil = $_POST['estado_civil'];
      $cep = $_POST['cep'];
      $enderecoResidencial = $_POST['enderecoResidencial'];
      $bairro = $_POST['bairro'];
      $cidade = $_POST['cidade'];
      $senha = $_POST['senha'];
      $confirmar_senha = $_POST['confirmar_senha'];

      $query = mysqli_query($conn, "SELECT * FROM usuario WHERE cpf = '{$cpf_usuario}' ");

      $result = mysqli_fetch_array ($query);

      if ($result > null) {
        ?>
          <script>
            alert("Usuário já cadastrado no sistema, reeveja os dados!");
          </script>
        <?php
        header("Refresh: 0; cadastroUsuario.php");
      } else {
        $query = "INSERT INTO usuario
        (senha, tipoUsuario, nome, data_nasc, telefone, sexo, estado_civil, rg, cpf, bairro, cep, cidade, enderecoResidencial, email, confirmar_senha)
        VALUES
        ('{$senha}', '{$tipoUsuario}', '{$nome}', '{$data_nasc}', '{$telefone}', '{$sexo}', '{$estado_civil}', '{$rg}', '{$cpf_usuario}', '{$bairro}', '{$cep}', '{$cidade}', '{$enderecoResidencial}', '{$email}', '{$confirmar_senha}')";

        $result = mysqli_query($conn, $query);

        if ($result) {
          ?>
            <script>
              alert("Usuário cadastrado com sucesso no sistema!");
            </script>
          <?php
          header("Refresh: 0; listaUsuario.php");
        } else {
          ?>
            <script>
              alert("Erro ao cadastrar usuário!");
            </script>
          <?php
          header("Refresh: 0; cadastroUsuario.php");
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
  <meta name="description" content="Cadastro de Usuários">
  <meta name="keyword" content="Web System, Odontologic System, Dentist">
  <title>Cadastro de Usuários</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/main.css">
  <link rel="icon" type="image/png" href="images/icons/iconEdent.png"/>
</head>

<body>
  <section id="container" class="">
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>
      <a class="navbar-brand" href="#">
          <img src="images/icons/E-DENT-3.png" class="nav-item " alt="logo" style="width: 90px">
      </a>
    </header>

    <aside>
      <div id="sidebar" class="nav-collapse ">
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
              <li><a class="" href="cadastroPaciente.php"> Cadastrar Paciente</a></li>
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
              <li><a class="" href="cadastroUsuario.php"> Cadastrar Usuario</a></li>
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
      </div>
    </aside>

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
                    <div class="form-group ">
                      <label for="nome" class="control-label col-lg-2">Nome Completo<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class=" form-control" type="text" name="nome" required="required" placeholder="Digite o Nome"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="tipoUsuario" class="control-label col-lg-2">Tipo Usuário<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="tipoUsuario" class="form-control" required="required">
                            <option value="" selected>Selecionar</option>
                            <option value="Profissional">Profissional</option>
                            <option value="Coordenador">Coordenador</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group ">
                      <label for="data_nasc" class="control-label col-lg-2">Data de Nascimento<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="date" name="data_nasc" required="required"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cpf" class="control-label col-lg-2">CPF<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="cpf" required="required" placeholder="12345678910"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="rg" class="control-label col-lg-2">RG<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="rg" required="required" placeholder="123456789"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="telefone" class="control-label col-lg-2">Telefone<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="telefone" required="required" placeholder="(DD)99999-9999"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">Email<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" name="email" type="email" placeholder="seunome@email.com"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="sexo" class="control-label col-lg-2">Sexo<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="sexo" class="form-control" required="required">
                            <option value="" selected>Selecionar</option>
                            <option value="f">Feminino</option>
                            <option value="m">Masculino</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group ">
                      <label for="estado_civil" class="control-label col-lg-2">Estado Civil<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="estado_civil" class="form-control" required="required">
                            <option value="" selected>Selecionar</option>
                            <option value="s">Solteiro</option>
                            <option value="c">Casado</option>
                            <option value="d">Divorciado</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="cep" class="control-label col-lg-2">CEP<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="cep" required="required" placeholder="Digite o CEP"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="enderecoResidencial" class="control-label col-lg-2">Endereço Residencial<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control"  type="text" name="enderecoResidencial" required="required" placeholder="Digite o Endereço"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="bairro" class="control-label col-lg-2">Bairro<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="bairro" required="required" placeholder="Digite o Bairro"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cidade" class="control-label col-lg-2">Cidade<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="cidade" required="required" placeholder="Digite a Cidade"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="senha" class="control-label col-lg-2">Senha<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="password" name="senha" required="required" placeholder="Digite a Senha"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="confirmar_senha" class="control-label col-lg-2">Confirme a Senha<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="password"name="confirmar_senha" required="required" placeholder="Confirme a senha"/>
                      </div>
                    </div>
                    <center>
                      <div>
                        <small id="" class="form-text text">
                          OBS: Antes de encerrar o cadastro verificar com o auxilio do profissional se todos os dados estão corretos.
                        </small>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                          <button class="btn btn-primary" type="submit" value="">Salvar</button>
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
  </section>

  <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="js/jquery.customSelect.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="js/scripts.js"></script>
</body>

</html>
