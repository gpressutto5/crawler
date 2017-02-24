<?php
return [
    'database' => [
        'name' => 'crawler',
        'username' => 'crawler',
        'password' => 'senha',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ]
    ]
];
