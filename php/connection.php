<?php
  
  class db{
    
      private $host='localhost';
      private $database='bancosistema';
      private $user='root';
      private $password='';

    public function conexaoBd(){

      $conexao=mysqli_connect($this->host,$this->user,
      $this->password,$this->database);
      
        mysqli_set_charset($conexao,'utf8');

        if(mysqli_connect_errno()){
            echo 'Erro ao conectar com o Banco de dados: '.mysqli_connect_error();	  
        }
        return $conexao;
    }
  }
?>