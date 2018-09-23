<?php

return yii\helpers\ArrayHelper::merge(require __DIR__.'/web.php', [
    'id' => 'plusarchive-test',
    'components' => [
        'urlManager' => [
            'showScriptName' => true,
        ],
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=plusarchive_test',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
        'hashids' => [
            'class' => app\components\Hashids::class,
            'salt' => 'testsalt',
            'minHashLength' => 8,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-',
        ],
    ],
    'params' => [
        'admin-username' => 'admin',
        'admin-email' => 'admin@example.com',
        'admin-password' => 'adminadmin',
    ]
]);
