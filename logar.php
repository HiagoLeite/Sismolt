<?php 
	require_once ('navBar.php');

	$erroLogin= isset($_GET['erro_login'])	? $_GET['erro_login'] : 0;

?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/styleSheets.css">
	<title>Logar|Sismolt</title>

</head>

<body class="fundoCorpo">
	<div class="tamanhoArea">
		<section id="logar">
			<form class="formPag" method="POST" action="php/login.php">
				<h3>Login</h3>
				<br/>
				
				<?php 
					if($erroLogin){
						echo '<font style="color:#FF0000">
						Dados invalidos!
						</font> <br/><br/>';
					}
				?>
				
				<label class="lblMsg">Nome:</label>
				<input id="logNome"  class="formTexto" type="text" placeholder="Digite seu nome" name="logNome"  required="requiored">

				<br/><br/>
				<label class="lblMsg">Email:</label>
				<input id="logEmail"  class="formTexto" type="email" placeholder="Digite seu email" name="logEmail"  required="requiored">
				<br/><br/>
				
				<label class="lblMsg">Senha:</label>
				<input id="logSenha"  class="formTexto" type="password" placeholder="Digite sua senha" name="logSenha"  required="requiored">
				<br/><br/>

				<input class="button" id="btnLogin" type="submit" value="Entrar">
				<br/><br/>

				Não tem uma
				conta? <a id="cadLink" href="cadastrar.php">Cadastrar-se</a>
				<br/><br/>
				<a id="esqueceuLink" href="#">Esqueceu a senha?</a>

			</form>
		</section>
	</div>

</body>
</html>	