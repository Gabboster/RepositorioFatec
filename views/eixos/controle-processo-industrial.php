<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css">
    <link href="../../css/footer.css" rel="stylesheet">
    <link href="../../css/top.css" rel="stylesheet">
    <link href="../../css/navbar.css" rel="stylesheet">
    <link href="../../css/trabalhos.css" rel="stylesheet">
    <link href="../../css/cadastro-projeto.css" rel="stylesheet">
    
    <link href="../../css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.js"></script>
    <script src="../../controller/js-scripts/sweetalert.min.js"></script>
      <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <title>Repositório de Conteúdo</title>
    <base href="/">
  </head>
  <body>
    <?php include dirname(__DIR__).'/../templates/navbar.php';?>
    
    <div class="container">
    <h3 id="eixo" style="margin-top: 15px;">Controle e Processos Industriais</h3>
    <?php 
        include '../../model/connect.php';
        include '../../controller/trabalhos-eixo.php';
        $eixo = 'controles e processos';
        $returnVal = getTrabalhosPorEixo($conn, $eixo);
        
        for ($i=0; $i < sizeof($returnVal); $i++) { 
            echo '<div id="artigos"><div class="artigo"><a href="#"><div class="row"><div class="col-sm-12"><p class="text-left"><h3>' .$returnVal[$i]->titulo . '</h3></p></div></div></a><div class="row"><div class="col-lg-12"><h6 class="artigo-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="event">Resumo: </span>' .$returnVal[$i]->resumo . '</h6></div></div><div class="row"><div class="col-lg-12"><p><span class="event">Autores: </span> <a href="#">' . $returnVal[$i]->autor . '</a></p></div></div><div class="row"><div class="col-lg-12"><p><span class="event">Nº Procolo: </span> <a href="#">' . $returnVal[$i]->id . '</a></p></div></div><div class="row"><div class="col-lg-12"><p><span class="event">Ano: </span> <a href="#">' . $returnVal[$i]->ano . '</a></p></div></div><div class="row"><div class="col-lg-4"><p><span class="event">Evento: </span> <a href="#">InovaTec</a></p></div></div><div class="row"><div class="col-lg-4"><a href="'. $returnVal[$i]->caminho .'" target="_blank" download"><span>Baixar</span> <img src="/img/baixar.png" width="15"></a></div></div></div><div>';
        }
    ?>
    </div>
    <?php include '../../templates/footer.php' ?>

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
            url: '../../controller/pesquisa-geral.php',
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