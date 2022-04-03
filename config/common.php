<?php

declare(strict_types=1);

use app\components\Hashids;
use yii\caching\ApcCache;
use yii\db\Connection;
use yii\helpers\Url;
use yii\log\FileTarget;
use yii\rbac\PhpManager;

Yii::$classMap = [
    Url::class => '@app/helpers/Url.php',
];

return [
    'name' => 'PlusArchive',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'authManager' => [
            'class' => PhpManager::class,
        ],
        'cache' => [
            'class' => ApcCache::class,
            'useApcu' => true,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                    'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION'],
                ],
            ],
        ],
        'db' => [
            'class' => Connection::class,
            'dsn' => $_SERVER['DB_DSN'],
            'username' => $_SERVER['DB_USER'],
            'password' => $_SERVER['DB_PASS'],
            'charset' => 'utf8',
            'enableSchemaCache' => true,
        ],
        'hashids' => [
            'class' => Hashids::class,
            'salt' => $_SERVER['HASHIDS_SALT'],
            'minHashLength' => 11,
            'alphabet' => $_SERVER['HASHIDS_ALPHABET'],
        ],
    ],
];
