<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
    'params' => [
        'admin-username' => 'admin',
        'admin-email' => 'admin@example.com',
        'admin-password' => 'adminadmin',
    ]
]);
