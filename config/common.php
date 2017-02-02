<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Yii::$classMap = [
    yii\helpers\Url::class => '@app/helpers/Url.php',
];

return [
    'name' => 'Plus Archive',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'authManager' => [
            'class' => yii\rbac\PhpManager::class,
        ],
        'cache' => [
            'class' => yii\caching\ApcCache::class,
            'useApcu' => true,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                    'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION'],
                ],
            ],
        ],
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => getenv('DB_DSN'),
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASS'),
            'charset' => 'utf8',
            'enableSchemaCache' => true,
        ],
        'hashids' => [
            'class' => app\components\Hashids::class,
            'salt' => getenv('HASHIDS_SALT'),
            'minHashLength' => 11,
            'alphabet' => getenv('HASHIDS_ALPHABET'),
        ],
    ],
];
