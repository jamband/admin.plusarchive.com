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
    'defaultRoute' => 'track',
    'bootstrap' => ['log'],
    'components' => [
        'authManager' => [
            'class' => yii\rbac\PhpManager::class,
        ],
        'cache' => [
            // 'class' => yii\caching\FileCache::class,
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
    'params' => [
        'ripple-embed-index' => [
            'Bandcamp' => 'size=large/tracklist=false/artwork=small/bgcol=333333/linkcol=cc6055/',
            'SoundCloud' => '&auto_play=true&show_comments=false',
            'YouTube' => '?autoplay=1&showinfo=0&playsinline=1',
            'Vimeo' => '?autoplay=1',
        ],
        'ripple-embed-view' => [
            'Bandcamp' => 'size=large/tracklist=false/bgcol=333333/linkcol=cc6055/',
            'SoundCloud' => '&show_comments=false&visual=true',
            'YouTube' => '?showinfo=0&playsinline=1',
        ],
    ],
];
