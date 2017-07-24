<?php

return [
    // redis sentinelのアドレス
    'sentinels' => ['tcp://127.0.0.1:26379', 'tcp://127.0.0.1:26380'],
    // オプション(see: https://github.com/nrk/predis#client-configuration)
    'options' => [
        'replication' => 'sentinel',
        'service' => 'mymaster',
        'prefix' => 'phpsession_',
    ]
];
