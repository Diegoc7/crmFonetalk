<?php

//session_start();
//if (!isset($_SESSION['UsuarioNivel'])) {
////    $passar = "http://192.168.0.126/crm";
//    header("Location: login.php");
//}
require './config.php';


spl_autoload_register(function($class) {

    if (file_exists('controllers/' . $class . '.php')) {
        require 'controllers/' . $class . '.php';
    } else if (file_exists('models/' . $class . '.php')) {
        require 'models/' . $class . '.php';
    } else if (file_exists('core/' . $class . '.php')) {
        require 'core/' . $class . '.php';
    }
});

$core = new Core();
$core->run();
