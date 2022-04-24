<?php

declare(strict_types=1);

use yii\data\Pagination;
use yii\filters\AjaxFilter;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\JqueryAsset;
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\widgets\PjaxAsset;

$container = [
    'definitions' => [
        Pagination::class => [
            'pageSizeParam' => false,
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
        ActionColumn::class => [
            'icons' => [
                'eye-open' => '<i class="fas fa-fw fa-eye"></i>',
                'pencil' => '<i class="fas fa-fw fa-edit"></i>',
                'trash' => '<i class="fas fa-fw fa-trash"></i>',
            ],
            'buttonOptions' => [
                'class' => 'me-0 tag',
            ],
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
        Pjax::class => [
            'scrollTo' => 0,
        ],
    ]
];

if (YII_ENV_DEV) {
    $container['definitions'] += [
        JqueryAsset::class => [
            'sourcePath' => '@app/node_modules/jquery/dist',
        ],
        PjaxAsset::class => [
            'sourcePath' => '@app/node_modules/yii2-pjax',
        ],
    ];
}

return $container;
