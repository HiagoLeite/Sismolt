<?php
    SESSION_START();

    require_once 'connection.php';

    // FORM
    $user = $_POST['logNome'];
    $email = $_POST['logEmail'];
    $password=md5($_POST['logSenha']);

    $objConnection = new db();
    $link = $objConnection->conexaoBd();

    $sqlSelect="SELECT*FROM usuarios WHERE 
    '$user'=nome AND '$password'=senha";

    if($resDb=mysqli_query($link,$sqlSelect)){
        $resUsuario=mysqli_fetch_array($resDb);

        if(isset($resUsuario['nome'])){
            // var_dump($resUsuario['nome']);
            $_SESSION['idUsuario'] = $resUsuario['idUsuario'];
            $_SESSION['nome']=$resUsuario['nome'];
            $_SESSION['email']=$resUsuario['email'];
            header('Location: ../home.php');
  
        }else{
            $retorno_get = '';
		    $retorno_get.= "erro_login=1&";
		    header('Location: ../logar.php?'.$retorno_get);
        }
    }else{
        echo 'erro ao executar a query';
    }
?>