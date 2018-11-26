<?php

session_start();
include "conexao.php";

$login  = $_POST['login']; 
$pass   = $_POST['pass'];

if ($login == "" or $pass == "") {
    header("location:login.php?e=3");
}else{
    $pass = sha1($pass);
    $sqlValidaLogin = "SELECT id,login, senha, perfil, CONCAT(nome, ' ', sobrenome) AS nome FROM usuario WHERE login = '$login' and senha = '$pass' and ativo = 1";
    $resultadoValidaLogin = mysqli_query($conn,$sqlValidaLogin);
    $contadorValidaLogin = mysqli_num_rows($resultadoValidaLogin);

    if ($contadorValidaLogin > 0) {
        while ($linhaUsuario = $resultadoValidaLogin -> fetch_array(MYSQLI_ASSOC)) {

            $id = $linhaUsuario['id'];
            $nome = $linhaUsuario['nome'];
            $login = $linhaUsuario['login'];
            $perfil = $linhaUsuario['perfil'];

            $_SESSION['id'] = $id;
            $_SESSION['nome'] = $nome;
            $_SESSION['login'] = $login;
            $_SESSION['pass'] = $pass;
            $_SESSION['perfil'] = $perfil;
        }
        header("location:index.php");
    }else {
        session_destroy();
        header("location:login.php?e=1");
    }
}

?>