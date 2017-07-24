<?php

require realpath(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

define('APPPATH', realpath(__DIR__).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR);

$config = include (APPPATH.'config.php');

$client = new Predis\Client($config['sentinels'], $config['options']);

$sessionHandler = new Predis\Session\Handler($client);
$sessionHandler->register();


session_start();

if ($_GET) {
    foreach($_GET as $key => $val) {
        $_SESSION[$key] = $val;
    }
}

var_dump($_SESSION);
