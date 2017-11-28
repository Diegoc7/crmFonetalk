<?php

require './environment.php';

$config = array();

if (ENVIRONMENT == 'development') {
    define("BASE_URL", "http://192.168.0.126/crm/");
    $config['dbname'] = 'bd_crm';
    $config['host'] = '127.0.0.1';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'y2jrpdwk';
//    $config['dbuser'] = 'Desenvolve';
//    $config['dbpass'] = 'ds100';
} else {
    define("BASE_URL", "http://siteonline/");
    $config['dbname'] = 'estrutura_mvc';
    $config['host'] = 'localhost'; //IP SERVER exemplo: 201.xxx.xxx
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}
global $db;
try {
    $db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'], $config['dbuser'], $config['dbpass']);
} catch (PDOException $e) {
    echo "ERRO" . $e->getMessage();
    exit;
}



