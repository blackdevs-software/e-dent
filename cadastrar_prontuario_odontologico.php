<?php
  include_once('connection.php');

  $paciente = $_POST['paciente'];
  $dificuldade_engolir_alimentos = $_POST['dificuldade_engolir_alimentos'];
  $protese_dentadura = $_POST['protese_dentadura'];
  $quanto_tempo_perdeu_dentes = $_POST['quanto_tempo_perdeu_dentes'];
  $adaptado_protese = $_POST['adaptado_protese'];
  $dentes_sensiveis = $_POST['dentes_sensiveis'];
  $gengiva_sangra = $_POST['gengiva_sangra'];
  $mau_halito = $_POST['mau_halito'];
  $toma_cafe_refrigerante = $_POST['toma_cafe_refrigerante'];
  $observacao = $_POST['observacao'];

  $query = "insert into prontuario_odontologico (dificuldade_engolir_alimentos, protese_dentadura, quanto_tempo_perdeu_dentes, adaptado_protese, dentes_sensiveis, gengiva_sangra, mau_halito,toma_cafe_refrigerante, observacao)
  values
  ('{$dificuldade_engolir_alimentos}', '{$protese_dentadura}', '{$quanto_tempo_perdeu_dentes}', '{$adaptado_protese}', '{$dentes_sensiveis}', '{$gengiva_sangra}', '{$mau_halito}', '{$toma_cafe_refrigerante}', '{$observacao}')";

  $salvar_prontuario = mysqli_query($conn, $query);

  $inserted_id = mysqli_insert_id($conn);

  if (empty($inserted_id)) {
    ?>
      <script>
        alert("Houve um erro ao cadastrar!");
      </script>
    <?php
  }

  $query = "insert into paciente_prontuario_odontologico (fk_idUsuario, fk_idPaciente, fk_idProntuarioOdontologico)
  values
  (1, {$paciente}, {$inserted_id});";

  $salvar_relacao = mysqli_query($conn, $query);

  mysqli_close($conn);
?>

<script>
  alert("Prontuario odontológico cadastrado!");
</script>

<?PHP
  header("Refresh: 0; index.php");
?>