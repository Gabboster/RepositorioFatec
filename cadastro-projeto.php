<?php
    session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css">
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/top.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/trabalhos.css" rel="stylesheet">
    <link href="css/cadastro-projeto.css" rel="stylesheet">
    
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.js"></script>
    <script src="controller/js-scripts/sweetalert.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <title>Repositório de Conteúdo</title>
    
  </head>
  <body>
    <?php
        if (!isset($_SESSION['matricula'])) {
            echo "<script>
            alert('Usuario deve estar logado para acessar esta página!');
            window.location.href='/login.php';
            </script>";
            
        }else{
            include 'templates/navbar.php';
        }
        
    ?>
      
      <!-- ------------------ -->
    <div class="container">
      <div id="artigos"></div>
        <div id="conteudo">
    
    <div class="row">
        <div class="col-md-12-offset3" id="formulario-container">
            <div class="well well-sm" id="formulario">
                <form id="form-cadastro" action="" enctype="multipart/form-data" method="POST">
                <h3 id="cadastro-titulo">Cadastro e inclusão de projeto</h3>
                <div class="row">
                    <div class="col-md-4" id="left-inputs">
                        <div class="form-group">
                            <label >
                                Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required="required" />
                        </div>
                        <div class="form-group">
                            <label >
                                Autores</label>
                            <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor, Autor, A..." required="required" />
                        </div>
                        <div class="form-group">
                            <label >
                                Ano</label>
                            <input type="text" class="form-control" id="ano" name="ano" placeholder="Ano" required="required" />
                        </div>
                        <div class="form-group">
                            <label >
                                Evento</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="evento" name="evento" placeholder="Evento" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label >
                                Eixo</label>
                            <select id="eixo" name="eixo" class="form-control" required="required">
                                <option value="null" selected="">Eixos:</option>
                                <option value="Gestão e Projetos">Gestão e Projetos</option>
                                <option value="Produção Alimentícia">Produção Alimentícia</option>
                                <option value="Tecnologia da Informação">Tecnologia da Informação</option>
                                <option value="Controles e Processos Industriais">Controles e Processos Industriais</option>
                            </select>
                        </div>
                        <div class="form-group">
                                <label >
                                    Status</label>
                                <input type="text" name="status"class="form-control" id="status" placeholder="Em andamento; Encerrado" required="required" />
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="resumo-protocolo">
                            <label >
                                Resumo</label>
                            <textarea class="form-control" rows="15" cols="10" id="resumo" name="resumo" required="required"
                                placeholder="Resumo"></textarea>
                        </div>
                    </div>
                    <div class="col-md-9">
                            <br>
                        <div class="form-group">   
                            <span class="control-fileupload">
                                <input type="file" id="userfile" name="userfile" accept="application/pdf" >
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary pull-right" id="registrar">
                            Cadastrar
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
</div>

<!-- Footer -->
<div class="demo">
<footer class="bg-success center footer" id="footer">
    <div class="container" id="container-footer">
      <div id="assinatura" class="row justify-content-center">
        <div id="assinatura_logo"><a href="http://www.senaimt.com.br" target="_blank"><img src="img/fatec_senai_branca.png" alt="" border="0" style="max-width:200px" class="center"/></a></div>
      </div>
      <div class="row justify-content-center" id="footer-text">
        <div id="copyright" class="textoCopyright"> <strong>FATEC SENAI MT -  Faculdade de Tecnologia SENAI Mato Grosso</strong><br/>Telefone: (65) 3612-1710 / 1712
          - Central de Atendimento: 0800 777 9737 <br> &nbsp;&bull; &copy; Copyright 2018 - Todos os direitos reservados.</div>
        <div style="clear:both;">&nbsp;</div>
      </div>
    </div>
    <!-- /.container -->
  </footer> 
  </div>

<script>
    $(document).ready(function() {  
        //retornar número de protocolo
        $.ajax({
                    url: 'php/retornaid.php',
                    type: "get",
                    data: "",
                    success: function(returnVal){
                        returnVal++;
                        $('#resumo-protocolo').append('<br><h4 id="num-protocolo" style="font-style: bolder">Nº Protocolo: ' + returnVal + '</h4>');
                    },
                    error:function(){
                        alert("Requisição falhou");
                    }   
        });
        
        $("#form-cadastro").on('submit', function(e){
          e.preventDefault();
          let file_data = $('#userfile').prop('files')[0];   
          let form_data = new FormData();                  
          form_data.append('userfile', file_data);
          form_data.append('titulo', $('#titulo').val());
          form_data.append('autor', $('#autor').val());
          form_data.append('ano', $('#ano').val());
          form_data.append('evento', $('#evento').val());
          form_data.append('eixo', $('#eixo').val());
          form_data.append('status', $('#status').val());
          form_data.append('resumo', $('#resumo').val());
            $.ajax({
                    url: 'controller/upload-file.php',
                    type: "post",
                    dataType: 'script',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(res){
                        res = JSON.parse(res);
                        if (res.error) {
                          swal(res.data, "", "error");
                        } else {
                          swal("Arquivo enviado com sucesso!", "", "success");
                          $.ajax({
                                    url: 'php/retornaid.php',
                                    type: "get",
                                    data: "",
                                    success: function(returnVal){
                                        returnVal++;
                                        $('#num-protocolo').remove();
                                        $('#resumo-protocolo').append('<h4 id="num-protocolo" style="font-style: bolder">Nº Protocolo: ' + returnVal + '</h4>');
                                    },
                                    error:function(){
                                        alert("Requisição falhou");
                                    }   
                        });
                        }
                    },
                    error:function(){
                        alert("Requisição falhou");
                    }   
            });
        });

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
            url: 'controller/pesquisa-geral.php',
                    type: "get",
                    data: $('#pesquisa-geral').serialize(),
                    success: function(returnVal){
                      if (returnVal.length > 0 || null) {
                        returnVal = JSON.parse(returnVal);
                        
                        for (let i = 0; i < returnVal.length; i++) {
                            $('#artigos').append('<div class="artigo"><a href="#"><div class="row"><div class="col-sm-12"><p class="text-left"><h3>' + returnVal[i].titulo + '</h3></p></div></div></a><div class="row"><div class="col-lg-12"><h6 class="artigo-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="event">Resumo: </span>' + returnVal[i].resumo + '</h6></div></div><div class="row"><div class="col-lg-12"><p><span class="event">Autores: </span> <a href="#">' + returnVal[i].autor + '</a></p></div></div><div class="row"><div class="col-lg-12"><p><span class="event">Nº Procolo: </span> <a href="#">' + returnVal[i].id + '</a></p></div></div><div class="row"><div class="col-lg-12"><p><span class="event">Ano: </span> <a href="#">' + returnVal[i].ano + '</a></p></div></div><div class="row"><div class="col-lg-4"><p><span class="event">Evento: </span> <a href="#">InovaTec</a></p></div></div><div class="row"><div class="col-lg-4"><a href="'+ returnVal[i].caminho +'" target="_blank" download"><span>Baixar</span> <img src="img/baixar.png" width="15"></a></div></div></div>');   
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