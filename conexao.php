<?php

	$hostname = "127.0.0.1";
	$user = "root";
	$password = "";
	$database = "db_odontologia";
	$conexao = mysqli_connect($hostname, $user, $password, $database);

	if(!$conexao){

		echo "Falha na conexão com o banco de dados";
		
	}


?>