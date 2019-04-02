<html>
	
	
<head>
	<title>Projeto Redes</title>
	
		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>


	<body>
	
	<style>
	body {
		font-family:Helvetica, Arial, sans-serif;
		margin:2%;
	}
	.bloco {
		float:left;
		margin-right:10px;
	}
	</style>

<?php


$id = $_GET['id'];
$servidor = 'localhost:3307';
$usuario = 'root';
$senha = 'p@ssw0rd';
$banco = 'monitor';
// Conecta-se ao banco de dados MySQL
$mysqli = new mysqli($servidor, $usuario, $senha, $banco);
// Caso algo tenha dado errado, exibe uma mensagem de erro
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
?>







<div class="container">
	<h1>Monitor de Redes</h1>
<?php
	


// faz seleção na base de dados dos computadores
$sql = "SELECT `id`, `nome`, `ip` FROM `computadores`";
$query = $mysqli->query($sql);
while ($dados = $query->fetch_array()) {
	
$id = $dados['id'];
$nome = $dados['nome'];
$ip = $dados['ip'];

	
$ping = `ping $ip -n 1 -l 1`;
 
if (preg_match("/bytes=/", $ping)) {
echo 

"
<div class='bloco'>

<img src='online.png' width='20px'> <a href='computador.php?id=$id' target='_blank'>".$nome. "</a> <br />" . "".$ip;

echo "<div style='font-familly:console;font-size:12px; background-color:#eee; padding:5px; width:200px;border:3px solid green;'>";
verificaPortas($ip);

echo "</div><br /></div>";


} else {
echo "
<div class='bloco'>
<img src='offline.png' width='20px'> ".$nome . ": <br />" . "".$ip;

echo "<div style='font-familly:console;font-size:12px; display:block; background-color:#eee; padding:5px; width:200px;border:3px solid green;'>";

verificaPortas($ip);
echo "</div><br /></div>";

}
}

?>

<br />

<?php

function verificaPortas($ip) {
$portas = array(
"HTTP" => "80",
"FTP" => "21",
"SMTP" => "25",
"POP3" => "110"
);
 
foreach ($portas as $nome => $porta) {

$fp = @fsockopen($ip, $porta, $errno, $errstr, 1);
 
if($fp >= 1){
echo $nome . ": ON" . "<br />";
} else {
echo $nome . ": OFF" . "<br />";
}
}
}
?>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	</html>

