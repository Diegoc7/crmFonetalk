<?php

require './environment.php';

$config = array();

if (ENVIRONMENT == 'development') {
    define("BASE_URL", "");
    $config['dbname'] = '';
    $config['host'] = '';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
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



