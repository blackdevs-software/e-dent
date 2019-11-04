<?php
	include_once('connection.php');

	$dificuldade_engolir_alimentos = $_POST['dificuldade_engolir_alimentos'];
	$protese_dentadura = $_POST['protese_dentadura'];
	$quanto_tempo_perdeu_dentes = $_POST['quanto_tempo_perdeu_dentes'];
	$adaptado_protese = $_POST['adaptado_protese'];
	$dentes_sensiveis = $_POST['dentes_sensiveis'];
	$gengiva_sangra = $_POST['gengiva_sangra'];
	$mau_halito = $_POST['mau_halito'];
	$toma_cafe_refrigerante = $_POST['toma_cafe_refrigerante'];
	$observacaoPO = $_POST['observacaoPO'];

	$slq_insert_prontuarioO = "insert into prontuario_odontologico (dificuldade_engolir_alimentos, protese_dentadura ,quanto_tempo_perdeu_dentes ,adaptado_protese ,dentes_sensiveis , gengiva_sangra, mau_halito,toma_cafe_refrigerante  ,observacaoPO) values ('$dificuldade_engolir_alimentos','$protese_dentadura', '$quanto_tempo_perdeu_dentes', '$adaptado_protese', '$dentes_sensiveis', '$gengiva_sangra','$mau_halito', '$toma_cafe_refrigerante', '$observacaoPO')";

	$salvar_prontuarioO = mysqli_query($conn, $slq_insert_prontuarioO);

	mysqli_close($conn);
?>

<script>
  alert("Prontuario odontológico cadastrado!");
</script>

<?PHP
  header("Refresh: 0; index.php");
?>