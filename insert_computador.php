<?php
	
	$servidor = 'localhost:3307';
	$usuario = 'root';
	$senha = 'p@ssw0rd';
	$banco = 'monitor';
	// Conecta-se ao banco de dados MySQL
	$mysqli = new mysqli($servidor, $usuario, $senha, $banco);
	// Caso algo tenha dado errado, exibe uma mensagem de erro
	if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
	
	$nome = $_POST['nome'];
	$ip = $_POST['ip'];
	
	$sql = "insert into computadores (nome, ip) values ('$nome', '$ip')";
	$query = $mysqli->query($sql);
	header("location:index.php");

?>