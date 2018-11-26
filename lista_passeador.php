<?php
include "cabecalho.php";

$id = $_SESSION['id'];
$id_pet = $_GET['pet'];
$id_pacote = $_GET['pacote'];

$sqlConsultaPacote = "SELECT id, dt_passeio, hora_inicio, hora_fim FROM pacote WHERE id_usuario = $id and ativo = 1";
$resultadoConsultaPacote = mysqli_query($conn,$sqlConsultaPacote);
$contadorConsultaPacote = mysqli_num_rows($resultadoConsultaPacote);
?>
<div id="conteudo">
<div class="container">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Passeadores Disponíveis</h2>
        </div>
        <div class="table-responsive panel panel-default">
        
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col"></th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Selecionar</th>
                    </tr>
                </thead>
                <tbody>
            <?php

            $sqlValidaPasseador = "SELECT A.id_usuario FROM pacote P LEFT JOIN agenda A ON (A.dt_passeio = P.dt_passeio) WHERE	P.id_usuario = $id and A.dt_passeio IS NULL";
            $resultadoValidaPasseador = mysqli_query($conn,$sqlValidaPasseador);
            $contadorValidaPasseador = mysqli_num_rows($resultadoValidaPasseador);

            $arrayIndisponiveis = [];

            if ($contadorValidaPasseador > 0) {

                while ($linhaValidaPasseador = $resultadoValidaPasseador -> fetch_array(MYSQLI_ASSOC)) {
                    array_push($arrayIndisponiveis, $linhaValidaPasseador['id_usuario']);        
                }
                echo "<tr><th scope='col' colspan=4 align=center>Não existem passeadores disponíveis</th></tr>";
            }else{

                $totalArray = count($arrayIndisponiveis);
                
                if ($totalArray > 0) {

                    $listaPasseadorIndisponivel = implode($arrayIndisponiveis,',');
                    $sql = "SELECT CONCAT(U.nome, ' ', U.sobrenome) AS nome, U.id as id, CONCAT(U.rua, ', ', U.bairro) as endereco FROM agenda A INNER JOIN usuario U ON (A.id_usuario = U.id AND U.perfil = 'pas') WHERE A.id_usuario NOT IN ($listaPasseadorIndisponivel) GROUP BY A.id_usuario";
                    
                } else {
                    $sql = "SELECT CONCAT(U.nome, ' ', U.sobrenome) AS nome, U.id as id, CONCAT(U.rua, ', ', U.bairro) as endereco FROM agenda A INNER JOIN usuario U ON (A.id_usuario = U.id AND U.perfil = 'pas') GROUP BY A.id_usuario";
                }

                $resultadoPasseadorDisponivel = mysqli_query($conn,$sql);

                while ($linhaPasseadorDisponivel = $resultadoPasseadorDisponivel -> fetch_array(MYSQLI_ASSOC)) {
                    $nome = $linhaPasseadorDisponivel['nome'];
                    $endereco = utf8_encode($linhaPasseadorDisponivel['endereco']);
                    $idPasseador = $linhaPasseadorDisponivel['id'];

                    echo " <tr>
                    <th></th>
                    <td width=30%>$nome</td>
                    <td width=60%>$endereco</td>";?>
                    <td width=10% align=center><a href="#" onclick="if(confirm('Tem certeza que deseja contratar este passeador?')) <?php echo "window.location.href = 'http://www.petline.com.br/cadastra_servico.php?pet=$id_pet&pacote=$id_pacote&passeador=$idPasseador';" ?> ; return false" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a></td>
                    <?php echo "</tr>";
                }
            }
            ?>                 
            </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12" align="left">
        <a href="http://www.petline.com.br/lista_pet.php" class="btn btn-primary">Voltar</a>
    </div>
    </div>
</div>