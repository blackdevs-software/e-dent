<?php
	$hostname = !empty(getenv('DB_HOST')) ? getenv('DB_HOST') : '127.0.0.1';
	$user = !empty(getenv('DB_USER')) ? getenv('DB_USER') : 'root';
	$password = !empty(getenv('DB_PASSWORD')) ? getenv('DB_PASSWORD') : 'admin';
	$database = !empty(getenv('DB_DATABASE')) ? getenv('DB_DATABASE') : 'db_odontologia';
	$conn = mysqli_connect($hostname, $user, $password, $database);

	if (!$conn) {
    echo 'Falha na conexão com o banco de dados';
	}
?>