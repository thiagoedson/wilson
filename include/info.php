<?php

date_default_timezone_set('America/Sao_Paulo');
header("Content-Type: text/html; charset=utf8", true);
error_reporting(E_ERROR | E_PARSE);


require_once '../../vendor/autoload.php';

define("CAMINHO", dirname($_SERVER["SCRIPT_FILENAME"]));


$dotenv = new Dotenv\Dotenv('../../');
$dotenv->load();

$db = new MysqliDb ([
    'host'     => getenv('DB_HOST'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
    'db'       => getenv('DB_1'),
    'port'     => getenv('DB_PORT'),
    'charset'  => 'utf8'
]);

require_once '../../include/function.php';