<?php

declare(strict_types=1);

use app\components\Formatter;
use app\components\Sort;
use app\controllers\site\ErrorController;
use app\models\User;
use yii\data\Pagination;
use yii\data\Sort as BaseSort;
use yii\debug\Module as DebugModule;
use yii\filters\AjaxFilter;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\web\JqueryAsset;
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\widgets\PjaxAsset;

$config = [
    'id' => 'web',
    // 'catchAll' => ['site/offline/index'],
    'components' => [
        'request' => [
            'cookieValidationKey' => $_SERVER['COOKIE_VALIDATION_KEY'],
        ],
        'user' => [
            'identityClass' => User::class,
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
    'container' => [
        'definitions' => [
            Pagination::class => [
                'pageSizeParam' => false,
            ],
            BaseSort::class => [
                'class' => Sort::class,
            ],
            AjaxFilter::class => [
                'errorMessage' => 'Invalid request.',
            ],
            DetailView::class => [
                'options' => ['class' => 'table table-striped table-bordered detail-view'],
            ],
            GridView::class => [
                'layout' => '{items}',
                'tableOptions' => ['class' => 'table table-striped table-bordered'],
            ],
            ActiveField::class => [
                'options' => ['class' => 'mb-3'],
                'errorOptions' => ['class' => 'invalid-feedback'],
                'labelOptions' => ['class' => 'form-label'],
                'hintOptions' => ['class' => 'form-text'],
            ],
            ActiveForm::class => [
                'validateOnBlur' => false,
                'validationStateOn' => ActiveForm::VALIDATION_STATE_ON_INPUT,
                'errorCssClass' => 'is-invalid',
                'successCssClass' => 'is-valid',
            ],
            LinkPager::class => [
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
        'class' => DebugModule::class,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['container']['definitions'] += [
        JqueryAsset::class => [
            'sourcePath' => '@app/node_modules/jquery/dist',
        ],
        PjaxAsset::class => [
            'sourcePath' => '@app/node_modules/yii2-pjax',
        ],
    ];
}

return ArrayHelper::merge(require __DIR__.'/common.php', $config);
