<?php

declare(strict_types=1);

use app\components\Formatter;
use app\controllers\site\ErrorController;
use app\models\User;
use yii\debug\Module as DebugModule;
use yii\helpers\ArrayHelper;

$config = [
    'id' => 'web',
//    'catchAll' => ['site/offline/index'],
    'components' => [
        'request' => [
            'cookieValidationKey' => $_SERVER['COOKIE_VALIDATION_KEY'],
        ],
        'user' => [
            'identityClass' => User::class,
            'enableAutoLogin' => true,
            'loginUrl' => ['auth/login/index'],
        ],
        'urlManager' => require __DIR__.'/routes.php',
        'errorHandler' => [
            /** @see ErrorController */
            'errorAction' => 'site/error/index',
        ],
        'formatter' => [
            'class' => Formatter::class,
            'dateFormat' => 'yyyy.MM.dd',
            'datetimeFormat' => 'yyyy.MM.dd HH:mm',
        ],
        'assetManager' => [
            'bundles' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ],
    ],
    'container' => require __DIR__.'/container.php',
    'params' => require __DIR__.'/params.php',
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => DebugModule::class,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return ArrayHelper::merge(require __DIR__.'/base.php', $config);
