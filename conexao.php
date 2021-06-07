<?php

$servidor = "localhost";
$usuario = "tiagoperez";
$senha = "tiagoperez";
$dbname = "doitdb";

//CRIAR CONECAO COM O BANCO
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

if (!$conn) {
	die("Conexao Falhou: " . mysqli_connect_error());
}else {
	//echo "<div id='bd_connection'><img src='imagens/icon/online.png'></div>";
}
?>