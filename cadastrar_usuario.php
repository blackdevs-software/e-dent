<?php
	include_once("conexao.php");

	echo print_r($_POST);

	$nome = $_POST['nome'];
	$tipoUsuario = $_POST['tipoUsuario'];
	$data_nasc = $_POST['data_nasc'];
	$cpf = $_POST['cpf'];
	$rg = $_POST['rg'];
	$telefone = $_POST['telefone'];
	$email = $_POST['email'];
	$sexo = $_POST['sexo'];
	$estado_civil = $_POST['estado_civil'];
	$cep = $_POST['cep'];
	$enderecoResidencial = $_POST['enderecoResidencial'];
	$bairro = $_POST['bairro'];
	$cidade = $_POST['cidade'];
	$senha = $_POST['senha'];
	$confirmar_senha = $_POST['confirmar_senha'];

	$slq_insert_usuario = "insert into usuario (senha, tipoUsuario, nome, data_nasc, telefone, sexo, estado_civil, rg, cpf, bairro, cep, cidade, enderecoResidencial, email, confirmar_senha) values ('$senha', '$tipoUsuario', '$nome', '$data_nasc', '$telefone', '$sexo', '$estado_civil', '$rg', '$cpf', '$bairro', '$cep', '$cidade', '$enderecoResidencial', '$email', '$confirmar_senha')";

	$salvar_usuario = mysqli_query($conexao, $slq_insert_usuario);

	mysqli_close($conexao);
?>
<script>
  alert("Usuario Cadastrado!");
</script>

<?PHP
  header("Refresh: 0; indexCoordenador.html");
?>
