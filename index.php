<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Repositório Digital</title>
  <link href="css/footer.css" rel="stylesheet">
  <link href="css/top.css" rel="stylesheet">
  <link href="css/navbar.css" rel="stylesheet">
  <link href="css/trabalhos.css" rel="stylesheet">
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <script src="vendor/jquery/jquery.min.js"></script>
  </head>

<body>

  <!-- Page head -->
  <?php include 'templates/navbar.php';?>
  <!----->

  <!-- Page Content -->
  <div class="container">
    <div id="artigos"></div>
    <div id="conteudo">
      <div id="carouselExampleIndicators" class="carousel slide" style="margin-top:15%;"data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="responsive-img slideopc" src="img/fatec_logo.svg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class=" responsive-img slideopc" src="img/farinha.jpg" alt="Second slide">
            </div>
          
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

    <!-- /.col-lg-3 -->

    <p class="h5" style="margin-top:10%;">Destaques</p>
    <div class="row">

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="img/artigo.jpg" style=" height: 219.41px;" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Artigo</a>
            </h4>

            <p class="card-text">Sistema de Gestão de Energia Elétrica Utilizando o EnergyPlus: uma Aplicação Voltada aos Edifícios Inteligentes.</p>
          </div>

        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="img/farinha.jpg" style=" height: 219.41px;" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Projeto</a>
            </h4>


            <p class="card-text">Produto Inovador - Farinha de Bagaço de Malte Enriquecida com Amaranto – curso de Alimentos.</p>
          </div>

        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="img/meteo.jpg"style=" height: 219.41px;" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Evento</a>
            </h4>

            <p class="card-text">Processo Inovador - Estação Micrometeorológica de Baixo Custo.</p>
          </div>

        </div>
      </div>
    </div>
    <!-- /.row -->




    </div>
  </div>
  
  <!-- /container -->

  <!-- footer -->
  <?php include 'templates/footer.php'; ?>
  <!-- /footer -->

  <!-- js -->  
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function(){

      windowResizing();
      
      
      $('#pesquisa-geral').on('submit', function (e){
        e.preventDefault();
        if (window.location.href.includes('index.html')) {
          $('#team').empty();
        } else {
          $('#artigos').empty();
          $('#conteudo').empty();
          $('#filter-buttons').remove();
          $('#setor').remove();
          $("#artigos").css('margin-top', '10px');
        }

      

      $.ajax({
            url: '/controller/pesquisa-geral.php',
                    type: "get",
                    data: $('#pesquisa-geral').serialize(),
                    success: function(returnVal){
                      if (returnVal.length > 0 || null) {
                        returnVal = JSON.parse(returnVal);
                        
                        for (let i = 0; i < returnVal.length; i++) {
                            $('#artigos').append('<div class="artigo"><a href="#"><div class="row"><div class="col-sm-12"><p class="text-left"><h3>' + returnVal[i].titulo + '</h3></p></div></div></a><div class="row"><div class="col-lg-12"><h6 class="artigo-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="event">Resumo: </span>' + returnVal[i].resumo + '</h6></div></div><div class="row"><div class="col-lg-12"><p><span class="event">Autores: </span> <a href="#">' + returnVal[i].autor + '</a></p></div></div><div class="row"><div class="col-lg-12"><p><span class="event">Nº Procolo: </span> <a href="#">' + returnVal[i].id + '</a></p></div></div><div class="row"><div class="col-lg-12"><p><span class="event">Ano: </span> <a href="#">' + returnVal[i].ano + '</a></p></div></div><div class="row"><div class="col-lg-4"><p><span class="event">Evento: </span> <a href="#">InovaTec</a></p></div></div><div class="row"><div class="col-lg-4"><a href="'+ returnVal[i].caminho +'" target="_blank" download"><span>Baixar</span> <img src="/images/baixar.png" width="15"></a></div></div></div>');   
                        }
                      } else {
                          $('#artigos').append('<h3>Nenhum resultado encontrado</h3>');
                      }
                    
                    },
                    error:function(){
                        alert("Requisição falhou");

                    }   
          });

      });
    })

    function windowResizing() {
      if (($(window).width() <= 862)){
            $('#logo-row').addClass('justify-content-center');
          } else{
            $('#logo-row').removeClass('justify-content-center');
          }

          $(window).resize(function() {
            if (($(window).width() <= 862)){
              $('#logo-row').addClass('justify-content-center');
            } else{
              $('#logo-row').removeClass('justify-content-center');
            }
          }); 
    }
  </script>
</body>

</html>