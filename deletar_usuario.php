<!DOCTYPE html>
<?php
session_start();
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

$cpfUsuario = filter_input(INPUT_GET, 'cpfUsuario', FILTER_SANITIZE_STRING);


$result_usuario = "SELECT * FROM usuario WHERE cpfUsuario = '$cpfUsuario'";
$resultado_usuario = mysqli_query($conn, $result_usuario);

$row_usuario = mysqli_fetch_assoc($resultado_usuario);

?>
<html lang="pt-br">
  <head>
    <title>Editar Usuario</title>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<style type="text/css"></style>
  </head>
  <body>
    <header class="cabecalho">
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
		<form method="POST" action="deletar_usuario_process.php" enctype="multipart/form-data">
			<fieldset class="grupo">
				<?php
						if (isset($_SESSION['msg'])){
								echo "<div class='mensagem'>" . $_SESSION['msg'] . "</div>";
								unset ($_SESSION['msg']);
								}
				?>
				<div>
					<label for="nome"><strong>Nome</strong></label> <br>
					<input type="text" name="nome" id="nome" value="<?php echo $row_usuario['nome']; ?>">
				</div>
				<div>
					<label for="sobrenome"><strong>Sobrenome</strong></label><br>
					<input type="text" name="sobrenome" id="sobrenome" required value="<?php echo $row_usuario['sobrenome']; ?>">
				</div>
				<div>
					<label for="sobrenome"><strong>CPF</strong></label><br>
					<input type="text" name="cpfUsuario" id="cpfUsuario" required value="<?php echo $row_usuario['cpfUsuario']; ?>">
				</div>
				<div>
					<label for="nome"><strong>Apelido no DoIT!</strong></label> <br>
					<input type="text" name="apelido" id="apelido" disabled='disabled' required value="<?php echo $row_usuario['apelidoUsuario']; ?>">
				</div>
				<div>
					<label for="email"><strong>Email</strong></label><br>
					<input type="email" name="email" id="email" required value="<?php echo $row_usuario['email']; ?>">
				</div>
				<div>
					<label for="telefone"><strong>Telefone</strong></label><br>
					<input type="text" name="telefone" id="telefone" required value="<?php echo $row_usuario['telefone']; ?>">
				</div>
				<div>
					<label for="genero"><strong>Genero</strong></label><br>
					<select id="genero" name="genero" value="<?php echo $row_usuario['genero']; ?>">
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
						<option value="N">Prefiro não informar</option>
					</select>
				</div>
				<div>
					<label for="datanascimento"><strong>Data de Nascimento</strong></label><br>
					<input type="date" name="dataNascimento" id="dataNascimento" value="<?php echo $row_usuario['dataNascimento']; ?>">
				</div>	
				<button class="botao" type="submit">Excluir</button>
				<a class="botao_cancelar" href="pesquisar_usuarios.php">Cancelar</a>			
			</fieldset>
			<div class="foto_identificacao_editar" method="post">
					<?php echo "<img id='foto_lista_editar' src='" . $row_usuario['fotoUsuario'] . "'></br>"; ?>
					<label>Foto:</label>
					<input type="file" name="foto_cadastro"></input>
			</div>
		</form>
	</section>
	<aside>
	</aside>
	<footer>
	</footer>
  </body>
</html>