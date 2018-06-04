<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/login-style.css">
    <script src="jquery/jquery.js"></script>
    <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <script src="controller/js-scripts/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#login-form-link').click(function(e) {
                $("#login-form").delay(100).fadeIn(100);
                $("#register-form").fadeOut(100);
                $('#register-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#register-form-link').click(function(e) {
                $("#register-form").delay(100).fadeIn(100);
                $("#login-form").fadeOut(100);
                $('#login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#password, #confirmed-password').on('keyup', function () {
                if ($('#password').val() === $('#confirmed-password').val()) {
                    $('#message').html('Senhas combinam').css('color', 'green');
                } else 
                    $('#message').html('Senhas não combinam').css('color', 'red');
                }
            );

            $('#login-form').on('submit', function (e){
                e.preventDefault();
                $.ajax({
                        type: 'post',
                        url: '/controller/login.php',
                        data: $('#login-form').serialize(),
                        success: function (res) {
                            res = JSON.parse(res);
                            if (res.error) {
                                swal(res.data, "Tente novamente ou contate o administrador", "error");
                            }else{
                               window.location = '/';
                            }
                        }
                });   
            });

            $('#register-form').on('submit', function (e){
                e.preventDefault();
                if ($('#message').text() === 'Senhas combinam') {
                    $.ajax({
                        type: 'post',
                        url: '/controller/cadastro-usuario.php',
                        data: $('#register-form').serialize(),
                        success: function (res) {
                            res = JSON.parse(res);
                            if (res.error) {
                                swal(res.data, "Tente novamente ou contate o administrador", "error");
                            }else{
                                swal("Sua conta foi ativada!", "Aperte o botão para efetuar o login...", "success");
                                $("#login-form").delay(100).fadeIn(100);
                                $("#register-form").fadeOut(100);
                                $('#register-form-link').removeClass('active');
                                $(this).addClass('active');
                            }
                        }
                    });   
                } else{
                    alert("Senhas não estando combinando!");
                }
            })
        });
    </script>
    <title>Login Repositório</title>
    <?php 
    include '../model/connect.php';
    session_start();

    if (isset($_SESSION['matricula'])) {
        header("Location: /");
        die();
    }
?>
  </head>
  <body>
        <div class="container">
            <div class="row">
                <div id="fatec-logo">
                    <img id="fatec-logo" class="img-responsive" src="img/fatec_logo.svg" width="450">
                </div>
            </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-login">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <a href="#" class="active" id="login-form-link">Login</a>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="#" id="register-form-link">Ativar Conta</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form id="login-form" action="#" method="post" role="form" style="display: block;">
                                            <div class="form-group">
                                                <input type="email" name="email" id="usernameId" tabindex="1" class="form-control" placeholder="E-mail" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" id="passwordId" tabindex="2" class="form-control" placeholder="Senha" maxlength="8" required pattern="[A-Za-z0-9]{8}">
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                                <label for="remember"> Lembrar</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Logar">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="text-center">
                                                            <a href="#" tabindex="5" class="forgot-password">Recuperar Senha</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <form id="register-form" action="#" method="post" role="form" style="display: none;">
                                            <div class="form-group">
                                                <input type="text" name="name" id="username" tabindex="1" class="form-control" placeholder="Nome Completo" maxlength="100" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="number" name="matricula" id="matricula" tabindex="1" class="form-control" placeholder="Matricula" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" maxlength="100" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Senha (8 caracteres)" maxlength="8" required pattern="[A-Za-z0-9]{8}">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="confirmed-password" id="confirmed-password" tabindex="2" class="form-control" placeholder="Confirmar Senha" maxlength="8" required pattern="[A-Za-z0-9]{8}">
                                            </div>
                                            <h4 id='message'></h4>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Ativar Conta">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  </body>
</html>