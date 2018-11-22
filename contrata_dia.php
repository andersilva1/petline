<?php

include "cabecalho.php";

$id = $_SESSION['id'];
if (isset($_GET['po'])) {
    $pacote = $_GET['po'];
}else{
    $pacote = $_POST['pacote_opcao'];
}

if (isset($_GET['add'])) {
    $dt_passeio = $_POST['dt_passeio'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];
    $pacote = $_POST['pacote_opcao'];
    $pacoteAtual = $pacote;

    $sqlContaDias = "SELECT SUM(quantidade_passeio) as total FROM pacote WHERE nome = '$pacote' AND id_usuario = '$id' and ativo = 1";
    $resultadoContaDias = mysqli_query($conn, $sqlContaDias);
    $contatdorContaDias = mysqli_num_rows($resultadoContaDias);
    $sqlAdicionaDia = "INSERT INTO pacote (dt_passeio, hora_inicio, hora_fim, id_usuario, ativo, nome, quantidade_passeio) VALUES ('$dt_passeio', '$hora_inicio', '$hora_fim', $id, 1, '$pacote', 1)";

    if ($contatdorContaDias == 0) {
        $total = 0;
    }else{

        while ($linhaContaDias = $resultadoContaDias -> fetch_array(MYSQLI_ASSOC)) {
            $total = $linhaContaDias['total'];

            $sqlVerificaPacoteAtual = "SELECT nome FROM pacote WHERE ativo = 1 and id_usuario = '$id' GROUP BY nome";
            $resultadoVerificaPacoteAtual = mysqli_query($conn, $sqlVerificaPacoteAtual);

            while ($linhaVerificaPacoteAtual = $resultadoVerificaPacoteAtual -> fetch_array(MYSQLI_ASSOC)) {
                $pacoteAtual = $linhaVerificaPacoteAtual['nome'];
            }

            if ($pacote != $pacoteAtual and $pacoteAtual != null) {
                $pacote = 'INVALIDO';
            }
        }
    }
    switch ($pacote) {
        case 'LINE_BASIC':
            if ($total < 8) {

                if (!mysqli_query($conn,$sqlAdicionaDia)) {
                    echo '<script type="text/javascript">'; 
                    echo "alert('Não foi possível inserir o dia, favor entrar em contato com o administrador!');"; 
                    echo '</script>';
                }

            }else{
                echo '<script type="text/javascript">'; 
                echo "alert('A quantidade de passeios do seu pacote foi excedida!');"; 
                echo '</script>';
            }
            break;

        case 'RICH_DOG':
            if ($total < 12) {

                if (!mysqli_query($conn,$sqlAdicionaDia)) {
                    echo '<script type="text/javascript">'; 
                    echo "alert('Não foi possível inserir o dia, favor entrar em contato com o administrador!');"; 
                    echo '</script>';
                }

            }else{
                echo '<script type="text/javascript">'; 
                echo "alert('A quantidade de passeios do seu pacote foi excedida!');"; 
                echo '</script>';
            }
            break;
        case 'GOLDEN_DOG':
            if ($total < 22) {
                
                if (!mysqli_query($conn,$sqlAdicionaDia)) {
                    echo '<script type="text/javascript">'; 
                    echo "alert('Não foi possível inserir o dia, favor entrar em contato com o administrador!');"; 
                    echo '</script>';
                }
            }else{
                echo '<script type="text/javascript">'; 
                echo "alert('A quantidade de passeios do seu pacote foi excedida!');"; 
                echo '</script>';
            }
            break;
        case 'INVALIDO':
            echo '<script type="text/javascript">'; 
            echo "alert('Já existe um pacote ativo em seu nome!');"; 
            echo '</script>';
            break;
    }
}
?>
<img src="../img/pagContrataPac.jpg" alt="Imagem titulo pagina de contratar pacotes" style="width:100%;">
<br></br>
<div id="conteudo">
<div class="container">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Selecione os dias do Passeio</h2>
        </div>
        <form action="contrata_dia.php?add" method="post" name="contrata_dia" id="contrata_dia">
        <input type="hidden" name="pacote_opcao" id="pacote_opcao" value=<?php echo $pacote; ?>>
            <div class="form-row">
                <div class="col-md-4">
                    <label for="dt_passeio">Data Passeio</label>
                    <input type="date" class="form-control" name="dt_passeio" id="dt_passeio">
                </div>

                <div class="col-md-3">
                    <label for="hora_inicio">Hora Inicio</label>
                    <input type="time" class="form-control" name="hora_inicio" id="hora_inicio">
                </div>

                <div class="col-md-3">
                    <label for="hora_fim">Hora Fim</label>
                    <input type="time" class="form-control" name="hora_fim" id="hora_fim">
                </div>

                <div class="col-md-2">
                    <label for="add">Adicionar</label> <br>
                    <button type="submit" class="btn btn-success glyphicon glyphicon-plus"></button>
                </div> <br>
                <?php
                    $sqlConsultaPacote = "SELECT id, dt_passeio, hora_inicio, hora_fim, nome, quantidade_passeio FROM pacote WHERE id_usuario = $id and ativo = 1 ORDER BY nome";
                    $resultadoConsultaPacote = mysqli_query($conn,$sqlConsultaPacote);
                    $contadorConsultaPacote = mysqli_num_rows($resultadoConsultaPacote);
                    $quantidadePasseio = 0;
                ?>
                <br></br>
                <hr>
                <div class="table-responsive panel panel-default col-md-12">
                    <div class="panel-heading" align="center">Passeios Ativos</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">Data Passeio</th>
                        <th scope="col">Hora Início</th>
                        <th scope="col">Hora Fim</th>
                        <th scope="col">Pacote</th>
                        <th scope="col">Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if ($contadorConsultaPacote > 0) {

                            while ($linhaConsultaPet = $resultadoConsultaPacote -> fetch_array(MYSQLI_ASSOC)) {
                                $dt_passeio = $linhaConsultaPet['dt_passeio'];
                                $hora_inicio = $linhaConsultaPet['hora_inicio'];
                                $hora_fim = $linhaConsultaPet['hora_fim'];
                                $nomePacote = $linhaConsultaPet['nome'];
                                $idPacote = $linhaConsultaPet['id'];
                                $quantidade_passeio = $linhaConsultaPet['quantidade_passeio'];
                                $quantidadePasseio = $quantidadePasseio + $quantidade_passeio;

                                echo " <tr>
                                    <th></th>
                                    <td>$dt_passeio</td>
                                    <td>$hora_inicio</td>
                                    <td>$hora_fim</td>
                                    <td>$nomePacote</td>";?>
                                    <td width=10% align=center><a href="http://www.petline.com.br/consulta/deleta_usuario.php" onclick="if(confirm('Tem certeza que deseja excluir o dia?')) <?php echo "window.location.href = 'http://www.petline.com.br/deleta_dia.php?id=$idPacote&po=$pacote';" ?> ; return false" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
                                    <?php echo "</tr>";
                            }
                        }else{
                            echo "<h4>Não existem dias selecionados</h4>";
                        }
                    ?>                        
                    </tbody>
                </table>
                </div>
                <input type="hidden" name="quantidade" id="quantidade" value=<?php echo $quantidadePasseio; ?>>
                <div class="col-md-6" align="left">
                    <a href="http://www.petline.com.br/contrata_pacote.php" class="btn btn-primary">Voltar</a>
                </div>

                <div class="col-md-6" align="right">
                    <a href="http://www.petline.com.br/lista_pet.php" class="btn btn-primary" id="lista_pet" name="lista_pet">Avançar</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<?php include "rodape.php";?>