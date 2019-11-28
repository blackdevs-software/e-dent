<?php
	$hostname = !empty(getenv('MYSQL_HOST')) ? getenv('MYSQL_HOST') : '127.0.0.1';
	$username = !empty(getenv('MYSQL_USER')) ? getenv('MYSQL_USER') : 'root';
	$password = !empty(getenv('MYSQL_PASSWORD')) ? getenv('MYSQL_PASSWORD') : 'admin';
	$database = !empty(getenv('MYSQL_DATABASE')) ? getenv('MYSQL_DATABASE') : 'db_odontologia';
	$conn = mysqli_connect($hostname, $username, $password, $database);

  if (!$conn) {
    echo 'Error: Unable to connect to MySQL.' . PHP_EOL;
    echo 'Debugging errno: ' . mysqli_connect_errno() . PHP_EOL;
    echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
    die();
  }
?>