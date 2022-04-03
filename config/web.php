<?php

 declare(strict_types=1);

$config = [
    'id' => 'plusarchive',
    'defaultRoute' => 'track',
    // 'catchAll' => ['site/offline/index'],
    'components' => [
        'request' => [
            'cookieValidationKey' => $_SERVER['COOKIE_VALIDATION_KEY'],
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
                '<controller:\w+>s/<id:\d+>' => '<controller>/view',
                '<controller:[\w-]+>s/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[\w-]+>s/<action:(admin|create|now|list|stop-all-urge)>' => '<controller>/<action>',
                '<controller:(track|playlist)>s/<id:[\w-]+>' => '<controller>/view',
                '' => 'site/home/index',
            ],
        ],
        'errorHandler' => [
            /** @see app\controllers\site\ErrorController */
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
                'template' => '<p>{image} <span class="captcha-refresh">'.
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
                'options' => ['class' => 'table table-striped table-bordered detail-view'],
            ],
            yii\grid\GridView::class => [
                'layout' => '{items}',
                'tableOptions' => ['class' => 'table table-striped table-bordered'],
            ],
            yii\widgets\ActiveField::class => [
                'options' => ['class' => 'mb-3'],
                'errorOptions' => ['class' => 'invalid-feedback'],
                'labelOptions' => ['class' => 'form-label'],
                'hintOptions' => ['class' => 'form-text'],
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
                'firstPageCssClass' => 'page-item flex-fill',
                'nextPageCssClass' => 'page-item flex-fill',
                'prevPageCssClass' => 'page-item flex-fill',
                'lastPageCssClass' => 'page-item flex-fill',
                'hideOnSinglePage' => false,
                'linkOptions' => ['class' => 'page-link'],
                'disabledListItemSubTagOptions' => ['tag' => 'span', 'class' => 'page-link'],
                'options' => ['class' => 'pagination my-4 text-center'],
            ],
            yii\widgets\Pjax::class => [
                'scrollTo' => 0,
            ],
        ],
    ],
    'params' => [
        'embed-track' => [
            'Bandcamp' => 'size=large/tracklist=false/bgcol=333333/linkcol=c45c65/',
            'SoundCloud' => 'show_comments=false&color=c45c65&hide_related=true&visual=true',
            'YouTube' => 'playsinline=1',
        ],
        'embed-track-modal' => [
            'Bandcamp' => 'size=large/tracklist=false/artwork=small/bgcol=333333/linkcol=c45c65/',
            'SoundCloud' => 'show_comments=false&color=c45c65',
            'YouTube' => 'playsinline=1',
        ],
        'embed-playlist' => [
            'SoundCloud' => 'show_comments=false&color=c45c65&hide_related=true&show_playcount=false',
            'YouTube' => 'playsinline=1',
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['container']['definitions'] += [
        yii\web\JqueryAsset::class => [
            'sourcePath' => '@app/node_modules/jquery/dist',
        ],
        yii\widgets\PjaxAsset::class => [
            'sourcePath' => '@app/node_modules/yii2-pjax',
        ],
    ];
}

return yii\helpers\ArrayHelper::merge(require __DIR__.'/common.php', $config);
