<?php
  include_once('check_session.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/db/connection.php');

  $id = $_GET['id'];

  if (empty($id)) {
    header('Refresh: 0; lista_usuario.php');
    return;
  }

  $query = "DELETE FROM usuario WHERE idUsuario = {$id}";

  $result = mysqli_query($conn, $query);

  if (empty($result)) {
    ?>
      <script>
        alert('Houve um erro!');
      </script>
    <?php
    header('Refresh: 0; lista_usuario.php');
    return;
  }

  ?>
    <script>
      alert('Deletado com sucesso!');
    </script>
  <?php
  header('Refresh: 0; lista_usuario.php');

  mysqli_close($conn);
?>
