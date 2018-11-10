<?php
include "../cabecalho.php";
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

$sqlConsultaUsuarios = "SELECT id, CONCAT(nome, ' ', sobrenome) AS nome, login, ativo, perfil FROM usuario";
$resultadoConsultaUsuarios = mysqli_query($conn,$sqlConsultaUsuarios);
$contadorConsultaUsuarios = mysqli_num_rows($resultadoConsultaUsuarios);

$quantidade_pg = 10;

$num_pagina = ceil($contadorConsultaUsuarios/$quantidade_pg);

$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

if (isset($_GET['busca'])) {
    $busca = $_GET['busca'];
    $sqlConsultaUsuario = "SELECT id, CONCAT(nome, ' ', sobrenome) AS nome, login, ativo, perfil FROM usuario WHERE CONCAT(nome, ' ', sobrenome) LIKE '%$busca%' LIMIT $incio, $quantidade_pg";
}else{
    $sqlConsultaUsuario = "SELECT id, CONCAT(nome, ' ', sobrenome) AS nome, login, ativo, perfil FROM usuario LIMIT $incio, $quantidade_pg";
}
$resultadoConsultaUsuario = mysqli_query($conn,$sqlConsultaUsuario);
$contadorConsultaUsuario = mysqli_num_rows($resultadoConsultaUsuario);
?>
<div id="conteudo">
<div class="container">
    <div class="page-header">
        <h2>Usuários Cadastrados</h2>
    </div>
    <br>

    <form action="consulta_usuario.php" method="get">
    <div style="margin: auto; max-width: 300px;" align="right">
        <table>
            <tr>
                <td width=100%><input type="text" class="form-control" id="busca" name="busca" placeholder="Pesquise pelo nome"></td>
                <td><button type="submit" class="btn btn-primary" id="busca"><span class="glyphicon glyphicon-search"></span></button></td>
            <tr>
        </table>
    </div>
    </form>

    <?php
    if (isset($_GET['busca'])) {
        $busca = $_GET['busca'];
        echo "<h5 style= 'text-align: center;'>Exibindo $contadorConsultaUsuario resultado(s) para '$busca'. <a href='consulta_usuario.php'> <b>Clique aqui</b> </a> para listar todos</h5>";
    }
    ?>

    <div class="table-responsive panel panel-default">
        <table width=100% class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Login</th>
                <th scope="col">Perfil</th>
                <th></th>
            </tr>
        </thead>
            <?php
                if ($contadorConsultaUsuario > 0) {
                    while ($linhaUsuario = mysqli_fetch_assoc($resultadoConsultaUsuario)) {
                        $nome = $linhaUsuario['nome'];
                        $login = $linhaUsuario['login'];
                        $id = $linhaUsuario['id'];
                        $ativo = $linhaUsuario['ativo'];
                        $perfil = $linhaUsuario['perfil'];

                        echo "<tr>
                            <td width=40%>$nome</td>
                            <td width=20%>$login</td>
                            <td width=20%>$perfil</td>";
                        if ($ativo == 1) {
                            echo "
                            <td width=10% align=center><a href='http://www.petline.com.br/consulta/detalha_usuario.php?id=$id' class='btn btn-warning'><span class='glyphicon glyphicon-pencil'></span> Alterar</a></td>";?>
                            <td width=10% align=center><a href="http://www.petline.com.br/consulta/deleta_usuario.php" onclick="if(confirm('Tem certeza que deseja desativar o usuário?')) <?php echo "window.location.href = 'http://www.petline.com.br/consulta/deleta_usuario.php?cod=$id';" ?> ; return false" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Desativar</a></td>
                            <?php echo "</tr>";
                        }else{
                            echo "
                            <td width=20% colspan=2 align=center><a href='http://www.petline.com.br/consulta/ativa_usuario.php?cod=$id' class='btn btn-success'><span class='glyphicon glyphicon-ok'></span> Ativar</a></td>
                            </tr>";
                        }
                    }
                }else{
                    echo "<h4>Usuário não encontrado</h4>";
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
                    <a href="http://www.petline.com.br/consulta/consulta_usuario.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                <?php }else{ ?>
                    <span aria-hidden="true">&laquo;</span>
            <?php }  ?>
            </li>
            <?php 
            //Apresentar a paginacao
            for($i = 1; $i < $num_pagina + 1; $i++){ ?>
                <li><a href="http://www.petline.com.br/consulta/consulta_usuario.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <li>
                <?php
                if($pagina_posterior <= $num_pagina){ ?>
                    <a href="http://www.petline.com.br/consulta/consulta_usuario.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                <?php }else{ ?>
                    <span aria-hidden="true">&raquo;</span>
            <?php }  ?>
            </li>
        </ul>
    </nav>
</div>
</div>
<?php
include "../rodape.php";
?>