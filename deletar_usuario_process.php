<?php

session_start();
include_once("conexao.php");

$cpfUsuario =  filter_input(INPUT_POST, 'cpfUsuario', FILTER_SANITIZE_STRING);
$sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);

echo "<h1>tiago</h1>" . $cpfUsuario;


$deletar_usuario_sql = "DELETE FROM usuario WHERE cpfUsuario='$cpfUsuario'";
$deletar_usuario = mysqli_query($conn, $deletar_usuario_sql);

if (mysqli_affected_rows($conn)){
	
	$_SESSION['msg'] = "Usuario Exluido";

	header("Location: http://localhost/projetos/doitsport/editar_usuario.php");
}else{
	echo "Usuario Não Editado";
}


?>