<?php
	include_once('connection.php');

	$queixaPrincipal = $_POST['queixaPrincipal'];
	$historia_doenca_atual = $_POST['historia_doenca_atual'];
	$historia_progressa = $_POST['historia_progressa'];
	$historia_familiar = $_POST['historia_familiar'];
	$historia_pessoal_social = $_POST['historia_pessoal_social'];
	$observacaoHM = $_POST['observacaoHM'];

	$slq_insert_historiaM = "insert into prontuario_historia_medica (queixaPrincipal, historia_doenca_atual, historia_progressa, historia_familiar, historia_pessoal_social, observacaoHM ) values ('$queixaPrincipal', '$historia_doenca_atual', '$historia_progressa', '$historia_familiar', '$historia_pessoal_social', '$observacaoHM')";

	$salvar_historiaM = mysqli_query($conn, $slq_insert_historiaM);

	mysqli_close($conn);
?>
<script>
  alert("História médica cadastrada!");
</script>

<?PHP
  header("Refresh: 0; index.php");
?>
