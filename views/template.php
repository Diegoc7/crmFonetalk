<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CRM - FONETALK</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <!--http://192.168.0.126/crm/-->
        <link rel="icon" href="<?php echo BASE_URL ?>assets/img/icone.png" type="text/css" />
        <!--<link rel="icon" href="../../../../assets/img/icone.png" type="text/css" />-->
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/vendor/bootstrap/css/bootstrap.css">
        <!--<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">-->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <!--<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap-select.min.css">-->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/vendor/bootstrap/css/bootstrap-select-bootstrap4.css">
        <!--<link  rel = " stylesheet "  href = " https://cdn.rawgit.com/infostreams/bootstrap-select/fd227d46de2afed300d97fd0962de80fa71afb3b/dist/css/bootstrap-select.min.css " />-->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/vendor/bootstrap/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/vendor/bootstrap/css/jquery.dataTables.css">
        <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/vendor/bootstrap/css/buttons.dataTables.css">

        <!-- Fontastic Custom icon font-->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/fontastic.css">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/vendor/font-awesome/css/font-awesome.min.css">


        <!-- Google fonts - Poppins -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/style.blue.css" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/custom.css">
        <!-- Favicon-->
        <link rel="shortcut icon" href="favicon.png">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body style="display: none;">
        <div class="page home-page">
            <!-- Main Navbar-->
            <header class="header">
                <nav class="navbar">
                    <!-- Search Box-->
                    <div class="search-box">
                        <button class="dismiss"><i class="icon-close"></i></button>
                        <form id="searchForm" action="#" role="search">
                            <input type="search" placeholder="Digite algo a buscar" class="form-control">
                        </form>
                    </div>
                    <div class="container-fluid">
                        <div class="navbar-holder d-flex align-items-center justify-content-between">
                            <!-- Navbar Header-->
                            <div class="navbar-header">
                                <!-- Navbar Brand --><a href="<?php echo BASE_URL ?>index.php" class="navbar-brand">
                                    <div class="brand-text brand-big"><span>CRM </span><strong>Fonetalk</strong></div>
                                    <div class="brand-text brand-small"><strong>CF</strong></div></a>
                                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                            </div>
                            <!-- Navbar Menu -->
                            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                <!-- Search-->
                                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                                <!-- Notifications-->
                                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red">12</span></a>
                                    <ul aria-labelledby="notifications" class="dropdown-menu">
                                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                                                <div class="notification">
                                                    <div class="notification-content"><i class="fa fa-envelope bg-green"></i>Você tem 6 novas mensagens </div>
                                                    <div class="notification-time"><small>4 minutos atrás</small></div>
                                                </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                                                <div class="notification">
                                                    <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>Você tem 2 seguidores</div>
                                                    <div class="notification-time"><small>4 minutos atrás</small></div>
                                                </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                                                <div class="notification">
                                                    <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Servidor Reinciado</div>
                                                    <div class="notification-time"><small>4 minutos atrás</small></div>
                                                </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                                                <div class="notification">
                                                    <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>Você tem 2 Seguidores</div>
                                                    <div class="notification-time"><small>10 minutos atrás</small></div>
                                                </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Ver todas notificações                                            </strong></a></li>
                                    </ul>
                                </li>
                                <!-- Messages                        -->
                                <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange">10</span></a>
                                    <ul aria-labelledby="notifications" class="dropdown-menu">
                                        <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                                <div class="msg-profile"> <img src="" alt="..." class="img-fluid rounded-circle"></div>
                                                <div class="msg-body">
                                                    <h3 class="h5">Usuário 1</h3><span>Enviou uma mensagem</span>
                                                </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                                <div class="msg-profile"> <img src="" alt="..." class="img-fluid rounded-circle"></div>
                                                <div class="msg-body">
                                                    <h3 class="h5">Usuário 2</h3><span>Enviou uma mensagem</span>
                                                </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                                <div class="msg-profile"> <img src="" alt="..." class="img-fluid rounded-circle"></div>
                                                <div class="msg-body">
                                                    <h3 class="h5">Usuário 3</h3><span>Enviou uma mensagem</span>
                                                </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Ler todas as mensagens    </strong></a></li>
                                    </ul>
                                </li>
                                <!-- Logout    -->
                                <li class="nav-item"><a href="login" class="nav-link logout">Sair<i class="fa fa-sign-out"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="page-content d-flex align-items-stretch">
                <!-- Side Navbar -->
                <nav class="side-navbar">
                    <!-- Sidebar Header-->
                    <div class="sidebar-header d-flex align-items-center">
                      <!--<div class="avatar"><img src="assets/img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>-->
                        <div class="avatar"><img src="" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="title">
                            <h1 class="h4"><?php echo $_SESSION['nome']; ?></h1>
                            <p><?php echo $_SESSION['tipo']; ?></p>
                        </div>
                    </div>
                    <!-- Sidebar Navidation Menus--><span class="heading">Principal</span>
                    <ul class="list-unstyled">
                        <li id="barIndex" > <a href="<?php echo BASE_URL ?>index.php"><i class="icon-home"></i>Inicio</a></li>
                        <li > <a href="index.php"><i class="fa fa-money"></i>Négocios</a></li>
            <!--            <li><a href="#dashvariants" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Dropdown </a>
                          <ul id="dashvariants" class="collapse list-unstyled">
                            <li><a href="#">Page</a></li>
                            <li><a href="#">Page</a></li>
                            <li><a href="#">Page</a></li>
                            <li><a href="#">Page</a></li>
                          </ul>
                        </li>-->
                        <li id="bar_contatos" > <a href="<?php echo BASE_URL ?>contatos"> <i class="icon-user"></i>Contatos </a></li>
                        <li id="barEmpresas"> <a href="<?php echo BASE_URL ?>charts.html"> <i class="fa fa-building"></i>Empresas </a></li>
                        <li id="barRelatorio"> <a href="<?php echo BASE_URL ?>forms.html"> <i class="fa fa-file"></i>Relatório </a></li>
                        <!--<li> <a href="login.html"> <i class="icon-interface-windows"></i>Login Page</a></li>-->
                    </ul><span class="heading">Extras</span>
                    <ul class="list-unstyled">
                      <!--<li> <a href="#"> <i class="icon-flask"></i>Demo </a></li>-->
                        <li id="barAgenda"> <a href="<?php echo BASE_URL ?>#"> <i class="fa fa-calendar-o"></i>Agenda </a></li>
                        <li id="barMensagens"> <a href="<?php echo BASE_URL ?>#"> <i class="icon-mail"></i>Mensagens </a></li>
                        <li id="bar_usuarios"> <a href="<?php echo BASE_URL ?>usuarios"> <i class="fa fa-address-card-o"></i>Usuários </a></li>
                    </ul>
                </nav>
                <div class="content-inner">
                    <!-- Page Header-->
                    <header class="page-header">
                        <div class="container-fluid">
                            <h2 class="no-margin-bottom">Dashboard</h2>
                        </div>
                    </header>
                    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
                    <footer class="main-footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-10">
                                    <p> © Copyright 2017.  <b>Fonetalk Telecom </b>
                                        Tel. 4003 5154 / 0800 878 8585 
                                        CNPJ: 13.387.472/0001-90. Autorizada Anatel: 4653/2015.<br/>
                                        e-mail:relacionamento@fonetalk.com.br</p>
                                </div>
                                <div class="col-sm-2 text-right">
                                    <p>Desenvolvimento <strong>Fonetalk</strong> </p>
                                    <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCarregar" tabindex="-1" role="dialog" aria-labelledby="example" aria-hidden="true" data-backdrop="static" style="display: none;">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header" >
                        <h4 class="modal-title"  id="exampleModalLabel">Aguarde...</h4>
                    </div>
                    <div class="modal-body">
                        <div class="loader">Loading...</div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>-->
                            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" >
                        <h4 class="modal-title"  id="exampleModalLabel">Erro!</h4>
                    </div>
                    <div class="modal-body">
                        <center><img src="assets/img/error.png" width="100" height="100" /></center> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalOK" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" >
                        <h4 class="modal-title"  id="exampleModalLabel">Completo!</h4>
                    </div>
                    <div class="modal-body">
                        <center><img src="assets/img/complete.png" width="100" height="100" /></center> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Javascript files-->
        <!--<script src="assets/js/jquery.min.js"></script>-->
        <script src="<?php echo BASE_URL ?>assets/vendor/jquery/jquery.js"></script>
        <script src="<?php echo BASE_URL ?>assets/vendor/popper.js/umd/popper.min.js"></script>
        <script src="<?php echo BASE_URL ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--<script src="assets/vendor/bootstrap/js/bootstrap-select.min.js"></script>-->
        <!--<script  src = " https://cdn.rawgit.com/infostreams/bootstrap-select/fd227d46de2afed300d97fd0962de80fa71afb3b/dist/js/bootstrap-select.min.js " > </script >-->
        <script src="<?php echo BASE_URL ?>assets/vendor/bootstrap/js/bootstrap-select-bootstrap4.min.js"></script>
        <script src="<?php echo BASE_URL ?>assets/vendor/bootstrap/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo BASE_URL ?>assets/vendor/bootstrap/js/locales/bootstrap-datepicker.pt-BR.min.js"></script>
        <script src="<?php echo BASE_URL ?>assets/vendor/bootstrap/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo BASE_URL ?>assets/vendor/bootstrap/js/dataTables/dataTables.buttons.min.js"></script>
        <script src="<?php echo BASE_URL ?>assets/vendor/bootstrap/js/dataTables/buttons.flash.min.js"></script>
        <script src="<?php echo BASE_URL ?>assets/vendor/jquery.cookie/jquery.cookie.js"></script>
        <script src="<?php echo BASE_URL ?>assets/vendor/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?php echo BASE_URL ?>assets/vendor/bootstrap/js/jquery.mask.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script src="<?php echo BASE_URL ?>assets/js/charts-home.js"></script>
        <script src="<?php echo BASE_URL ?>assets/js/front.js"></script>
        <script src="<?php echo BASE_URL ?>assets/js/scripts/template.js"></script>
    </body>
</html>