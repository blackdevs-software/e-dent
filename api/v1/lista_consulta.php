<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Access-Control-Allow-Methods, Authorization');

  include_once($_SERVER['DOCUMENT_ROOT'] . '/check_session.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/db/connection.php');

  $query = mysqli_query($conn, "SELECT * FROM consulta");
  $rows = mysqli_num_rows($query);

  if ($rows == 0) {
    echo json_encode([]);
    return;
  }

  $result = [];
  while ($data = mysqli_fetch_array($query)) {
    // mapping fields from database to FullCalendar format
    $entry = [
      'id' => $data['idConsulta'],
      'title' => $data['titulo'],
      'start' => $data['data_hora'],
      'end' => $data['data_hora'],
    ];
    $result[] = $entry;
  }

  echo json_encode($result);

  mysqli_close($conn);
?>
