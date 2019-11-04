<?php
	include_once('connection.php');

	$bochecho = $_POST['bochecho'];
	$creme_dental = $_POST['creme_dental'];
	$palito = $_POST['palito'];
	$higiene_lingua = $_POST['higiene_lingua'];
	$fio_dental = $_POST['fio_dental'];
	$observacaoH0 = $_POST['observacaoH0'];

	$slq_insert_higieneO = "insert into prontuario_higiene_oral (bochecho, creme_dental, palito, higiene_lingua, fio_dental, observacaoH0 ) values ('$bochecho','$creme_dental', '$palito', '$higiene_lingua', '$fio_dental', '$observacaoH0')";

	$salvar_higieneO = mysqli_query($conn, $slq_insert_higieneO);

	mysqli_close($conn);
?>

<script>
alert("Prontuario de Higiene Oral Cadastrado!");
</script>

<?PHP
header("Refresh: 0; index.php");
?>
