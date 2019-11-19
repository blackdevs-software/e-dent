<?php
  include_once('check_session.php');
  include_once('connection.php');

  if (!empty($_POST)) {
    if (empty($_POST['nome']) || empty($_POST['data_nasc']) || empty($_POST['telefone'])
      || empty($_POST['sexo']) || empty($_POST['estado_civil']) || empty($_POST['rg'])
      || empty($_POST['cpf']) || empty($_POST['endereco']) || empty($_POST['bairro'])
      || empty($_POST['cep']) || empty($_POST['cidade']) || empty($_POST['email'])) {
    ?>
      <script>
        alert('Todos os campos são obrigatorios');
      </script>
    <?php
      header('Refresh: 0; cadastro_paciente.php');
      return;
    } else {
      $nome = trim(htmlspecialchars(filter_var($_POST['nome'], FILTER_SANITIZE_STRING)));
      $email = trim(htmlspecialchars(filter_var($_POST['email'], FILTER_SANITIZE_STRING)));
      $rg = trim(htmlspecialchars(filter_var($_POST['rg'], FILTER_SANITIZE_STRING)));
      $cpf = trim(htmlspecialchars(filter_var($_POST['cpf'], FILTER_SANITIZE_STRING)));
      $data_nasc = $_POST['data_nasc'];
      $telefone = $_POST['telefone'];
      $sexo = $_POST['sexo'];
      $estado_civil = $_POST['estado_civil'];
      $endereco = $_POST['endereco'];
      $bairro = $_POST['bairro'];
      $cep = $_POST['cep'];
      $cidade = $_POST['cidade'];

      $query = mysqli_query($conn, "SELECT * FROM paciente WHERE email = '{$email}' OR rg = '{$rg}' OR cpf = '{$cpf}'");

      $result = mysqli_fetch_array($query);

      if ($result > 0) {
        ?>
          <script>
            alert('Paciente já cadastrado no sistema, reveja os dados!');
          </script>
        <?php

        header('Refresh: 0; cadastro_paciente.php');
        return;
      } else {
        $query = "INSERT INTO paciente
        (nome, email, rg, cpf, data_nasc, telefone, sexo, estado_civil, endereco, bairro, cep, cidade)
        VALUES
        ('{$nome}', '{$email}', '{$rg}', '{$cpf}', '{$data_nasc}', '{$telefone}', '{$sexo}', '{$estado_civil}', '{$endereco}', '{$bairro}', '{$cep}', '{$cidade}')";

        $result = mysqli_query($conn, $query);

        if ($result) {
          ?>
            <script>
              alert('Paciente cadastrado com sucesso no sistema!');
            </script>
          <?php
          header('Refresh: 0; lista_paciente.php');
          return;
        } else {
          ?>
            <script>
              alert('Erro ao cadastrar paciente!');
            </script>
          <?php
          header('Refresh: 0; cadastro_paciente.php');
          return;
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
  <meta name="description" content="Cadastro de Pacientes">
  <meta name="keyword" content="Web System, Odontologic System, Dentist">
  <title>Cadastro de Pacientes</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="images/icons/iconEdent.png"/>
</head>

<body>
  <section id="container">
    <header class="header" style="background-color: #111; border-bottom: #fff 1px solid;">
      <div class="toggle-nav" style="margin-top: 15px;">
        <div class="icon-reorder tooltips" data-original-title="Menu lateral" data-placement="bottom">
        <i class="fas fa-bars" style="color: #fff;"></i>
      </div>
      </div>
      <a class="navbar-brand" href="login.php">
        <img src="images/icons/E-DENT-3.png" class="nav-item" alt="logo" style="width: 90px">
      </a>
    </header>

    <?php
      include('aside.php');
    ?>

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
                  <form class="form-validate form-horizontal" id="register_form" method="POST" action="">
                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="nome" class="control-label col-lg-2">Nome Completo<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class=" form-control" id="nome" name="nome" type="text" placeholder="Digite o Nome" required="required"/>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="email" class="control-label col-lg-2">Email<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" name="email" type="email" placeholder="email@dominio.com"/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="rg" class="control-label col-lg-2">RG<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" onkeypress="$(this).mask('99.999.999-9')" id="rg" name="rg" type="text" placeholder="99.999.999-9" required="required"/>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="cpf" class="control-label col-lg-2">CPF<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" onkeypress="$(this).mask('000.000.000-00');" id="cpf" name="cpf" placeholder="000.000.000-00" type="text" required="required"/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="data_nasc" class="control-label col-lg-2">Data de Nascimento<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class=" form-control" id="data_nasc" name="data_nasc" type="date" required="required" />
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="telefone" class="control-label col-lg-2" >Telefone<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" onkeypress="$(this).mask('(00) 0000-00009')" id="telefone" name="telefone" type="text" placeholder="(99)99999-9999" required="required"/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="sexo" class="control-label col-lg-2">Sexo<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="sexo" class="form-control" required="required">
                            <option value="" selected>Selecionar</option>
                            <option value="f">Feminino</option>
                            <option value ="m">Masculino</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="estado_civil" class="control-label col-lg-2">Estado Civil<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select required="required" name ="estado_civil" class="form-control">
                            <option value="" selected>Selecionar</option>
                            <option value="s">Solteiro</option>
                            <option value="c">Casado</option>
                            <option value="d">Divorciado</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="cep" class="control-label col-lg-2">CEP<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" onkeypress="$(this).mask('00.000-000')" id="cep" name="cep" placeholder="Digite o CEP" type="text" required="required" maxlength="9"/>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="endereco" class="control-label col-lg-2">Endereço Residencial<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" id="endereco" name="endereco" class="form-control" id="endereco" placeholder="Digite o Endereço" type="text" required="required" />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="bairro" class="control-label col-lg-2">Bairro<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" id="bairro" name="bairro" class="form-control" placeholder="Digite o Bairro" type="text" required="required" />
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="cidade" class="control-label col-lg-2">Cidade<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" id="cidade" name="cidade" class="form-control" placeholder="Digite a Cidade" type="text" required="required" />
                        </div>
                      </div>
                    </div>

                    <div class="row" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                      <div>
                        <small class="form-text text">
                          OBS: Antes de encerrar verificar se todos os dados estão corretos.
                        </small>
                      </div>
                      <button class="btn btn-primary" type="submit">Salvar</button>
                    </div>
                  </form>
                </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>


  <script>
    const cepField = $('#cep');
    cepField.keyup(function(e) {
      let value = e.target.value;
      if (!value) {
        return;
      }
      value = value.toString().replace(/[^\d]+/g, '');
      if (value.length > 5) {
        value = `${value.substring(0, 5)}-${value.substring(5,)}`;
      }
      if (value.length === 9 && value.match(/[\d]{5}-[\d]{3}/g)) {
        $.get(`http://viacep.com.br/ws/${value.toString().replace(/[^\d]+/g, '')}/json`, function(data) {
          let body = typeof data === 'string' ? JSON.parse(data) : data;
          if (body.logradouro) {
            $('#endereco').val(body.logradouro);
          }
          if (body.bairro) {
            $('#bairro').val(body.bairro);
          }
          if (body.localidade) {
            $('#cidade').val(body.localidade);
          }
        });
      }
      e.target.value = value;
    });
  </script>
</body>

</html>
