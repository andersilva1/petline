<?php
include "../cabecalho.php";
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

$id = $_SESSION['id'];

if ($id == 1) {
    $sqlConsultaPets = "SELECT P.id, P.nome, P.raca, P.peso, P.cor, P.dt_nascimento, P.descricao, CONCAT(U.nome, ' ', U.sobrenome) as dono, P.ativo FROM pet P INNER JOIN usuario U ON P.id_usuario = U.id";
}else{
    $sqlConsultaPets = "SELECT P.id, P.nome, P.raca, P.peso, P.cor, P.dt_nascimento, P.descricao, CONCAT(U.nome, ' ', U.sobrenome) as dono, P.ativo FROM pet P INNER JOIN usuario U ON P.id_usuario = U.id WHERE P.id_usuario = $id";
}
$resultadoConsultaPets = mysqli_query($conn,$sqlConsultaPets);
$contadorConsultaPets = mysqli_num_rows($resultadoConsultaPets);

$quantidade_pg = 10;
$num_pagina = ceil($contadorConsultaPets/$quantidade_pg);
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

if (isset($_GET['busca'])) {
    $busca = $_GET['busca'];
    if ($id == 1) {
        $sqlConsultaPet = "SELECT P.id, P.nome, P.raca, P.peso, P.cor, P.dt_nascimento, P.descricao, CONCAT(U.nome, ' ', U.sobrenome) as dono, P.ativo FROM pet P INNER JOIN usuario U ON P.id_usuario = U.id WHERE P.nome LIKE '%$busca%' LIMIT $incio, $quantidade_pg";
    }else{
        $sqlConsultaPet = "SELECT P.id, P.nome, P.raca, P.peso, P.cor, P.dt_nascimento, P.descricao, CONCAT(U.nome, ' ', U.sobrenome) as dono, P.ativo FROM pet P INNER JOIN usuario U ON P.id_usuario = U.id WHERE P.id_usuario = $id and P.nome LIKE '%$busca%' LIMIT $incio, $quantidade_pg";
    }
}else{
    if ($id == 1) {
        $sqlConsultaPet = "SELECT P.id, P.nome, P.raca, P.peso, P.cor, P.dt_nascimento, P.descricao, CONCAT(U.nome, ' ', U.sobrenome) as dono, P.ativo FROM pet P INNER JOIN usuario U ON P.id_usuario = U.id LIMIT $incio, $quantidade_pg";
    }else{
        $sqlConsultaPet = "SELECT P.id, P.nome, P.raca, P.peso, P.cor, P.dt_nascimento, P.descricao, CONCAT(U.nome, ' ', U.sobrenome) as dono, P.ativo FROM pet P INNER JOIN usuario U ON P.id_usuario = U.id WHERE P.id_usuario = $id LIMIT $incio, $quantidade_pg";
    }
}
$resultadoConsultaPet = mysqli_query($conn,$sqlConsultaPet);
$contadorConsultaPet = mysqli_num_rows($resultadoConsultaPet);
?>
<div id="conteudo">
    <h3>Consulta Pet</h3>
    <h4>Pesquise por uma palavra chave ou selecione o PET da lista</h4>
    <br>
    <form action="consulta_pet.php" method="get">
    <div style="margin: auto; max-width: 300px;" align="right">
        <table>
            <tr>
                <td><input type="text" class="form-control" id="busca" name="busca" placeholder="Pesquise pelo nome do PET"></td>
                <td><button type="submit" class="btn btn-primary" id="busca">
                    <span class="glyphicon glyphicon-search"> </span>
                </button></td>
            <tr>
        </table>
    </div>
    </form>
    <?php
    if (isset($_GET['busca'])) {
        $busca = $_GET['busca'];
        echo "<h5 style= 'text-align: center;'>Exibindo $contadorConsultaPet resultado(s) para '$busca'. <a href='consulta_pet.php'> <b>Clique aqui</b> </a> para listar todos</h5>";
    }
    ?>
    <div style="margin: auto; max-width: 800px;" class="table-responsive panel panel-default">
    <table width=100% class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Raca</th>
            <th scope="col">Dono</th>
            <th></th>
        </tr>
    </thead>
        <?php
            if ($contadorConsultaPet > 0) {
                while ($linhaPet = mysqli_fetch_assoc($resultadoConsultaPet)) {
                    $nome = $linhaPet['nome'];
                    $raca = $linhaPet['raca'];
                    $id = $linhaPet['id'];
                    $ativo = $linhaPet['ativo'];
                    $dono = $linhaPet['dono'];

                    echo "<tr>
                        <td width=50%>$nome</td>
                        <td width=30%>$raca</td>
                        <td width=30%>$dono</td>";
                    if ($ativo == 1) {
                        echo "
                        <td width=10% align=center><a href='http://www.petline.com.br/consulta/detalha_pet.php?id=$id' class='btn btn-warning'><span class='glyphicon glyphicon-pencil'></span> Alterar</a></td>";?>
                        <td width=10% align=center><a href="#" onclick="if(confirm('Tem certeza que deseja desativar o PET?')) <?php echo "window.location.href = 'http://www.petline.com.br/consulta/altera_pet.php?cod=$id&ex=1';" ?> ; return false" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Desativar</a></td>
                        <?php echo "</tr>";
                    }else{
                        echo "
                        <td width=20% colspan=2 align=center><a href='http://www.petline.com.br/consulta/altera_pet.php?cod=$id' class='btn btn-success'><span class='glyphicon glyphicon-ok'></span> Ativar</a></td>
                        </tr>";
                    }
                }
            }else{
                echo "<h4>Não existem pets cadastrados</h4>";
            }
        ?>
    </table>
    <div align="center">
        <h4>Para adicionar um novo PET <a href="http://www.petline.com.br/cadastro_pet.php"><b>Clique Aqui</b></a></h4>
    </div>
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
                    <a href="http://www.petline.com.br/consulta/consulta_pet.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                <?php }else{ ?>
                    <span aria-hidden="true">&laquo;</span>
            <?php }  ?>
            </li>
            <?php 
            //Apresentar a paginacao
            for($i = 1; $i < $num_pagina + 1; $i++){ ?>
                <li><a href="http://www.petline.com.br/consulta/consulta_pet.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <li>
                <?php
                if($pagina_posterior <= $num_pagina){ ?>
                    <a href="http://www.petline.com.br/consulta/consulta_pet.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                <?php }else{ ?>
                    <span aria-hidden="true">&raquo;</span>
            <?php }  ?>
            </li>
        </ul>
    </nav>
</div>

<?php
include "../rodape.php";
?>