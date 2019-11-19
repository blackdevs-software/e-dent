<?php
include_once('check_session.php');

if (!isset($usuario_tipo) || $usuario_tipo !== 'coordenador') {
  header('HTTP/1.1 302 Found');
  header('Location: index.php');
  return;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Lista de Usuários">
  <meta name="keyword" content="Web System, Odontologic System, Dentist">
  <title>Lista de Usuários</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet"/>
  <link rel="icon" type="image/png" href="images/icons/iconEdent.png"/>
</head>

<body>
  <?php
    include_once('connection.php');

    $search = isset ($_GET['search']) ? $_GET['search'] : '';
    // Sanitize query param
    $search = trim(htmlspecialchars(filter_var($search, FILTER_SANITIZE_STRING)));
  ?>
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
                LISTA USUÁRIOS
              </header>
                <div class="panel-body">
                  <form method="get" action="">
                    <div class="form">
                      <label for="search" class="control-label col-lg-2">Pesquise o usuário: <span class="required">*</span></label>
                      <div class="col-lg-6">
                        <input type="text" name="search" class="form-control" placeholder="Busque pelo titulo, observação" required autofocus value="<?= $search ? $search : ''; ?>">
                      </div>
                      <div class="col-lg-2">
                        <input class="btn btn-primary" type="submit">
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
                            <th style="text-align: center;">Nome</th>
                            <th style="text-align: center;">Tipo Usuario</th>
                            <th style="text-align: center;">Nascimento</th>
                            <th style="text-align: center;">RG</th>
                            <th style="text-align: center;">CPF</th>
                            <th style="text-align: center;">Telefone</th>
                            <th style="text-align: center;">Ações</th>
                          </tr>

                          <?php
                            // Build query
                            $fields = "idUsuario,
                                        nome,
                                        tipo_usuario,
                                        date_format(data_nasc, '%d/%m/%Y') as data_nasc,
                                        rg,
                                        cpf,
                                        telefone";

                            $where_search = "WHERE
                                              nome LIKE '%{$search}%' OR
                                              cpf LIKE '%{$search}%' OR
                                              rg LIKE '%{$search}%'";

                            // If there is a search in query param, use it
                            $where = $search ? $where_search : '';

                            $sql_search = "SELECT {$fields} FROM usuario {$where} LIMIT 50";

                            $result = mysqli_query($conn, $sql_search);

                            if ($result) {
                              while ($data = mysqli_fetch_array($result)) {
                                ?>
                                  <tr>
                                    <td style="text-align: center;"><?= $data['nome']; ?></td>
                                    <td style="text-align: center;"><?= $data['tipo_usuario']; ?></td>
                                    <td style="text-align: center;"><?= $data['data_nasc']; ?></td>
                                    <td style="text-align: center;"><?= $data['rg']; ?></td>
                                    <td style="text-align: center;"><?= $data['cpf']; ?></td>
                                    <td style="text-align: center;"><?= $data['telefone']; ?></td>
                                    <td style="text-align: center;">
                                      <a class="btn btn-sm btn-primary" href="editar_usuario.php?id=<?= $data['idUsuario']; ?>">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                      <a class="btn btn-sm btn-danger" href="deletar_usuario.php?id=<?= $data['idUsuario']; ?>">
                                        <i class="fas fa-trash"></i>
                                      </a>
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
