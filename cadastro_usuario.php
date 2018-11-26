<script>

    function validateNumber(evt) {
        var e = evt || window.event;
        var key = e.keyCode || e.which;

        if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
        // numbers   
        key >= 48 && key <= 57 ||
        // Numeric keypad
        key >= 96 && key <= 105 ||
        // Backspace and Tab and Enter
        key == 8 || key == 9 || key == 13 ||
        // Home and End
        key == 35 || key == 36 ||
        // left and right arrows
        key == 37 || key == 39 ||
        // Del and Ins
        key == 46 || key == 45) {
            // input is VALID
        }
        else {
            // input is INVALID
            e.returnValue = false;
            if (e.preventDefault) e.preventDefault();
        }
    }

</script>

<script type="text/javascript" >
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

</script>

<script type="text/javascript">

function VerificaCPF () {
    if (vercpf(document.cadastro_usuario.cpf.value)) 
    { //CPF valido
    }else {
        alert('CPF NÃO VÁLIDO');
        document.cadastro_usuario.cpf.value="";
        document.cadastro_usuario.cpf.focus();
    }

}

function vercpf (cpf) {

    cpf = cpf.replace('.','');
    cpf = cpf.replace('.','');
    cpf = cpf.replace('-','');

    if (cpf.length == 0){
        return true;
    }else{
    if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
    return false;
    add = 0;
    for (i=0; i < 9; i ++)
    add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
    rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
    return false;
    add = 0;
    for (i = 0; i < 10; i ++)
    add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
    rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
    return false;
    return true;
    }
}

</script>

<script>
function teste(e)
	{
		var expressao;

		expressao = /[0-9]/;

		if(expressao.test(String.fromCharCode(e.keyCode)))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
</script>

<?php

$pc = 0;

if (isset($_GET['cod'])) {
    
    $pc = 1;
    echo 
    "<html>
        <head>
            <link rel='stylesheet' href='css/bootstrap.min.css'>

            <!-- jQuery library -->
            <script src='http://code.jquery.com/jquery-1.9.1.js'></script>

            <script src='js/valida_form.js?29'></script>
            <script src='js/check-letters-numbers.js?2'></script>
            <script type='text/javascript' src='js/jquery.mask.min.js'></script>
            
            <!-- Latest compiled JavaScript -->
            <script src='js/bootstrap.min.js'></script>
            <link rel='stylesheet'' href='css/estilos.css'>

        </head>
    <body>";

    include "conexao.php";
}else {
    include "cabecalho.php";
}
?>

<header>
    <div id="topo">
        <center>
        <img src="img/logo4.png" alt="logo petline" style="width: 15%;" >
            </center>
    </div>
</header>

    <div class="container">

        <div class="col-md-12">
            
            <div class="page-header">
                <h2> <span style="font-size: 35; font-family: helvetica; font-weight: 900; color: black">Cadastre-se</span></h2>
                         </div>
        
<?php
            
    echo "<form action='cadastra_usuario.php?pc=$pc' method='post' name='cadastro_usuario' id='cadastro_usuario'>";
?>
                       
            <div class="form-row">

                <div class="col-md-6">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" maxlength="255" id="nome" onKeypress="return teste(event);">
                </div>

                <div class="col-md-6">
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" class="form-control" name="sobrenome" maxlength="255" id="sobrenome" onKeypress="return teste(event);">
                </div>

            </div>

             <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" onblur="validacaoEmail(event)" maxlength="60" size='65' placeholder="exemplo@exemplo.com">
            </div>

            <div class="form-group col-md-6">
                <label for="dt_nascimento">Data de Nascimento</label>
                <input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento" min="1900-01-01" max="2018-12-31" required>
            </div>

            <div class="form-group col-md-6">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" name="telefone" maxlength="50" id="telefone" onkeydown="validateNumber(event);" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" placeholder="Apenas Números">
                <script type="text/javascript">$("#telefone").mask("(00) 00000-0009");</script>
            </div>

            <div class="clearfix"></div>

            <div class="form-row">

                <div class="col-md-6">
                    <label for="rg">RG</label>
                    <input type="text" class="form-control" name="rg" maxlength="11" id="rg" onkeydown=validateNumber(event); pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" placeholder="Apenas Números">
                </div>

                <div class="col-md-6">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" name="cpf" size="14" maxlength="11" id="cpf" onkeydown="validateNumber(event);" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" onblur="VerificaCPF();" placeholder="Apenas Números">
                    <script type="text/javascript">$("#cpf").mask("000.000.000-00");</script>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" id="cep" value="" size="10" maxlength="9"  class="form-control" onkeydown="validateNumber(event);" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" onblur="pesquisacep(this.value);" placeholder="Apenas Números">
                    <script type="text/javascript">$("#cep").mask("00000-000");</script>
                </div>
                <div class="form-group col-md-6">
                    <label for="rua">Endereço</label>
                    <input type="text" name="rua" id="rua"  class="form-control" placeholder="Preenchimento Automático">
                </div>
                <div class="form-group col-md-4">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" id="bairro"  class="form-control" placeholder="Preenchimento Automático">
                </div>
            </div>

            <div class="form-group col-md-8">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" name="cidade" maxlength="255" id="cidade" placeholder="Preenchimento Automático">
            </div>

            <div class="form-group col-md-4">
                <label for="uf">Estado</label>
                <input type="text" class="form-control" name="uf" maxlength="2" id="uf" placeholder="Preenchimento Automático">
            </div>

            <div class="form-group col-md-6">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" maxlength="15" id="login" onblur="alphanumeric(document.cadastro_usuario.login)" placeholder="Apenas letras e números">
            </div>

            <div class="clearfix"></div>

            <div class="form-group col-md-6">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" name="senha" maxlength="50" id="senha" placeholder="Apenas letras e números">
            </div>

            <div class="form-group col-md-6">
                <label for="senha2">Confirme Sua Senha</label>
                <input type="password" class="form-control" name="senha2" maxlength="50" id="senha2" placeholder="Apenas letras e números">
            </div>

            <div class="form-group col-md-12">
                <label for="perfil">Perfil</label>
                
                <select name="perfil" class="form-control" style="width:15%" id="perfil">
                    <option value="0" selected>Selecione...</option>
                    <option value="cli">Cliente</option>
                    <option value="pas">Passeador</option>
                </select>
            </div>
            
            <div class="form-row">
                <div class="col-md-12">
                    <p><textarea class="form-control" name="descricao" id="descricao" cols="148" rows="10" placeholder="Descrição" maxlength="255"></textarea></p>
                </div>
            </div>

            <div class="form-row">

                <div class="col-md-6" align="left">
                    <a href="http://www.petline.com.br/index.php" class="btn btn-danger">Cancelar</a>
                </div>

                <div class="col-md-6" align="right">
                    <button type="button" class="btn btn-primary" id="salvar"> Salvar </button>
                </div>

            </div>

        </form>
            
<?php
include "rodape.php";
?>
