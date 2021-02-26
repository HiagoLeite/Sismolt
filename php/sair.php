<?php

    session_start();

    unset($_SESSION['idUsuario']);
    unset($_SESSION['nome']);
    unset($_SESSION['email']);
    header('Location: ../index.php');

?>