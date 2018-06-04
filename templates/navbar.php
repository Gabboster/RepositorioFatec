

<div class="container-fluid" id="top">
<div class="row inline" id="logo-row">
    <div class="inline" id="logo-block">
        <img id="fatec-logo" class="img-responsive" src="img/fatec_logo.svg">
    </div>
</div>
<div class="row justify-content-center inline" id="title">
    <div class="inline">
        <h1 id="h1-row">Repositório Digital</h1>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-success py-lg-2" id="navbar">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
    aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav">
            <?php
              if(isset($_SESSION['matricula'])){
                echo '<li class="nav-item dropdown">
                <a class="nav-link white-text dropdown-toggle" id="user-anchor" href="" id="navbarDropdownMenuLink" aria-haspopup="true"
                  aria-expanded="false">
                  <i class="fas fa-user"></i>
                        <span class="glyphicon-user">' .$_SESSION['nome'].'</i></span>
                      </a><div class="dropdown-menu dropdown-box" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Gerenciar Conta</a>
                <a class="dropdown-item" href="/cadastro-projeto.php">Cadastro e Protocolo de Projetos</a>
                <a class="dropdown-item" href="/controller/logout.php">Sair</a>
              </div></li>';
              echo "<script>$(document).ready(function(){
                $('.dropdown-toggle').attr('data-toggle', 'dropdown');
              });</script>";
            } else{
              echo '<li class="nav-item dropdown">
              <a class="nav-link white-text dropdown-toggle" id="user-anchor" href="/login.php">
                <i class="fas fa-user"></i>
                      <span class="glyphicon-user"> Conta</i></span>
                    </a></li>';
            }?>
            
          
          <li class="nav-item dropdown">
        <a class="nav-link white-text" href="/" aria-haspopup="true"
          aria-expanded="false">
          Home
            </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle white-text" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
                Produção Científica
              </a>
        <div class="dropdown-menu dropdown-box" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="views/eixos/gestao-e-negocios.php">Eixo de Gestão de Negócios</a>
          <a class="dropdown-item" href="views/eixos/producao-alimenticia.php">Eixo de Produção Alimentícia</a>
          <a class="dropdown-item" href="views/eixos/tecnologia-informacao.php">Eixo de Tecnologia da Informação e Comunicação</a>
          <a class="dropdown-item" href="views/eixos/controle-processo-industrial.php">Eixo de Controles e Processos Industriais</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle white-text" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
              Eventos Científicos
            </a>
        <div class="dropdown-menu dropdown-box" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="#">Inova</a>
          <a class="dropdown-item" href="#">Iniciação Científica</a>
          <a class="dropdown-item" href="#">Extensão Universitária</a>
        </div>
      </li>  
    </ul>
  </div>
  <form class="form-inline" id="pesquisa-geral" action="">
    <div class="input-group" id="search-block">
    
      <input type="text" class="form-control" id="search-input" name="valor-pesquisa" placeholder="Pesquisar" aria-label="Username" aria-describedby="basic-addon1">
      <div class="input-group-prepend bg-success">
              <button type="submit" id="pesquisarBtn" class="btn btn-default"><span class="glyphicon glyphicon-search"></span><i class="fas fa-search"></i></button>
      </div>
    </div>
  </form>
</div>

</nav>
</div>

<script>
    $(document).ready(function(){
      window.onscroll = function() {switchStickyNavbar()};

var navbar = document.getElementById("navbar");

// posição do navbar
var sticky = navbar.offsetTop;

//função para trocar a posição do navbar de solto para fixed e o contrário
function switchStickyNavbar() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
    });
</script>