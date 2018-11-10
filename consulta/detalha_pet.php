
<?php
include "../cabecalho.php";

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];

        $sqlConsultaPet = "SELECT nome, raca, peso, cor, dt_nascimento, descricao FROM pet WHERE id = $id";
        $resultadoConsultaPet = mysqli_query($conn,$sqlConsultaPet);
        $contadorConsultaPet = mysqli_num_rows($resultadoConsultaPet);

        if ($contadorConsultaPet != 0) {

            while ($linhaPet = $resultadoConsultaPet -> fetch_array(MYSQLI_ASSOC)) {
                $nome = utf8_encode($linhaPet['nome']);
                $raca = utf8_encode($linhaPet['raca']);
                $peso = $linhaPet['peso'];
                $cor = $linhaPet['cor'];
                $dt_nascimento = $linhaPet['dt_nascimento'];
                $descricao = utf8_encode($linhaPet['descricao']);
            }
        }
    }
?>
<div id="conteudo">
<div class="container">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Altere as informações do seu PET</h2>
        </div>
        <?php echo "<form action='http://www.petline.com.br/cadastra_pet.php?cod=$id' method='post' name='cadastro_pet' id='cadastro_pet'>";?>
            <div class="form-row">
                <div class="col-md-12">
                    <label for="nome_pet">Nome</label>
                    <input type="text" class="form-control" name="nome_pet" maxlength="255" id="nome_pet" value='<?php echo $nome; ?>'>
                </div>

                <div class="col-md-4">
                    <label for="raca">Raça</label>
                    <input type="text" class="form-control" name="raca" maxlength="255" id="raca" value='<?php echo $raca; ?>'>
                </div>

                <div class="col-md-1">
                    <label for="peso">Peso</label>
                    <input type="number" class="form-control" name="peso" maxlength="255" id="peso" value='<?php echo $peso; ?>'>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-4">
                    <label for="cor">Cor</label>
                    <input type="text" class="form-control" name="cor" maxlength="255" id="cor" value='<?php echo $cor; ?>'>
                </div>

                <div class="form-group col-md-4">
                    <label for="dt_nascimento">Data de Nascimento</label>
                    <input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento" value='<?php echo $dt_nascimento; ?>'>
                </div>

                <div class="clearfix"></div>

                <div class="form-row">
                    <div class="col-md-8">
                    <label for="descricao_pet">Descrição</label>
                        <p><textarea class="form-control" name="descricao_pet" id="descricao_pet" cols="148" rows="10" ><?php echo $descricao; ?></textarea></p>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6" align="left">
                        <a href="http://www.petline.com.br/index.php" class="btn btn-danger">Cancelar</a>
                    </div>

                    <div class="col-md-6" align="right">
                        <button type="button" class="btn btn-primary" id="salvar_pet">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<?php include "../rodape.php"; ?>