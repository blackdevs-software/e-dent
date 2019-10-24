<?php

	include_once("conexao.php");

		
	$nome = $_POST['nome'];
	$data_nasc = $_POST['data_nasc'];
	$telefone = $_POST['telefone'];
	$sexo = $_POST['sexo'];
	$estado_civil = $_POST['estado_civil'];
	$rg = $_POST['rg'];
	$cpf = $_POST['cpf'];
	$endereco = $_POST['endereco'];
	$bairro = $_POST['bairro'];
	$cep = $_POST['cep'];
	$cidade = $_POST['cidade'];
	$email = $_POST['email'];



	$slq_insert_paciente = "INSERT INTO paciente (nome, data_nasc, telefone, sexo, estado_civil, rg, cpf, endereco, bairro, cep, cidade, email) VALUES ('$nome', '$data_nasc', '$telefone', '$sexo', '$estado_civil', '$rg', '$cpf', '$endereco', '$bairro', '$cep','$cidade','$email')";

	$salvar_paciente = mysqli_query($conexao, $slq_insert_paciente);



	mysqli_close($conexao);

?>
<script> 

alert("Paciente Cadastrado");
 
</script>

<?PHP
 
header("Refresh: 0; index.html");
 
?>