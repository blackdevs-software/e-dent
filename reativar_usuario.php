<?php
  include_once('check_session.php');
  include_once('connection.php');

  $id = intval($_GET['id']);
  if (empty($id)) {
    header('Refresh: 0; lista_usuario.php');
    return;
  }

  $query = "UPDATE usuario SET deleted_at = NULL WHERE idUsuario = {$id}";

  $result = mysqli_query($conn, $query);

  if (empty($result)) {
    header('Refresh: 0; lista_usuario.php');
    return;
  }

  mysqli_close($conn);
  header('Refresh: 0; lista_usuario.php');
?>
