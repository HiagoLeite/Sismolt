<?php
    SESSION_START();

    require_once('php/connection.php');

    $objConnection = new db();
    $link = $objConnection->conexaoBd();
    $idUsuario=$_SESSION['idUsuario'];


?>
<!DOCTYPE html>
<html>
<head>
    
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- JS -->
	<script src="js/scripts.js" defer></script>

    <title>Home</title>

</head>
<body>  

    <nav>
		<ul class="topNav">
			<a id="logo" href="index.php">Sismolt</a>	

            <li><a href="#">Ajuda</a></li>
			<li><a href="php/sair.php">Sair</a></li>
			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
	</nav>	

    <div>
    <!-- class="tamanhoArea" -->
        <div id="dadosUsuario"> 
            <label id="msgBemVindo">Bem Vindo 
                <?php echo $_SESSION['nome']; ?>
            </label>  
            
        </div>

        <div class="contHome">
            <form method="POST" action="home.php">
                <input id="inputData" type="date" name="data">
                <input id="btnPesquisar" class="button" type="submit" name="submit" value="Pesquisar">
            </form>
            
            <table id="tabDados">
                <tr>
                    <th>Registro</th>
                    <th>Estado do solo</th> 
                    <th>Nivel umidade</th> 
                    <th>Grau de perigo</th> 
                    <th>Data/Hora</th> 
                </tr>
                <?php 

                $data =(isset($_POST['data'])? $_POST['data'] : '' );
                if(empty($data)){

                    $sqlSelect="SELECT*FROM dadomonitorado 
                    WHERE '$idUsuario'=dadoMonitorado.idUsuario AND 
                    DATE_FORMAT(dataAtual, '%Y-%m-%d') = CURDATE()";

                    $resDb=mysqli_query($link,$sqlSelect);

                    while($row=mysqli_fetch_array($resDb)){
                        
                        if($row['umidadeSolo']>= 0 && $row['umidadeSolo']<= 400){
                            $perigo="#cb4543";
                        }else if($row['umidadeSolo']> 400 && $row['umidadeSolo']<= 800){
                            $perigo="#cd6437";
                        }else{
                            $perigo="#94eba1";
                        }
                        echo" 
                        <tr>
                        <td style='background-color:$perigo;'>".$row['registro']." </td>
                        <td style='background-color:$perigo;'>" .$row['estado']." </td>
                        <td style='background-color:$perigo;'>" .$row['umidadeSolo']." </td>
                        <td style='background-color:$perigo;'>" .$row['grauPerigo']." </td>
                        <td style='background-color:$perigo;'>" .$row['dataAtual']." </td>
                        </tr>";
                    }

                }else{
                    
                    $sqlSelect="SELECT*FROM dadomonitorado 
                    WHERE '$idUsuario'=dadoMonitorado.idUsuario AND dataAtual Like'$data%'";
           
                    $resDb=mysqli_query($link,$sqlSelect);
    
                    while($row=mysqli_fetch_array($resDb)){
                        
                        if($row['umidadeSolo']>= 0 && $row['umidadeSolo']<= 400){
                            $perigo="#cb4543";
                        }else if($row['umidadeSolo']> 400 && $row['umidadeSolo']<= 800){
                            $perigo="#cd6437";
                        }else{
                            $perigo="#94eba1";
                        }
                        echo" 
                        <tr>
                        <td style='background-color:$perigo;'>".$row['registro']." </td>
                        <td style='background-color:$perigo;'>" .$row['estado']." </td>
                        <td style='background-color:$perigo;'>" .$row['umidadeSolo']." </td>
                        <td style='background-color:$perigo;'>" .$row['grauPerigo']." </td>
                        <td style='background-color:$perigo;'>" .$row['dataAtual']." </td>
                        </tr>";
                    }
                }
                ?>
                
            </table>
            <br/> <br/>
        </div>
    </div>    
</body>
</html>