<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$_ = Yii::$container;

$_->set(app\widgets\ToastrNotification::class, [
    'options' => [
        'escapeHtml' => true,
        'timeOut' => 3600,
        'positionClass' => 'toast-bottom-left',
    ],
]);
$_->set(dosamigos\selectize\SelectizeTextInput::class, [
    'options' => ['class' => 'form-control'],
    'clientOptions' => [
        'plugins' => ['remove_button'],
        'valueField' => 'name',
        'labelField' => 'name',
        'searchField' => ['name'],
        'create' => true,
    ],
]);
$_->set(yii\captcha\Captcha::class, [
    'template' => '<p>{image} <span class="captcha-refresh label label-default">'.
        '<i class="fa fa-fw fa-refresh"></i> Refresh</span></p>'."\n{input}",
]);
$_->set(yii\data\Pagination::class, [
    'pageSizeParam' => false,
]);
$_->set(yii\data\Sort::class, [
    'class' => app\data\Sort::class,
]);
$_->set(yii\grid\GridView::class, [
    'layout' => '{items}{pager}',
]);
$_->set(yii\widgets\ActiveForm::class, [
    'validateOnBlur' => false,
]);
$_->set(yii\widgets\LinkPager::class, [
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
]);
$_->set(yii\widgets\Pjax::class, [
    'scrollTo' => 0,
]);
