<?php
include "cabecalho.php";
$perfil = $_SESSION['perfil'];
?>

<img src="../img/pagRelat.jpg" alt="" style="width:100%;">
<br></br>
<?php
if ($perfil == 'pas') {
    echo "
    <div id='conteudo'>
    <div class='container'>
        <div class='page-header'>
            <h2>Controle Geral</h2>
        </div>
        <iframe frameborder=0 width='100%' height='300' src='https://analytics.zoho.com/open-view/1853753000000003148/1a4d6b15bbc87f180739a268623aebf8'></iframe>
    </div>
    </div>";
}else if ($perfil == 'adm') {
    echo "
    <div id='conteudo'>
    <div class='container'>
        <div class='page-header'>
            <h2>Controle Geral</h2>
        </div>
        <iframe frameborder=0 width='100%' height='600' src='https://analytics.zoho.com/open-view/1853753000000003684/390a1ffc751988058dcb3975c5eb043c'></iframe>
        <br></br>
        <iframe frameborder=0 width='100%' height='600' src='https://analytics.zoho.com/open-view/1853753000000003554/a72ecb6236d5f5a6ddf309c595599589'></iframe>
    </div>
    </div>";
}
?>

<?php
include "rodape.php";
?>