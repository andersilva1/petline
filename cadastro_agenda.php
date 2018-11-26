<?php

include "cabecalho.php";

$id = $_SESSION['id'];

if (isset($_GET['add'])) {

    $dt_passeio = $_POST['dt_passeio'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];
    $descricao = utf8_decode($_POST['descricao_agenda']);

    $sqlAdicionaDia = "INSERT INTO agenda (dt_passeio, hora_inicio, hora_fim, id_usuario, descricao, ativo) VALUES ('$dt_passeio', '$hora_inicio', '$hora_fim', $id, '$descricao', 1)";
    $resultadoAdicionaDia = mysqli_query($conn, $sqlAdicionaDia);
}
?>
<img src="../img/pagAgenda.jpg" alt="" style="width:100%;">
<br></br>
<div id="conteudo">
<div class="container">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Selecione os dias da Agenda</h2>
        </div>
        <form action="cadastro_agenda.php?add" method="post" name="cadastro_agenda" id="cadastro_agenda">
            <div class="form-row">
                <div class="col-md-2">
                    <label for="dt_passeio">Data Agenda</label>
                    <input type="date" class="form-control" name="dt_passeio" id="dt_passeio" min="2018-01-01" max="2018-12-31" required>
                </div>

                <div class="col-md-2">
                    <label for="hora_inicio">Hora Inicio</label>
                    <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" required>
                </div>

                <div class="col-md-2">
                    <label for="hora_fim">Hora Fim</label>
                    <input type="time" class="form-control" name="hora_fim" id="hora_fim" required>
                </div>

                <div class="col-md-5">
                    <label for="descricao_agenda">Descrição</label>
                    <input type="text" class="form-control" name="descricao_agenda" id="descricao_agenda">
                </div>

                <div class="col-md-1">
                    <label for="add">Adicionar</label> <br>
                    <button type="submit" class="btn btn-success glyphicon glyphicon-plus"></button>
                </div> <br>
<?php
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

if ($id == 1) {
    $sqlConsultaDias = "SELECT id, dt_passeio, hora_inicio, hora_fim, descricao FROM agenda";
}else{
    $sqlConsultaDias = "SELECT id, dt_passeio, hora_inicio, hora_fim, descricao FROM agenda WHERE id_usuario = $id";
}
    $resultadoConsultaDias = mysqli_query($conn,$sqlConsultaDias);
    $contadorConsultaDias = mysqli_num_rows($resultadoConsultaDias);

$quantidade_pg = 10;
$num_pagina = ceil($contadorConsultaDias/$quantidade_pg);
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

if ($id == 1) {
    $sqlConsultaDia = "SELECT id, dt_passeio, hora_inicio, hora_fim, descricao FROM agenda ORDER BY dt_passeio LIMIT $incio, $quantidade_pg";
}else{
    $sqlConsultaDia = "SELECT id, dt_passeio, hora_inicio, hora_fim, descricao FROM agenda WHERE id_usuario = $id ORDER BY dt_passeio LIMIT $incio, $quantidade_pg";
}
    $resultadoConsultaDia = mysqli_query($conn,$sqlConsultaDia);
    $contadorConsultaDia = mysqli_num_rows($resultadoConsultaDia);
?>
                <div class="table-responsive panel panel-default col-md-12">
                <table width=100% class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">Data Passeio</th>
                        <th scope="col">Hora Início</th>
                        <th scope="col">Hora Fim</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Deletar</th>
                        </tr>
                    </thead>
                    <?php 
                        if ($contadorConsultaDia > 0) {

                            while ($linhaConsultaDia = mysqli_fetch_assoc($resultadoConsultaDia)) {
                                $dt_passeio = $linhaConsultaDia['dt_passeio'];
                                $hora_inicio = $linhaConsultaDia['hora_inicio'];
                                $hora_fim = $linhaConsultaDia['hora_fim'];
                                $descricao = utf8_encode($linhaConsultaDia['descricao']);
                                $id_agenda = $linhaConsultaDia['id'];

                                echo " <tr>
                                    <th></th>
                                    <td>$dt_passeio</td>
                                    <td>$hora_inicio</td>
                                    <td>$hora_fim</td>
                                    <td>$descricao</td>";?>
                                    <td width=10% align=center><a href="#" onclick="if(confirm('Tem certeza que deseja excluir o dia?')) <?php echo "window.location.href = 'http://www.petline.com.br/deleta_dia_agenda.php?id=$id_agenda';" ?> ; return false" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
                                    <?php echo "</tr>";
                            }
                        }else{
                            echo "<h4>Não existem dias selecionados</h4>";
                        }
                    ?>
                </table>
                </div>
                <?php
                    //Verificar a pagina anterior e posterior
                    $pagina_anterior = $pagina - 1;
                    $pagina_posterior = $pagina + 1;
                ?>
                <nav class="text-center">
                    <ul class="pagination">
                        <li>
                            <?php
                            if($pagina_anterior != 0){ ?>
                                <a href="http://www.petline.com.br/cadastro_agenda.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            <?php }else{ ?>
                                <span aria-hidden="true">&laquo;</span>
                        <?php }  ?>
                        </li>
                        <?php 
                        //Apresentar a paginacao
                        for($i = 1; $i < $num_pagina + 1; $i++){ ?>
                            <li><a href="http://www.petline.com.br/cadastro_agenda.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <li>
                            <?php
                            if($pagina_posterior <= $num_pagina){ ?>
                                <a href="http://www.petline.com.br/cadastro_agenda.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            <?php }else{ ?>
                                <span aria-hidden="true">&raquo;</span>
                        <?php }  ?>
                        </li>
                    </ul>
                </nav>

                <div class="col-md-6" align="left">
                    <a href="http://www.petline.com.br/index.php" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<?php include "rodape.php";?>