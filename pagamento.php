<?php

include "cabecalho.php";

$id = $_SESSION['id'];

$sqlPacote = "SELECT nome FROM pacote WHERE id_usuario = $id and ativo = 1 GROUP BY nome";
$resultadoSql = mysqli_query($conn,$sqlPacote);

while ($linhaSql = $resultadoSql -> fetch_array(MYSQLI_ASSOC)) {
    $nome = $linhaSql['nome'];

    switch ($nome) {
        case 'LINE_BASIC':
            $valor = 'R$ 339,72';
            $nomePacote = 'Line Basic';
            break;
        case 'RICH_DOG':
            $valor = 'R$ 482,76';
            $nomePacote = 'Rich Dog';
            break;
        case 'GOLDEN_DOG':
            $valor = 'R$ 835,89';
            $nomePacote = 'Golden Dog';
            break;
    }
}
?>
  <style type="text/css" media="screen">
    .has-error input {
      border-width: 2px;
    }

    .validation.text-danger:after {
      content: 'Número do cartão incorreto!';
    }

    .validation.text-success:after {
        content: 'Número do cartão correto!';
    }
  </style>
  <script>
    jQuery(function($) {
      $('[data-numeric]').payment('restrictNumeric');
      $('.cc-number').payment('formatCardNumber');
      $('.cc-exp').payment('formatCardExpiry');
      $('.cc-cvc').payment('formatCardCVC');

      $.fn.toggleInputError = function(erred) {
        this.parent('.form-group').toggleClass('has-error', erred);
        return this;
      };

      $('form').submit(function(e) {
        e.preventDefault();

        var cardType = $.payment.cardType($('.cc-number').val());
        $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
        $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
        $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
        $('.cc-brand').text(cardType);

        $('.validation').removeClass('text-danger text-success');
        $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
      });

    });
  </script>
<div id="conteudo">
<div class="container">
    <div class="page-header"><h2>Pagamento</h2> </div> 
    <form novalidate autocomplete="on" method="POST">
    <div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Nome Pacote</th>
                <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    echo "<tr>
                        <td width=20%>$nomePacote</td>
                        <td width=10%>$valor</td>";
                ?>          
            </tbody>
        </table>
        </div>
        <div class="form-group">
            <label for="opcao_pagamento">Forma de Pagamento</label> <br>
            <input type="radio" name="opcao_pagamento" checked> Cartão de Débito
        </div>
        <div class="form-group">
            <input type="radio" name="opcao_pagamento"> Cartão de Crédito
        </div>
        <div class="form-group">
            <label for="cc-name">Nome do Cartão</label>
            <input id="cc-name" type="text" class="form-control" placeholder="Nome completo" maxlenght="255">
        </div>

        <div class="form-group">
            <label for="cc-number" class="control-label">Número do Cartão<small class="text-muted">[<span class="cc-brand"></span>]</small></label>
            <input id="cc-number" type="tel" class="input form-control cc-number" autocomplete="cc-number" placeholder="0000 0000 0000 0000" required>
        </div>

        <div class="form-group">
            <label for="cc-exp" class="control-label">Ano e Mês de Expiração</label>
            <input id="cc-exp" type="tel" class="input form-control cc-exp" autocomplete="cc-exp" placeholder="00 / 00" required>
        </div>

        <div class="form-group">
            <label for="cc-cvc" class="control-label">Código de Verificação</label>
            <input id="cc-cvc" type="tel" class="input form-control cc-cvc" autocomplete="off" placeholder="0000" required>
        </div>

        <div class="col-md-6" align="left">
            <button type="submit" class="btn btn-primary">Validar Cartão</button>
        </div>
        
        <div class="col-md-6" align="right">
            <a onclick="if(confirm('Tem certeza que deseja confirmar o pagamento?')) <?php echo "window.location.href = 'http://www.petline.com.br/index.php';" ?> ; return false" class="btn btn-success"><span>Confirmar Pagamento</span></a>
        </div>

        <h2 class="validation"></h2>
        </form>
    </div>
</div>
<?php include "rodape.php"; ?>