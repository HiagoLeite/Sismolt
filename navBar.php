<!DOCTYPE HTML>
<html lang="pt-br">
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/styleSheets.css">
	<!-- JS -->
	<script>
		function myFunction() {
    		document.getElementsByClassName("topNav")[0].classList.toggle("responsive");
		}
	</script>
	
	<nav>
		<ul class="topNav">
			<a href="index.php"><img class="imgLogo" src="imagens/nv50.png"><span id="logo">Sismolt</span></a>	
			<li><a id="navSair" href="php/sair.php">Sair</a></li>
			<li><a id="navPrevencoes" href="prevencoes.php">Prevenções</a></li>
			<li><a id="navLogar" href="logar.php">Logar | Cadastrar</a></li>
			<li><a id="navHome" href="home.php">Home</a></li>
			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
	</nav>	

</html> 