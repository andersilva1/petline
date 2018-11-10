<?php
include "cabecalho.php";
?>
<div id="conteudo">
<div class="container">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Cadastre seu PET</h2>
        </div>
        <form action="cadastra_pet.php" method="post" name="cadastro_pet" id="cadastro_pet">
            <div class="form-row">
                <div class="col-md-12">
                    <label for="nome_pet">Nome</label>
                    <input type="text" class="form-control" name="nome_pet" maxlength="50" id="nome_pet">
                </div>

                <div class="clearfix"></div>

                <div class="col-md-4">
                    <label for="raca">Raça</label>
                    <select name="raca" class="form-control" style="width:100%" id="raca">
                        <option value="" selected>Selecione...</option>
                        <option value="Afegao Hound">Afegão Hound</option>
                        <option value="Affenpinscher">Affenpinscher</option>
                        <option value="Airedale Terrier">Airedale Terrier</option>
                        <option value="Akita">Akita</option>
                        <option value="American Staffordshire Terrier">American Staffordshire Terrier</option>
                        <option value="Basenji">Basenji</option>
                        <option value="Basset Hound">Basset Hound</option>
                        <option value="Beagle">Beagle</option>
                        <option value="Beagle Harrier">Beagle Harrier</option>
                        <option value="Bearded Collie">Bearded Collie</option>
                        <option value="Bedlington Terrier">Bedlington Terrier</option>
                        <option value="Bichon Frise">Bichon Frisé</option>
                        <option value="Bloodhound">Bloodhound</option>
                        <option value="Bobtail">Bobtail</option>
                        <option value="Boiadeiro Australiano">Boiadeiro Australiano</option>
                        <option value="Boiadeiro Bernês">Boiadeiro Bernês</option>
                        <option value="Border Collie">Border Collie</option>
                        <option value="Border Terrier">Border Terrier</option>
                        <option value="Borzoi">Borzoi</option>
                        <option value="Boston Terrier">Boston Terrier</option>
                        <option value="Boxer">Boxer</option>
                        <option value="Buldogue Francês">Buldogue Francês</option>
                        <option value="Buldogue Inglês">Buldogue Inglês</option>
                        <option value="Bull Terrier">Bull Terrier</option>
                        <option value="Bulmastife">Bulmastife</option>
                        <option value="Cairn Terrier">Cairn Terrier</option>
                        <option value="Cane Corso">Cane Corso</option>
                        <option value="Cao de Agua Portugues">Cão de Água Português</option>
                        <option value="Cao de Crista Chines">Cão de Crista Chinês</option>
                        <option value="Cavalier King Charles Spaniel">Cavalier King Charles Spaniel</option>
                        <option value="Chesapeake Bay Retriever">Chesapeake Bay Retriever</option>
                        <option value="Chihuahua">Chihuahua</option>
                        <option value="Chow Chow">Chow Chow</option>
                        <option value="Cocker Spaniel Americano">Cocker Spaniel Americano</option>
                        <option value="Cocker Spaniel Ingles">Cocker Spaniel Inglês</option>
                        <option value="Collie">Collie</option>
                        <option value="Coton de Tulear">Coton de Tuléar</option>
                        <option value="Dachshund">Dachshund</option>
                        <option value="Dalmata">Dálmata</option>
                        <option value="Dandie Dinmont Terrier">Dandie Dinmont Terrier</option>
                        <option value="Doberman">Doberman</option>
                        <option value="Dogo Argentino">Dogo Argentino</option>
                        <option value="Dogue Alemão">Dogue Alemão</option>
                        <option value="Fila Brasileiro">Fila Brasileiro</option>
                        <option value="Fox Terrier">Fox Terrier (Pelo Duro e Pelo Liso)</option>
                        <option value="Foxhound Ingles">Foxhound Inglês</option>
                        <option value="Galgo Escoces">Galgo Escocês</option>
                        <option value="Galgo Irlandes">Galgo Irlandês</option>
                        <option value="Golden Retriever">Golden Retriever</option>
                        <option value="Grande Boiadeiro Suico">Grande Boiadeiro Suiço</option>
                        <option value="Greyhound">Greyhound</option>
                        <option value="Grifo da Belgica">Grifo da Bélgica</option>
                        <option value="Husky Siberiano">Husky Siberiano</option>
                        <option value="Jack Russell Terrier">Jack Russell Terrier</option>
                        <option value="King Charles">King Charles</option>
                        <option value="Komondor">Komondor</option>
                        <option value="Labradoodle">Labradoodle</option>
                        <option value="Labrador Retriever">Labrador Retriever</option>
                        <option value="Lakeland Terrier">Lakeland Terrier</option>
                        <option value="Leonberger">Leonberger</option>
                        <option value="Lhasa Apso">Lhasa Apso</option>
                        <option value="Lulu da Pomerania">Lulu da Pomerânia</option>
                        <option value="Malamute do Alasca">Malamute do Alasca</option>
                        <option value="Maltes">Maltês</option>
                        <option value="Mastife">Mastife</option>
                        <option value="Mastim Napolitano">Mastim Napolitano</option>
                        <option value="Mastim Tibetano">Mastim Tibetano</option>
                        <option value="Norfolk Terrier">Norfolk Terrier</option>
                        <option value="Norwich Terrier">Norwich Terrier</option>
                        <option value="Papillon">Papillon</option>
                        <option value="Pastor Alemao">Pastor Alemão</option>
                        <option value="Pastor Australiano">Pastor Australiano</option>
                        <option value="Pinscher Miniatura">Pinscher Miniatura</option>
                        <option value="Poodle">Poodle</option>
                        <option value="Pug">Pug</option>
                        <option value="Rottweiler">Rottweiler</option>
                        <option value="Sem Raca Definida">Sem Raça Definida (SRD)</option>
                        <option value="ShihTzu">ShihTzu</option>
                        <option value="Silky Terrier">Silky Terrier</option>
                        <option value="Skye Terrier">Skye Terrier</option>
                        <option value="Staffordshire Bull Terrier">Staffordshire Bull Terrier</option>
                        <option value="Terra Nova">Terra Nova</option>
                        <option value="Terrier Escoces">Terrier Escocês</option>
                        <option value="Tosa">Tosa</option>
                        <option value="Weimaraner">Weimaraner</option>
                        <option value="Welsh Corgi (Cardigan)">Welsh Corgi (Cardigan)</option>
                        <option value="Welsh Corgi (Pembroke)">Welsh Corgi (Pembroke)</option>
                        <option value="West Highland White Terrier">West Highland White Terrier</option>
                        <option value="Whippet">Whippet</option>
                        <option value="Xoloitzcuintli">Xoloitzcuintli</option>
                        <option value="Yorkshire Terrier">Yorkshire Terrier</option>
                    </select>
                </div>

                <div class="col-md-1">
                    <label for="peso">Peso</label>
                    <input type="number" class="form-control" name="peso" id="peso">
                </div>

                <div class="clearfix"></div>

                <div class="col-md-4">
                    <label for="cor">Cor</label>
                    <select name="cor" class="form-control" style="width:100%" id="cor">
                        <option value="0" selected>Selecione...</option>
                        <option value="Amarelo">Amarelo</option>
                        <option value="Azul">Azul</option>
                        <option value="Branco">Branco</option>
                        <option value="Chocolate">Chocolate</option>
                        <option value="Cinzento">Cinzento</option>
                        <option value="Creme">Creme</option>
                        <option value="Dourado">Dourado</option>
                        <option value="Preto">Preto</option>
                        <option value="Vermelho">Vermelho</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="dt_nascimento">Data de Nascimento</label>
                    <input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento" min="1990-01-01" max="2018-12-31">
                </div>

                <div class="form-row">
                    <div class="col-md-8">
                    <label for="descricao_pet">Descrição</label>
                        <p><textarea class="form-control" name="descricao_pet" id="descricao_pet" cols="148" rows="10" maxlength="255" placeholder="Escreva uma breve descrição do seu pet"></textarea></p>
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
<?php include "rodape.php"; ?>