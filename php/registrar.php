<?php

    require_once ('connection.php');
    
    // FORM
    $regNome=$_POST['registraNome'];
    $regEmail=$_POST['regitraEmail'];
    $regEndereco=$_POST['registraEndereco'];
    $regNumero=$_POST['registraNumero'];
    $regCep=$_POST['registraCep'];
    $regSenha=md5($_POST['registraSenha']);
    $confSenha=md5($_POST['confirmarSenha']);
    // AUX
    $cepExiste=false;
    $numExiste=false;


    $objConnection = new db();
    $link = $objConnection->conexaoBd();

    // CHECKOUT CEP 
    $sqlSelect="SELECT*FROM usuarios WHERE 
    '$regCep'=cep";
    if($resDb = mysqli_query($link, $sqlSelect)){
        
        $resUsuario=mysqli_fetch_array($resDb);

        if(isset($resUsuario['cep'])){
            $cepExiste=true;
        }
    }else{
        echo'Erro: Não foi possivel validar o cep <br/>';
    }

    // CHECKOUT NUM
    $sqlSelect="SELECT*FROM usuarios WHERE 
    '$regNumero'=numero";
    if($resDb = mysqli_query($link, $sqlSelect)){
         
        $resUsuario=mysqli_fetch_array($resDb);
 
        if(isset($resUsuario['numero'])){
            $numExiste=true;
        }
    }else{
        echo'Erro: Não foi possivel validar o cep <br/>';
    }
    
    if($cepExiste && $numExiste){
        $retorno_get = '';

		$retorno_get.= "erro_cadastro=1&";
		header('Location: ../cadastrar.php?'.$retorno_get);
		die();
    }
 
    $sqlInsert ="INSERT INTO usuarios (nome,email,cep,endereco,numero,senha,senhaC) VALUES(
    '$regNome','$regEmail','$regCep','$regEndereco','$regNumero','$regSenha',
    '$confSenha')";

    // VERIFICA SENHA
    if($regSenha === $confSenha){

        if(mysqli_query($link, $sqlInsert)){
            header('Location: ../logar.php');
        }else{
           echo 'erro na query';
        }
    }else{
        $retorno_get.= "erro_senha=1&";
        header('Location: ../cadastrar.php?'.$retorno_get);
    }
?>