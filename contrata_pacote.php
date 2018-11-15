<?php
include "cabecalho.php"
?>
<img src="../img/pagContrataPac.jpg" alt="Imagem titulo pagina de contratar pacotes" style="width:100%;">
<br></br>
<div id="conteudo">
<div class="container">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Contratação de Pacotes</h2>
        </div>
        <form action="contrata_dia.php" method="post" name="contrata_pacote" id="contrata_pacote">
            <div class="form-row">
                <div class="panel panel-default table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Pacote</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Preço</th>
                            </tr>
                        </thead>
                        <tr>
                            <td align="center" width="40px"><input type="radio" name="pacote_opcao" value="LINE_BASIC" checked></td>
                            <td width=20%>Line Basic</td>
                            <td width=60%>Este pacote dispõe de 8 (oito) passeios para pets e devem ser utilizados durante o mês de compra do mesmo. Trata-se do pacote mais básico disponibilizado pela PetLine, excelente escolha para clientes que utilizam o serviço em torno de duas vez por semana.</td>
                            <td width=15%>R$ 339,72</td>
                        </tr>
                        <tr>
                            <td align="center" width="40px" ><input type="radio" name="pacote_opcao" value="RICH_DOG"></td>
                            <td width=20%>Rich Dog</td>
                            <td width=60%>Este pacote dispõe de 12 (doze) passeios para pets e devem ser utilizados durante o mês de compra do mesmo. Trata-se do pacote intermediário da PetLine, perfeito para usuários que utilizam os passeios de uma a três vezes por semana. </td>
                            <td width=15%>R$ 482,76</td>
                        </tr>
                        <tr>
                            <td align="center" width="40px" ><input type="radio" name="pacote_opcao" value="GOLDEN_DOG"></td>
                            <td width=20%>Golden Dog</td>
                            <td width=60%>Este pacote dispõe de 22 (vinte e dois) passeios para pets e devem ser utilizados durante o mês de compra do mesmo. Trata-se do pacote mais completo da PetLine, para clientes que não possuem tempo para passear com os seus pets, esta opção é perfeita.</td>
                            <td width=15%>R$ 835,89</td>
                        </tr>
                    </table>
                </div>

                <div class="form-row">
                    <div align="right">
                        <button type="submit" class="btn btn-primary" name="envia_pacote">Avançar</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
</div>

<?php
include "rodape.php"
?>