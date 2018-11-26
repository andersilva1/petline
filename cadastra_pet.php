<?php

include "cabecalho.php";

$id = $_SESSION['id'];
$nome = utf8_decode($_POST['nome_pet']);
$raca = utf8_decode($_POST['raca']);
$cor = utf8_decode($_POST['cor']);
$peso = utf8_decode($_POST['peso']);
$dt_nascimento = $_POST['dt_nascimento'];
$descricao = utf8_decode($_POST['descricao_pet']);

if (isset($_GET['cod'])) {
    
    $cod = $_GET['cod'];
    $sqlCadastraPet = "UPDATE pet SET nome = '$nome', raca = '$raca', cor = '$cor', peso = '$peso', dt_nascimento = '$dt_nascimento', descricao = '$descricao' WHERE id = $cod";
}else{
    $sqlCadastraPet = "INSERT INTO pet (nome, raca, cor, peso, dt_nascimento,descricao, id_usuario, ativo) VALUES ('$nome','$raca','$cor','$peso','$dt_nascimento','$descricao',$id,1)";
}

if (mysqli_query($conn,$sqlCadastraPet)) {
    echo '<script type="text/javascript">';

    if (isset($_GET['cod'])) {
        echo "alert('Pet alterado com sucesso!');";
    }else{
        echo "alert('Pet cadastrado com sucesso!');";
    }
    
    echo 'window.location.href = "http://www.petline.com.br/consulta/consulta_pet.php";';
    echo '</script>';
}else{
    echo '<script type="text/javascript">'; 
    echo "alert('Não foi possivel cadastrar o PET, contate o Administrador');"; 
    echo 'window.location.href = "http://www.petline.com.br/cadastro_pet.php";';
    echo '</script>';
}

?>