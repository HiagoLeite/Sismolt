<?php 
	require_once ('navBar.php');
	require_once ('footer.php');

	$erroCad= isset($_GET['erro_cadastro'])	? $_GET['erro_cadastro'] : 0;
	$erroSenha= isset($_GET['erro_senha']) ? $_GET['erro_senha']	: 0;
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- JS -->
	<script src="js/scripts.js" defer></script>

	<title>cadastrar|Sismolt</title>

</head>

<body>

	<div class="tamanhoArea">
		<section id="cadastro" >
			<form method="POST" action="php/registrar.php">
				<h3>Cadastrar </h3>
				<br/>

				<label class="lblMsg">Nome:</label>
				<input class="formTexto" type="text" placeholder="Digite seu nome" name="registraNome"  required="requiored">
				<br/><br/>
				
				<label class="lblMsg">Email:</label>
				<input class="formTexto" type="text" placeholder="Digite seu email" name="regitraEmail"  required="requiored">
				<br/><br/>
				
				<label class="lblMsg">Cep:</label>
				<input class="formTexto" type="text" placeholder="Digite o cep" name="registraCep"  required="requiored">
				<br/><br/>

				<?php
					if($erroCad){
						echo '<font style="color:#FF0000">
						Este endereço ja possui cadastro!
						</font> <br/><br/>';
					}
				?>

				<label class="lblMsg">Endereço:</label>
				<input class="formTexto" type="text" placeholder="Digite nome da rua ou bairro" name="registraEndereco"  required="requiored">
				<br/><br/>

				<label class="lblMsg">Numero:</label>
				<input class="formTexto" type="text" placeholder="Digite o numero da casa" name="registraNumero"  required="requiored">
				<br/><br/>
				
				<?php
					if($erroSenha){
						echo '<font style="color:#FF0000">
						Digite a mesma senha, em ambos os campos
						</font> <br/><br/>';
					}
				?>

				<label class="lblMsg">Senha:</label>
				<input class="formTexto" type="password" placeholder="Digite sua senha" name="registraSenha"  required="requiored">
				<br/><br/>
				
				<label class="lblMsg">Senha:</label>
				<input class="formTexto" type="password" placeholder="Confirme a senha" name="confirmarSenha"  required="requiored">
				<br/><br/>

				<input class="button" id="btnRegistrar"  type="submit" name="enviarCad" value="Registrar">
				
			</form>
		</section>
	</div>

</body>
</html>	