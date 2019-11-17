<?php
include_once('check_session.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Lista de Pacientes">
  <meta name="keyword" content="Web System, Odontologic System, Dentist">
  <title>Lista de Pacientes</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="images/icons/iconEdent.png"/>
</head>

<body>
  <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/db/connection.php');

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
                LISTA PACIENTES
              </header>
              <div class="panel-body">
                  <form method="get" action="">
                  <div>
                    <label for="" class="control-label col-lg-2">Pesquise o Paciente: <span class="required">*</span></label>
                      <div class="col-lg-6">
                        <input type="text" name="search" class="form-control" placeholder="Busque pelo nome, RG ou CPF" required autofocus value="<?= $search ? $search : ''; ?>">
                        <br>
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
                          <th style="text-align: center;">Email</th>
                          <th style="text-align: center;">RG</th>
                          <th style="text-align: center;">CPF</th>
                          <th style="text-align: center;">Nascimento</th>
                          <th style="text-align: center;">Telefone</th>
                          <th style="text-align: center;">Prontuários</th>
                          <th style="text-align: center;">Ações</th>
                        </tr>
                        <?php
                          // Build query
                          $fields = "pac.idPaciente,
                                      pac.nome,
                                      date_format(pac.data_nasc, '%d/%m/%Y') as data_nasc,
                                      pac.email,
                                      pac.rg,
                                      pac.cpf,
                                      pac.telefone";

                          $where_search = "WHERE
                                            pac.nome LIKE '%{$search}%' OR
                                            pac.cpf LIKE '%{$search}%' OR
                                            pac.rg LIKE '%{$search}%'";

                          // If there is a search in query param, use it
                          $where = $search ? $where_search : '';

                          $query = "SELECT
                                    {$fields},
                                    group_concat(distinct ppho.fk_idProntuarioHigieneOral) as idsProntuariosPPHO,
                                    group_concat(distinct pphm.fk_idProntuarioHistoriaMedica) as idsProntuariosPPHM,
                                    group_concat(distinct ppo.fk_idProntuarioOdontologico) as idsProntuariosPPO
                                  FROM
                                    paciente pac
                                  LEFT JOIN paciente_prontuario_higiene_oral ppho ON
                                    ppho.fk_idPaciente = pac.idPaciente
                                  LEFT JOIN paciente_prontuario_historia_medica pphm ON
                                    pphm.fk_idPaciente = pac.idPaciente
                                  LEFT JOIN paciente_prontuario_odontologico ppo ON
                                    ppo.fk_idPaciente = pac.idPaciente
                                  {$where}
                                  GROUP BY pac.idPaciente
                                  LIMIT 50";

                          $result = mysqli_query($conn, $query);

                          if ($result) {
                            while ($data = mysqli_fetch_array($result)) {
                              $prontuariosHO = []; // higiente oral
                              $prontuariosHM = []; // historia medica
                              $prontuariosO = []; // odontologico

                              if (!empty($data['idsProntuariosPPHO'])) {
                                $prontuariosHO = explode(',', $data['idsProntuariosPPHO']);
                              }
                              if (!empty($data['idsProntuariosPPHM'])) {
                                $prontuariosHM = explode(',', $data['idsProntuariosPPHM']);
                              }
                              if (!empty($data['idsProntuariosPPO'])) {
                                $prontuariosO = explode(',', $data['idsProntuariosPPO']);
                              }
                              ?>
                                <tr>
                                  <td style="text-align: center;"><?= $data['nome']; ?></td>
                                  <td style="text-align: center;"><?= $data['email']; ?></td>
                                  <td style="text-align: center;"><?= $data['rg']; ?></td>
                                  <td style="text-align: center;"><?= $data['cpf']; ?></td>
                                  <td style="text-align: center;"><?= $data['data_nasc']; ?></td>
                                  <td style="text-align: center;"><?= $data['telefone']; ?></td>
                                  <td style="text-align: center;">
                                    <span
                                      style="cursor: pointer; color: #007aff;"
                                      onclick="document.querySelector('#tr-prontuario-paciente-<?= $data['idPaciente']; ?>').style.display =
                                        document.querySelector('#tr-prontuario-paciente-<?= $data['idPaciente']; ?>').style.display == 'contents' ?
                                        'none' : 'contents' ;"
                                    >
                                      Ver prontuários <i class="fas fa-eye"></i>
                                    </span>
                                  </td>
                                  <td style="text-align: center;">
                                    <a class="btn btn-sm btn-primary" href="editar_paciente.php?id=<?= $data['idPaciente']; ?>">
                                      <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger" href="deletar_paciente.php?id=<?= $data['idPaciente']; ?>">
                                      <i class="fas fa-trash"></i>
                                    </a>
                                  </td>
                                </tr>

                                <tr
                                  id="tr-prontuario-paciente-<?= $data['idPaciente']; ?>"
                                  style="display: none; min-height: 40px;"
                                >
                                  <?php
                                    if (!empty($prontuariosHO) || !empty($prontuariosHM) || !empty($prontuariosO)) {
                                      ?>
                                        <td style="min-height: 40px; width: 100%;" colspan="8">

                                          <?php
                                            // higiene oral
                                            if (!empty($prontuariosHO)) {
                                              foreach ($prontuariosHO as $prontuarioHO) {
                                                ?>
                                                  <a
                                                    style="display: block; margin: 10px auto;"
                                                    href="editar_prontuario_higiene_oral.php?id=<?= $prontuarioHO; ?>"
                                                  >
                                                    Prontuario Higiente Oral - <?= $prontuarioHO ?>
                                                    <i class="fas fa-edit"></i>
                                                  </a>
                                                <?php
                                              }
                                            }
                                          ?>

                                          <?php
                                            // historia medica
                                            if (!empty($prontuariosHM)) {
                                              foreach ($prontuariosHM as $prontuarioHM) {
                                                ?>
                                                  <a
                                                    style="display: block; margin: 10px auto;"
                                                    href="editar_prontuario_historia_medica.php?id=<?= $prontuarioHM; ?>"
                                                  >
                                                    Prontuario História Médica - <?= $prontuarioHM ?>
                                                    <i class="fas fa-edit"></i>
                                                  </a>
                                                <?php
                                              }
                                            }
                                          ?>

                                          <?php
                                            // odontologico
                                            if (!empty($prontuariosO)) {
                                              foreach ($prontuariosO as $prontuarioO) {
                                                ?>
                                                  <a
                                                    style="display: block; margin: 10px auto;"
                                                    href="editar_prontuario_odontologico.php?id=<?= $prontuarioO; ?>"
                                                  >
                                                    Prontuario Odontologico - <?= $prontuarioO ?>
                                                    <i class="fas fa-edit"></i>
                                                  </a>
                                                <?php
                                              }
                                            }
                                          ?>

                                        </td>
                                      <?php
                                    } else {
                                      ?>
                                        <td style="height: 40px; min-height: 40px; width: 100%;" colspan="8">
                                          Nenhum prontuário cadastrado
                                        </td>
                                      <?php
                                    }
                                  ?>
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
