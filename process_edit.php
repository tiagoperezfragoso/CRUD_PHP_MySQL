<?php
session_start();
include_once("conexao.php");

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
$cpfUsuario =  filter_input(INPUT_POST, 'cpfUsuario', FILTER_SANITIZE_STRING);
$apelido =  filter_input(INPUT_POST, 'apelido', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
$genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING);
$dataNascimento = filter_input(INPUT_POST, 'dataNacimento', FILTER_SANITIZE_STRING);;
$data=date("Y-m-d", strtotime($dataNascimento));
$foto_id= "0";

if (isset($_FILES['foto_cadastro'])) {
				$formatos_permitidos = array("png", "jpg", "jpeg", "gif");
				$extensao = strtolower(pathinfo($_FILES['foto_cadastro']['name'], PATHINFO_EXTENSION));
				
				if(in_array($extensao, $formatos_permitidos)):
					$pasta = "upload/";
					$temporario = $_FILES['foto_cadastro']['tmp_name'];
					$novo_nome = uniqid().".$extensao";
						
					if(move_uploaded_file($temporario, $pasta.$novo_nome))
						$mensagem = "Upload feito com sucesso";
						$foto_id = $pasta.$novo_nome;
					else:
						$mensagem = "Erro, não foi possível fazer o upload";
					endif;
			}else{				
					$mensagem = "Formato Inválido";
			}
				
				echo $mensagem;

$editar_usuario_sql = "UPDATE usuario SET nome='$nome', sobrenome='$sobrenome', email='$email', telefone='$telefone', genero='$genero', dataNascimento='$data', fotoUsuario='$foto_id' WHERE cpfUsuario='$cpfUsuario'";
	$editar_usuario= mysqli_query($conn, $editar_usuario_sql);

if (mysqli_affected_rows($conn)){
	
	$_SESSION['msg'] = "Usuario editado com sucesso";

	header("Location: http://localhost/projetos/doitsport/editar_usuario.php");
}else{
	echo "Usuario Não Editado";
}

mysqli_close($conn);




?>