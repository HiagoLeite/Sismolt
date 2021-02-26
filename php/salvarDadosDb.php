<?php
   require_once 'connection.php';

// $sensor=$_GET['registro'];
    $estado=$_GET['estado'];
    $umidadeSolo=$_GET['sensor'];
    $grauPerigo=$_GET['grauPerigo'];
    $idUsuario=$_GET['idUsuario'];

    $objConnection = new db();
    $link = $objConnection->conexaoBd();

    $sqlDados="INSERT INTO dadoMonitorado(estado,umidadeSolo,grauPerigo,dataAtual,idUsuario)  
    VALUES('$estado','$umidadeSolo','$grauPerigo',CURRENT_TIMESTAMP(),'$idUsuario')";
    
        if(mysqli_query($link,$sqlDados)){
            echo "Salvou";
        }else{
            echo"ERRO!";
        }
?>