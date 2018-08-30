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
    'defaultRoute' => 'track',
    // 'catchAll' => ['site/offline/index'],
    'components' => [
        'request' => [
            'cookieValidationKey' => getenv('COOKIE_VALIDATION_KEY'),
        ],
        'user' => [
            'identityClass' => app\models\User::class,
            'enableAutoLogin' => true,
            'loginUrl' => ['auth/login/index'],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '<controller:(track|playlist|label|store|bookmark)>s' => '<controller>/index',
                '<controller:(login|logout|signup)>' => 'auth/<controller>/index',
                '<controller:(about|admin|contact|offline|privacy|privacy-consent|privacy-opt-out|third-party-licenses)>' => 'site/<controller>/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:[\w-]+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[\w-]+>/<action:(admin|create|now|list)>' => '<controller>/<action>',
                '<controller:(track|playlist)>/<id:[\w-]+>' => '<controller>/view',
                '' => 'track/index',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error/index',
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
            yii\captcha\Captcha::class => [
                'template' => '<p>{image} <span class="captcha-refresh label label-default">'.
                    '<i class="fas fa-fw fa-sync"></i> Refresh</span></p>'."\n{input}",
            ],
            yii\data\Pagination::class => [
                'pageSizeParam' => false,
            ],
            yii\data\Sort::class => [
                'class' => app\components\Sort::class,
            ],
            yii\filters\AjaxFilter::class => [
                'errorMessage' => 'Invalid request.',
            ],
            yii\widgets\DetailView::class => [
                'options' => ['class' => 'table table-striped table-bordered table-dark detail-view'],
            ],
            yii\grid\GridView::class => [
                'layout' => '{items}',
                'tableOptions' => ['class' => 'table table-striped table-bordered table-dark'],
            ],
            yii\widgets\ActiveField::class => [
                'errorOptions' => ['class' => 'invalid-feedback'],
            ],
            yii\widgets\ActiveForm::class => [
                'validateOnBlur' => false,
                'validationStateOn' => yii\widgets\ActiveForm::VALIDATION_STATE_ON_INPUT,
                'errorCssClass' => 'is-invalid',
                'successCssClass' => 'is-valid',
            ],
            yii\widgets\LinkPager::class => [
                'maxButtonCount' => false,
                'prevPageLabel' => '<i class="fas fa-angle-left"></i>',
                'nextPageLabel' => '<i class="fas fa-angle-right"></i>',
                'firstPageLabel' => '<i class="fas fa-angle-double-left"></i>',
                'lastPageLabel' => '<i class="fas fa-angle-double-right"></i>',
                'firstPageCssClass' => 'first page-item w-25',
                'hideOnSinglePage' => false,
                'nextPageCssClass' => 'next page-item w-25',
                'prevPageCssClass' => 'prev page-item w-25',
                'lastPageCssClass' => 'last page-item w-25',
                'linkOptions' => ['class' => 'page-link text-center'],
                'disabledListItemSubTagOptions' => ['tag' => 'span', 'class' => 'page-link text-center'],
                'options' => ['class' => 'pagination my-4'],
            ],
            yii\widgets\Pjax::class => [
                'scrollTo' => 0,
            ],
            app\widgets\ToastrNotification::class => [
                'options' => [
                    'escapeHtml' => true,
                    'timeOut' => 3600,
                    'positionClass' => 'toast-bottom-full-width',
                ],
            ],
        ],
    ],
    'params' => [
        'embed-track' => [
            'Bandcamp' => 'size=large/tracklist=false/bgcol=333333/linkcol=cc6055/',
            'SoundCloud' => '&show_comments=false&visual=true',
            'YouTube' => '&showinfo=0&playsinline=1',
        ],
        'embed-track-modal' => [
            'Bandcamp' => 'size=large/tracklist=false/artwork=small/bgcol=333333/linkcol=cc6055/',
            'SoundCloud' => '&show_comments=false',
            'YouTube' => '&showinfo=0&playsinline=1',
        ],
        'embed-playlist' => [
            'SoundCloud' => '&show_comments=false&color=cc6055&show_playcount=false',
            'YouTube' => '&playsinline=1',
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['container']['definitions'] += [
        yii\bootstrap\BootstrapAsset::class => [
            'sourcePath' => '@vendor/twbs/bootstrap/dist',
        ],
        yii\bootstrap\BootstrapPluginAsset::class => [
            'sourcePath' => '@vendor/twbs/bootstrap/dist',
        ],
        yii\gii\TypeAheadAsset::class => [
            'sourcePath' => '@app/node_modules/typeahead.js/dist',
        ],
        yii\web\JqueryAsset::class => [
            'sourcePath' => '@app/node_modules/jquery/dist',
        ],
        yii\widgets\PjaxAsset::class => [
            'sourcePath' => '@app/node_modules/yii2-pjax',
        ],
    ];
}

return yii\helpers\ArrayHelper::merge(require __DIR__.'/common.php', $config);
