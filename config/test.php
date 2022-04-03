<?php

declare(strict_types=1);

use app\components\Hashids;
use yii\helpers\ArrayHelper;

require __DIR__.'/test-container.php';

return ArrayHelper::merge(require __DIR__.'/web.php', [
    'id' => 'test',
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
            'class' => Hashids::class,
            'salt' => 'testsalt',
            'minHashLength' => 8,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-',
        ],
    ],
]);
