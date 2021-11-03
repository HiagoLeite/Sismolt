<?php 
	require_once ('navBar.php');
?> 
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">	
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name="theme-color" content="cor em hexadecimal">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/styleSheets.css">
	<title>Sismolt</title>
	
</head>	

<body class="fundoCorpo">
		<div class="textArea">
			<h1>Segurança para todos!</h1>
			<br/>
			<a class="btnAdquirir" href="#refContainer">Saiba Mais</a>
		</div>
		
	<div class="container" id="refContainer">
		<div class="row">

			<section class="col-4 col-xs-min-4 col-md-min-4 col-lg-min-4" id="imgProt">
				<h3>Imagens do Protótipo</h3>
				<div id="contImg"  >
				
					<div class="imgDiv" style="float:left;"> a</div>
					<div class="imgDiv" style="float:right;"> b</div>
					<div class="imgDiv" style="float:left;"> c</div>
					<div class="imgDiv" style="float:right;"> d</div>
				
				</div>
			</section>
			
			<section class="col-4 col-xs-min-7 col-md-min-7 col-lg-min-7" id="descricao">
				<div id="objetivo" >
					<h2>Objetivo</h2>
					<br/>
					
					<p> O Sismolt é um sistema de monitoração de deslizamento
					,o objetivo principal do sistema Sismolt é propor informações que
					estabeleção segurança, permitindo que o usuario tenha noção das
					condições que se encontra o terreno ingrime perto da sua moradia.</p>
					
					<p>Proporcionando conforto e estabilidade para que o usuario possa
					ter qualidade de vida.</p>
				</div>
				
				<div id="comoFunciona" >
					<h2> Como Funciona</h2>
					<br/>

					<p>O sistema Sismolt funciona com base em um microcontrolador 
					e um sensor de umidade de solo, este sensor tem a função de
					captar os dados de umidade do solo. Os dados obtidos serão
					salvos e disponibilizados para a visualização do usuario.</p>

					<p>Por meio de uma tabela é apresentado os valores captados,
					o estado do solo e a data/hora além do nivel de perigo
					que o usuario esta correndo, o usuario pode fazer buscas
					para que ele tenha maior controle de e noção sobre o estado
					do solo.</p>
				</div>
			</section>
		</div>
	</div>

	<footer id="rodapeIndex">
		
		<div class="row">
			<div class="centro">
			<ul id="ulComunidade">
				<h3>Comunidade</h3>
				<br/>
				<li><a href="#">Desenvolvedores</a></li>
				<li><a href="#">Apoiadores</a></li>
				<li><a href="#">Parcerias</a></li>
				<li><a href="#">Apoiadores</a></li>

			</ul>
			<ul id="ulContato">
				<h3>Contato</h3>
				<br/>
				<li>Email:XXXXXX@hotmail.com</li>
				<li>Gmail:XXXXXX@gmail.com</li>
				<li>Numero:+55 (11)9999-99999</li>
			</ul>

			<ul id="ulRedeSociais">
				<h3>Redes Sociais</h3>
				<br/>
				<li> <a href="#">Facebook</a></li>
			</ul>
			</div>
		</div>
		
		<p>© Projeto Sismolt 2021</p>
	</footer>
</body>

</html>