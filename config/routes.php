<?php

declare(strict_types=1);

use yii\web\GroupUrlRule;

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,
    'rules' => [
        new GroupUrlRule([
            'prefix' => 'tracks',
            'rules' => [
                'now' => 'now/index',
                'admin' => 'admin/index',
                'create' => 'create/index',
                'stop-all-urge' => 'stop-all-urge/index',
                'update/<id:\d+>' => 'update/index',
                'delete/<id:\d+>' => 'delete/index',
                '<id:[\w-]+>' => 'view/index',
                '' => 'index/index',
            ],
        ]),
        new GroupUrlRule([
            'prefix' => 'playlists',
            'rules' => [
                'admin' => 'admin/index',
                'create' => 'create/index',
                'update/<id:\d+>' => 'update/index',
                'delete/<id:\d+>' => 'delete/index',
                '<id:[\w-]+>' => 'view/index',
                '' => 'index/index',
            ],
        ]),
        new GroupUrlRule([
            'prefix' => 'labels',
            'rules' => [
                'admin' => 'admin/index',
                'create' => 'create/index',
                'view/<id:\d+>' => 'view/index',
                'update/<id:\d+>' => 'update/index',
                'delete/<id:\d+>' => 'delete/index',
                '' => 'index/index',
            ],
        ]),
        new GroupUrlRule([
            'prefix' => 'stores',
            'rules' => [
                'admin' => 'admin/index',
                'create' => 'create/index',
                'view/<id:\d+>' => 'view/index',
                'update/<id:\d+>' => 'update/index',
                'delete/<id:\d+>' => 'delete/index',
                '' => 'index/index',
            ],
        ]),
        new GroupUrlRule([
            'prefix' => 'bookmarks',
            'rules' => [
                'admin' => 'admin/index',
                'create' => 'create/index',
                'view/<id:\d+>' => 'view/index',
                'update/<id:\d+>' => 'update/index',
                'delete/<id:\d+>' => 'delete/index',
                '' => 'index/index',
            ],
        ]),
        new GroupUrlRule([
            'prefix' => 'musicGenres',
            'rules' => [
                'admin' => 'admin/index',
                'update/<id:\d+>' => 'update/index',
                'delete/<id:\d+>' => 'delete/index',
            ],
        ]),
        new GroupUrlRule([
            'prefix' => 'bookmarkTags',
            'rules' => [
                'admin' => 'admin/index',
                'update/<id:\d+>' => 'update/index',
                'delete/<id:\d+>' => 'delete/index',
            ],
        ]),
        new GroupUrlRule([
            'prefix' => 'labelTags',
            'rules' => [
                'admin' => 'admin/index',
                'update/<id:\d+>' => 'update/index',
                'delete/<id:\d+>' => 'delete/index',
            ],
        ]),
        new GroupUrlRule([
            'prefix' => 'storeTags',
            'rules' => [
                'admin' => 'admin/index',
                'update/<id:\d+>' => 'update/index',
                'delete/<id:\d+>' => 'delete/index',
            ],
        ]),
        '<controller:(login|logout|signup)>' => 'auth/<controller>/index',
        '<controller:(about|admin|contact|offline|privacy|privacy-consent|privacy-opt-out|third-party-licenses)>' => 'site/<controller>/index',
        '' => 'site/home/index',
    ],
];
