<!DOCTYPE html>
<?php

$servidor = "localhost";
$usuario = "tiagoperez";
$senha = "tiagoperez";
$dbname = "doitdb";

//CRIAR CONECAO COM O BANCO
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
?>
<?php
				$qtd_itens = filter_input(INPUT_POST, 'qtd_itens', FILTER_SANITIZE_STRING);

				$qnt_result_pg = $qtd_itens;

				//Receber o numero da pagina
				$pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
				
				$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

				//calcular o inicio da visualização
				$inicio_pag = ($qnt_result_pg * $pagina) - $qnt_result_pg;

				//Quantidade de registros
				
						$sql_count = "SELECT * FROM usuario";
						$result = mysqli_query($conn, $sql_count);
						$row = mysqli_num_rows($result);

				if ($qnt_result_pg == 0){

					$qnt_result_pg = 5;

				//consultar no banco de dados
				$result_usuario = "SELECT * FROM usuario LIMIT $inicio_pag, $qnt_result_pg";
				$resultado_usuario = mysqli_query($conn, $result_usuario);


				}else
				if ($qtd_itens == "5") {

 						$qnt_result_pg = $qtd_itens;

				}else if ($qtd_itens== "10"){


					$qnt_result_pg = $qtd_itens;

				}else

					$qnt_result_pg = $qtd_itens;

					//consultar no banco de dados
				$result_usuario = "SELECT * FROM usuario LIMIT $inicio_pag, $qnt_result_pg";
				$resultado_usuario = mysqli_query($conn, $result_usuario);
				
?>
<html lang="pt-br">
  <head>
    <title>Home</title>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<style type="text/css"></style>
  </head>
  <body>
    <header class="cabecalho">
		<div>
			<?php
				//Verificar se o banco de dados está funcionando, caso sim mostrar icone verde
				if (!$conn) {
					die("Conexao Falhou: " . mysqli_connect_error());
					}else {
					echo "<div id='bd_connection'><img src='imagens/icon/online.png'></div>";
					}
			?>
		</div>
		<div id="usuario">
			<img src="imagens/icons_1/user-3.png">
			<ul>
				<li><a href="#">NOME USUARIO</a>
					<ul>
						<li><a href="#">EDITAR PERFIL</a></li>
						<li><a href="#">PLANOS</a></li>
						<li><a href="#">SAIR</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</header>
	<nav class="menu">
		<ul>
			<li><a href="cadastrar_usuario.html">CADASTRAR USUARIO</a></li>
			<li><a href="pesquisar_usuarios.php">USUÁRIOS CADASTRADOS</a></li>
			<li><a href="upload.php">RANCKING</a></li>			
		</ul>
	</nav>
	<section>
		<form class="qtd_item" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label>Quantidades de Itens</label>
			<select name="qtd_itens">
				<option value=5 selected=5>5</option>
				<option value=10>10</option>
				<option value=15>15</option>
			</select>
			<input type="submit" value="OK"></input>
			<h4>Quantidade de usuários cadastrados: <?php echo $row ?></h4>		
		</form>
		
		<div>
			<table class="tabela_cliente">
					<tr id="topo_lista">
						<td><b>FOTO</b></td>
						<td><b>CPF USUARIO</b></td>
						<td><b>NOME</b></td>
						<td><b>SOBRENOME</b></td>
						<td><b>NICKNAME</b></td>
						<td><b>DATA DE NASCIMENTO</b></td>
						<td><b>EMAIL</b></td>
						<td><b>TELEFONE</b></td>
						<td><b>GENERO</b></td>
						<td><b>AÇÕES</b></td>
					</tr>
					<tr>
					<?php while ($dados = mysqli_fetch_assoc($resultado_usuario)) { ?>
							<td><?php echo "<img id='foto_lista' src='" . $dados['fotoUsuario'] . "'>"; ?></td>
							<td><?php echo $dados['cpfUsuario']; ?></td>
							<td><?php echo $dados['nome']; ?></td>
							<td><?php echo $dados['sobrenome']; ?></td>
							<td><?php echo $dados['apelidoUsuario']; ?></td>
							<td><?php echo $dados['dataNascimento']; ?></td>
							<td><?php echo $dados['email']; ?></td>
							<td><?php echo $dados['telefone']; ?></td>
							<td><?php echo $dados['genero']; ?></td>
							<td><?php echo "<a class='botao_editar' href='editar_usuario.php?cpfUsuario=" . $dados['cpfUsuario'] . "'>Editar</a>" ?></br>
							<?php echo "<a class='botao_editar' href='deletar_usuario.php?cpfUsuario=" . $dados['cpfUsuario'] . "'>Excluir</a>" ?></td>
					</tr>
					<?php 				
					
					} ?>

			</table>
		</div>
		
		
	</section>
	<aside>
	</aside>
	<footer>
	</footer>
  </body>
</html>