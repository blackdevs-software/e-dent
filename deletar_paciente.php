<?php
  include_once('check_session.php');
  include_once('connection.php');

  $id = intval($_GET['id']);
  if (empty($id)) {
    header('Refresh: 0; lista_paciente.php');
    return;
  }

  $query = "UPDATE paciente SET deleted_at = current_timestamp WHERE idPaciente = {$id}";

  $result = mysqli_query($conn, $query);

  if (empty($result)) {
    ?>
      <script>
        alert('Houve um erro!');
      </script>
    <?php
    header('Refresh: 0; lista_paciente.php');
    return;
  }

  ?>
    <script>
      alert('Deletado com sucesso!');
    </script>
  <?php
  header('Refresh: 0; lista_paciente.php');

  mysqli_close($conn);
?>
