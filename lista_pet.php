<?php
include "cabecalho.php";

$id = $_SESSION['id'];
$sqlConsultaPacote = "SELECT id FROM pacote WHERE id_usuario = $id GROUP BY nome LIMIT 1";
$resultadoConsultaPacote = mysqli_query($conn,$sqlConsultaPacote);

while ($linhaPacote = $resultadoConsultaPacote -> fetch_array(MYSQLI_ASSOC)) {
    $idPacote = $linhaPacote['id'];
}

$sqlConsultaPet = "SELECT id, nome, raca, peso, descricao FROM pet WHERE id_usuario = $id and ativo = 1";
$resultadoConsultaPet = mysqli_query($conn,$sqlConsultaPet);
$contadorConsultaPet = mysqli_num_rows($resultadoConsultaPet);
?>
<img src="../img/pagContrataPac.jpg" alt="Imagem titulo pagina de contratar pacotes" style="width:100%;">
<br></br>
<div id="conteudo">
<div class="container">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Pets Disponíveis</h2>
        </div>
        <div class="panel panel-default">
        
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Raça</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Selecione</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                if ($contadorConsultaPet > 0) {
                    while ($linhaPet = $resultadoConsultaPet -> fetch_array(MYSQLI_ASSOC)) {
                        $nome = utf8_encode($linhaPet['nome']);
                        $raca = utf8_encode($linhaPet['raca']);
                        $peso = $linhaPet['peso'];
                        $id_pet = $linhaPet['id'];
                        $descricao = utf8_encode($linhaPet['descricao']);

                        echo "<tr>
                            <td width=20%>$nome</td>
                            <td width=10%>$raca</td>
                            <td width=10%>$peso</td>
                            <td width=50%>$descricao</td>";?>
                            <td width=10% align=center><a href="#" onclick="if(confirm('Tem certeza que deseja selecionar esse pet?')) <?php echo "window.location.href = 'http://www.petline.com.br/lista_passeador.php?pet=$id_pet&pacote=$idPacote';" ?> ; return false" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a></td>
                            <?php echo "</tr>";
                    }
                }else{
                    echo "<h4>Não existem PETs cadastrados</h4>";
                }
            ?>                 
            </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6" align="left">
        <a href="http://www.petline.com.br/contrata_dia.php" class="btn btn-primary">Voltar</a>
    </div>
</div>
</div>
<?php include "rodape.php"; ?>