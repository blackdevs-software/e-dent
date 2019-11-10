<?php
  include_once('connection.php');

	if (!empty($_POST)) {
    if (empty($_POST['idPaciente']) || empty($_POST['nome']) || empty($_POST['data_nasc'])
      || empty($_POST['telefone']) || empty($_POST['sexo']) || empty($_POST['estado_civil'])
      || empty($_POST['rg']) || empty($_POST['cpf']) || empty($_POST['endereco'])
      || empty($_POST['bairro']) || empty($_POST['cep']) || empty($_POST['cidade'])
      || empty($_POST['email'])) {
      echo 'Todos os campos são obrigatorios';
		} else {
      $id = $_POST['idPaciente'];
      $data = [
        'nome' => $_POST['nome'],
        'data_nasc' => $_POST['data_nasc'],
        'telefone' => $_POST['telefone'],
        'sexo' => $_POST['sexo'],
        'estado_civil' => $_POST['estado_civil'],
        'rg' => $_POST['rg'],
        'cpf' => $_POST['cpf'],
        'endereco' => $_POST['endereco'],
        'bairro' => $_POST['bairro'],
        'cep' => $_POST['cep'],
        'cidade' => $_POST['cidade'],
        'email' => $_POST['email'],
      ];

      $update_fields = [];

      $update_fields = array_map(function($key, $value) {
        $value = trim(htmlspecialchars(filter_var($value, FILTER_SANITIZE_STRING)));
        if (preg_match("/[^0-9]+/", $value)) {
          $value="'{$value}'";
        }
        return "{$key} = {$value}";
      }, array_keys($data), $data);

      $update_fields = implode(', ', $update_fields);

      $query = "UPDATE
                  paciente
                SET
                  {$update_fields}
                WHERE
                  idPaciente = {$id}";

      $result = mysqli_query($conn, $query);

      if ($result) {
        ?>
          <script>
            alert('Cadastro alterado com sucesso!');
          </script>
        <?php
      } else {
        ?>
          <script>
            alert('Erro ao alterar o cadastro!');
          </script>
        <?php
      }
      header('Refresh: 0; lista_paciente.php');
      return;
		}
	}

  if (empty($_GET['id'])) {
    header('Location: lista_paciente.php');
  }
  $idP = $_GET['id'];

  $sql = mysqli_query($conn, "SELECT idPaciente, nome, data_nasc, telefone, sexo, estado_civil, rg, cpf, endereco, bairro, cep, cidade, email FROM paciente WHERE idPaciente = {$idP} ");

  $result_sql = mysqli_num_rows($sql);

  if ($result_sql == 0) {
    header('Location: lista_usuario.php');
  } else {
    while ($data = mysqli_fetch_array($sql)) {
      $idPaciente = $data['idPaciente'];
      $nome = $data['nome'];
      $data_nasc = $data['data_nasc'];
      $telefone = $data['telefone'];
      $sexo = $data['sexo'];
      $estado_civil = $data['estado_civil'];
      $rg = $data['rg'];
      $cpf = $data['cpf'];
      $endereco = $data['endereco'];
      $bairro = $data['bairro'];
      $cep = $data['cep'];
      $cidade = $data['cidade'];
      $email = $data['email'];
    }
  }

  $genres_options = [
    [ 'name' => 'Feminino', 'value' => 'f' ],
    [ 'name' => 'Masculino', 'value' => 'm' ],
  ];

  $marital_state_options = [
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
  <meta name="description" content="Editar Pacientes">
  <meta name="keyword" content="Web System, Odontologic System, Dentist">
  <title>Editar Pacientes</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/main.css">
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
                EDITAR CADASTRO DE PACIENTE
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="register_form" method="post" action="">
                    <input type="hidden" name="idPaciente" value="<?= $idP; ?>">
                    <div class="form-group">
                      <label for="nome" class="control-label col-lg-2">Nome Completo<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="nome" placeholder="Digite o Nome" required="required" value="<?= $nome; ?>"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="data_nasc" class="control-label col-lg-2">Data de Nascimento<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class=" form-control"  type="date"  name="data_nasc"required="required" value="<?= $data_nasc; ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="cpf" class="control-label col-lg-2">CPF<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="cpf" placeholder="12345678910" value="<?= $cpf; ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="rg" class="control-label col-lg-2">RG<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" name="rg" type="text" placeholder="123456789" value="<?= $rg; ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="telefone" class="control-label col-lg-2">Telefone<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" name="telefone" type="text" placeholder="(99)99999-9999" value="<?= $telefone; ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="control-label col-lg-2">Email<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" name="email" type="email" placeholder="email@dominio.com" value="<?= $email; ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="sexo" class="control-label col-lg-2">Sexo<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="sexo" class="form-control" required="required">
                            <?php
                              foreach ($genres_options as $option) {
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
                    <div class="form-group">
                      <label for="estado_civil" class="control-label col-lg-2">Estado Civil<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select class="form-control" name="estado_civil" required="required">
                            <?php
                              foreach ($marital_state_options as $option) {
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
                        <input class="form-control"  type="text" name="cep" placeholder="Digite o CEP" value="<?= $cep; ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="endereco" class="control-label col-lg-2">Endereço Residencial<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="endereco" placeholder="Digite o Endereço" value="<?= $endereco; ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="bairro" class="control-label col-lg-2">Bairro<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="bairro" placeholder="Digite o Bairro" value="<?= $bairro; ?>"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="cidade" class="control-label col-lg-2">Cidade<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" name="cidade" placeholder="Digite a Cidade" value="<?= $cidade; ?>"/>
                      </div>
                    </div>
                    <center>
                      <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                          <button class="btn btn-primary" type="submit">Salvar</button>
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
