<html>
	<head>
		<title></title>title?</title>
	</head>

	<body>
		<?php

			if (isset($_FILES['foto_cadastro'])) {
				$formatos_permitidos = array("png", "jpg", "jpeg", "gif");
				$extensao = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
				
				if(in_array($extensao, $formatos_permitidos)):
					$pasta = "upload/";
					$temporario = $_FILES['arquivo']['tmp_name'];
					$novo_nome = uniqid().".$extensao";
						
					if(move_uploaded_file($temporario, $pasta.$novo_nome))
						$mensagem = "Upload feito com sucesso";
					else
						$mensagem = "Erro, não foi possível fazer o upload";
					endif;
			}else{				
					$mensagem = "Formato Inválido";
			}
				
				echo $mensagem;
			

		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
			<input type="file" name="arquivo"></input>
			<input type="submit" name="foto_cadastro"></input>
		</form>
	</body>

</html>



<?php
 				if ($qtd_itens == "5") {

 						$qnt_result_pg = $qtd_itens;

				}else if ($qtd_itens== "10"){


					$qnt_result_pg = $qtd_itens;

				}else

					$qnt_result_pg = $qtd_itens;
				
				//Quantidade de registros
				
						$sql_count = "SELECT * FROM usuario";
						$result = mysqli_query($conn, $sql_count);
						$row = mysqli_num_rows($result);
				
				
				//consultar no banco de dados
				$result_usuario = "SELECT * FROM usuario LIMIT $inicio_pag, $qnt_result_pg";
				$resultado_usuario = mysqli_query($conn, $result_usuario);

?>
