<?php
  include_once('check_session.php');
  include_once('connection.php');

  if (!isset($usuario_tipo) || $usuario_tipo !== 'coordenador') {
    header('HTTP/1.1 302 Found');
    header('Location: index.php');
    return;
  }

  if (!empty($_POST)) {
    if (empty($_POST['idUsuario']) || empty($_POST['nome']) || empty($_POST['email'])
      || empty($_POST['senha']) || empty($_POST['rg']) || empty($_POST['cpf'])
      || empty($_POST['tipo_usuario']) || empty($_POST['data_nasc']) || empty($_POST['telefone'])
      || empty($_POST['sexo']) || empty($_POST['estado_civil']) || empty($_POST['bairro'])
      || empty($_POST['cep']) || empty($_POST['cidade']) || empty($_POST['endereco_residencial'])
      || empty($_POST['confirmar_senha'])) {
      ?>
        <script>
          alert('Todos os campos são obrigatorios!');
        </script>
      <?php
      header('Refresh: 0; lista_usuario.php');
      return;
    } else {
      if ($_POST['senha'] !== $_POST['confirmar_senha']) {
        ?>
          <script>
            alert('Senhas não coincidem!');
          </script>
        <?php
        header('Refresh: 0; lista_usuario.php');
        return;
      }

      $id = $_POST['idUsuario'];
      $data = [
        'nome' => trim(htmlspecialchars(filter_var($_POST['nome'], FILTER_SANITIZE_STRING))),
        'email' => trim(htmlspecialchars(filter_var($_POST['email'], FILTER_SANITIZE_STRING))),
        'senha' => trim(htmlspecialchars(filter_var($_POST['senha'], FILTER_SANITIZE_STRING))),
        'rg' => trim(htmlspecialchars(filter_var($_POST['rg'], FILTER_SANITIZE_STRING))),
        'cpf' => trim(htmlspecialchars(filter_var($_POST['cpf'], FILTER_SANITIZE_STRING))),
        'tipo_usuario' => $_POST['tipo_usuario'],
        'data_nasc' => $_POST['data_nasc'],
        'telefone' => $_POST['telefone'],
        'sexo' => $_POST['sexo'],
        'estado_civil' => $_POST['estado_civil'],
        'cep' => $_POST['cep'],
        'endereco_residencial' => $_POST['endereco_residencial'],
        'bairro' => $_POST['bairro'],
        'cidade' => $_POST['cidade'],
      ];

      $data['senha'] = md5($data['senha']);

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
                  usuario
                SET
                  {$update_fields}
                WHERE
                  idUsuario = {$id}";

      $result = mysqli_query($conn, $query);

      if ($result) {
        ?>
          <script>
            alert('Cadastro do usuario alterado com sucesso no sistema!');
          </script>
        <?php
      } else {
        ?>
          <script>
            alert('Erro ao alterar o cadastro do usuario!');
          </script>
        <?php
      }
      header('Refresh: 0; lista_usuario.php');
      return;
    }
  }

  //Retornar dados do usuário:
  if (empty($_GET['id'])) {
    header('Location: lista_usuario.php');
    return;
  }
  $idU = $_GET['id'];

  $sql = mysqli_query($conn, "SELECT idUsuario, nome, email, senha, rg, cpf, tipo_usuario, data_nasc, telefone, sexo, estado_civil, bairro, cep, cidade, endereco_residencial FROM usuario WHERE idUsuario = $idU");

  $rows = mysqli_num_rows($sql);

  if ($rows == 0) {
    header('Location: lista_usuario.php');
    return;
  } else {
    while ($data = mysqli_fetch_array($sql)) {
      $idUsuario = $data['idUsuario'];
      $nome = $data['nome'];
      $email = $data['email'];
      $senha = $data['senha'];
      $rg = $data['rg'];
      $cpf = $data['cpf'];
      $tipo_usuario = $data['tipo_usuario'];
      $data_nasc = $data['data_nasc'];
      $telefone = $data['telefone'];
      $sexo = $data['sexo'];
      $estado_civil = $data['estado_civil'];
      $bairro = $data['bairro'];
      $cep = $data['cep'];
      $cidade = $data['cidade'];
      $endereco_residencial = $data['endereco_residencial'];
    }
  }

  $genre_options = [
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
  <meta name="description" content="Editar Usuários">
  <meta name="keyword" content="Web System, Odontologic System, Dentist">
  <title>Editar Usuários</title>
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
                CADASTRO USUARIO
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="register_form" method="POST" action="">
                    <input type="hidden" name="idUsuario" value="<?= $idU; ?>">

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="nome" class="control-label col-lg-2">Nome Completo<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class=" form-control" type="text" name="nome" required="required" placeholder="Digite o Nome" value="<?= $nome; ?>"/>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="email" class="control-label col-lg-2">Email<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" name="email" type="email" placeholder="email@dominio.com" value="<?= $email; ?>"/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="rg" class="control-label col-lg-2">RG<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" type="text" name="rg" required="required" placeholder="123456789" value="<?= $rg; ?>"/>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="cpf" class="control-label col-lg-2">CPF<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" type="text" name="cpf" required="required" placeholder="12345678910" value="<?= $cpf; ?>"/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="tipo_usuario" class="control-label col-lg-2">Tipo Usuário<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="tipo_usuario" class="form-control" required="required">
                            <?php
                              if ($tipo_usuario === 'profissional') {
                                ?>
                                  <option value="profissional" selected>Profissional</option>
                                  <option value="coordenador">Coordenador</option>
                                <?php
                              } else {
                                ?>
                                  <option value="profissional">Profissional</option>
                                  <option value="coordenador" selected>Coordenador</option>
                                <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="data_nasc" class="control-label col-lg-2">Data de Nascimento<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" type="date" name="data_nasc" required="required" value="<?= $data_nasc; ?>"/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="telefone" class="control-label col-lg-2">Telefone<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" type="text" name="telefone" required="required" placeholder="(99)99999-9999" value="<?= $telefone; ?>"/>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="sexo" class="control-label col-lg-2">Sexo<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="sexo" class="form-control" required="required">
                            <?php
                              foreach ($genre_options as $option) {
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
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="cep" class="control-label col-lg-2">CEP<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" type="text" name="cep" required="required" placeholder="Digite o CEP" value="<?= $cep; ?>"/>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="estado_civil" class="control-label col-lg-2">Estado Civil<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <select name="estado_civil" class="form-control" required="required">
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
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="endereco_residencial" class="control-label col-lg-2">Endereço Residencial<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control"  type="text" name="endereco_residencial" required="required" placeholder="Digite o Endereço" value="<?= $endereco_residencial; ?>"/>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group"></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="bairro" class="control-label col-lg-2">Bairro<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" type="text" name="bairro" required="required" placeholder="Digite o Bairro" value="<?= $bairro; ?>" />
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="senha" class="control-label col-lg-2">Senha<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" type="password" name="senha" required="required" placeholder="Digite a Senha"/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="cidade" class="control-label col-lg-2">Cidade<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" type="text" name="cidade" required="required" placeholder="Digite a Cidade" value="<?= $cidade; ?>"/>
                        </div>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label for="confirmar_senha" class="control-label col-lg-2">Confirme a Senha<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input class="form-control" type="password" name="confirmar_senha" required="required" placeholder="Confirme a senha"/>
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
