<?php
  include_once('connection.php');

  $paciente = $_POST['paciente'];
  $queixa_principal = $_POST['queixa_principal'];
  $historia_doenca_atual = $_POST['historia_doenca_atual'];
  $historia_progressa = $_POST['historia_progressa'];
  $historia_familiar = $_POST['historia_familiar'];
  $historia_pessoal_social = $_POST['historia_pessoal_social'];
  $observacao = $_POST['observacao'];

  $query = "insert into prontuario_historia_medica (queixa_principal, historia_doenca_atual, historia_progressa, historia_familiar, historia_pessoal_social, observacao)
  values
  ('{$queixa_principal}', '{$historia_doenca_atual}', '{$historia_progressa}', '{$historia_familiar}', '{$historia_pessoal_social}', '{$observacao}')";

  $salvar_prontuario = mysqli_query($conn, $query);

  $inserted_id = mysqli_insert_id($conn);

  if (empty($inserted_id)) {
    ?>
      <script>
        alert('Houve um erro ao cadastrar!');
      </script>
    <?php
    header('Refresh: 0; prontuario_historia_medica.php');
    return;
  }

  $query = "insert into paciente_prontuario_historia_medica (fk_idUsuario, fk_idPaciente, fk_idHistoriaMedica)
  values
  (1, {$paciente}, {$inserted_id});";

  $salvar_relacao = mysqli_query($conn, $query);

  $inserted_id = mysqli_insert_id($conn);

  if (empty($inserted_id)) {
    ?>
      <script>
        alert('Houve um erro ao cadastrar!');
      </script>
    <?php
    header('Refresh: 0; prontuario_historia_medica.php');
    return;
  }

  mysqli_close($conn);
?>

<script>
  alert('Prontuario de História Médica cadastrada!');
</script>

<?PHP
  header('Refresh: 0; prontuario_historia_medica.php');
?>
