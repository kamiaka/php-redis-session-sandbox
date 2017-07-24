<?php

// Composerパッケージのオートロードを設定
require realpath(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

// コンフィグデータの読み込み
// return [
//     // redis sentinelのアドレス
//     'sentinels' => ['tcp://127.0.0.1:26379', 'tcp://127.0.0.1:26380'],
//     // オプション(see: https://github.com/nrk/predis#client-configuration)
//     'options' => [
//         'replication' => 'sentinel',
//         'service' => 'mymaster',
//         'prefix' => 'phpsession_',
// ];
$config = include (realpath(__DIR__).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'config.php');

// Redisクライアントの作成
$client = new Predis\Client($config['sentinels'], $config['options']);

// セッションハンドラの作成
$sessionHandler = new Predis\Session\Handler($client);

// セッションハンドラを登録(内部でsession_set_save_handlerを呼び出している)
$sessionHandler->register();

// あとは通常通りセッションを使うとRedisに保存する/されているデータを読む
session_start();
if ($_GET) {
    foreach($_GET as $key => $val) {
        $_SESSION[$key] = $val;
    }
}
var_dump($_SESSION);
