<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$config = [
    'id' => 'plusarchive',
    // 'catchAll' => ['site/offline'],
    'components' => [
        'request' => [
            'cookieValidationKey' => getenv('COOKIE_VALIDATION_KEY'),
        ],
        'user' => [
            'identityClass' => app\models\User::class,
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '<controller:(track|playlist|label|store|bookmark)>s' => '<controller>/index',
                '<action:\w+>' => 'site/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:[\w-]+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[\w-]+>/<action:(admin|create|sort|now|list)>' => '<controller>/<action>',
                '<controller:(track|playlist)>/<id:[\w-]+>' => '<controller>/view',
                '' => 'track/index',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'class' => app\components\Formatter::class,
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
    'container' => [
        'definitions' => [
            yii\data\Pagination::class => [
                'pageSizeParam' => false,
            ],
            yii\data\Sort::class => [
                'class' => app\components\Sort::class,
            ],
            yii\grid\GridView::class => [
                'layout' => '{items}{pager}',
            ],
            yii\widgets\ActiveForm::class => [
                'validateOnBlur' => false,
            ],
            yii\widgets\LinkPager::class => [
                'maxButtonCount' => false,
                'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
                'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
                'firstPageLabel' => '<i class="fa fa-angle-double-left"></i>',
                'lastPageLabel' => '<i class="fa fa-angle-double-right"></i>',
                'firstPageCssClass' => 'first btn-group',
                'nextPageCssClass' => 'next btn-group',
                'prevPageCssClass' => 'prev btn-group',
                'lastPageCssClass' => 'last btn-group',
                'options' => ['class' => 'pagination btn-group btn-group-justified'],
            ],
            yii\widgets\Pjax::class => [
                'scrollTo' => 0,
            ],
        ],
        'singletons' => [
            yii\captcha\Captcha::class => [
                'template' => '<p>{image} <span class="captcha-refresh label label-default">'.
                    '<i class="fa fa-fw fa-refresh"></i> Refresh</span></p>'."\n{input}",
            ],
            app\widgets\ToastrNotification::class => [
                'options' => [
                    'escapeHtml' => true,
                    'timeOut' => 3600,
                    'positionClass' => 'toast-bottom-left',
                ],
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
    ];
}

return yii\helpers\ArrayHelper::merge(require __DIR__.'/common.php', $config);
