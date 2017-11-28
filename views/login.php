<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login CRM FONETALK</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <link rel="icon" href="assets/img/icone.png" type=assets/img/icone.png" />
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <!-- Fontastic Custom icon font-->
        <link rel="stylesheet" href="assets/css/fontastic.css">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
        <!-- Google fonts - Poppins -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="assets/css/style.blue.css" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="assets/css/custom.css">
        <!-- Favicon-->
        <link rel="shortcut icon" href="favicon.png">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body>
        <div class="page login-page">
            <div class="container d-flex align-items-center">
                <div class="form-holder has-shadow">
                    <div class="row">
                        <!-- Logo & Information Panel-->
                        <div class="col-lg-6">
                            <div class="info d-flex align-items-center">
                                <div class="content">
                                    <div class="logo">
                                        <h1>Fonetalk</h1>
                                    </div>
                                      <!--<p><img src="assets/images/fonetalk_logo.png" /></p>-->
                                    <p>CRM FONETALK.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Form Panel    -->
                        <div class="col-lg-6 bg-white">
                            <div class="form d-flex align-items-center">
                                <div class="content">
                                    <form id="login-form" method="POST" action="login/verificar">
                                        <div class="form-group">
                                            <input id="usuario" type="text" name="usuario" required="required" class="input-material" >
                                            <label for="login-username" class="label-material">Login</label>
                                        </div>
                                        <div class="form-group">
                                            <input id="senha" type="password" name="senha" required="required" class="input-material">
                                            <label for="login-password" class="label-material">Senha</label>
                                        </div><button  type="submit" class="btn btn-primary">Login</button>
                                        <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                                    </form><br/><a href="#" class="forgot-pass"  data-toggle="modal" data-target="#modalEsqueceuSenha">Esqueceu a senha?</a><br>
                                    <!--</form><a href="#" class="forgot-pass">Esqueceu a senha?</a><br><small>Do not have an account? </small><a href="register.html" class="signup">Signup</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
            <div class="copyrights text-center">
                <p>Versão <a href="" class="external">0.2.0</a></p>
                <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
            </div>
        </div>
        <div class="modal fade" id="modalEsqueceuSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title " id="exampleModalLabel">Esqueceu a senha?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="email" class="input-material" placeholder="Insira o e-mail cadastrado" />
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>-->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Javascript files-->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/vendor/popper.js/umd/popper.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/vendor/jquery.cookie/jquery.cookie.js"></script>
        <script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
        <script src="assets/js/front.js"></script>
        <script src="assets/js/scripts/index.js"></script>
       
    </body>
</html>