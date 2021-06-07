<?php

include_once ("conexao.php");

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

	
	$cadastrar_usuario = "INSERT INTO usuario (nome, sobrenome, cpfUsuario ,apelidoUsuario, email, telefone, genero, dataNascimento, fotoUsuario) 
							VALUES ('$nome', '$sobrenome', '$cpfUsuario', '$apelido', '$email', '$telefone', '$genero', '$data', '$foto_id')";
							
	if (mysqli_query($conn, $cadastrar_usuario)){
		
	echo "USUARIO CADASTRADO COM SUSCESSO";
	}else{
	echo "USUARIO NÃO CADASTRADO" . $foto_id;
		}

mysqli_close($conn);





?>
