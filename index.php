<?php
include "cabecalho.php";
$perfil = $_SESSION['perfil'];
$id = $_SESSION['id'];

if ($perfil == 'pas') {
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    
    $sqlIndexPasseadores = "SELECT DISTINCT
    CONCAT(U1.nome,' ',U1.sobrenome) as cliente_passeio,
    P.dt_passeio,
    P.hora_inicio,
	P.hora_fim,
    PE.nome as nome_pet,
    P.ativo as passeio_realizado,
    P.id as id_pacote,
    P.pet_pego
    FROM servico S
    INNER JOIN usuario U ON (S.id_passeador = U.id AND U.perfil = 'pas')
    INNER JOIN usuario U1 ON (S.id_cliente = U1.id AND U1.perfil = 'cli')
    INNER JOIN pacote P ON (P.id_usuario = U1.id)
    INNER JOIN pet PE ON (PE.id = S.id_pet)
    WHERE
    U.id = $id
    AND PE.ativo = 1
    AND P.ativo = 1";
    $resultadoSqlIndexPasseadores = mysqli_query($conn,$sqlIndexPasseadores);
    $contadorIndexPasseadores = mysqli_num_rows($resultadoSqlIndexPasseadores);

    $quantidade_pg = 10;
    $num_pagina = ceil($contadorIndexPasseadores/$quantidade_pg);
    $incio = ($quantidade_pg*$pagina)-$quantidade_pg;

    $sqlIndexPasseador = "SELECT DISTINCT
    CONCAT(U1.nome,' ',U1.sobrenome) as cliente_passeio,
    P.dt_passeio,
    P.hora_inicio,
	P.hora_fim,
    PE.nome as nome_pet,
    P.ativo as passeio_realizado,
    P.id as id_pacote,
    P.pet_pego
    FROM servico S
    INNER JOIN usuario U ON (S.id_passeador = U.id AND U.perfil = 'pas')
    INNER JOIN usuario U1 ON (S.id_cliente = U1.id AND U1.perfil = 'cli')
    INNER JOIN pacote P ON (P.id_usuario = U1.id)
    INNER JOIN pet PE ON (PE.id = S.id_pet)
    WHERE
    U.id = $id
    AND PE.ativo = 1
    AND P.ativo = 1
    LIMIT $incio, $quantidade_pg";
    $resultadoSqlIndexPasseador = mysqli_query($conn,$sqlIndexPasseador);
    $contadorIndexPasseador = mysqli_num_rows($resultadoSqlIndexPasseador);
?>
<div id="conteudo">
<div class="container">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Passeios a Serem Realizados</h2>
        </div>
        <div class="panel panel-default">
        
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">Data Passeio</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Termino</th>
                    <th scope="col">Nome Pet</th>
                    <th scope="col">Passeio Iniciado?</th>
                    <th scope="col">Passeio Realizado?</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                if ($contadorIndexPasseador > 0) {
                    while ($linhaIndexPasseador = mysqli_fetch_assoc($resultadoSqlIndexPasseador)) {
                        $id_pacote = $linhaIndexPasseador['id_pacote'];
                        $cliente_passeio = $linhaIndexPasseador['cliente_passeio'];
                        $dt_passeio = $linhaIndexPasseador['dt_passeio'];
                        $hora_inicio = $linhaIndexPasseador['hora_inicio'];
                        $hora_fim = $linhaIndexPasseador['hora_fim'];
                        $nome_pet = $linhaIndexPasseador['nome_pet'];
                        $pet_pego = $linhaIndexPasseador['pet_pego'];

                        echo "<tr>
                            <td width=20%>$cliente_passeio</td>
                            <td width=10%>$dt_passeio</td>
                            <td width=10%>$hora_inicio</td>
                            <td width=10%>$hora_fim</td>
                            <td width=10%>$nome_pet</td>";
                            if ($pet_pego == 1) {
                                echo "<td></td>";
                            }else{
                                ?>
                            <td style="width:10%; align:center;"><a href="#" onclick="if(confirm('Tem certeza que deseja iniciar esse passeio?')) <?php echo "window.location.href = 'http://www.petline.com.br/inicia_passeio.php?id=$id_pacote';" ?> ; return false" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a></td>
                            <?php } ?>
                            <td style="width:10%; align:center;"><a href="#" onclick="if(confirm('Tem certeza que deseja finalizar esse passeio?')) <?php echo "window.location.href = 'http://www.petline.com.br/finaliza_passeio.php?id=$id_pacote';" ?> ; return false" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a></td>
                            <?php echo "</tr>";
                    }
                }else{
                    echo "<h4>Não existem PETs cadastrados</h4>";
                }
            ?>                 
            </tbody>
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
                        <a href="index.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    <?php }else{ ?>
                        <span aria-hidden="true">&laquo;</span>
                <?php }  ?>
                </li>
                <?php 
                //Apresentar a paginacao
                for($i = 1; $i < $num_pagina + 1; $i++){ ?>
                    <li><a href="index.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <li>
                    <?php
                    if($pagina_posterior <= $num_pagina){ ?>
                        <a href="index.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
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
</div>

    <br>
    <?php
    include "noticias.php";
    ?>
<?php }else if ($perfil == 'cli'){
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

    $sqlIndexClientes = "SELECT DISTINCT
    CONCAT(U.nome,' ',U.sobrenome) as passeador,
    P.dt_passeio,
    P.hora_inicio,
    P.hora_fim,
    PE.nome as nome_pet,
    P.ativo as passeio_realizado,
    P.id as id_pacote
    FROM servico S
    INNER JOIN usuario U ON (S.id_passeador = U.id AND U.perfil = 'pas')
    INNER JOIN usuario U1 ON (S.id_cliente = U1.id AND U1.perfil = 'cli')
    INNER JOIN pacote P ON (P.id_usuario = U1.id)
    INNER JOIN pet PE ON (PE.id = S.id_pet)
    WHERE
    U1.id = $id
    AND PE.ativo = 1
    AND P.ativo = 1";
    $resultadoSqlIndexClientes = mysqli_query($conn,$sqlIndexClientes);
    $contadorIndexClientes = mysqli_num_rows($resultadoSqlIndexClientes);

    $quantidade_pg = 10;
    $num_pagina = ceil($contadorIndexClientes/$quantidade_pg);
    $incio = ($quantidade_pg*$pagina)-$quantidade_pg;

    $sqlIndexCliente = "SELECT DISTINCT
    CONCAT(U.nome,' ',U.sobrenome) as passeador,
    P.dt_passeio,
    P.hora_inicio,
    P.hora_fim,
    PE.nome as nome_pet,
    P.ativo as passeio_realizado,
    P.id as id_pacote
    FROM servico S
    INNER JOIN usuario U ON (S.id_passeador = U.id AND U.perfil = 'pas')
    INNER JOIN usuario U1 ON (S.id_cliente = U1.id AND U1.perfil = 'cli')
    INNER JOIN pacote P ON (P.id_usuario = U1.id)
    INNER JOIN pet PE ON (PE.id = S.id_pet)
    WHERE
    U1.id = $id
    AND PE.ativo = 1
    AND P.ativo = 1
    LIMIT $incio, $quantidade_pg";
    $resultadoSqlIndexCliente = mysqli_query($conn,$sqlIndexCliente);
    $contadorIndexCliente = mysqli_num_rows($resultadoSqlIndexCliente);
    ?>
<div id="conteudo">
    <div class="container">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Passeios a Serem Realizados</h2>
            </div>
            <div class="panel panel-default">
            
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Passeador</th>
                        <th scope="col">Data Passeio</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Termino</th>
                        <th scope="col">Nome Pet</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    if ($contadorIndexCliente > 0) {
                        while ($linhaIndexCliente = mysqli_fetch_assoc($resultadoSqlIndexCliente)) {
                            $passeador = $linhaIndexCliente['passeador'];
                            $dt_passeio = $linhaIndexCliente['dt_passeio'];
                            $hora_inicio = $linhaIndexCliente['hora_inicio'];
                            $hora_fim = $linhaIndexCliente['hora_fim'];
                            $nome_pet = $linhaIndexCliente['nome_pet'];
    
                            echo "<tr>
                                <td width=20%>$passeador</td>
                                <td width=10%>$dt_passeio</td>
                                <td width=10%>$hora_inicio</td>
                                <td width=10%>$hora_fim</td>
                                <td width=10%>$nome_pet</td>
                                </tr>";
                        }
                    }else{
                        echo "<h4>Não existem passeios a serem realizados</h4>";
                    }
                ?>                 
                </tbody>
                </table>
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
                        <a href="index.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    <?php }else{ ?>
                        <span aria-hidden="true">&laquo;</span>
                <?php }  ?>
                </li>
                <?php 
                //Apresentar a paginacao
                for($i = 1; $i < $num_pagina + 1; $i++){ ?>
                    <li><a href="index.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <li>
                    <?php
                    if($pagina_posterior <= $num_pagina){ ?>
                        <a href="index.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
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
    <br>
    <?php
    include "noticias.php";
    ?>
<?php }else{
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

    $sqlIndexAdms = "SELECT DISTINCT
    CONCAT(U.nome,' ',U.sobrenome) as passeador,
    CONCAT(U1.nome,' ',U1.sobrenome) as cliente,
    P.dt_passeio,
    P.hora_inicio,
    P.hora_fim,
    PE.nome as nome_pet,
    P.ativo as passeio_realizado,
    P.id as id_pacote
    FROM servico S
    INNER JOIN usuario U ON (S.id_passeador = U.id AND U.perfil = 'pas')
    INNER JOIN usuario U1 ON (S.id_cliente = U1.id AND U1.perfil = 'cli')
    INNER JOIN pacote P ON (P.id_usuario = U1.id)
    INNER JOIN pet PE ON (PE.id = S.id_pet)
    WHERE
    PE.ativo = 1
    AND P.ativo = 1";
    $resultadoSqlIndexAdms = mysqli_query($conn,$sqlIndexAdms);
    $contadorIndexAdms = mysqli_num_rows($resultadoSqlIndexAdms);

    $quantidade_pg = 10;
    $num_pagina = ceil($contadorIndexAdms/$quantidade_pg);
    $incio = ($quantidade_pg*$pagina)-$quantidade_pg;

    if (isset($_GET['data_inicio']) and isset($_GET['data_fim'])) {
        $data_inicio = $_GET['data_inicio'];
        $data_fim = $_GET['data_fim'];
    }

    $sqlIndexAdmSelect = "SELECT DISTINCT
    CONCAT(U.nome,' ',U.sobrenome) as passeador,
    CONCAT(U1.nome,' ',U1.sobrenome) as cliente,
    P.dt_passeio,
    P.hora_inicio,
    P.hora_fim,
    PE.nome as nome_pet,
    P.ativo as passeio_realizado,
    P.id as id_pacote
    FROM servico S
    INNER JOIN usuario U ON (S.id_passeador = U.id AND U.perfil = 'pas')
    INNER JOIN usuario U1 ON (S.id_cliente = U1.id AND U1.perfil = 'cli')
    INNER JOIN pacote P ON (P.id_usuario = U1.id)
    INNER JOIN pet PE ON (PE.id = S.id_pet)
    WHERE
    PE.ativo = 1
    AND P.ativo = 1 ";

    if (isset($_GET['data_inicio']) and isset($_GET['data_fim'])) {
        $sqlIndexAdmWhere = "AND dt_passeio BETWEEN '$data_inicio' AND '$data_fim' ";
    }else{
        $sqlIndexAdmWhere = "";
    }

    $sqlIndexPaginacao = "LIMIT $incio, $quantidade_pg";

    $sqlIndexAdm = $sqlIndexAdmSelect . $sqlIndexAdmWhere . $sqlIndexPaginacao;
    $resultadoSqlIndexAdm = mysqli_query($conn,$sqlIndexAdm);
    $contadorIndexAdm = mysqli_num_rows($resultadoSqlIndexAdm);
    ?>
<div id="conteudo">
    <div class="container">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Próximos Passeios</h2>
            </div>
            </div>
            <form action="index.php?busca" method="get">
            <div style="margin: auto; max-width: 300px;" align="right">
                <table>
                    <tr>
                        <td style="text-align: center;" colspan=5>Busca por Data</td>
                    </tr>
                    <tr>
                    <td>De:</td>
                    <td><input type="date" class="form-control" id="data_inicio" name="data_inicio" min="2018-01-01" max="2018-12-31"></td>
                    <td>Até:</td>
                    <td><input type="date" class="form-control" id="data_fim" name="data_fim" min="2018-01-01" max="2018-12-31"></td>
                    <td><button type="submit" class="btn btn-primary" id="busca"><span class="glyphicon glyphicon-search"></span></button></td>
                    </tr>
                </table>
            </div>
            </form>

            <?php
            if (isset($_GET['data_inicio']) and isset($_GET['data_fim'])) {
                
                echo "<h5 style= 'text-align: center;'>Exibindo $contadorIndexAdm resultado(s) entre '$data_inicio' e '$data_fim'. <a href='index.php'> <b>Clique aqui</b> </a> para listar todos</h5>";
            }
            ?>
            <div class="panel panel-default">
            
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Passeador</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Nome Pet</th>
                        <th scope="col">Data Passeio</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Termino</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    if ($contadorIndexAdm > 0) {
                        while ($linhaIndexAdm = mysqli_fetch_assoc($resultadoSqlIndexAdm)) {
                            $passeador = $linhaIndexAdm['passeador'];
                            $cliente = $linhaIndexAdm['cliente'];
                            $nome_pet = $linhaIndexAdm['nome_pet'];
                            $dt_passeio = $linhaIndexAdm['dt_passeio'];
                            $hora_inicio = $linhaIndexAdm['hora_inicio'];
                            $hora_fim = $linhaIndexAdm['hora_fim'];
    
                            echo "<tr>
                                <td width=20%>$passeador</td>
                                <td width=20%>$cliente</td>
                                <td width=10%>$nome_pet</td>
                                <td width=10%>$dt_passeio</td>
                                <td width=10%>$hora_inicio</td>
                                <td width=10%>$hora_fim</td>
                                </tr>";
                        }
                    }else{
                        echo "<h4>Não existem passeios a serem realizados</h4>";
                    }
                ?>                 
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
        $flagBusca = 0;

        if (isset($_GET['data_inicio']) and isset($_GET['data_fim'])) {
            $flagBusca = 1;
        }

        //Verificar a pagina anterior e posterior
        $pagina_anterior = $pagina - 1;
        $pagina_posterior = $pagina + 1;
    ?>
    <nav class="text-center">
        <ul class="pagination">
            <li>
                <?php
                if($pagina_anterior != 0){ ?>
                    <a href="index.php?pagina=<?php echo $pagina_anterior; if($flagBusca == 1){ echo "&data_inicio=$data_inicio&data_fim=$data_fim";}?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                <?php }else{ ?>
                    <span aria-hidden="true">&laquo;</span>
            <?php }  ?>
            </li>
            <?php 
            //Apresentar a paginacao
            for($i = 1; $i < $num_pagina + 1; $i++){ ?>
                <li><a href="index.php?pagina=<?php echo $i; if($flagBusca == 1){ echo "&data_inicio=$data_inicio&data_fim=$data_fim";}?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <li>
                <?php
                if($pagina_posterior <= $num_pagina){ ?>
                    <a href="index.php?pagina=<?php echo $pagina_posterior; if($flagBusca == 1){ echo "&data_inicio=$data_inicio&data_fim=$data_fim";}?>" aria-label="Previous">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                <?php }else{ ?>
                    <span aria-hidden="true">&raquo;</span>
            <?php }  ?>
            </li>
        </ul>
    </nav>
<?php } ?>
</div>
<br>
<?php
include "rodape.php";
?>