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
        <iframe frameborder=0 width='100%' height='300' src='https://analytics.zoho.com/open-view/1850091000000139805/e5022a4985e27a020a2a6911f3be8a5c'></iframe>
    </div>
    </div>";
}else if ($perfil == 'adm') {
    echo "
    <div id='conteudo'>
    <div class='container'>
        <div class='page-header'>
            <h2>Controle Geral</h2>
        </div>
        <iframe frameborder=0 width='100%' height='800' src='https://analytics.zoho.com/open-view/1850091000000139302/660b5ec17a1ac5a5e594d629946ee573'></iframe>
        <br></br>
        <iframe frameborder=0 width='100%' height='800' src='https://analytics.zoho.com/open-view/1850091000000022208/09cb261cb4aa8b54a09e38a6270ca12a'></iframe>
    </div>
    </div>";
}
?>

<?php
include "rodape.php";
?>