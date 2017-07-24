# php-redis-session-sandbox

PHPのセッションにRedis sentinelで管理されたRedis storeを使用してみます。

## 事前準備

composer がインストールされている必要があります。

## インストール

redisパッケージ([github.com/nrk/predis](https://github.com/nrk/predis))をインストールします。

```bash
php composer.phar install
```

## 確認

クエリパラメータでセットされたキーに対する値($_GET)をそのままセッションに保存します。
セッションの一覧を表示します。

### データの登録

以下URLにブラウザでアクセス

```
http://hostname/path/to/sample/index.php?mykey=myvalue
```

#### 出力

```
array(1) {
  ["key"]=>
  string(7) "myvalue"
}
```

### Redisストアでの確認

直接Redisサーバにアクセスして値が取れることを確認できました。

```bash
$ redis-cli -p 6379
127.0.0.1:6379> keys *
1) "phpsession_deadbeef0123456789..."
127.0.0.1:6379> get phpsession_deadbeef01234...
"mykey|s:7:\"myvalue\";"
```
