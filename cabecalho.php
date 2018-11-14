<?php
include "conexao.php";
include "valida_login.php";
$perfil = $_SESSION['perfil'];
$nome = $_SESSION['nome'];
$id = $_SESSION['id'];
?>

<html>
    <head>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

        <link rel="stylesheet" href="../css/petline.css">
        <link rel="stylesheet" href="../css/bootstrap-social.css">          

        <!-- jQuery library -->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>

        <script src="http://www.petline.com.br/js/valida_form.js?56"></script>

        <script src="http://www.petline.com.br/js/jquery.payment.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> 
    </head>

<body> <!--Inicio-->
<div class="background-image"></div>
<div class="wrapper">
  <!-- Sidebar Holder -->
  <nav id="sidebar">
    <div class="sidebar-header">
      <img src="../img/logo4.png" alt="" style="width:100%;">      
    </div>
    
    <ul class="list-unstyled components">
      <p>Olá, <?php echo $nome;?></p> <!--Nome do usuario logado-->
      <li class="active">
        <a href="http://www.petline.com.br/index.php">Inicio</a>
      </li>
      <!--Inicio validação para o menu, de acordo com o tipo de login-->
      <?php
        switch ($perfil) {
            case 'adm':
              echo "
                  <li>
                    <a href='http://www.petline.com.br/consulta/consulta_usuario.php'>Consulta Usuário</a>
                    <a href='http://www.petline.com.br/consulta/consulta_pet.php'>Consulta PETs</a>
                    <a href='http://www.petline.com.br/relatorio.php'>Relatórios</a>
                    <a href='#pageSubmenu' data-toggle='collapse' aria-expanded='false'>Históricos</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu'>
                      <li><a href='http://www.petline.com.br/historico.php'>Histórico Passeador</a></li>
                      <li><a href='http://www.petline.com.br/historico.php'>Histórico Cliente</a></li>          
                    </ul>
                  </li>";
                break;
                
              case 'pas':
                echo "
                  <li>
                    <a href='http://www.petline.com.br/cadastro_agenda.php'>Agenda</a>
                  </li>
                  <li>
                    <a href='http://www.petline.com.br/historico.php'>Histórico  de Passeios</a>
                  </li>
                  <li>
                    <a href='http://www.petline.com.br/relatorio.php'>Relatórios</a>
                  </li>";
                  break;

                case 'cli':
                  echo "
                      <li>
                        <a href='http://www.petline.com.br/consulta/consulta_pet.php'>Meus Pets</a>
                      </li>
                      <li>
                        <a href='http://www.petline.com.br/contrata_pacote.php'>Contratar Pacote</a>
                      </li>
                      <li>
                        <a href='http://www.petline.com.br/historico.php'>Histórico  de Passeios</a>
                      </li>
                      <li>
                        <a href='http://www.petline.com.br/relatorio.php'>Relatórios</a>
                      </li>";
                    break;
            }
      ?>    
    <!--Fim validação para o menu, de acordo com o tipo de login-->
        
  </ul>
</nav>

  <!-- Page Content Holder -->
  <div id="content">
    <!--Menu topo-->
    <nav class="navbar navbar-default">
      <div class="container-fluid">

        <div class="navbar-header">
          <button type="button" id="sidebarCollapse" class="navbar-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
        </div>
        <!--Links do menu topo-->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a id="tmenu" href="http://www.petline.com.br/index.php">Inicio</a></li>
            <li><a id="tmenu" href="http://www.petline.com.br/consulta/detalha_usuario.php?id=<?php echo $id; ?>">Meu Perfil</a></li>
            <li><a id="tmenu" href="http://www.petline.com.br/sobre.php">Sobre</a></li>
            <li><a id="tmenu" href="#" onclick="if(confirm('Tem certeza que deseja sair?')) <?php echo "window.location.href = 'http://www.petline.com.br/logout.php';" ?> ; return false"<span>Sair</span></a></li>
          </ul>
        </div>
      </div>
    </nav>
   <!--Fim menu topo-->

   <script  src="../js/menuindex.js"></script>