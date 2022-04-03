<?php

 declare(strict_types=1);

require __DIR__.'/test-container.php';

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
]);
