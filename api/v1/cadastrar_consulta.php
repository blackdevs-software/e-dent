<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Access-Control-Allow-Methods, Authorization');

  include_once('../../check_session.php');
  include_once('../../connection.php');

  if (empty($_POST['paciente']) || empty($_POST['titulo'])
    || empty($_POST['observacao']) || empty($_POST['data_hora'])) {
      echo json_encode(['message' => 'Campos inválidos']);
      return;
  }

  $paciente = intval($_POST['paciente']);
  $titulo = trim(htmlspecialchars(filter_var($_POST['titulo'], FILTER_SANITIZE_STRING)));
  $observacao = trim(htmlspecialchars(filter_var($_POST['observacao'], FILTER_SANITIZE_STRING)));
  $data_hora = date('Y-m-d H:i:s', strtotime($_POST['data_hora']));

  $status = trim(htmlspecialchars(filter_var($_POST['status'], FILTER_SANITIZE_STRING)));
  if (!in_array($status, ['agendada', 'finalizada', 'cancelada'])) {
    echo json_encode(['message' => 'Houve um erro']);
    return;
  }

  // verify if it already exists an appointment
  $query = mysqli_query($conn, "SELECT * FROM consulta where data_hora = '{$data_hora}' AND deleted_at IS NULL");
  $rows = mysqli_num_rows($query);

  if ($rows > 0) {
    echo json_encode(['message' => 'Já existe uma consulta neste horário']);
    return;
  }

  $query = "INSERT INTO
              consulta
            (
              fk_idUsuario,
              fk_idPaciente,
              titulo,
              observacao,
              status,
              data_hora,
              created_at
            )
              VALUES
            (
              {$usuario_id},
              {$paciente},
              '{$titulo}',
              '{$observacao}',
              '{$status}',
              '{$data_hora}',
              NOW()
            )";

  mysqli_query($conn, $query);
  $inserted_id = mysqli_insert_id($conn);

  if (empty($inserted_id)) {
    echo json_encode(['message' => 'Houve um erro']);
    return;
  }

  mysqli_close($conn);

  echo json_encode([
    'message' => 'Cadastrado com sucesso',
    'id' => $inserted_id,
  ]);
?>
