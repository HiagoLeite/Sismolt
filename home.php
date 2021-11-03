<?php
    SESSION_START();
    require_once('navbar.php');
    require_once('php/connection.php');
    $objConnection = new db();
    $link = $objConnection->conexaoBd();
    $idUsuario=$_SESSION['idUsuario'];
    $anoChuva=date('Y');
?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">	
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/styleSheets.css">
    <!-- JS -->
	<script src="js/scripts.js" defer></script>
	<title>Home</title>
	
</head>	

<body class="fundoCorpo">
    <div id="dadosUsuario"> 
        <label id="msgBemVindo">Bem Vindo: 
            <?php echo $_SESSION['nome']; ?>
        </label>   
    </div>
		
	<div class="containerHome">
		<div class="row">
            <section  class="col-4 col-xs-min-4 col-md-min-4 col-lg-min-4" id="contPrinc">
                <form id="formPesquisa" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input id="inputData" type="date" name="data">
                    <input id="btnPesquisar" class="button" type="submit" name="submit" value="Pesquisar">
                </form>
                <table class="tabDados">
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
                            $sqlSelect="SELECT registro,estado,umidadeSolo,grauPerigo,
                            DATE_FORMAT(dataAtual, '%d/%m/%Y %H:%i') as dataAtual 
                            FROM dadomonitorado 
                            WHERE '$idUsuario'=dadoMonitorado.idUsuario AND 
                            DATE_FORMAT(dataAtual, '%Y-%m-%d') = CURDATE()";

                            $resDb=mysqli_query($link,$sqlSelect);
                            imprDados($resDb);
                        }else{
                            $sqlSelect="SELECT registro,estado,umidadeSolo,grauPerigo,
                            DATE_FORMAT(dataAtual, '%d/%m/%Y %H:%i') as dataAtual FROM 
                            dadomonitorado 
                            WHERE '$idUsuario'=dadoMonitorado.idUsuario AND dataAtual Like'$data%'";
                
                            $resDb=mysqli_query($link,$sqlSelect);
                            imprDados($resDb);
                        }
                        function imprDados($resDb){
                            while($row=mysqli_fetch_array($resDb)){
                                if($row['umidadeSolo']>= 0 && $row['umidadeSolo']<= 400){
                                    $perigo="#cb4543";
                                }else if($row['umidadeSolo']> 400 && $row['umidadeSolo']<= 800){
                                    $perigo="#cd6437";
                                }else{
                                    $perigo="#94eba1";
                                }
                                echo"<tr>
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
                
            </section>
            <section class="col-4 col-xs-min-7 col-md-min-7 col-lg-min-7" id="contOcorrencia">
                <h3>Ocorrência de chuva <?php echo $anoChuva;?></h3>
                <br/>
                <table class="tabDados">
                        <tr>
                            <th>Jan</th>
                            <th>Fev</th>
                            <th>Mar</th>
                            <th>Abr</th>
                            <th>Mai</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Ago</th>
                            <th>Set</th>
                            <th>Out</th>
                            <th>Nov</th>
                            <th>Dez</th>
                        </tr>
                        <?php
                            $sqlSelect="CALL chuvaMes($anoChuva)";
                            $resDb=mysqli_query($link,$sqlSelect);
                            while($row=mysqli_fetch_array($resDb)){
                                echo"<tr>
                                <td>".$row['jane']."</td>
                                <td>".$row['feve']."</td>
                                <td>".$row['marc']."</td>
                                <td>".$row['abri']."</td>
                                <td>".$row['maio']."</td>
                                <td>".$row['junh']."</td>
                                <td>".$row['julh']."</td>
                                <td>".$row['agos']."</td>
                                <td>".$row['setem']."</td>
                                <td>".$row['outu']."</td>
                                <td>".$row['nove']."</td>
                                <td>".$row['deze']."</td>
                                </tr>";
                            }
                        ?>
                </table>
            </section>
		</div>
	</div>
</body>

</html>