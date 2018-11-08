<?php

session_start();

include "conexao.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $sqlIniciaPasseio = "UPDATE pacote SET pet_pego = 1 WHERE id = $id";

    if(mysqli_query($conn,$sqlIniciaPasseio)){
        header("location:index.php");
    }
}
?>